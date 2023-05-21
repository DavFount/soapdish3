<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    active: Boolean
})
</script>

<template>
    <Link
       class="block rounded-md px-3 py-2 text-base font-medium text-gray-600 dark:text-gray-300"
       :class="{
        'hover:bg-gray-300 dark:hover:bg-gray-900': ! active,
        'bg-gray-300 dark:bg-gray-900': active
       }"
    ><slot /></Link>
</template>

<style scoped>

</style>
