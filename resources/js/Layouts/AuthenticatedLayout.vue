<script setup lang="ts">
import {Package2, Search, UsersRound, LayoutDashboard} from 'lucide-vue-next'
import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";
import NavLink from "@/Components/NavLink.vue";
import UserToggle from "@/Components/UserToggle.vue";
import NProgress from 'nprogress'
import { router } from '@inertiajs/vue3'

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

const APP_NAME = import.meta.env.VITE_APP_NAME
</script>

<template>
    <div class="grid min-h-screen w-full md:grid-cols-[220px_1fr] lg:grid-cols-[280px_1fr]">
        <div class="hidden border-r bg-muted/40 md:block">
            <div class="flex h-full max-h-screen flex-col gap-2">
                <div class="flex h-14 items-center border-b px-3 lg:h-[60px]">
                    <a href="/clients" class="flex items-center gap-2 font-semibold">
                        <Package2 class="h-6 w-6" />
                        <span class="">{{ APP_NAME }}</span>
                    </a>
                </div>
                <div class="flex-1">
                    <nav class="grid items-start text-sm font-medium">
                        <NavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')"
                        >
                            <LayoutDashboard />
                            Dashboard
                        </NavLink>
                        <NavLink
                            :href="route('clients.index')"
                            :active="route().current('clients.index')"
                        >
                            <UsersRound />
                            Clients
                        </NavLink>
                        <NavLink
                            :href="route('search.index')"
                            :active="route().current('search.index')"
                        >
                            <Search />
                            Search
                        </NavLink>
                    </nav>
                </div>
            </div>
        </div>
        <div class="flex flex-col">
            <header class="flex h-14 items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6">
                <slot name="header" />
                <slot name="search" v-if="$slots.search" />
                <div class="w-full flex-1" v-else />
                <UserToggle />
                <ThemeSwitcher />
            </header>
            <main class="flex flex-1 flex-col gap-4 p-4 lg:gap-6 lg:p-6">
                <slot />
            </main>
        </div>
    </div>
</template>
