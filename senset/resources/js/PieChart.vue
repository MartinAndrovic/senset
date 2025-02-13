<template>
    <Pie
        :options="{maintainAspectRatio: false}"
        :data="chartData"
    />
</template>
<script>
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from 'chart.js';
import { Pie } from 'vue-chartjs';
ChartJS.register(ArcElement, Tooltip, Legend)

export default {
    name: 'PieChart',
    components: { Pie },
    props: {
        input_data: Array
    },
    data() {
        return {
            chartData: {

                labels: ['Januar','Februar','Marec','April','Maj','Jun','Jul','August','September','Oktober','November','December'],
                datasets: [
                    {
                        label: 'pocet narodeni v danom mesiaci',
                        data: this.input_data,
                        backgroundColor: ["rgb(50,162,235)", "rgb(54,162,200)","rgb(100,162,180)","rgb(130,162,150)",
                            "rgb(150,162,130)","rgb(150,200,130)","rgb(180,220,50)","rgb(180,220,50)","rgb(230,220,50)",
                            "rgb(230,220,100)","rgb(230,220,50)","rgb(230,250,120)"]
                    }
                ]
            },
            chartOptions: {
                responsive: true
            }
        }
    }
}
</script>
