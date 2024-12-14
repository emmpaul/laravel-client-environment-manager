<template>
    <TooltipProvider :delay-duration="300">
        <Tooltip>
            <TooltipTrigger>
                <div class="flex justify-center items-center hover:text-primary">
                    <Dialog ref="dialogRef" title="Add a client">
                        <template #trigger>
                            <UserRoundPlus />
                        </template>

                        <form @submit.prevent="submit">
                            <div>
                                <InputLabel for="name" value="Name"/>

                                <TextInput
                                    id="name"
                                    type="name"
                                    class="mt-1 block w-full"
                                    v-model="form.name"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />

                                <InputError class="mt-2" :message="form.errors.name"/>
                            </div>

                            <div class="mt-4 flex items-center justify-end">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Add a client
                                </PrimaryButton>
                            </div>
                        </form>
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
import {UserRoundPlus} from "lucide-vue-next";
import Dialog from "@/Components/Dialog.vue";
import {Link, useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger
} from '@/Components/ui/tooltip'

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
        TooltipTrigger
    },

    data() {
        return {
            form: useForm({
                name: ''
            })
        }
    },

    methods: {
        submit() {
            this.form.post(route('clients.store'), {
                onSuccess: () => {
                    this.form.reset('name');
                    this.$refs.dialogRef.close();
                },
            });
        },
    },
}
</script>
