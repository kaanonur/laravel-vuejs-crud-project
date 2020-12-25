import Vue from 'vue';
import VueRouter from "vue-router";

Vue.use(VueRouter);

import Dashboard from '../pages/Dashboard';

const routes = [
    { path: '/', component: Dashboard, name: 'dashboard' }
]

export default new VueRouter({
    mode: 'hash',
    routes
})
