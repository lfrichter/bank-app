import { RouteRecordRaw } from 'vue-router'
import { createRouter, createWebHistory } from 'vue-router'
import Home from '../pages/Home.vue'
import Login from '../pages/Login.vue'
import Register from '../pages/Register.vue'
import Balance from '../pages/Balance.vue'
import Expenses from '../pages/Expenses.vue'
import Checks from '../pages/Checks.vue'
import Deposit from '../pages/Deposit.vue'
import Purchase from '../pages/Purchase.vue'
import ChecksControl from '../admin/ChecksControl.vue'
import CheckDetail from '../admin/CheckDetail.vue'
import LoginAdmin from '../admin/LoginAdmin.vue'
import { store } from '../store/vuex'

const routes = [
        {
            path: '/balance',
            name: 'Balance',
            component: Balance,
            meta: { requiresAuth: true },
        },
        {
            path: '/login',
            name: 'Login',
            component: Login
        },
        {
            path: '/',
            name: 'Home',
            component: Home,
            meta: { requiresAuth: true },
        },
        {
            path: '/register',
            name: 'Register',
            component: Register
        },
        {
            path: '/expenses',
            name: 'Expenses',
            component: Expenses,
            meta: { requiresAuth: true },
        },
        {
            path: '/checks',
            name: 'Checks',
            component: Checks,
            meta: { requiresAuth: true },
        },
        {
            path: '/deposit',
            name: 'Deposit',
            component: Deposit,
            meta: { requiresAuth: true },
        },
        {
            path: '/purchase',
            name: 'Purchase',
            component: Purchase,
            meta: { requiresAuth: true },
        },
        {
            path: '/admin',
            name: 'Checks-Control',
            component: ChecksControl,
            meta: { requiresAuth: true },
        },
        {
            path: '/admin/login',
            name: 'Login-Admin',
            component: LoginAdmin
        },
        {
            path: '/admin/check-detail/:id',
            name: 'Check-Detail',
            component: CheckDetail,
            meta: { requiresAuth: true },
        }
    ];

const router = createRouter({
    history: createWebHistory(),
    routes: routes as RouteRecordRaw[]
})

function getFirstFolderLocation() {
    let loc = window.location.href;
    loc = loc.replace(window.origin + '/', '') + '/'
    if(loc.indexOf("/")){
        loc = loc.substring(0, loc.indexOf("/"))
    }
    return loc
}

 router.beforeEach((to, from, next) => {
    // console.log(store.state)
    if (to.matched.some((record) => record.meta.requiresAuth)) { // <-- check for requiresAuth here
        if (!store.state.authenticated) {
            if(getFirstFolderLocation() === 'admin') {
                next('/admin/login')
            }else{
                next('/login')
            }
        } else {
            if(store.state.admin && getFirstFolderLocation() !== 'admin') {
                console.log('getFirstFolderLocation', getFirstFolderLocation())
                next('/admin')
            }
            next()
        }
    } else {
        next()
    }
  })

export default router
