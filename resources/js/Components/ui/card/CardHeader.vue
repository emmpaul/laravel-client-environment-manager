<script setup>
import { cn } from '@/lib/utils';

const props = defineProps({
  class: { type: null, required: false },
});
</script>

<template>
  <div :class="cn('flex justify-between items-center gap-y-1.5 p-6', props.class)">
    <slot />
  </div>
</template>
