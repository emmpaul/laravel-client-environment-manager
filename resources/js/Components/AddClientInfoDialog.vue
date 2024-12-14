<template>
    <TooltipProvider :delay-duration="300">
        <Tooltip>
            <TooltipTrigger>
                <div class="flex justify-center items-center cursor-pointer">
                    <Dialog ref="dialogRef" :title="`Add informations for ${client.name}`">
                        <template #trigger>
                            <CirclePlus class="hover:text-primary" />
                        </template>

                        <form @submit.prevent="submit">
                            <div class="mt-2">
                                <InputLabel for="url" value="URL"/>

                                <TextInput
                                    id="url"
                                    type="url"
                                    class="mt-1 block w-full"
                                    v-model="form.url"
                                    required
                                    autofocus
                                />

                                <InputError class="mt-2" :message="form.errors.url"/>
                            </div>

                            <div class="mt-2">
                                <InputLabel for="server" value="Server"/>

                                <TextInput
                                    id="server"
                                    type="server"
                                    class="mt-1 block w-full"
                                    v-model="form.server"
                                    required
                                    autofocus
                                />

                                <InputError class="mt-2" :message="form.errors.server"/>
                            </div>

                            <div class="mt-2">
                                <InputLabel class="mt-2" for="environment" value="Environment"/>

                                <Select v-model="form.environment">
                                    <SelectTrigger class="w-full">
                                        <SelectValue placeholder="Select an environment" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectGroup>
                                            <SelectLabel>Environments</SelectLabel>
                                            <SelectItem v-for="(env, index) in environments" :value="env.name" :key="index">
                                                {{ env.name }}
                                            </SelectItem>
                                        </SelectGroup>
                                    </SelectContent>
                                </Select>

                                <InputError class="mt-2" :message="form.errors.environment"/>
                            </div>

                            <div class="mt-4 flex items-center justify-end">
                                <PrimaryButton
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                >
                                    Add information for {{ client.name }}
                                </PrimaryButton>
                            </div>
                        </form>
                    </Dialog>
                </div>
            </TooltipTrigger>
            <TooltipContent>
                <p>Add informations for {{ client.name }}</p>
            </TooltipContent>
        </Tooltip>
    </TooltipProvider>
</template>

<script>
import {CirclePlus} from "lucide-vue-next";
import Dialog from "@/Components/Dialog.vue";
import {Link, useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import Checkbox from "@/Components/Checkbox.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import InputError from "@/Components/InputError.vue";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from '@/Components/ui/select/index.js'

import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger
} from '@/Components/ui/tooltip'

export default {
    name: 'AddClientInfoDialog',
    components: {
        InputError,
        PrimaryButton,
        Checkbox,
        TextInput,
        InputLabel,
        Link,
        Dialog,
        CirclePlus,
        Select,
        SelectContent,
        SelectGroup,
        SelectItem,
        SelectLabel,
        SelectTrigger,
        SelectValue,
        Tooltip,
        TooltipContent,
        TooltipProvider,
        TooltipTrigger
    },

    props: {
        client: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            form: useForm({
                client_id: this.client.id,
                url: '',
                server: '',
                environment: ''
            }),
            environments: [
                {
                    'name': 'UAT'
                },
                {
                    'name': 'PROD'
                },
                {
                    'name': 'PRE-PROD'
                }
            ]
        }
    },

    methods: {
        submit() {
            this.form.post(route('informations.store'), {
                onSuccess: () => {
                    this.form.reset('client_id', 'url', 'server', 'environment');
                    this.$refs.dialogRef.close();
                },
            });
        },
    },
}
</script>
