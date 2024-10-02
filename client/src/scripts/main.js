import '../assets/css/reset.css'
import '../assets/css/main.css'
import '../assets/css/base.css'

import { createApp } from 'vue';
import App from '../App.vue';
import router from './router.js';
import { createPinia } from 'pinia';

// Load YouTube API script globally
const tag = document.createElement('script');
tag.src = 'https://www.youtube.com/iframe_api';
const firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

const pinia = createPinia();

// Create and mount the Vue app
createApp(App)
    .use(router)
    .use(pinia)
    .mount('#app');