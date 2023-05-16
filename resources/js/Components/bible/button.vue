<script setup>
defineProps({
    disabled: Boolean
})
</script>

<template>
    <Component
            :is="disabled ? 'span' : 'button'"
            class="py-2 px-2 border border-gray-300 dark:border-gray-600 text-sm rounded"
            :class="{
                'hover:bg-gray-100 dark:hover:bg-gray-700': ! disabled,
                'text-gray-300 dark:text-gray-600': disabled
            }"
    ><slot /></Component>
</template>

<style scoped>

</style>
