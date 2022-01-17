import Vue from 'vue'
import VueRouter from 'vue-router'
import StudentView from '../components/views/StudentView.vue';
import Users from '../components/views/Users.vue';
import Permission from '../components/views/Permission.vue';
import Disciple from '../components/views/Disciple.vue';
import signinform from '../components/signin/signinform.vue';
import NotAuthorized from '../components/nav/NotAuthorized.vue';

Vue.use(VueRouter)

const routes = [
     
    { 
        path: '/',
        component: signinform,

    },
    {
        path: '/signin',
        component: signinform
    },
    {
        path: '/user',
        component: Users,
        meta: { needLogin: true, needAdmin: true },
    },
    {
        path: '/student',
        component: StudentView,
        meta: { needLogin: true, needAdmin: true },
    },
    {
        path: '/permission',
        component: Permission,
        meta: { needLogin: true, needAdmin: true },
    },
    {
        path: '/disciple',
        component: Disciple,
        meta: { needLogin: true, needAdmin: true },
    },
    {
        path: "/:pathMatch(.*)*",
        component: NotAuthorized,
    },
    {
        path: "/unauthorized",
        component: NotAuthorized,
    },

]

let authenticationGuard = (to, from, next) => {
    let needLogin = to.meta.needLogin;

    if (needLogin) {

        let isLoggedIn = localStorage.getItem("user_id") !== null;

        if (!isLoggedIn) {
            next("/");
        } else {
            next();
        }

    } else {
        next();
    }
};
const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    routes
})


router.beforeEach(authenticationGuard);

export default router