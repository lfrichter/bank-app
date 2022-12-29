<template>
    <div>
        <section class="bg-gray-50 dark:bg-purple-900">
            <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <logo-asset></logo-asset>
                    <div class="pl-2">Login Admin</div>
                </a>
                <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Sign in to your account
                        </h1>
                        <form class="space-y-4 md:space-y-6" action="#">

                             <div v-if="displayErrors.active" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                                <div class="block" v-for="items in errors" :key="items">
                                    <p class="block" v-for="item in items" :key="item">
                                        {{ item }}
                                    </p>
                                </div>
                                <a href="#" @click="closeError" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                </a>
                            </div>

                            <div>
                                <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                                <input type="email" name="email" id="email" v-model="formData.email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                            </div>
                            <div>
                                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                <input type="password" name="password" id="password" v-model="formData.password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                            </div>
                            <button type="submit" @click="handleSubmit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign in</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script lang="ts">
import { Login } from '../interfaces';
import { AuthService } from '../services';
import { defineComponent, ref, onMounted, watch, watchEffect, shallowRef, triggerRef} from 'vue'
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'
import { store } from '../store/vuex';
import LogoAsset from '../components/LogoAsset.vue'

export default defineComponent({
    name: 'LoginAdmin',
    components: { LogoAsset },
    setup(props, context){
        const store = useStore()
        const formData = ref(AuthService.getLoginForm());
        let errors = shallowRef({ messages: [] })
        let displayErrors = shallowRef({active: false});
        const router = useRouter();

        function handleSubmit(e: any) {
            e.preventDefault()
            AuthService.adminLogin(formData.value as Login)
                .then(response => {
                    if(response.success){
                        store.dispatch('setLogin', { user: response.user, token: response.token, admin: true })
                        router.push({ path: '/admin', name: 'Checks-Control'})
                    }else{
                        displayErrors.value.active = true
                        triggerRef(displayErrors)
                        errors.value = {...response.messages}
                        triggerRef(errors)
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        }

        function closeError() {
            displayErrors.value.active = false
            triggerRef(displayErrors)
            errors.value = { messages: [] }
            triggerRef(errors)
        }

        return {
            formData,
            errors,
            displayErrors,
            handleSubmit,
            closeError

        }

    },
    beforeRouteEnter(to, from, next) {
        if (store.state.authenticated && store.state.admin) {
            return next('/admin')
        }
        if (store.state.authenticated && !store.state.admin) {
            return next('/')
        }
        next()
    }
})
</script>

<style lang="" scoped>

</style>
