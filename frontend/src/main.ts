import { createApp } from 'vue';
import { createPinia } from 'pinia';
import App from '@/App.vue'; // Using absolute path
import '@/style.css'; // Using absolute path
import '@/index.css'; 

const app = createApp(App);

// Create a Pinia instance
const pinia = createPinia();

// Use Pinia in the Vue app
app.use(pinia);

app.mount('#app');
