<script setup>
import {Button} from '@/Components/ui/button'

defineProps({
    variant: {
        type: String,
        default: ''
    },
});
</script>

<template>
    <Button as="button" :variant="variant ? variant : ''" class="w-full">
        <slot />
    </Button>
</template>
