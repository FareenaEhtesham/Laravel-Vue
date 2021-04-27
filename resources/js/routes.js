import Dashboard from './components/Dashboard.vue';
import Profile from './components/Profile.vue';

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
];