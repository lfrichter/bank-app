<template>
    <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
        <p class="text-gray-700 font-bold mb-5 text-lg">
            Purchase
        </p>
        <div class="grid grid-cols-1 gap-1 md:mt-0 sm:max-w-md">

            <current-balance></current-balance>

            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-500 dark:border-gray-500">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
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
                            <label for="amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount</label>
                            <input type="number" name="amount" id="amount" v-model="formData.amount" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="USD" required="">
                        </div>
                        <div>
                            <label for="created_at" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                            <input type="date" name="created_at" id="created_at" v-model="formData.created_at" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <input type="text" name="description" id="description" v-model="formData.description" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <button type="submit" @click="handleSubmit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Add Purchase</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, shallowRef, triggerRef, onMounted} from 'vue'
import { Purchase } from '../interfaces';
import { useRouter } from 'vue-router'
import { PurchaseService } from '../services';
import CurrentBalance from '../components/CurrentBalance.vue';
import { useStore } from 'vuex'

export default defineComponent({
    name: 'Purchase',
    components: { CurrentBalance },
    setup(){
        const store = useStore()
        const formData = ref(PurchaseService.getPurchaseForm());
        let errors = shallowRef({ messages: [] })
        let displayErrors = shallowRef({active: false});
        const router = useRouter();

        function handleSubmit(e: any) {
            e.preventDefault()
            PurchaseService.addPurchase(formData.value as Purchase, store.state.token)
                .then(response => {
                    if(response.success){
                        console.log("Added purchase")
                        console.log(response)
                        router.push('/expenses')
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
            router,
            errors,
            displayErrors,
            handleSubmit,
            closeError,
            store
        }
    }
})
</script>

<style lang="" scoped>

</style>
