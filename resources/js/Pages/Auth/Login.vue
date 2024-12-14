<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in"/>

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <div class="w-full lg:min-h-[600px] lg:grid-cols-2 xl:min-h-[800px]">
            <div class="flex items-center justify-center py-12">
                <div class="mx-auto grid w-[550px] gap-6">
                    <div class="grid gap-2 text-center">
                        <h1 class="text-3xl font-bold">
                            Log in
                        </h1>
                    </div>

                    <form @submit.prevent="submit">
                        <div>
                            <InputLabel for="email" value="Email"/>

                            <TextInput
                                id="email"
                                type="email"
                                class="mt-1 block w-full"
                                v-model="form.email"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.email"/>
                        </div>

                        <div class="mt-4">
                            <InputLabel for="password" value="Password"/>

                            <TextInput
                                id="password"
                                type="password"
                                class="mt-1 block w-full"
                                v-model="form.password"
                                required
                                autocomplete="current-password"
                            />

                            <InputError class="mt-2" :message="form.errors.password"/>
                        </div>

                        <div class="mt-4 flex justify-between">
                            <label class="flex items-center">
                                <Checkbox name="remember" v-model:checked="form.remember"/>
                                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                                    Remember me
                                </span>
                            </label>

                            <Link
                                v-if="canResetPassword"
                                :href="route('password.request')"
                                class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                            >
                                Forgot your password?
                            </Link>
                        </div>

                        <div class="mt-4 flex items-center justify-end">
                            <PrimaryButton
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Log in
                            </PrimaryButton>
                        </div>
                    </form>

                    <PrimaryButton
                        variant="ghost"
                    >
                        <Link :href="route('register')">
                            Don't have an account ?
                        </Link>
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
