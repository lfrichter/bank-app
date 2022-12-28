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
import { defineComponent } from 'vue'
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'

export default defineComponent({
    name: 'Home',
    setup(){
        const store = useStore()
        const router = useRouter()

        return {
            router,
            store
        }
    }
})
</script>
