/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');



Vue.component('example-component', require('./components/ExampleComponent.vue').default);

//--------------------component lists--------------------------

import category_index from './components/categories/index.vue';
import industries_index from './components/industries/index.vue';
import jobstype_index from './components/jobs-types/index.vue';
import seo_form from './components/seo/form.vue';


//---------------------frontend components----------------------

import manage_jobs from './components/frontend/manage_jobs.vue';
import notifications from './components/frontend/notifications.vue';
import notifications_header from './components/frontend/notifications_header.vue';

//---------------------chat-------------------------

import frontend_chat from './components/frontend/chat/chat.vue';




import {ServerTable, ClientTable, Event} from 'vue-tables-2';

import VueTimeago from 'vue-timeago'

import VueChatScroll from 'vue-chat-scroll'

Vue.use(VueChatScroll)

Vue.use(VueTimeago, {
  name: 'Timeago', // Component name, `Timeago` by default
  locale: 'Asia/Kolkata', // Default locale
  // We use `date-fns` under the hood
  // So you can use all locales from it
  locales: {
    'zh-CN': require('date-fns/locale/zh_cn'),
    ja: require('date-fns/locale/ja')
  }
})

Vue.use(ClientTable);

Vue.use(require('vue-moment'));

const app = new Vue({
    el: '#app',
    components:{
        category_index,
        industries_index,
        jobstype_index,
        manage_jobs,
        seo_form,
        frontend_chat,
        notifications,
        notifications_header
    }
});
