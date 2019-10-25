import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'

Vue.use(Vuex)

export default new Vuex.Store({
    state: {
        loggingIn: false,
        loginError: null,
        loginSuccessful: false
    },
    mutations: {
        loginStart: state => state.loggingIn = true,
        loginStop: (state, errorMessage) => {
            state.loggingIn = false;
            state.loginError = errorMessage;
            state.loginSuccessful = !errorMessage;
        }
    },
    actions: {
        doLogin({ commit }, loginData) {
            commit('loginStart');

            axios.post('/vuelogin', {
                ...loginData
            })
                .then((data) => {
                    if (data.data.status == 'success') {
                        commit('loginStop', null)
                        location.reload();
                    } else {
                        commit('loginStop', data.data.user)
                    }
                })
                .catch(error => {
                    commit('loginStop', data.data.user)
                })
        }
    }
})