<template>
    <div class="flex-1">
        <nav class="grid items-start text-sm font-medium">
            <NavLink
                :href="route('dashboard')"
                :active="route().current('dashboard')"
            >
                <LayoutDashboard/>
                {{ $t('dashboard.title') }}
            </NavLink>
            <NavLink
                :href="route('clients.index')"
                :active="route().current('clients.index')"
            >
                <UsersRound/>
                {{ $t('clients.title') }}
            </NavLink>
            <NavLink
                :href="route('search.index')"
                :active="route().current('search.index')"
            >
                <Search/>
                {{ $t('search.title') }}
            </NavLink>
        </nav>
    </div>
</template>

<script>
import {LayoutDashboard, Search, UsersRound} from "lucide-vue-next";
import NavLink from "@/Components/NavLink.vue";

export default {
    name: 'Navigation',
    components: {NavLink, LayoutDashboard, UsersRound, Search}
}
</script>
