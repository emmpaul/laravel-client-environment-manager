<template>
    <AuthenticatedLayout>
        <Head title="Clients"/>

        <template #header>
            <span class="text-2xl flex items-center gap-4">
                Clients
                <Badge class="bg-primary text-primary-foreground p-2">
                    {{ clientsCount }}
                </Badge>
            </span>
            <AddClientDialog/>
            <TextInput
                @input="search"
                id="search"
                type="text"
                class="block w-[500px]"
                v-model="searchQuery"
                required
                autofocus
                placeholder="Search"
                autocomplete="username"
            />
        </template>

        <Deferred data="clients">
            <template #fallback>
                <div class="mx-auto flex items-center gap-4">
                    Loading clients...
                    <bounce-loader size="30px" color="#f97316"></bounce-loader>
                </div>
            </template>

            <Grid :cols="2">
                <ClientCard v-for="client in localClients" :key="client.id" :client="client"/>
            </Grid>
        </Deferred>

    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import AddClientDialog from "@/Components/AddClientDialog.vue";
import ClientCard from "@/Pages/Clients/ClientCard.vue"
import {UserRoundPlus} from "lucide-vue-next";
import {Head, Deferred } from "@inertiajs/vue3";
import {Badge} from "@/Components/ui/badge/index.js";
import Grid from "@/Components/Grid.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import _ from 'lodash';
import BounceLoader from 'vue-spinner/src/BounceLoader.vue'

export default {
    name: 'ClientsIndex',

    components: {
        TextInput,
        InputLabel,
        Grid,
        Badge,
        AddClientDialog,
        AuthenticatedLayout,
        UserRoundPlus,
        Head,
        ClientCard,
        BounceLoader,
        Deferred
    },

    data() {
        return {
            searchQuery: '',
            localClients: [],
        }
    },

    props: {
        clients: {
            type: Array
        }
    },

    watch: {
        clients: {
            immediate: true,
            handler(newClients) {
                this.localClients = newClients;
            }
        }
    },

    computed: {
        clientsCount() {
            return this.localClients?.length
        }
    },

    methods: {
        search: _.debounce(function() {
            axios.post('/clients/search', { keyword: this.searchQuery })
                .then(res => {
                    this.localClients = res.data.result;
                })
                .catch(error => {
                    console.error('Search error:', error);
                })
        }, 500),
    },
}
</script>
