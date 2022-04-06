import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from 'axios';
import VueAxios from 'vue-axios';

import './../../styles/app.scss';

const app = createApp(App).use(router).use(VueAxios, axios);

import store from "./store";
app.use(store);

app.mount('#app');
