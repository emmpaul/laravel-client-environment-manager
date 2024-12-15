<template>
    <AuthenticatedLayout>
        <Head title="Dashboard"/>

        <template #header>
            <span class="text-2xl flex items-center">
                Dashboard
            </span>
        </template>

        <div>
            <span class="text-2xl flex items-center">
                Clients added this year
            </span>
            <LineChart :data="monthlyClients" :categories="['total']" :index="'name'" :rounded-corners="0"/>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import {LineChart} from '@/Components/ui/chart-line';

export default {
    name: 'Overview',
    components: {
        AuthenticatedLayout,
        Head,
        LineChart
    },
    data() {
        return {
            monthlyClients: [],
            clientsTodayData: [{name: 'Today', total: 0}],
            last7DaysClients: [],
            totalClientsData: [{name: 'Total Clients', total: 0}],
            thisMonthClientsData: [{name: 'This Month', total: 0}],
        };
    },
    mounted() {
        this.fetchStats();
    },
    methods: {
        async fetchStats() {
            try {
                const response = await axios.get('/stats');
                this.monthlyClients = response.data.monthly_clients;
                this.clientsTodayData = [{name: 'Today', total: response.data.clients_today}];
                this.last7DaysClients = response.data.last_7_days;
                this.totalClientsData = [{name: 'Total Clients', total: response.data.total_clients}];
                this.thisMonthClientsData = [{name: 'This Month', total: response.data.this_month_clients}];
            } catch (error) {
                console.error('Error fetching stats:', error);
            }
        }
    }
}
</script>
