import Dashboard from './components/Dashboard.vue';
import Profile from './components/Profile.vue';
import User from './components/Users.vue';
import Developer from './components/Developer.vue';
import NotFound from './components/NotFound.vue';

export const routes = [
    {
        name: 'dashboard',
        path: '/dashboard',
        component: Dashboard
    },
    {
        name: 'home',
        path: '/home',
        component: Dashboard
    },
    {
        name: 'default',
        path: '/',
        component: Dashboard
    },
    {
        name: 'profile',
        path: '/profile',
        component: Profile
    },
    {
        name: 'users',
        path: '/users',
        component: User
    },
    {
        name: 'developer',
        path: '/developer',
        component: Developer
    },
    {
        name: 'NotFound',
        path: '*',
        component: NotFound
    },
];