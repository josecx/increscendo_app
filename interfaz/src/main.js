import Vue from    'vue'
import App from    './App.vue'
import router from './router'
import axios from  'axios'
import store from './store'
import "../src/assets/css/style.css";
import "../src/assets/css/normalize.css";
// Font Awesome
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { far } from '@fortawesome/free-regular-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'

library.add(fas, far, fab)

Vue.component('font-awesome-icon', FontAwesomeIcon)
// Fin Font Awesome

Vue.config.productionTip = false

Vue.prototype.urlBase = 'increscendo.php'

Vue.prototype.$http = axios.create();
Vue.prototype.$http.defaults.headers.common['Authorization'] = store.state.token;

Vue.prototype.$http.interceptors.response.use(undefined, function(err) {
  return new Promise(function() {
    if (err.response.status === 401 && err.config && !err.config.__isRetryRequest) {
      store.dispatch('logout');
      router.push({name: 'Login'});
    }
  });
});

new Vue({
    router,
    store,
    render: h => h(App)
}).$mount('#app')
