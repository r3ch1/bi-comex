import { createApp } from 'vue';
import App from './pages/App.vue';
import router from './router/index.js';

import Header from './components/Header.vue';
import SideMenu from './components/SideMenu.vue';

const app = createApp(App).use(router);

app.component('app-header', Header);
app.component('app-sidemenu', SideMenu);

app.mount('#app');
