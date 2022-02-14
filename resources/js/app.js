require('./bootstrap');


import { createApp } from 'vue'
import App from './components/App'

// const routes = [
//   { path: '/', component: App },
// ]

// const router = VueRouter.createRouter({
//   history: VueRouter.createWebHashHistory(),
//   routes,
// })

const app = createApp({});


app.component('app', App);
// app.use(router)
app.mount('#app');
