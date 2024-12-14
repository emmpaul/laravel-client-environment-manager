<script setup>
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import {Head, Link, useForm} from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <div class="w-full lg:min-h-[600px] lg:grid-cols-2 xl:min-h-[800px]">
            <div class="flex items-center justify-center py-12">
                <div class="mx-auto grid w-[550px] gap-6">
                    <div class="grid gap-2 text-center">
                        <h1 class="text-3xl font-bold">
                            Register
                        </h1>
                    </div>
                    <form class="grid gap-4" @submit.prevent="submit">
                        <div class="grid gap-2">
                            <InputLabel for="name" value="Name"/>

                            <TextInput
                                id="name"
                                type="text"
                                v-model="form.name"
                                required
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.email"/>
                        </div>

                        <div class="grid gap-2">
                            <InputLabel for="email" value="Email"/>

                            <TextInput
                                id="email"
                                type="email"
                                v-model="form.email"
                                required
                                autocomplete="email"
                            />

                            <InputError class="mt-2" :message="form.errors.email"/>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="grid gap-2">
                                <InputLabel for="password" value="Password"/>

                                <TextInput
                                    id="password"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="form.password"
                                    required
                                    autocomplete="new-password"
                                />

                                <InputError class="mt-2" :message="form.errors.password"/>
                            </div>

                            <div class="grid gap-2">
                                <InputLabel
                                    for="password_confirmation"
                                    value="Confirm Password"
                                />

                                <TextInput
                                    id="password_confirmation"
                                    type="password"
                                    class="mt-1 block w-full"
                                    v-model="form.password_confirmation"
                                    required
                                    autocomplete="new-password"
                                />

                                <InputError
                                    class="mt-2"
                                    :message="form.errors.password_confirmation"
                                />
                            </div>
                        </div>

                        <PrimaryButton
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                        >
                            Register
                        </PrimaryButton>

                    </form>
                    <PrimaryButton
                        variant="ghost"
                    >
                        <Link :href="route('login')">
                            Already registered?
                        </Link>
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
