<template>
 <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, watch} from 'vue'
import { state } from '../state/index'
import { useRouter } from 'vue-router'
import { BalanceService } from '../services';
import { Balance } from '../interfaces';
import CurrentBalance from '../components/CurrentBalance.vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css'

export default defineComponent({
    name: 'Expenses',
    components: { CurrentBalance, Datepicker },
    setup(){
        const router = useRouter()
        const currentState = ref(state)

        return {
            currentState,
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!state.authenticated) {
            return next('/login')
        }
        if (state.admin) {
            return next('/admin')
        }
        next();
    }
})
</script>

<style lang="" scoped>

</style>
