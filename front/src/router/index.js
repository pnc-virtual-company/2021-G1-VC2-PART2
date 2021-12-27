import Vue from 'vue'
import VueRouter from 'vue-router'
// import StudentView from '../components/views/StudentView.vue'
import StudentDetail from '../components/views/StudentDetail.vue'


Vue.use(VueRouter)

const routes = [
  {
    // path:'/', component: StudentView,
    path:'/', component: StudentDetail

  },
  
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

export default router
