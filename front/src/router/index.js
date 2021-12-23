import Vue from 'vue'
import VueRouter from 'vue-router'
<<<<<<< HEAD
import formPermission from "../components/ui/formPermission.vue";


Vue.use(VueRouter)

const routes = [
  { path: '/', component: formPermission },
=======
import Permission from '../components/views/Permission.vue'
Vue.use(VueRouter)

const routes = [
    { path: "/", component: Permission }
>>>>>>> 9d2bf7b15e72899ef8d1a2dce063e3125e129bb1
]

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})

export default router