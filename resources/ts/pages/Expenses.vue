<template>
    <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
        <p class="text-gray-700 font-bold mb-5 text-lg">
            Expenses
        </p>
        <div class="grid grid-cols-1 gap-1">
            <Datepicker v-model="month" month-picker class="pb-2"></Datepicker>
            <div class="border-cyan-800 rounded-md">
                <div class="grid grid-cols-2 gap-0" v-for="expense in expenses" :key="expense">
                    <div class="bg-white p-4 mb-4 rounded-tl-md rounded-bl-md">
                        <span class="text-base">{{ expense.description }}</span><br />
                        <span class="text-xs">{{ expense.created_at }}</span>
                    </div>
                    <div class="bg-white to-blue-300 p-4 mb-4 rounded-tr-md rounded-br-md text-right font-semibold text-red-500">
                       <span class="inline-block align-middle">
                            {{ expense.amount }}
                       </span>
                    </div>
                </div>

                <div class="pt-6 text-right">
                    <button type="button" @click="goPurchase" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        <span class="sr-only">Icon description</span>
                    </button>
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
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { useStore } from 'vuex'

export default defineComponent({
    name: 'Expenses',
    components: { Datepicker },
    setup(){
        const store = useStore()
        const router = useRouter();
        let expenses = ref([] as Balance[]);
        const month = ref({
            month: new Date().getMonth(),
            year: new Date().getFullYear()
        });

        function goPurchase() {
            router.push('/purchase')
        }

        function getExpenses() {
            BalanceService.getExpenses(month.value, store.state.token)
                .then(response => {
                    if(response as Balance[]){
                        expenses.value = response
                    }
                })
                .catch(error => {
                    console.error(error);
                })
        }

        watch(month, () => {
            getExpenses()
        })

        onMounted(() => {
            getExpenses()
        });

        return {
            expenses,
            goPurchase,
            month
        }
    }
})
</script>

<style lang="" scoped>

</style>
