<template>
    <Dialog :open="isOpen" @update:open="isOpen = $event">
        <DialogTrigger>
            <slot name="trigger" v-if="$slots.trigger" />
            <span v-else>Trigger</span>
        </DialogTrigger>
        <DialogContent>
            <DialogHeader>
                <DialogTitle>{{ title }}</DialogTitle>
                <DialogDescription v-if="description">
                    {{ description }}
                </DialogDescription>
            </DialogHeader>

            <slot />
        </DialogContent>
    </Dialog>
</template>

<script>
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from '@/Components/ui/dialog'
export default {
    name: 'AddClientDialog',

    components: {
        Dialog,
        DialogContent,
        DialogDescription,
        DialogFooter,
        DialogHeader,
        DialogTitle,
        DialogTrigger,
    },

    props: {
        title: {
            type: String,
            required: true
        },
        description: {
            type: String,
            default: ''
        },
    },

    data() {
        return {
            isOpen: false
        }
    },

    methods: {
        close() {
            this.isOpen = false;
        },
        open() {
            this.isOpen = true;
        }
    }
}
</script>
