/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'
import Notifications from 'vue-notification'
import VeeValidate from 'vee-validate';
import { DatePicker } from 'element-ui'

// Style for datepicker
import 'element-ui/lib/theme-default/index.css'

// Internationalization for Datepicker
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'

// configure language
locale.use(lang)

// configure datepicker language
locale.use(lang)


Vue.use(Notifications)
Vue.use(VeeValidate)
Vue.use(DatePicker)


window.Events = new Vue()

import Currencies from './components/Currency/Currencies.vue'
import Rates from './components/CurrencyRate/Rates.vue';

Vue.component('modal', require('./components/Modal.vue'))

const app = new Vue({
    el: '#app',

    components: {
        Currencies,
        Rates
    }
});

export { app }