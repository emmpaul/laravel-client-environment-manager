<template>
    <AuthenticatedLayout>
        <Head title="Dashboard" />

        <template #header>
            <span class="text-2xl flex items-center gap-4">
                Dashboard
            </span>
        </template>

        <Grid :cols="2">
            <div>
                <span class="text-2xl flex items-center gap-4">
                    Clients added this year
                </span>
                <BarChart :data="monthlyClients" :categories="['total']" :index="'name'" :rounded-corners="0" />
            </div>
        </Grid>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Head} from "@inertiajs/vue3";
import {BarChart} from '@/Components/ui/chart-bar';
import Grid from "@/Components/Grid.vue"

export default {
    name: 'Overview',
    components: {
        BarChart,
        AuthenticatedLayout,
        Head,
        Grid
    },
    data() {
        return {
            monthlyClients: [],
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
            } catch (error) {
                console.error('Error fetching stats:', error);
            }
        }
    }
}
</script>
