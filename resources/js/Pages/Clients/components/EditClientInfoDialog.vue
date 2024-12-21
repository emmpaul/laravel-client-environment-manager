<template>
    <TooltipProvider :delay-duration="300">
        <Tooltip>
            <TooltipTrigger>
                <div class="flex justify-center items-center cursor-pointer">
                    <Dialog ref="dialogRef" title="Edit informations">
                        <template #trigger>
                            <Cog class="hover:text-primary" />
                        </template>

                        <InfoForm
                            :client="client"
                            :information-id="informationId"
                            @submitted="closeDialog"
                        />
                    </Dialog>
                </div>
            </TooltipTrigger>
            <TooltipContent>
                <p>Edit informations</p>
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>

<script>
import { Cog } from "lucide-vue-next"
import Dialog from "@/Components/Dialog.vue"
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger
} from '@/Components/ui/tooltip/index.js'
import InfoForm from "@/Pages/Clients/components/InfoForm.vue"

export default {
    name: 'EditClientInfoDialog',
    components: {
        Dialog,
        Cog,
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
        },
        informationId: {
            type: Number,
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
