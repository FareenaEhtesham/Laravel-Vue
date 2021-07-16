require('./bootstrap');

import Vue from 'vue';
import moment from 'moment';
import VueRouter from 'vue-router';
import {routes} from './routes';
import VueProgressBar from 'vue-progressbar';
import swal from 'sweetalert2';
import Form from 'vform';

Vue.use(VueRouter)
window.swal=swal;

window.Form = Form;
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

Vue.use(VueProgressBar, {
    color: 'rgb(143, 255, 199)',
    failedColor: 'red',
    height: '2px',
    transition: {
        speed: '2s',
        opacity: '0.6s',
        termination: 300
      },
  });

// toast notification by sweetalert
 
const Toast = swal.mixin({
    toast: true,
    position: 'top-end',
    timer: 3000,
    showConfirmButton: false,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', swal.stopTimer)
      toast.addEventListener('mouseleave', swal.resumeTimer)
    }
  })
  window.Toast=Toast;

// make this global variable to use any where in any component
let Fire = new Vue();
window.Fire = Fire;

const app = new Vue({
    el: '#app',
    router: router
});