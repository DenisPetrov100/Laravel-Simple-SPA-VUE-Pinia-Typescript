import { createRouter, createWebHistory } from 'vue-router'
import PaymentsIndex from '../components/payments/PaymentsIndex.vue'
import PaymentsCreate from '../components/payments/PaymentsCreate.vue'
import UsersIndex from '../components/users/UsersIndex.vue'
import UsersCreate from '../components/users/UsersCreate.vue'
import UsersView from '../components/users/UsersView.vue'
import UsersEdit from '../components/users/UsersEdit.vue'
import Dashboard from '../components/layout/Dashboard.vue'

const NotFound = { template: '<h2>Page Not Found</h2>' }
const AccessDenied = { template: '<h2>Access Denied</h2>' }


const routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard
    },
    {
        path: '/users',
        name: 'users.index',
        component: UsersIndex,
    },
    {
        path: '/users/create',
        name: 'users.create',
        component: UsersCreate
    },
    {
        path: '/users/:id/view',
        name: 'users.view',
        component: UsersView
    },
    {
        path: '/users/:id/edit',
        name: 'users.edit',
        component: UsersEdit
    },
    {
        path: '/payments',
        name: 'payments.index',
        component: PaymentsIndex
    },
    {
        path: '/users/:id/payments',
        name: 'user.payments',
        component: PaymentsIndex,
    },
    {
        path: '/payments/create',
        name: 'payments.create',
        component: PaymentsCreate
    },
    {
        path: '/:pathMatch(.*)*',
        name: 'notfound',
        component: NotFound
    },
    {
        path: '/denied',
        name: 'denied',
        component: AccessDenied
    },
];

export default createRouter({
    history: createWebHistory(),
    routes
})
