<template>
    <Card @dblclick="goToClientPage(client.id)">
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
        </CardContent>
    </Card>
</template>

<script>
import {timeAgo} from '@/lib/utils.js'
import { Button } from '@/Components/ui/button'
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/Components/ui/card'
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
} from '@/Components/ui/alert-dialog'
import {
    Separator
} from "@/Components/ui/separator";
import {router} from "@inertiajs/vue3";
import AddClientInfoDialog from "@/Components/AddClientInfoDialog.vue";
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger
} from '@/Components/ui/tooltip'
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
        Separator,
        Tooltip,
        TooltipContent,
        TooltipProvider,
        TooltipTrigger,
        Delete,
        BadgeX
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
        goToClientPage(id) {
            router.get(`/clients/${id}`)
        },
        deleteClient(id) {
            router.delete(`/clients/${id}`)
        }
    }
}
</script>
