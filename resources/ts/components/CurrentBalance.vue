<template>
    <div class="grid grid-cols-1 gap-1">
        <div class="rounded-md">
            <div class="grid grid-cols-2 gap-0">
                <div class="bg-gray-300 p-4 rounded-tl-md rounded-bl-md">
                    <span class="text-sm">Current Balance</span><br />
                    ${{ currentBalance.current_balance }}
                </div>
                <div class="bg-gray-300 p-4 rounded-tr-md rounded-br-md text-right font-semibold text-gray-900 dark:text-white align-middle">
                    <span class="inline-block align-middle">
                    </span>
                </div>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted} from 'vue'
import { BalanceService } from '../services';
import { Balance } from '../interfaces';
import { useStore } from 'vuex'

export default defineComponent({
    name: 'CurrentBalance',
    setup(){
        const store = useStore()
        let balances = ref([] as Balance[]);
        let currentBalance = ref({} as Balance);

        function getCurrentBalance() {
            BalanceService.getCurrentBalance(store.state.token)
                .then(response => {
                    if(response as Balance){
                        currentBalance.value = response
                    }
                })
                .catch(error => {
                    console.error(error);
                })
        }

        onMounted(() => {
            getCurrentBalance();
        });

        return {
            currentBalance,
            balances
        }
    }
})
</script>

<style lang="" scoped>

</style>
