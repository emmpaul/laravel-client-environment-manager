<script setup>
import { Label } from '@/Components/ui/label'

defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <Label>
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </Label>
</template>
