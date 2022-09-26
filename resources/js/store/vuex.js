import {createStore} from 'vuex'
import axiosClient from "../axios";

const store = createStore({
    state: {
        user: {
            data: {
                name: 'Tony',
                email: 'tony@toy.com',
                image: ''
            },
            token: sessionStorage.getItem('TOKEN')
        }
    },
    getters: {},
    actions: {
      register({ commit }, user){
        return axiosClient.post('/register', user)
          .then(({data}) => {
            // commit('setUser', data);
            return data;
          }).
            catch((errors) => {
                return errors.response.data.errors
            })
      },
      login({ commit }, user){
        return axiosClient('/login', user)
          .then(({data}) => {
            commit('setUser', data);
            return data;
          })
      },
      logout({commit}){
        return axiosClient('/logout')
          .then(res => {
            commit('logout');
            return res;
          })
      }
    },
    mutations: {
      logout: state => {
          state.user.token = null,
          state.user.data = {}
      },
      setUser: (state, userData) => {
        state.user.token = userData.token;
        state.user.data = userData.user;
        sessionStorage.setItem('TOKEN', userData.token);
      }
    },
    modules: {}
});

export default store
