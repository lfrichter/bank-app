<template>
 <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
        <p class="text-gray-700 font-bold mb-5 text-lg">
            Balance
        </p>
        <div class="grid grid-cols-1 gap-1">
            <Datepicker v-model="month" month-picker class="pb-2"></Datepicker>
            <current-balance></current-balance>

            <div class="grid grid-cols-1 gap-1">
                <div class="rounded-md">
                    <div class="grid grid-cols-2 gap-0">
                        <div class="border-red-800 bg-blue-300 p-4 rounded-tl-md rounded-bl-md">
                            <span class="text-sm">Incomes</span>
                            ${{ balances.incomes }}
                        </div>
                        <div class="bg-blue-300 p-4 rounded-tr-md rounded-br-md text-right font-semibold text-gray-900 dark:text-white align-middle">
                            <div class="flex justify-end">
                                <a href="#"  @click="goChecks" class="flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-2 h-2" class="w-7 h-7 pr-1">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Deposit a check
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

             <div class="grid grid-cols-1 gap-1">
                <div class="rounded-md">
                    <div class="grid grid-cols-2 gap-0">
                        <div class="border-red-800 bg-red-300 p-4 rounded-tl-md rounded-bl-md">
                            <span class="text-sm">Expenses</span>
                            ${{ balances.expenses }}
                        </div>
                        <div class="bg-red-300 p-4 rounded-tr-md rounded-br-md text-right font-semibold text-gray-900 dark:text-white align-middle">
                            <div class="flex justify-end">
                                <a href="#" @click="goPurchase" class="flex justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="w-2 h-2" class="w-7 h-7 pr-1">
                                        <path strokeLinecap="round" strokeLinejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Purchase
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-md pt-2">
                <div class="grid grid-cols-2 gap-0" v-for="balance in balances.balances" :key="balance">
                    <div class="bg-white p-4 mb-4 rounded-tl-md rounded-bl-md">
                        <span class="text-base">{{ balance.description }}</span><br />
                        <span class="text-xs">{{ balance.created_at }}</span>
                    </div>
                    <div class="bg-white p-4 mb-4 rounded-tr-md rounded-br-md text-right font-semibold " :class="Math.sign(balance.amount) >= 0 ? 'text-blue-500' : 'text-red-500'">
                       <span class="inline-block align-middle">
                            {{ balance.amount }}
                       </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, watch} from 'vue'
import { useRouter } from 'vue-router'
import { BalanceService } from '../services';
import { Balance } from '../interfaces';
import CurrentBalance from '../components/CurrentBalance.vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { useStore } from 'vuex'

export default defineComponent({
    name: 'Balance',
    components: { CurrentBalance, Datepicker },
    setup(){
        const store = useStore()
        const router = useRouter()
        let balances = ref([] as Balance[])
        const month = ref({
            month: new Date().getMonth(),
            year: new Date().getFullYear()
        });

        function getBalances() {
            BalanceService.get(month.value, store.state.token)
                .then(response => {
                    if(response as Balance[]){
                        balances.value = response
                    }
                })
                .catch(error => {
                    console.error(error);
                })
        }

        function goPurchase() {
            router.push('/purchase')
        }

        function goChecks() {
            router.push('/checks')
        }

        watch(month, () => {
            getBalances()
        })

        onMounted(() => {
            getBalances()
        });

        return {
            balances,
            month,
            goPurchase,
            goChecks
        }
    }
})
</script>

<style lang="" scoped>

</style>
