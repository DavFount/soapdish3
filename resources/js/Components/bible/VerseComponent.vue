<script setup>
const props = defineProps({
    number: Number,
})
</script>

<template>
    <div class="flex py-3">
        <span class="text-xs align-super mr-1">{{ number }}</span>

        <p>
            <slot/>
        </p>
    </div>
</template>

<style scoped>
</style>
