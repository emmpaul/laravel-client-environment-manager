<template>
    <TooltipProvider :delay-duration="300">
        <Tooltip>
            <TooltipTrigger>
                <div class="flex justify-center items-center cursor-pointer">
                    <Dialog ref="dialogRef" :title="$t('informations.add', { name: client.name })">
                        <template #trigger>
                            <CirclePlus class="hover:text-primary" />
                        </template>

                        <InfoForm
                            :client="client"
                            @submitted="closeDialog"
                        />
                    </Dialog>
                </div>
            </TooltipTrigger>
            <TooltipContent>
                <p>{{ $t('informations.add', { name: client.name }) }}</p>
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>

<script>
import { CirclePlus } from "lucide-vue-next"
import Dialog from "@/Components/Dialog.vue"
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger
} from '@/Components/ui/tooltip/index.js'
import InfoForm from "@/Pages/Clients/components/InfoForm.vue"

export default {
    name: 'AddClientInfoDialog',
    components: {
        Dialog,
        CirclePlus,
        Tooltip,
        TooltipContent,
        TooltipProvider,
        TooltipTrigger,
        InfoForm
    },

    props: {
        client: {
            type: Object,
            required: true
        }
    },

    methods: {
        closeDialog() {
            this.$refs.dialogRef.close()
        }
    }
}
</script>
