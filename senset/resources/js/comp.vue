<script>
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale
} from 'chart.js'
import { Bar } from 'vue-chartjs'

ChartJS.register(CategoryScale, LinearScale, BarElement, Title, Tooltip, Legend)
export default {
name: "comp",
    components: {
        Bar
    },
    data() {
        return {
            customers: [],

            data: {
                labels: ['January', 'February', 'March'],
                datasets: [{ data: [40, 20, 12] }]
            },
            options: {
                responsive: true
            }
        }
    },

    mounted() {
        axios
            .get('https://dummyjson.com/users')
            .then(response => {
                this.customers = response.data.users;
                console.log(response.data)
            })
            .catch(error => {
                console.error( error);
            });
    }
}
</script>

<template>

    <table class="border-2">

                <tr v-for="customer in customers" class="border-2" >
                    <td class="border-2 min-w-20"> {{customer.firstName}} </td>
                    <td class="border-2 min-w-28"> {{customer.lastName}} </td>
                    <td class="border-2 min-w-72"> {{customer.email}} </td>
                    <td class="border-2 min-w-16"> {{customer.birthDate}} </td>
                </tr>

    </table>


    <Bar :data="data" :options="options" />

</template>

<style scoped>

    table {
        margin: auto;
        width: 50% !important;
    }

</style>
