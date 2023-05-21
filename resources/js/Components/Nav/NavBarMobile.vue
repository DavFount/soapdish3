<script setup>
import NavBarMobileItem from "@/Components/Nav/NavBarMobileItem.vue";

defineEmits(['toggle'])
</script>

<template>
    <div class="absolute right-2 top-16 w-64 border-l border-b border-r border-gray-400 dark:border-gray-600">
        <div class="lg:hidden bg-gray-100 dark:bg-gray-800">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <NavBarMobileItem :href="route('home')" :active="$page.component == 'Home'" v-text="'Home'"/>
                <NavBarMobileItem :href="route('bible')" :active="$page.component == 'Bible/Index'" v-text="'Bible'"/>
                <NavBarMobileItem :href="route('dashboard')" :active="$page.component == 'Dashboard'" v-text="'Dashboard'"/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
