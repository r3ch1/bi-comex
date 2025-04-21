import { createApp } from 'vue';
import App from './pages/App.vue';
import VueApexCharts from "vue3-apexcharts";
import router from './router/index.js';
import axios from 'axios';

import Header from './components/Header.vue';
import SideMenu from './components/SideMenu.vue';
import HeaderTotais from './components/dashboard/HeaderTotais.vue';

const app = createApp(App).use(router);
app.use(VueApexCharts);
app.component('app-header', Header);
app.component('app-sidemenu', SideMenu);
app.component('app-header-totais', HeaderTotais);

app.mount('#app');
