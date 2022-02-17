
import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from './components/Auth/Login';
import Dashboard from './components/Dashboard';
import Register from './components/Auth/Register';
import Departments from './components/Departments';
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        // {
        //     path: '/',
        //     component: Login
        // },

        {
            path: '/login',
            component: Login
        },
        {
            path: '/register',
            name: 'register',
            component: Register
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {
                requiresAuth:true
            },
        },
        {
            path: '/departments',
            name: 'departments',
            component: Departments,
            meta: {
                requiresAuth:true
            },
        },
    ]
});


// Meta Handling
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!token){
            next('/login');
        }
        else {
            next();
        }
    }
    else if (to.matched.some(record => record.meta.guest)) {
        if (localStorage.getItem('token') == null) {
            next()
        } else {
            next('/login')
        }
    } else {
        next()
    }
});
export default router;
