<template>
    <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
        <p class="text-gray-700 font-bold mb-5 text-lg">
            Checks
        </p>
        <div class="grid grid-cols-1 gap-1">
            <Datepicker v-model="month" month-picker class="pb-2"></Datepicker>



            <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                    <li class="mr-2" role="presentation">
                        <button @click="setPending" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-400 dark:hover:text-gray-400" id="pending-tab" data-tabs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="false">PENDING</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button @click="setAccepted" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-400 dark:hover:text-gray-400" id="accepted-tab" data-tabs-target="#accepted" type="button" role="tab" aria-controls="accepted" aria-selected="false">ACCEPTED</button>
                    </li>
                    <li class="mr-2" role="presentation">
                        <button @click="setRejected" class="inline-block p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-400 dark:hover:text-gray-400" id="rejected-tab" data-tabs-target="#rejected" type="button" role="tab" aria-controls="rejected" aria-selected="false">REJECTED</button>
                    </li>
                </ul>
            </div>
            <div id="myTabContent">
                <div class="p-2 bg-gray-300 rounded-md"  :class="{ 'hidden': !displayTab.pending }" id="pending" role="tabpanel" aria-labelledby="pending-tab">

                    <div class="grid grid-cols-2 gap-0" v-for="check in checks.pendings" :key="check">
                        <div class="bg-white p-4 mb-4 rounded-tl-md rounded-bl-md">
                            <span class="text-base">{{ check.description }}</span><br />
                            <span class="text-xs">{{ check.created_at }}</span>
                        </div>
                        <div class="bg-white to-blue-300 p-4 mb-4 rounded-tr-md rounded-br-md text-right font-semibold text-gray-500">
                        <span class="inline-block align-middle">
                                {{ check.amount }}
                        </span>
                        </div>
                    </div>

                </div>
                <div class="p-2 bg-blue-400 rounded-md"  :class="{ 'hidden': !displayTab.accepted }" id="accepted" role="tabpanel" aria-labelledby="accepted-tab">

                    <div class="grid grid-cols-2 gap-0" v-for="accepted in checks.accepted" :key="accepted">
                        <div class="bg-white p-4 mb-4 rounded-tl-md rounded-bl-md">
                            <span class="text-base">{{ accepted.description }}</span><br />
                            <span class="text-xs">{{ accepted.created_at }}</span>
                        </div>
                        <div class="bg-white to-blue-300 p-4 mb-4 rounded-tr-md rounded-br-md text-right font-semibold text-blue-500">
                        <span class="inline-block align-middle">
                                {{ accepted.amount }}
                        </span>
                        </div>
                    </div>

                </div>
                <div class="p-2 bg-red-300 rounded-md"  :class="{ 'hidden': !displayTab.rejected }" id="rejected" role="tabpanel" aria-labelledby="rejected-tab">

                     <div class="grid grid-cols-2 gap-0" v-for="rejected in checks.rejected" :key="rejected">
                        <div class="bg-white p-4 mb-4 rounded-tl-md rounded-bl-md">
                            <span class="text-base">{{ rejected.description }}</span><br />
                            <span class="text-xs">{{ rejected.created_at }}</span>
                        </div>
                        <div class="bg-white to-blue-300 p-4 mb-4 rounded-tr-md rounded-br-md text-right font-semibold text-red-500">
                        <span class="inline-block align-middle">
                                {{ rejected.amount }}
                        </span>
                        </div>
                    </div>

                </div>
            </div>



            <div class="pt-6 text-right">
                <button type="button" @click="goDeposit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    <span class="sr-only">Icon description</span>
                </button>
            </div>


        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, watch} from 'vue'
import { useRouter } from 'vue-router'
import { BalanceService } from '../services';
import { Checks } from '../interfaces';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'
import { useStore } from 'vuex'

export default defineComponent({
    name: 'Checks',

    components: { Datepicker },
    setup(){
        const store = useStore()
        const router = useRouter();
        let checks = ref([] as Checks);
        const month = ref({
            month: new Date().getMonth(),
            year: new Date().getFullYear()
        });
        let displayTab = ref({
            pending: true,
            accepted: false,
            rejected: false
        })
        let checkStatus = ref('pending')

        function goDeposit() {
            router.push('/deposit')
        }

        function getChecks() {
            BalanceService.getChecks(month.value, store.state.token)
                .then(response => {
                    if(response){
                        checks.value = response
                    }
                })
                .catch(error => {
                    console.error(error);
                })
        }

        function setPending()
        {
            displayTab.value = { pending: true, accepted: false, rejected: false }
            checkStatus.value = 'pending'
        }

        function setAccepted()
        {
            displayTab.value = { pending: false, accepted: true, rejected: false}
            checkStatus.value = 'accepted'
        }

        function setRejected()
        {
            displayTab.value = { pending: false, accepted: false, rejected: true}
            checkStatus.value = 'rejected'
        }


        watch(month, () => {
            getChecks();
        })

        onMounted(() => {
            getChecks();
        });

        return {
            checks,
            goDeposit,
            month,
            displayTab,
            setPending,
            setAccepted,
            setRejected
        }
    }
})
</script>

<style lang="" scoped>

</style>
