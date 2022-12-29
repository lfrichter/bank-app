<template>
    <div>
        <img class="block h-10 w-auto lg:hidden" :src="addAsset('/images/logo.svg?color=indigo&shade=500')" alt="Bank">
        <img class="hidden h-10 w-auto lg:block" :src="addAsset('/images/logo.svg?color=indigo&shade=500')" alt="Bank">
    </div>
</template>
<script lang="ts">
import { defineComponent} from 'vue'
export default defineComponent({
    name: 'LogoAsset',
    setup(){
        const domain = window.location.protocol + '//'+ window.location.host
        function addAsset(file: string) {
            return domain + file
        }
        return {
            addAsset
        }
    }
})
</script>
