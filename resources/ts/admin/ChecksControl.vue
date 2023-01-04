<template>
    <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
        <p class="text-gray-700 font-bold mb-5 text-lg">
            Checks control
        </p>
        <div class="grid grid-cols-1 gap-1">

            <span v-if="checks.pendings && checks.pendings.length > 0">
                <div class="p-2 border-cyan-800 rounded-md" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="grid grid-cols-2 gap-0" v-for="check in checks.pendings" :key="check">
                        <div class="bg-white p-4 mb-4 rounded-tl-md rounded-bl-md">
                            <a href="#" @click="goCheckDetail(check.id)">
                                <span class="text-base">{{ check.description }}</span><br />
                                <span class="text-xs">{{ check.created_at }}</span>
                            </a>
                        </div>
                        <div class="bg-white to-blue-300 p-4 mb-4 rounded-tr-md rounded-br-md text-right font-semibold text-blue-500">
                            <a href="#" @click="goCheckDetail(check.id)">
                                <span class="inline-block align-middle">
                                    {{ check.amount }}
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </span>

            <span v-else>
                <div class="p-2 border-cyan-800 rounded-md" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="bg-white p-4 mb-4 rounded">
                        No checks are pending!
                    </div>
                </div>
            </span>




        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onBeforeMount, onMounted, watch} from 'vue'
import { useRouter } from 'vue-router'
import { BalanceService } from '../services';
import { Checks } from '../interfaces';
import { useStore } from 'vuex'
import { store } from '../store/vuex';

export default defineComponent({
    name: 'ChecksControl',
    setup(){
        const store = useStore()
        const router = useRouter();
        let checks = ref([] as Checks);
        const month = ref({
            month: new Date().getMonth(),
            year: new Date().getFullYear()
        });
        let checkStatus = ref('pending')

        function goCheckDetail(id: number) {
            router.push('/admin/check-detail/'+id)
        }

        function getChecks() {
            BalanceService.getAdminChecks(month.value, store.state.token)
                .then(response => {
                    if(response){
                        checks.value = response
                    }
                })
                .catch(error => {
                    console.error(error);
                })
        }

        // onBeforeMount(() => {
        //     getChecks();
        // });

        onMounted(() => {
            getChecks();
        });

        return {
            checks,
            goCheckDetail,
            month
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
