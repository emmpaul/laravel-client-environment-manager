<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';
import {Home} from "lucide-vue-next";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'flex items-center gap-3 rounded-lg bg-muted px-3 py-2 text-primary transition-all hover:text-primary'
        : 'flex items-center gap-3 rounded-lg py-2 px-3 text-muted-foreground transition-all hover:text-primary',
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
