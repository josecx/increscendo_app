import Vue from    'vue'
import App from    './App.vue'
import router from './router'
import axios from  'axios'
import store from './store'

Vue.config.productionTip = false

Vue.prototype.urlBase = '/index.php'

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
