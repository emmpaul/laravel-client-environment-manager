<template>
    <Card>
        <CardHeader class="grid grid-cols-[minmax(0,1fr)_110px] items-start gap-4 space-y-0">
            <div class="space-y-1">
                <CardTitle>{{ informations.url }}</CardTitle>
            </div>
            <div>
                Actions
            </div>
        </CardHeader>
        <CardContent>
            <div class="flex space-x-4 text-sm text-muted-foreground">
                <div class="flex items-center">
                    Server : {{ informations.server }}
                </div>
                <div class="flex items-center">
                    Environment : {{ informations.environment }}
                </div>
                <div>{{ updatedAt }}</div>
            </div>
        </CardContent>
    </Card>
</template>

<script>
import {timeAgo} from "@/lib/utils.js";
import {Button} from '@/Components/ui/button'
import {Card, CardContent, CardDescription, CardHeader, CardTitle,} from '@/Components/ui/card'
import {
    DropdownMenu,
    DropdownMenuCheckboxItem,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/Components/ui/dropdown-menu'
import {Separator} from '@/Components/ui/separator'

export default {
    name: 'ClientInformationsCard',

    components: {
        Button,
        Card,
        CardContent,
        CardDescription,
        CardHeader,
        CardTitle,
        DropdownMenu,
        DropdownMenuCheckboxItem,
        DropdownMenuContent,
        DropdownMenuItem,
        DropdownMenuLabel,
        DropdownMenuSeparator,
        DropdownMenuTrigger,
        Separator
    },

    props: {
        informations: {
            type: Object,
            required: true
        }
    },

    computed: {
        updatedAt() {
            return 'Updated ' + timeAgo(this.informations.updated_at);
        },
    }
}
</script>
