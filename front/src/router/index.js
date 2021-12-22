import Vue from 'vue'
import VueRouter from 'vue-router'
import formPermission from "../components/ui/formPermission.vue";


Vue.use(VueRouter)

const routes = [
  { path: '/', component: formPermission },
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
