<script setup>
import {Link, router} from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};
</script>

<template>
    <div class="relative">
        <Dropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">
            <template #trigger>
                <span class="inline-flex rounded-md">
                    <button type="button"
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-900 hover:text-gray-900 dark:hover:text-gray-300 focus:outline-none focus:bg-gray-200 dark:focus:bg-gray-900 active:bg-gray-50 dark:active:bg-gray-700 transition ease-in-out duration-150">
                        {{ $page.props.auth.user.current_team.name }}

                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"/>
                        </svg>
                    </button>
                </span>
            </template>

            <template #content>
                <div class="w-60">
                    <!-- Team Management -->
                    <template v-if="$page.props.jetstream.hasTeamFeatures">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Manage Team
                        </div>

                        <!-- Team Settings -->
                        <DropdownLink :href="route('teams.show', $page.props.auth.user.current_team)">
                            Team Settings
                        </DropdownLink>

                        <DropdownLink v-if="$page.props.jetstream.canCreateTeams" :href="route('teams.create')">
                            Create New Team
                        </DropdownLink>

                        <!-- Team Switcher -->
                        <template v-if="$page.props.auth.user.all_teams.length > 1">
                            <div class="border-t border-gray-200 dark:border-gray-600"/>

                            <div class="block px-4 py-2 text-xs text-gray-400">
                                Switch Teams
                            </div>

                            <template v-for="team in $page.props.auth.user.all_teams" :key="team.id">
                                <button :active="team.id == $page.props.auth.user.current_team_id"
                                        class="block px-4 py-2 text-sm leading-5 text-gray-700 dark:text-gray-300 transition duration-150 ease-in-out w-full"
                                        :class="{
                                            'bg-gray-100 dark:bg-gray-800': active,
                                            'hover:bg-gray-100 dark:hover:bg-gray-800': ! active,
                                          }"
                                        @click="switchToTeam(team)"
                                    >
                                    <div class="flex items-center">
                                        <svg v-if="team.id == $page.props.auth.user.current_team_id"
                                             class="mr-2 h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                                             fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>

                                        <div>{{ team.name }}</div>
                                    </div>
                                </button>
                            </template>
                        </template>
                    </template>
                </div>
            </template>
        </Dropdown>
    </div>
</template>

<style scoped>

</style>
