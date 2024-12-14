<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div
        class="flex min-h-screen flex-col items-center bg-background pt-6 sm:justify-center sm:pt-0"
    >
        <nav class="flex justify-between items-center w-[550px]">
            <Link href="/">
                <ApplicationLogo class="h-20 w-20 fill-current text-gray-500" />
            </Link>
            <ThemeSwitcher />
        </nav>

        <slot />
    </div>
</template>
