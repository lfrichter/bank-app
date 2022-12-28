import './bootstrap'
import '../css/app.css'

import App from './App.vue'
import router from './router'
import { createApp } from 'vue'
import { store } from './store/vuex'

const app = createApp(App)
app.use(store)
app.use(router)
app.mount("#app")
store.commit('initialiseStore')

