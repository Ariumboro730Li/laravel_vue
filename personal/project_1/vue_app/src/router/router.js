import { createRouter, createWebHistory } from 'vue-router';
import TestApi from '../components/TestApi.vue';
import Dashboard from '../components/Dashboard.vue'

const router = createRouter({
    history : createWebHistory(),
    routes: [
        {
            name: "dashboard",
            path: "/",
            components : {
                default : Dashboard
            }
        },
        {
            name: "test-api",
            path: "/test-api",
            components:  {
                default : TestApi,
            }
        }
    ]
})

export default {
    router
}