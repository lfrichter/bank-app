<template>
    <div>
        <div class="container mx-auto bg-gray-200 rounded-xl shadow border p-8 m-10">
            <p class="text-3xl text-gray-700 font-bold mb-5">
                BNB <i class="fas fa-piggy-bank    "></i>
            </p>
            <p class="text-purple-500 text-lg">
                A manager to control your finances
            </p>
        </div>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, watch} from 'vue'
import { state } from '../state/index'
import { useRouter } from 'vue-router'

export default defineComponent({
    name: 'Home',
    setup(){
        const router = useRouter()
        const currentState = ref(state)

        return {
            router,
            currentState
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
