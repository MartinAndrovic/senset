import './bootstrap';
import {createApp} from 'vue';
import comp from "@/comp.vue";
const app = createApp({
});
app.component('comp', comp);
app.mount('#app');
