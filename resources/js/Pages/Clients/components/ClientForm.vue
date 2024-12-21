<template>
    <form @submit.prevent="processForm">
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

        <div class="mt-4 flex flex-col gap-4 items-center justify-end">
            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing || client.name === form.name"
            >
                {{ client ? 'Confirm changes' : 'Add a client' }}
            </PrimaryButton>

            <span class="text-sm text-gray-600 dark:text-gray-400" v-if="client.name === form.name">
                <MessageCircleWarning class="inline-block w-5 h-5 mr-2" />
                {{  `Client name needs to be different from ${client.name}` }}
            </span>
        </div>
    </form>
</template>

<script>
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import {useForm} from "@inertiajs/vue3";
import { MessageCircleWarning } from "lucide-vue-next"

export default {
    name: "ClientForm" ,
    components: {
        TextInput,
        PrimaryButton,
        InputError,
        InputLabel,
        MessageCircleWarning
    },

    emits: ['submit'],

    props: {
        client: {
            type: Object,
            default: () => {}
        },
    },

    data() {
        return {
            form: useForm({
                name: this.client ? this.client.name : ''
            })
        }
    },

    methods: {
        processForm() {
            this.$emit('submit', this.form)
        }
    }
}
</script>
