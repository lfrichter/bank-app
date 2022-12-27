import './bootstrap';
import * as _ from 'lodash';
import axios from './bootstrap';
import '../css/app.css'
import type { RouteRecordRaw } from 'vue-router';

import App from './App.vue'
import Home from './pages/Home.vue'
import Login from './pages/Login.vue'
import Register from './pages/Register.vue'
import Dashboard from './pages/Dashboard.vue'
import { createApp } from 'vue'
import { createRouter, createWebHistory } from 'vue-router'


const routes = [
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/register',
            name: 'Register',
            component: Register
        },
        {
            path: '/dashboard',
            name: 'Dashboard',
            component: Dashboard
        },
    ];

const router = createRouter({
    history: createWebHistory(),
    routes: routes as RouteRecordRaw[]
})

const app = createApp(App)
app.config.globalProperties.$http = axios;
app.use(router)
app.mount("#app")
