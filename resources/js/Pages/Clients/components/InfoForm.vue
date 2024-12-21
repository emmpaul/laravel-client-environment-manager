<template>
    <form @submit.prevent="processForm">
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
                    <SelectValue placeholder="Select an environment"/>
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
                {{ informationId ? 'Update' : 'Add' }} informations for {{ client.name }}
            </PrimaryButton>
        </div>
    </form>
</template>

<script>
import { useForm } from "@inertiajs/vue3"
import InputLabel from "@/Components/InputLabel.vue"
import InputError from "@/Components/InputError.vue"
import PrimaryButton from "@/Components/PrimaryButton.vue"
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectItem,
    SelectLabel,
    SelectTrigger,
    SelectValue,
} from "@/Components/ui/select/index.js"
import TextInput from "@/Components/TextInput.vue"

export default {
    name: "InfoForm",
    components: {
        TextInput,
        Select,
        SelectContent,
        SelectGroup,
        SelectItem,
        SelectLabel,
        SelectTrigger,
        SelectValue,
        PrimaryButton,
        InputError,
        InputLabel,
    },
    props: {
        client: {
            type: Object,
            required: true,
        },
        informationId: {
            type: Number,
            default: null,
        },
    },
    data() {
        return {
            form: useForm({
                client_id: this.client.id,
                url: this.informationId ? this.client.informations.find((information) => information.id === this.informationId).url : "",
                server: this.informationId ? this.client.informations.find((information) => information.id === this.informationId).server : "",
                environment: this.informationId ? this.client.informations.find((information) => information.id === this.informationId).environment : "",
            }),
            environments: [
                {name: "UAT"},
                {name: "PROD"},
                {name: "PRE-PROD"},
            ],
        }
    },
    methods: {
        processForm() {
            if (this.informationId) {
                this.form.patch(route('informations.update', {information: this.informationId}), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset()
                        this.$emit('submitted')
                    },
                })
            } else {
                this.form.post(route('informations.store'), {
                    preserveScroll: true,
                    onSuccess: () => {
                        this.form.reset()
                        this.$emit('submitted')
                    },
                })
            }
        },
    },
}
</script>
