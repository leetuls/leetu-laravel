import './bootstrap';

import {createApp} from 'vue';

import Hello from './Hello.vue';

const app = createApp(Hello);

app.mount('#hello-vue');