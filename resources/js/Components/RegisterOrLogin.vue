<template>
    <div class="flex items-center gap-4">
        <PrimaryButton>
            <Link :href="route('login')">
                {{ $t('login') }}
            </Link>
        </PrimaryButton>
        <PrimaryButton variant="outline">
            <Link :href="route('register')">
                {{ $t('register') }}
            </Link>
        </PrimaryButton>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";

export default {
    name: 'RegisterOrLogin',
    components: {PrimaryButton, Link}
}
</script>
