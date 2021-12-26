import Vue from 'vue'
import VueRouter from 'vue-router'
import Permission from '../components/views/Permission.vue'
Vue.use(VueRouter)

const routes = [
    { path: "/", component: Permission }
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router