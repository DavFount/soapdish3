<script setup>
import NavBarMobileItem from "@/Components/Nav/NavBarMobileItem.vue";

defineEmits(['toggle'])
</script>

<template>
    <div class="lg:hidden">
        <div class="space-y-1 px-2 pb-3 pt-2">
            <NavBarMobileItem :href="route('Home')" :active="$page.component == 'Home'" v-text="'Home'"/>
            <NavBarMobileItem :href="route('dashboard')" :active="$page.component == 'Studies'" v-text="'Studies'"/>
            <NavBarMobileItem :href="route('dashboard')" :active="$page.component == 'Community'" v-text="'Community'"/>
        </div>
        <div class="border-t border-gray-700 pb-3 pt-4">
            <div class="flex items-center px-5">
                <div>
                    <div class="text-base font-medium text-white">Tom Cook</div>
                    <div class="text-sm font-medium text-gray-400">tom@example.com</div>
                </div>
            </div>
            <div class="mt-3 space-y-1 px-2">
                <NavBarMobileItem :href="route('dashboard')" v-text="'Dashboard'"/>
                <NavBarMobileItem :href="route('profile.show')" v-text="'Profile'"/>
                <NavBarMobileItem :href="route('logout')" method="post" as="button" v-text="'Sign Out'"
                                  v-if="$page.props.auth.user" @click="$emit('toggle')"/>
                <NavBarMobileItem :href="route('login')" v-text="'Sign In'" v-else/>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
