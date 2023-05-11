<script setup>
import {Link} from "@inertiajs/vue3";

defineProps({
    active: Boolean
})
</script>

<template>
    <Link class="block px-4 py-2 text-sm text-gray-700"
          :class="{
        'bg-gray-100': active,
        'hover:bg-gray-200': ! active
    }"
          >
        <slot/>
    </Link>
</template>

<style scoped>

</style>
