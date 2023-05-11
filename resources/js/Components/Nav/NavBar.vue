<script setup>
import ApplicationMark from "@/Components/ApplicationMark.vue";
import NavBarItem from "@/Components/Nav/NavBarItem.vue";
import ThemeSwitcher from "@/Components/Nav/ThemeSwitcher.vue";
import NavBarShowButton from "@/Components/Nav/NavBarShowButton.vue";
import NavBarMobile from "@/Components/Nav/NavBarMobile.vue";
import TeamSwitcher from "@/Components/Nav/TeamSwitcher.vue";
import SettingsDropdown from "@/Components/Nav/SettingsDropdown.vue";
import AuthLinks from "@/Components/AuthLinks.vue";
import {ref} from "vue";

const mobileMenu = {
    show: ref(false),
    toggle: () => {
        mobileMenu.show.value = ! mobileMenu.show.value;
    }
}
</script>

<template>
    <nav class="bg-gray-100 dark:bg-gray-800 border-b border-gray-400 dark:border-gray-600">
        <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex items-center px-2 lg:px-0">
                    <div class="flex-shrink-0">
                        <ApplicationMark class="w-32"/>
                    </div>
                    <div class="hidden lg:ml-6 lg:block">
                        <div class="flex space-x-4">
                            <NavBarItem :href="route('Home')" :active="$page.component === 'Home'">Home</NavBarItem>
                            <NavBarItem :href="route('Home')" :active="$page.component === 'Studies'">Studies
                            </NavBarItem>
                            <NavBarItem :href="route('community.index')" :active="$page.component === 'Community/Index'" v-text="'Community'" />
                        </div>
                    </div>
                </div>
                <div class="flex align-middle">
                    <NavBarShowButton :open="mobileMenu.show.value" @toggle="mobileMenu.toggle"/>
                    <ThemeSwitcher class="hidden lg:flex" />
                    <div class="flex" v-if="$page.props.auth.user">
                        <TeamSwitcher />
                        <SettingsDropdown />
                    </div>
                    <AuthLinks v-else/>
                </div>
            </div>
        </div>
        <Transition>
            <NavBarMobile v-if="mobileMenu.show.value" @toggle="mobileMenu.toggle" />
        </Transition>
    </nav>
</template>

<style scoped>
.v-enter-active,
.v-leave-active {
    transition: opacity 0.25s ease;
}

.v-enter-from,
.v-leave-to {
    opacity: 0;
}
</style>
