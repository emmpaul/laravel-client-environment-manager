<template>
    <TooltipProvider :delay-duration="300">
        <Tooltip>
            <TooltipTrigger>
                <div class="flex justify-center items-center hover:text-primary">
                    <Dialog ref="dialogRef" title="Add a client">
                        <template #trigger>
                            <UserRoundPlus />
                        </template>

                        <ClientForm @submit="submit" />
                    </Dialog>
                </div>
            </TooltipTrigger>
            <TooltipContent>
                Add a client
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>

<script>
import {UserRoundPlus} from "lucide-vue-next"
import Dialog from "@/Components/Dialog.vue"
import {Link} from "@inertiajs/vue3"
import InputLabel from "@/Components/InputLabel.vue"
import TextInput from "@/Components/TextInput.vue"
import Checkbox from "@/Components/Checkbox.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import InputError from "@/Components/InputError.vue"
import {Tooltip, TooltipContent, TooltipProvider, TooltipTrigger} from '@/Components/ui/tooltip/index.js'
import ClientForm from "@/Pages/Clients/components/ClientForm.vue"

export default {
    name: 'AddClientDialog',
    components: {
        InputError,
        PrimaryButton,
        Checkbox,
        TextInput,
        InputLabel,
        Link,
        Dialog,
        UserRoundPlus,
        Tooltip,
        TooltipContent,
        TooltipProvider,
        TooltipTrigger,
        ClientForm
    },

    methods: {
        submit(form) {
            form.post(route('clients.store'), {
                onSuccess: () => {
                    form.reset('name')
                    this.$refs.dialogRef.close()
                },
            })
        },
    },
}
</script>
