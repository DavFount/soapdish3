<script setup>
const props = defineProps({
    verseId: Number,
    number: Number,
    selected: Boolean,
    highlight: String,
    underline: String,
    textSize: Number,
})
</script>

<template>
    <div class="flex" @click="$emit('selected', verseId)">
        <span class="text-xs align-super mr-1">{{ number }}</span>
        <div :class="underline + ' ' + highlight">
            <p class="text-md"
               :class="
                {
                    'underline underline-offset-8 decoration-dotted decoration-1': selected,
                    'text-sm': textSize === 1,
                    'text-md': textSize === 2,
                    'text-lg': textSize === 3,
                    'text-xl': textSize === 4,
                    'text-2xl': textSize === 5,
                }">
                <slot/>
            </p>
        </div>
    </div>
</template>

<style scoped>
</style>
