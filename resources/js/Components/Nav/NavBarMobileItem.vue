<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    active: Boolean
})
</script>

<template>
    <Link
       class="block rounded-md px-3 py-2 text-base font-medium"
       :class="{
        'text-gray-300 hover:bg-gray-700 hover:text-white': ! active,
        'bg-gray-900 text-white': active
       }"
    ><slot /></Link>
</template>

<style scoped>

</style>
