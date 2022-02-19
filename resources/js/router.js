
import Vue from 'vue';
import VueRouter from 'vue-router';

import Login from './components/Auth/Login';
import Dashboard from './components/Dashboard';
import Register from './components/Auth/Register';
import Departments from './components/Departments/Departments';
import AddDepartments from './components/Departments/AddDepartment';
import EditDepartments from './components/Departments/EditDepartment';

//users

import Users from './components/Users/Users';
import AddUser from './components/Users/AddUser';
import EditUser from './components/Users/EditUser';

//categories
import Categories from './components/Categories/Categories';
import AddCategory from './components/Categories/AddCategory';
import EditCategory from './components/Categories/EditCategory';


import Profile from './components/Profile';
import Roles from './components/Roles';
Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    linkExactActiveClass: 'active',
    routes: [
        {
            path: '/',
            component: Login
        },

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
        {
            path: '/departments/add',
            name: 'createDepartment',
            component: AddDepartments,
            meta: {
                requiresAuth:true
            },
        },

        {
            path: '/departments/update/:id',
            name: 'editDepartment',
            component: EditDepartments,
            meta: {
                requiresAuth:true
            },
        },


        //categories

        {
            path: '/categories',
            name: 'categories',
            component: Categories,
            meta: {
                requiresAuth:true
            },
        },
        {
            path: '/categories/add',
            name: 'createDepartment',
            component: AddCategory,
            meta: {
                requiresAuth:true
            },
        },

        {
            path: '/categories/update/:id',
            name: 'editCategory',
            component: EditCategory,
            meta: {
                requiresAuth:true
            },
        },


        //users
        {
            path: '/users',
            name: 'users',
            component: Users,
            meta: {
                requiresAuth:true
            },
        },
        {
            path: '/users/add',
            name: 'createUser',
            component: AddUser,
            meta: {
                requiresAuth:true
            },
        },


        {
            path: '/users/update/:id',
            name: 'editUser',
            component: EditUser,
            meta: {
                requiresAuth:true
            },
        },



        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            meta: {
                requiresAuth:true
            },
        },
        {
            path: '/my-roles-and-permissions',
            name: 'roles',
            component: Roles,
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
