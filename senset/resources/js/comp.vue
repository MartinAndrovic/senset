<template>

    <div v-if="ready">
        <PieChart  :input_data="chartData"/>
    </div>

    <br>

    <div class="selectDates ">
        <label for="dateFrom"> date from </label>
        <input id="dateFrom" type="date" class="ml-2 mr-3" v-model="date_from">
        <label for="dateTo"> date to </label>
        <input id="dateTo" type="date" class="ml-2 mr-3" v-model="date_to">
        <button v-show="!filtering" @click="filter"
                class="hover:bg-green-700 bg-green-400 float-end font-bold  px-4 rounded"> zobrazit
        </button>
        <button v-show="filtering" @click="cancelFilter"
                class="hover:bg-red-700 bg-red-400 float-end font-bold  px-4 rounded"> zrusit
        </button>
    </div>
    <br>


    <table class="border-2 mt-2.5">

        <tr v-for="customer in customers" v-show="customer.active" class="border-2">
            <td class="border-2 min-w-20"> {{ customer.firstName }}</td>
            <td class="border-2 min-w-28"> {{ customer.lastName }}</td>
            <td class="border-2 min-w-72"> {{ customer.email }}</td>
            <td class="border-2 min-w-16"> {{ customer.birthDate }}</td>
            <button @click="deleteCustomer(customer.email)" class="hover:bg-red-700 bg-red-400 float-end font-bold  px-4 rounded"> vymazat </button>
        </tr>

    </table>


</template>
<script>

import PieChart from './PieChart.vue';

export default {
    name: "comp",
    components: {
        PieChart
    },
    data() {
        return {
            customers: [],
            chartData: [],
            ready: false,
            date_from: null,
            date_to: null,
            filtering: false
        }
    },

    mounted() {
        axios
            .get('https://dummyjson.com/users')
            .then(response => {
                this.customers = response.data.users;
                console.log(this.customers)
                this.months()
                this.addActiveProperty()
                this.ready = true;

            })
            .catch(error => {
                console.error(error);
            });

    },

    methods: {

        months() {
            let array = []
            for (let i = 1; i < 13; i++) {
                let count = 0
                this.customers.forEach(customer => {
                    let date = new Date(customer.birthDate)
                    let month = date.getMonth() + 1
                    if (month === i) {
                        count++;
                    }
                })
                array.push(count)
            }
            this.chartData = array;
        },

        filter() {

            this.filtering = true;
            for (let i = 0; i < this.customers.length; i++) {
                if (this.date_from !== null && this.date_to === null) {
                    if (this.date_from <= this.customers[i].birthDate) {
                    } else{
                        this.customers[i].active = false;
                    }
                }
                if (this.date_from === null && this.date_to !== null)
                    if (this.date_to >= this.customers[i].birthDate) {

                    } else{
                        this.customers[i].active = false;
                    }
                if (this.date_from !== null && this.date_to !== null)
                    if (this.date_from <= this.customers[i].birthDate && this.date_to >= this.customers[i].birthDate) {

                    } else {
                        this.customers[i].active = false;
                    }
            }
        },

        cancelFilter() {
            this.date_from = null
            this.date_to = null
            this.filtering = false
            this.addActiveProperty()
        },

        addActiveProperty() {
            for (let i = 0; i < this.customers.length; i++) {
                this.customers[i].active = true;
            }
        },

        deleteCustomer(email){
            axios.delete(`/deleteCustomer/${email}`)
                .then(() => {
                    let i= this.customers.findIndex(c => c.email === email);
                    this.customers.splice(i, 1);
                })
                .catch(error => console.log(error))
        }
    }
}
</script>

<style scoped>

table {
    margin: auto;
    width: 50% !important;
}

.selectDates {
    margin: auto;
    width: 50% !important;
}

</style>
