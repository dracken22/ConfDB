import { createApp } from 'vue'
import App from './App.vue'
import ElementPlus from 'element-plus';
import 'element-plus/lib/theme-chalk/index.css';
import { createRouter, createWebHashHistory } from 'vue-router';
import AbilityList from './components/ability/AbilityList.vue';
import ArmyList from './components/army/ArmyList.vue';


const routes = [
    { path: '/ability', component: AbilityList},
    { path: '/army', component: ArmyList},
    { path: '/', redirect: '/ability'}
  ];

const router = createRouter({
    history: createWebHashHistory(),
    routes
});

createApp(App)
    .use(ElementPlus)
    .use(router)
    .mount('#app')
