<script setup>
import NavBarMobileItem from "@/Components/Nav/NavBarMobileItem.vue";

defineEmits(['toggle'])
</script>

<template>
    <div class="absolute right-2 top-16 w-64 border-l border-b border-r border-gray-400 dark:border-gray-600">
        <div class="lg:hidden bg-gray-100 dark:bg-gray-800">
            <div class="space-y-1 px-2 pb-3 pt-2">
                <NavBarMobileItem :href="route('Home')" :active="$page.component == 'Home'" v-text="'Home'"/>
                <NavBarMobileItem :href="route('dashboard')" :active="$page.component == 'Studies'" v-text="'Studies'"/>
                <NavBarMobileItem :href="route('dashboard')" :active="$page.component == 'Community'"
                                  v-text="'Community'"/>
            </div>

            <div class="border-t border-gray-700 pb-3">
                <div class="mt-3 space-y-1 px-2">
                    <NavBarMobileItem :href="route('dashboard')" v-text="'Dashboard'"/>
                    <NavBarMobileItem :href="route('profile.show')" v-text="'Profile'"/>
                    <NavBarMobileItem :href="route('logout')" method="post" as="button" v-text="'Sign Out'"
                                      v-if="$page.props.auth.user" @click="$emit('toggle')"/>
                    <NavBarMobileItem :href="route('login')" v-text="'Sign In'" v-else/>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
