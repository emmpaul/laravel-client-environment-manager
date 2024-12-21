<template>
    <TooltipProvider :delay-duration="300">
        <Tooltip>
            <TooltipTrigger>
                <div class="flex justify-center items-center hover:text-primary">
                    <Dialog ref="dialogRef" :title="`Edit ${client.name}`">
                        <template #trigger>
                            <Cog />
                        </template>

                        <ClientForm :client="client" @submit="submit" />
                    </Dialog>
                </div>
            </TooltipTrigger>
            <TooltipContent>
                Edit {{ client.name }}
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>

<script>
import { Cog } from "lucide-vue-next"
import Dialog from "@/Components/Dialog.vue"
import { Link } from "@inertiajs/vue3"
import InputLabel from "@/Components/InputLabel.vue"
import TextInput from "@/Components/TextInput.vue"
import Checkbox from "@/Components/Checkbox.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import InputError from "@/Components/InputError.vue"
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from "@/Components/ui/tooltip/index.js"
import ClientForm from "@/Pages/Clients/components/ClientForm.vue"

export default {
    name: "AddClientDialog",
    components: {
        InputError,
        PrimaryButton,
        Checkbox,
        TextInput,
        InputLabel,
        Link,
        Dialog,
        Cog,
        Tooltip,
        TooltipContent,
        TooltipProvider,
        TooltipTrigger,
        ClientForm
    },

    props: {
        client: {
            type: Object,
            required: true,
        },
    },

    methods: {
        submit(form) {
            form.patch(route("clients.update", { client: this.client.id }), {
                onSuccess: () => {
                    this.$refs.dialogRef.close()
                },
            })
        },
    },
}
</script>

