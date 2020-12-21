import Vue from 'vue'
import Vuex from 'vuex'
import createPersistedState from "vuex-persistedstate";
import createdMutationsSharer from "vuex-shared-mutations";

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
		token: '',
    titulo:'',
		usuario: {},
  },
  mutations: {
    setToken(state, valor) {
      state.token = valor;
    },
    setUsuario(state, valor) {
      state.usuario = valor;
    },
  },
  actions: {
    login(state, datos) {
      return new Promise((resolve) => {
        state.commit('setToken', datos.token);
        state.commit('setUsuario', datos.registro);
        Vue.prototype.$http.defaults.headers.common['Authorization'] = state.state.token;
        resolve(datos);
      })
    },
    logout (state) {
      return new Promise((resolve) => {
        state.commit('setToken', null);
        state.commit('setUsuario', null);
        delete Vue.prototype.$http.defaults.headers.common['Authorization']
        resolve(state);
      })
    },
  },
  getters: {
    isLoggedIn: state => !!state.token,
  },
  plugins: [
    createPersistedState({key: 'vuex-incresc'}),
    createdMutationsSharer({predicate: ['setToken','setUsuario']})
  ]
})
 