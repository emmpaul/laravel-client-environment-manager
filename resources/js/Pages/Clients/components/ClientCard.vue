<template>
    <Card>
        <CardHeader class="flex items-center gap-4 space-y-0">
            <TooltipProvider :delay-duration="300">
                <Tooltip>
                    <TooltipTrigger>
                        <CardTitle>
                            {{ client.name }}
                        </CardTitle>
                    </TooltipTrigger>
                    <TooltipContent>
                        {{ updatedAt }}
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
<!--            Actions-->
            <div class="flex items-center gap-2" v-if="$page.props.auth.user">
                <AddClientInfoDialog :client="client" />
                <EditClientDialog :client="client" />
                <AlertDialog>
                    <AlertDialogTrigger class="flex justify-center items-center" as="button">
                        <TooltipProvider :delay-duration="300">
                            <Tooltip>
                                <TooltipTrigger>
                                    <BadgeX class="hover:text-red-500" />
                                </TooltipTrigger>
                                <TooltipContent class="bg-red-500">
                                    {{ $t('delete.label', { name: client.name }) }}
                                </TooltipContent>
                            </Tooltip>
                        </TooltipProvider>
                    </AlertDialogTrigger>
                    <AlertDialogContent>
                        <AlertDialogHeader>
                            <AlertDialogTitle>
                                {{ $t('delete.areYouSure', { name: client.name }) }}
                            </AlertDialogTitle>
                            <AlertDialogDescription>
                                {{ $t('delete.cannotBeUndone') }}
                            </AlertDialogDescription>
                        </AlertDialogHeader>
                        <AlertDialogFooter>
                            <AlertDialogCancel>
                                {{ $t('cancel.label') }}
                            </AlertDialogCancel>
                            <AlertDialogAction @click="deleteClient(client.id)">
                                {{ $t('delete.label', { name: client.name }) }}
                            </AlertDialogAction>
                        </AlertDialogFooter>
                    </AlertDialogContent>
                </AlertDialog>
            </div>
<!--            End Actions-->
        </CardHeader>
        <CardContent>
            <Accordion type="single" collapsible v-if="client.informations.length">
                <AccordionItem v-for="information in client.informations" :key="information.id" :value="information.url">
                    <AccordionTrigger>{{ information.url }}</AccordionTrigger>
                    <AccordionContent>
                        <div class="flex flex-col gap-2">
                            <Card>
                                <CardHeader class="flex flex-col items-start gap-4 space-y-0">
                                    <CardTitle class="flex w-full items-center justify-between">
                                        <Badge class="p-2">
                                            {{ information.environment }}
                                        </Badge>

                                        <div class="flex items-center gap-2" v-if="$page.props.auth.user">
                                            <EditClientInfoDialog :client="client" :information-id="information.id" />
                                            <AlertDialog>
                                                <AlertDialogTrigger class="flex justify-center items-center" as="button">
                                                    <TooltipProvider :delay-duration="300">
                                                        <Tooltip>
                                                            <TooltipTrigger>
                                                                <BadgeX class="hover:text-red-500" />
                                                            </TooltipTrigger>
                                                            <TooltipContent class="bg-red-500">
                                                                {{ $t('delete.label', { name: information.url }) }}
                                                            </TooltipContent>
                                                        </Tooltip>
                                                    </TooltipProvider>
                                                </AlertDialogTrigger>
                                                <AlertDialogContent>
                                                    <AlertDialogHeader>
                                                        <AlertDialogTitle>
                                                            {{ $t('delete.areYouSure', { name: information.url }) }}
                                                        </AlertDialogTitle>
                                                        <AlertDialogDescription>
                                                            {{ $t('delete.cannotBeUndone') }}
                                                        </AlertDialogDescription>
                                                    </AlertDialogHeader>
                                                    <AlertDialogFooter>
                                                        <AlertDialogCancel>
                                                            {{ $t('cancel.label') }}
                                                        </AlertDialogCancel>
                                                        <AlertDialogAction @click="deleteInformation(information.id)">
                                                            {{ $t('delete.label', { name: information.url }) }}
                                                        </AlertDialogAction>
                                                    </AlertDialogFooter>
                                                </AlertDialogContent>
                                            </AlertDialog>
                                        </div>
                                    </CardTitle>
                                    <CardDescription>{{ information.server }}</CardDescription>
                                    <Button class="w-full" variant="outline">
                                        <a :href="information.url" target="_blank" class="text-primary-foreground">
                                            {{ $t('clients.visit') }}
                                        </a>
                                    </Button>
                                </CardHeader>
                            </Card>
                        </div>
                    </AccordionContent>
                </AccordionItem>
            </Accordion>
            <div v-else>
                {{ $t('clients.noInformationsFound') }}
            </div>
        </CardContent>
    </Card>
</template>

<script>
import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from '@/Components/ui/accordion'
import {timeAgo} from '@/lib/utils.js'
import { Button } from '@/Components/ui/button/index.js'
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card/index.js'
import {
    Delete,
    BadgeX
} from 'lucide-vue-next'
import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
    AlertDialogTrigger,
} from '@/Components/ui/alert-dialog/index.js'
import {router, Link} from "@inertiajs/vue3";
import AddClientInfoDialog from "@/Pages/Clients/components/AddClientInfoDialog.vue";
import EditClientDialog from "@/Pages/Clients/components/EditClientDialog.vue";
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger
} from '@/Components/ui/tooltip/index.js'
import {Badge} from "@/Components/ui/badge/index.js";
import EditClientInfoDialog from "@/Pages/Clients/components/EditClientInfoDialog.vue";
export default {
    name: 'ClientCard',

    components: {
        EditClientInfoDialog,
        Badge,
        AddClientInfoDialog,
        Button,
        Card,
        CardContent,
        CardDescription,
        CardHeader,
        CardTitle,
        AlertDialog,
        AlertDialogAction,
        AlertDialogCancel,
        AlertDialogContent,
        AlertDialogDescription,
        AlertDialogFooter,
        AlertDialogHeader,
        AlertDialogTitle,
        AlertDialogTrigger,
        Tooltip,
        TooltipContent,
        TooltipProvider,
        TooltipTrigger,
        Delete,
        BadgeX,
        EditClientDialog,
        Accordion,
        AccordionContent,
        AccordionItem,
        AccordionTrigger,
        Link
    },

    props: {
        client: {
            type: Object,
            required: true
        }
    },

    computed: {
        updatedAt() {
            return this.$t('clients.lastUpdated') + ' ' + timeAgo(this.client.updated_at, this.$i18n);
        },
    },

    methods: {
        deleteClient(id) {
            router.delete(`/clients/${id}`)
        },
        deleteInformation(id) {
            router.delete(`/informations/${id}`)
        }
    }
}
</script>
