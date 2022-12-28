<template>
    <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
        <p class="text-gray-700 font-bold mb-5 text-lg">
            Check Detail
        </p>
        <div class="grid grid-cols-1 gap-1">

            <div v-if="check" class="p-2 border-cyan-800 rounded-md" id="pending" role="tabpanel" aria-labelledby="pending-tab">

                <div class="grid grid-cols-2 gap-0">
                    <div class="border-red-800 bg-gray-300 p-4 rounded-tl-md rounded-bl-md">
                        <span class="text-sm text-gray-500">Customer</span><br />
                        {{ user.name }}
                    </div>
                    <div class="bg-gray-300 p-4 rounded-tr-md rounded-br-md text-right font-semibold text-gray-900 dark:text-white align-middle">
                        <div class="flex justify-end">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-0 pt-2">
                    <div class="border-red-800 bg-gray-300 p-4 rounded-tl-md rounded-bl-md">
                        <span class="text-sm text-gray-500">Customer E-mail</span><br />
                        {{ user.email }}
                    </div>
                    <div class="bg-gray-300 p-4 rounded-tr-md rounded-br-md text-right font-semibold text-gray-900 dark:text-white align-middle">
                        <div class="flex justify-end">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-0 pt-2">
                    <div class="border-red-800 bg-gray-300 p-4 rounded-tl-md rounded-bl-md">
                        <span class="text-sm text-gray-500">Account</span><br />
                        {{ getAccountNumber(user.id) }}
                    </div>
                    <div class="bg-gray-300 p-4 rounded-tr-md rounded-br-md text-right font-semibold text-gray-900 dark:text-white align-middle">
                        <div class="flex justify-end">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-0 pt-2">
                    <div class="border-red-800 bg-gray-300 p-4 rounded-tl-md rounded-bl-md">
                        <span class="text-sm text-gray-500">Reported Amount</span><br />
                        ${{ check.amount }} USD
                    </div>
                    <div class="bg-gray-300 p-4 rounded-tr-md rounded-br-md text-right font-semibold text-gray-900 dark:text-white align-middle">
                        <div class="flex justify-end">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-0 pt-1">
                    <div class="border-red-800 bg-gray-300 p-4 rounded-md w-full">
                        <img :src="check.image">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-2 pt-4">
                    <button type="submit" @click="updateStatus('rejected')" class="w-full bg-white hover:bg-white focus:ring-4 outline outline-inset-2 text-blue-600 outline-blue-500 focus:outline-none focus:ring-white font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-white dark:hover:bg-white dark:focus:ring-white">Reject</button>
                    <button type="submit" @click="updateStatus('accepted')" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Accept</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onBeforeMount, computed, watch} from 'vue'
import { useRouter } from 'vue-router'
import { BalanceService } from '../services';
import { Check } from '../interfaces';
import { useStore } from 'vuex'
import { store } from '../store/vuex';

export default defineComponent({
    name: 'CheckDetail',
    setup(props, context){
        const store = useStore()
        const router = useRouter();
        const checkId = computed(() => router.currentRoute.value.params.id);
        let check = ref({} as Check);
        let user = ref({});
        const month = ref({
            month: new Date().getMonth(),
            year: new Date().getFullYear()
        });
        let checkStatus = ref('pending')

        function goDeposit() {
            router.push('/deposit')
        }

        // Fake account number based in user id
        function getAccountNumber(userId: number) : number {
            return parseInt(`${userId}00000`) + 256
        }

        function getCheck() {
            BalanceService.getCheckDetail(checkId.value, store.state.token)
                .then(response => {
                    if(response){
                        check.value = response
                        user.value = response.user as Object
                    }
                })
                .catch(error => {
                    console.error(error);
                })
        }

        function updateStatus(status: string) {
            BalanceService.updateCheck(checkId.value, status, store.state.token)
                .then(response => {
                    if(response){
                        check.value = response
                        router.push('/admin')
                    }
                })
                .catch(error => {
                    console.error(error);
                })

        }

        onBeforeMount(() => {
            getCheck();
        });

        return {
            check,
            user,
            goDeposit,
            month,
            updateStatus,
            getAccountNumber
        }
    },
    beforeRouteEnter(to, from, next) {
        if (store.state.authenticated && !store.state.admin) {
            return next('/')
        }
        next()
    }
})
</script>

<style lang="" scoped>

</style>
