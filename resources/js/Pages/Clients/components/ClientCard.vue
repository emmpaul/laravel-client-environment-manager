<template>
    <Card>
        <CardHeader class="flex items-start gap-4 space-y-0">
            <TooltipProvider :delay-duration="300">
                <Tooltip>
                    <TooltipTrigger>
                        <CardTitle>
                            {{ client.name }}
                        </CardTitle>
                    </TooltipTrigger>
                    <TooltipContent>
                        Double click {{ client.name }} card to show informations
                    </TooltipContent>
                </Tooltip>
            </TooltipProvider>
<!--            Actions-->
            <div class="flex items-center gap-2">
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
                                    Delete {{ client.name }}
                                </TooltipContent>
                            </Tooltip>
                        </TooltipProvider>
                    </AlertDialogTrigger>
                    <AlertDialogContent>
                        <AlertDialogHeader>
                            <AlertDialogTitle>
                                Are you sure you want to delete {{ client.name }} ?
                            </AlertDialogTitle>
                            <AlertDialogDescription>
                                This action cannot be undone.
                            </AlertDialogDescription>
                        </AlertDialogHeader>
                        <AlertDialogFooter>
                            <AlertDialogCancel>Cancel</AlertDialogCancel>
                            <AlertDialogAction @click="deleteClient(client.id)">
                                Delete {{ client.name }}
                            </AlertDialogAction>
                        </AlertDialogFooter>
                    </AlertDialogContent>
                </AlertDialog>
            </div>
<!--            End Actions-->
        </CardHeader>
        <CardContent>
            <div class="flex justify-between space-x-4 text-sm text-muted-foreground">
                <div class="flex items-center space-x-4 text-sm">
                    <div>{{ updatedAt }}</div>
                </div>
            </div>
            <Accordion type="single" collapsible v-if="client.informations.length">
                <AccordionItem v-for="information in client.informations" :key="information.id" :value="information.url">
                    <AccordionTrigger>{{ information.url }}</AccordionTrigger>
                    <AccordionContent>
                        <div class="flex flex-col gap-2">
                            <Card>
                                <CardHeader class="flex flex-col items-start gap-4 space-y-0">
                                    <CardTitle>{{ information.environment }}</CardTitle>
                                    <CardDescription>{{ information.server }}</CardDescription>
                                    <Button class="w-full">
                                        <a :href="information.url" target="_blank" class="text-primary-foreground">Visit</a>
                                    </Button>
                                </CardHeader>
                            </Card>
                        </div>
                    </AccordionContent>
                </AccordionItem>
            </Accordion>
            <div v-else>
                No informations found
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
export default {
    name: 'ClientCard',

    components: {
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
            return 'Updated ' + timeAgo(this.client.updated_at);
        },
    },

    methods: {
        deleteClient(id) {
            router.delete(`/clients/${id}`)
        }
    }
}
</script>
