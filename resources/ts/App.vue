<template>
    <div>
        <template v-if="state.authenticated">
            <span v-if="isAdmin && state.admin">
                <admin-layout></admin-layout>
            </span>
            <span v-else>
                <app-layout></app-layout>
            </span>
        </template>
        <router-view></router-view>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, watch, watchEffect, shallowRef, triggerRef} from 'vue'
import { useRouter } from 'vue-router'
import { state } from './state/index'
import AdminLayout from './layouts/AdminLayout.vue'
import AppLayout from './layouts/AppLayout.vue'

export default defineComponent({
    name: 'App',
    components: {
        AppLayout,
        AdminLayout
    },
    setup(props, context){
        const currentState = ref(state);
        const router = useRouter();
        let isLoggedIn = ref(false)
        let isAdmin = ref(false)
        let firstFolder = ref('')

        function setLoggedIn() {
            if (window.Laravel.isLoggedin) {
                isLoggedIn.value = true
            }
        }

        function setFirstFolderLocation() {
            let loc = window.location.href;
            loc = loc.replace(window.origin + '/', '') + '/dfsdfdsfs'
            console.log(loc.indexOf("/"))
            if(loc.indexOf("/")){
                loc = loc.substring(0, loc.indexOf("/"))
            }
            firstFolder.value = loc
        }

        function setAdmin() {
            if (firstFolder.value === 'admin') {
                isAdmin.value = true;
            }
        }

        onMounted(() => {
            setLoggedIn()
            setFirstFolderLocation()
            setAdmin()
        })

        return {
            currentState,
            router,
            isLoggedIn,
            isAdmin,
            firstFolder,
            state
        }

    }
})
</script>

<style>

</style>
