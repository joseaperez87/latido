import axios from "axios";
import { authStore } from "@/store";

const axiosClient = axios.create({
    baseURL: 'http://localhost:8000/api',
});

axiosClient.interceptors.request.use(config => {
    const store = authStore();
    config.headers.Authorization = `Bearer ${store.user.token}`;
    config.method = 'post';
    return config;
})

export default axiosClient;
