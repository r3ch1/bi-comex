import { createApp } from 'vue';
import App from './pages/App.vue';
import VueApexCharts from "vue3-apexcharts";
import router from './router/index.js';
import axios from 'axios';

import Header from './components/Header.vue';
import SideMenu from './components/SideMenu.vue';
import HeaderTotais from './components/dashboard/HeaderTotais.vue';
import GraficoVlFobPorDia from './components/dashboard/GraficoVlFobPorDia.vue';
import GraficoVlFobPorPais from './components/dashboard/GraficoVlFobPorPais.vue';
import GraficoVlFobPorVia from './components/dashboard/GraficoVlFobPorVia.vue';

const app = createApp(App).use(router);
app.use(VueApexCharts);
app.component('app-header', Header);
app.component('app-sidemenu', SideMenu);
app.component('app-header-totais', HeaderTotais);
app.component('app-grafico-vl-fob-por-dia', GraficoVlFobPorDia);
app.component('app-grafico-vl-fob-por-pais', GraficoVlFobPorPais);
app.component('app-grafico-vl-fob-por-via', GraficoVlFobPorVia);

app.mount('#app');
