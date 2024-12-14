<template>
    <Head title="Clients" />

    <AuthenticatedLayout>
        <template #header>
            <MoveLeft class="cursor-pointer hover:text-primary" @click="goToClients" />
            <span class="text-2xl flex items-center gap-4">
                {{ client.name }}
            </span>
            <AddClientInfoDialog :client="client" />
        </template>
        <ClientInformationsCard v-for="(informations, index) in client.informations"  :informations="informations" :key="index" />
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import {Badge} from "@/Components/ui/badge/index.js";
import {Head, router} from "@inertiajs/vue3";
import {MoveLeft} from "lucide-vue-next"
import AddClientInfoDialog from "@/Components/AddClientInfoDialog.vue";
import ClientInformationsCard from "@/Pages/Clients/ClientInformationsCard.vue";

export default {
    name: 'Show',
    components: {ClientInformationsCard, AddClientInfoDialog, Head, Badge, AuthenticatedLayout, MoveLeft},

    props: {
        client: {
            type: Object
        }
    },

    methods: {
        goToClients() {
            router.get('/clients')
        }
    }
}
</script>
