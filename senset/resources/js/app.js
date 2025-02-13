import './bootstrap';
import {createApp} from 'vue';
import comp from "@/comp.vue";
import PieChart from "@/PieChart.vue";
const app = createApp({
});
app.component('comp', comp);
app.component('PieChart', PieChart);
app.mount('#app');
