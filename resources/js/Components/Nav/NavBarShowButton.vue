<script setup>
defineProps({
    open: Boolean
})

defineEmits(['toggle'])

</script>

<template>
    <div class="flex lg:hidden">
        <!-- Mobile menu button -->
        <button type="button"
                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                aria-controls="mobile-menu" aria-expanded="false"
                @click="$emit('toggle')"
        >
            <span class="sr-only">Open main menu</span>
            <!-- Closed SVG -->
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" aria-hidden="true"
                 v-if="! open"
            >
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
            </svg>
            <!-- Open SVG -->
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" aria-hidden="true"
                 v-else
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
</template>

<style scoped>

</style>
