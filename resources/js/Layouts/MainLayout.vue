<template>
    <div class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
        <div class="hidden border-r bg-muted/40 md:block">
            <div class="flex h-full max-h-screen flex-col gap-2">
                <NavigationHeader />
                <Navigation />
            </div>
        </div>
        <div class="flex flex-col">
            <LayoutHeader>
                <template #header>
                    <slot name="header" />
                </template>

                <template #search>
                    <slot name="search" />
                </template>
            </LayoutHeader>

            <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6">
                <slot />

                <footer v-if="$slots.bottom" class="bg-primary h-10 mt-auto flex items-center justify-center">
                    <slot name="bottom" />
                </footer>
            </main>
        </div>
    </div>
</template>

<script setup lang="ts">
import {router} from "@inertiajs/vue3"
import Navigation from "@/Layouts/Navigation.vue"
import NavigationHeader from "@/Layouts/NavigationHeader.vue"
import LayoutHeader from "@/Layouts/LayoutHeader.vue"
import NProgress from 'nprogress'

let timeout = null

router.on('start', () => {
    timeout = setTimeout(() => NProgress.start(), 250)
})

router.on('finish', (event) => {
    clearTimeout(timeout)
    if (!NProgress.isStarted()) {
        return
    }
})

router.on('progress', event => {
    if (!NProgress.isStarted()) {
        return
    }
})
</script>
