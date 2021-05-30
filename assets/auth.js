import Vue from 'vue';
import App from './componentsAuth/App.vue'
import Buefy from 'buefy'

import '@mdi/font/css/materialdesignicons.css'
import 'buefy/dist/buefy.css'

Vue.use(Buefy);


new Vue({
    components: {App},
}).$mount("#app")