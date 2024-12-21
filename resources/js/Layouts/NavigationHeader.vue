<template>
    <div class="flex h-14 items-center border-b px-3 lg:h-[60px]">
        <a href="/clients" class="flex items-center gap-2 font-semibold">
            <Package2 class="h-6 w-6" />
            <span class="">{{ APP_NAME }}</span>
        </a>
    </div>
</template>

<script>
import {Package2} from "lucide-vue-next";

export default {
    name: 'NavigationHeader',
    components: {Package2},

    data() {
        return {
            APP_NAME: import.meta.env.VITE_APP_NAME
        }
    }
}
</script>
