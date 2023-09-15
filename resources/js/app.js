require('./bootstrap');

import { createApp } from 'vue';
//import CurrencyDropdown from './components/CurrencyDropdown';
import Exchange from "./components/Exchange";

const app = createApp({});

app.component('exchange', Exchange);
app.mount('#app');
