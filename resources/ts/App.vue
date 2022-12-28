<template>
    <div>
        <template v-if="store.state.authenticated">
            <span v-if="isAdmin">
                <admin-layout @goLogout="logout"></admin-layout>
            </span>
            <span v-else>

                <app-layout @goLogout="logout"></app-layout>
            </span>
        </template>
        <router-view></router-view>
    </div>
</template>

<script lang="ts">
import { defineComponent, ref, onMounted, onBeforeMount, computed} from 'vue'
import { useRouter } from 'vue-router'
import { useStore } from 'vuex'
import { AuthService } from './services';
import AdminLayout from './layouts/AdminLayout.vue'
import AppLayout from './layouts/AppLayout.vue'

export default defineComponent({
    name: 'App',
    components: {
        AppLayout,
        AdminLayout
    },
    setup(props, context){
        const store = useStore()
        const router = useRouter();
        let isAdminFolder = ref(false)
        const isAdmin = computed(() => { return isAdminFolder && store.state.admin})
        let firstFolder = ref('')

        function setFirstFolderLocation() {
            let loc = window.location.href;
            loc = loc.replace(window.origin + '/', '') + '/dfsdfdsfs'
            if(loc.indexOf("/")){
                loc = loc.substring(0, loc.indexOf("/"))
            }
            firstFolder.value = loc
        }

        function setAdminFolder() {
            if (firstFolder.value === 'admin') {
                isAdminFolder.value = true;
            }
        }

        function logout() {
            AuthService.logout(store.state.token)
                .then(response => {
                    if(response.success){
                        store.dispatch('setLogoff')
                        router.push('/login')
                    }else{
                       console.log(response)
                    }
                })
                .catch((error) => {
                    console.error(error);
                });
        }

        onBeforeMount(() => {
            setFirstFolderLocation()
        })

        onMounted(() => {
            setAdminFolder()
        })

        return {
            router,
            isAdmin,
            firstFolder,
            store,
            logout
        }

    }
})
</script>

<style>

</style>
