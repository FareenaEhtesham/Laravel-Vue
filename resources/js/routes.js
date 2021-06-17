import Dashboard from './components/Dashboard.vue';
import Profile from './components/Profile.vue';
import User from './components/Users.vue';

export const routes = [
    {
        name: 'dashboard',
        path: '/dashboard',
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
];