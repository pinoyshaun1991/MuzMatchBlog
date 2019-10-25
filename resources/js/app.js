
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*require('./bootstrap');

 window.Vue = require('vue');
 */


import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify';
import Routes from '@/js/routes.js';
import App from '@/js/views/App';
import store from './stores/store.js'
// import connection from '@/js/connection.js';
import require from '@/js/requirejs';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan thvuetify.jsis directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

/* const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default)) */



// new Vue({
//     Vuetify,
// }).$mount('#app');
Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    router: Routes,
    store,
    // connection,
    require,
    vuetify : new Vuetify(),
    render: h => h(App)
});


/* Vue.component('example-component', require('./components/ExampleComponent.vue').default); */

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

export default app;
