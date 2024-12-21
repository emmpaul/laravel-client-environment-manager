<template>
    <MainLayout>
        <Head title="Clients"/>

        <template #header>
            <span class="text-2xl flex items-center gap-4">
                {{ $t('search.title') }}
            </span>
            <TextInput
                @input="search"
                id="search"
                type="search"
                class="block w-[500px]"
                v-model="searchQuery"
                required
                autofocus
                :placeholder="$t('search.title')"
                autocomplete="username"
            />
            <bounce-loader :loading="loading" size="30px" color="#f97316"></bounce-loader>
        </template>

        <!-- Clients Section -->
        <div v-if="!loading && clients.length" class="flex flex-col gap-2">
            <Grid :cols="2">
                <ClientCard v-for="client in clients" :key="client.id" :client="client" />
            </Grid>
        </div>

        <div v-if="!loading && !clients.length && searchQuery">
            <p>{{ $t('search.noClientsFound') + searchQuery }}</p>
        </div>

        <!-- No query message -->
        <div v-if="!loading && !searchQuery && !clients.length && !informations.length">
            <p>{{ $t('search.noQuery') }}</p>
        </div>
    </MainLayout>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import ClientCard from "@/Pages/Clients/components/ClientCard.vue";
import { Head } from "@inertiajs/vue3";
import Grid from "@/Components/Grid.vue";
import TextInput from "@/Components/TextInput.vue";
import BounceLoader from 'vue-spinner/src/BounceLoader.vue';
import _ from 'lodash';

export default {
    name: 'ClientsIndex',

    components: {
        TextInput,
        Grid,
        MainLayout,
        ClientCard,
        BounceLoader,
        Head
    },

    data() {
        return {
            searchQuery: '',
            clients: [],
            informations: [],
            loading: false
        };
    },

    methods: {
        search: _.debounce(function () {
            this.loading = true;

            if (this.searchQuery === '') {
                this.clients = [];
                this.informations = [];
                this.loading = false;
                return;
            }

            axios.post('/search', {keyword: this.searchQuery})
                .then(res => {
                    const clientsData = res.data.result;

                    this.clients = clientsData.map(item => item.client);
                    this.informations = clientsData.flatMap(item => item.informations);

                })
                .catch(error => {
                    console.error('Search error:', error);
                })
                .finally(() => {
                    this.loading = false;
                });
        }, 500),
    }
};
</script>
