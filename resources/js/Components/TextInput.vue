<script setup>
import { onMounted, ref } from 'vue';

import { Input } from '@/Components/ui/input'

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <Input v-model="model" ref="input" />
</template>
