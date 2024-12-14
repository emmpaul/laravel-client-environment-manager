<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="block bg-background w-full px-4 py-2 text-start text-sm leading-5 text-primary hover:text-white hover:bg-primary transition duration-150 ease-in-out focus:bg-gray-100 hover:text-primary focus:outline-none dark:focus:bg-gray-800"
    >
        <slot />
    </Link>
</template>
