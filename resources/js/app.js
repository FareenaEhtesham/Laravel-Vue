require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import {routes} from './routes';

Vue.use(VueRouter)

const router = new VueRouter({
    routes: routes
});

const app = new Vue({
    el: '#app',
    router: router,
});