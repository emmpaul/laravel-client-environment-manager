<template>
    <header class="flex h-14 justify-between items-center gap-4 border-b bg-muted/40 px-4 lg:h-[60px] lg:px-6">
        <div class="flex items-center gap-4">
            <slot name="header" v-if="$slots.header" />
            <slot name="search" v-if="$slots.search" />
            <div class="w-full flex-1" v-else />
        </div>
        <div class="flex items-center gap-4">
            <UserToggle v-if="$page.props.auth.user" />
            <RegisterOrLogin v-else />
            <ThemeSwitcher />
        </div>
    </header>
</template>

<script>

import ThemeSwitcher from "@/Components/ThemeSwitcher.vue";
import UserToggle from "@/Components/UserToggle.vue";
import RegisterOrLogin from "@/Components/RegisterOrLogin.vue";
export default {
    name: 'LayoutHeader',
    components: {ThemeSwitcher, UserToggle, RegisterOrLogin}
}
</script>
