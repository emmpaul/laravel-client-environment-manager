<template>
    <div :class="classes">
        <slot />
    </div>
</template>
<script>
export default {
    name: 'Grid',
    props: {
        cols: {
            type: Number,
            default: 2
        },
        rows: {
            type: Number,
            default: 4
        },
        gap: {
            type: Number,
            default: 2
        }
    },
    computed: {
        classes() {
            return `grid grid-cols-${this.cols} grid-rows-${this.rows} gap-${this.gap}`
        }
    },
}
</script>
