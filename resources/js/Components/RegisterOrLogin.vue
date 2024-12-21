<template>
    <div class="flex items-center gap-4">
        <PrimaryButton>
            <Link :href="route('login')">
                Login
            </Link>
        </PrimaryButton>
        <PrimaryButton variant="outline">
            <Link :href="route('register')">
                Register
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
