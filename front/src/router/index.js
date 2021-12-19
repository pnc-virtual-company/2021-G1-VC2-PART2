import Vue from 'vue'
import VueRouter from 'vue-router'
import signform from '../components/signin/signform.vue';
import Navigation from '../components/nav/Navigation.vue';

Vue.use(VueRouter)

const routes = [
    {path: '/' , component: signform},
    {path: '/signin' , component: signform},
    {path: '/navigation' , component: Navigation},
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
