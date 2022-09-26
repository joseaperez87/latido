import {defineStore} from 'pinia'
import axiosClient from "../axios";

export const authStore = defineStore({
    id: 'auth',
    state: () => ({
        user: { token: '' }
    }),
    actions: {
        async login(user) {
            return axiosClient('/login', user)
                .then(({data}) => {
                    commit('setUser', data);
                    return data;
                })
        },
        register(user) {
            return axiosClient.post('/register', user)
                .then(({data}) => {
                    return data;
                }).
                catch((errors) => {
                    return errors.response.data.errors
                })
        }
    }
});
