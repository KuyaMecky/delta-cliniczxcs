require('./bootstrap');

import Vue from 'vue';
import Calendar from './components/Calendar';

Vue.component('calendar', Calendar);

const app = new Vue({
    el: '#app',
});
