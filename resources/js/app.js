require('./bootstrap');

import Vue from 'vue';
import moment from 'moment';
import VueRouter from 'vue-router';
import {routes} from './routes';

Vue.use(VueRouter)

const router = new VueRouter({
    routes: routes,
    mode: 'history',
});

Vue.filter('capitalize', function (text) {
    if (!text) return ''
    text = text.toString()
    return text.charAt(0).toUpperCase() + text.slice(1)
  });

Vue.filter('Date' , function(value){
    return moment(value).format('MMMM Do YYYY, h:mm:ss a'); //moment is function
    //so we pass value in here
});
const app = new Vue({
    el: '#app',
    router: router
});