<template>
    <AuthenticatedLayout>
        <Head title="Clients" />

        <template #header>
            <span class="text-2xl flex items-center gap-4">
                Clients
                <Badge class="bg-primary text-primary-foreground p-2">
                    {{ total_clients }}
                </Badge>
            </span>
            <AddClientDialog />
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

            <Pagination
                :total="clients.total"
                :default-page="clients.current_page"
                :items-per-page="clients.per_page"
                :sibling-count="2"
                show-edges
                class="mx-auto">
                <PaginationList v-slot="{ items }" class="flex items-center gap-1">
                    <PaginationPrev
                        class="w-10 h-10 p-0"
                        variant="outline"
                        :disabled="paginationMeta.current_page === 1"
                        @click="goToPage(paginationMeta.current_page - 1)">
                    </PaginationPrev>
                    <template v-for="(item, index) in items" :key="index">
                        <PaginationListItem
                            v-if="item.type === 'page'"
                            :value="item.value"
                            as-child>
                            <Button
                                :class="{'bg-primary text-white': item.value === paginationMeta.current_page, 'w-10 h-10 p-0': true}"
                                variant="outline"
                                @click="goToPage(item.value)">
                                {{ item.value }}
                            </Button>
                        </PaginationListItem>
                        <PaginationEllipsis
                            v-else
                            :index="index" />
                    </template>
                    <PaginationNext
                        class="w-10 h-10 p-0"
                        variant="outline"
                        :disabled="paginationMeta.current_page === paginationMeta.last_page"
                        @click="goToPage(paginationMeta.current_page + 1)">
                    </PaginationNext>
                </PaginationList>
            </Pagination>
        </Deferred>
    </AuthenticatedLayout>
</template>

<script>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import AddClientDialog from "@/Components/AddClientDialog.vue"
import ClientCard from "@/Pages/Clients/ClientCard.vue"
import { UserRoundPlus } from "lucide-vue-next"
import { Head, Deferred } from "@inertiajs/vue3"
import { Badge } from "@/Components/ui/badge/index.js"
import Grid from "@/Components/Grid.vue"
import InputLabel from "@/Components/InputLabel.vue"
import TextInput from "@/Components/TextInput.vue"
import BounceLoader from 'vue-spinner/src/BounceLoader.vue'
import { Button } from "@/Components/ui/button"
import {
    Pagination,
    PaginationEllipsis,
    PaginationFirst,
    PaginationLast,
    PaginationList,
    PaginationListItem,
    PaginationNext,
    PaginationPrev,
} from '@/Components/ui/pagination'

export default {
    name: 'ClientsIndex',

    components: {
        Button,
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
        Deferred,
        Pagination,
        PaginationEllipsis,
        PaginationFirst,
        PaginationLast,
        PaginationList,
        PaginationListItem,
        PaginationNext,
        PaginationPrev,
    },

    data() {
        return {
            searchQuery: '',
            localClients: { data: [] },
            paginationMeta: {
                current_page: 1,
                total: null,
                per_page: null,
                last_page: null,
            }
        }
    },

    props: {
        clients: {
            type: Object
        },
        total_clients: {
            type: Number,
            required: true
        }
    },

    watch: {
        clients: {
            immediate: true,
            handler(newClients) {
                this.localClients = newClients?.data
                this.paginationMeta = {
                    current_page: newClients?.current_page,
                    total: newClients?.total,
                    per_page: newClients?.per_page,
                    last_page: newClients?.last_page,
                }
            },
        },
    },

    methods: {
        goToPage(page) {
            this.$inertia.visit(route('clients.index', { page }), {
                preserveState: true,
                preserveScroll: true,
            })
        },
    },
}
</script>
