import Vue from 'vue'
import VueRouter from 'vue-router'
import signform from '../components/signin/signform.vue';
import StudentView from '../components/views/StudentView.vue';
import Users from '../components/views/Users.vue';
import Permission from '../components/views/Permission.vue';
import Disciple from '../components/views/Disciple.vue';
Vue.use(VueRouter)

const routes = [
    {path: '/' , component: signform},
    {path: '/signin' , component: signform},
    {path: '/user' , component: Users},
    {path: '/student' , component: StudentView},
    {path: '/permission' , component: Permission},
    {path: '/disciple' , component: Disciple},
 
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
