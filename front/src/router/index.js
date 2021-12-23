import Vue from 'vue'
import VueRouter from 'vue-router'
import StudentView from '../components/views/StudentView.vue';
import Users from '../components/views/Users.vue';
import Permission from '../components/views/Permission.vue';
import Disciple from '../components/views/Disciple.vue';
import signinform from '../components/signin/signinform.vue';
Vue.use(VueRouter)

const routes = [
    {path: '/' , component: signinform},
    {path: '/signin' , component: signinform},
    {path: '/user' , component: Users},
    {path: '/student' , component: StudentView},
    {path: '/permission' , component: Permission},
    {path: '/disciple' , component: Disciple},
 
]
// let userID = localStorage.getItem('userid');

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
