import Vue from 'vue';
import Buefy from 'buefy'
import Vuex from 'vuex'
import VueRouter from 'vue-router'

import App from './componentsAlec/App.vue'
import '@mdi/font/css/materialdesignicons.css'
import 'buefy/dist/buefy.css'

Vue.use(Buefy).use(Vuex).use(VueRouter);

new Vue({
    components: {App},
}).$mount("#app")