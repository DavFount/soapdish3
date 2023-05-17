<script setup>

import SidebarItem from "@/Components/Nav/Admin/SidebarItem.vue";
</script>

<template>
    <div
        class="hidden min-h-screen lg:fixed lg:inset-y-16 lg:z-50 lg:flex lg:w-72 lg:flex-col border-r border-gray-400 dark:border-gray-600">
        <div class="flex grow flex-col gap-y-1 overflow-y-auto bg-gray-100 dark:bg-gray-800 px-6">
            <nav class="flex flex-1 flex-col mt-8">
                <ul role="list" class="flex flex-1 flex-col gap-y-7">
                    <li>
                        <ul role="list" class="-mx-2 space-y-1">
                            <li>
                                <SidebarItem :href="route('dashboard')" :active="$page.component === 'Dashboard'">
                                    <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                         stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
                                    </svg>
                                    Dashboard
                                </SidebarItem>
                            </li>
                            <li>
                                <SidebarItem :href="route('community.index')"
                                             :active="$page.component === 'Community/Index'">
                                    <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                         stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>
                                    </svg>
                                    Team
                                </SidebarItem>
                            </li>
                            <!--                            <li>-->
                            <!--                                <SidebarItem :href="route('community.index')"-->
                            <!--                                             :active="$page.component === 'Community/Index'">-->
                            <!--                                    <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5"-->
                            <!--                                         stroke="currentColor" aria-hidden="true">-->
                            <!--                                        <path stroke-linecap="round" stroke-linejoin="round"-->
                            <!--                                              d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z"/>-->
                            <!--                                    </svg>-->
                            <!--                                    Studies-->
                            <!--                                </SidebarItem>-->
                            <!--                            </li>-->
                            <li>
                                <SidebarItem :href="route('prayerlist.index')"
                                             :active="$page.component === 'PrayerList/Index'">
                                    <svg class="h-6 w-6 stroke-gray-300" viewBox="0 0 24.00 24.00" id="Layer_1"
                                         data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                           stroke="#CCCCCC" stroke-width="0.048"></g>
                                        <g id="SVGRepo_iconCarrier">
                                            <path class="cls-1"
                                                  d="M5.29,15.83V9.12A1.92,1.92,0,0,0,3.38,7.21h0A1.92,1.92,0,0,0,1.46,9.12v7.29A3.79,3.79,0,0,0,2.3,18.8l3,3.74v1"></path>
                                            <path class="cls-1"
                                                  d="M7.21,17.75,5.89,16.43A2,2,0,0,1,5.29,15h0a2,2,0,0,1,2-2h0a2,2,0,0,1,1.44.59L11.4,16.2a2,2,0,0,1,.6,1.43V23.5"></path>
                                            <path class="cls-1"
                                                  d="M18.71,15.83V9.12a1.92,1.92,0,0,1,1.91-1.91h0a1.92,1.92,0,0,1,1.91,1.91v7.29a3.79,3.79,0,0,1-.84,2.39l-3,3.74v1"></path>
                                            <path class="cls-1"
                                                  d="M16.79,17.75l1.32-1.32a2,2,0,0,0,.6-1.44h0a2,2,0,0,0-2-2h0a2,2,0,0,0-1.44.59L12.6,16.2a2,2,0,0,0-.6,1.43V23.5"></path>
                                            <line class="cls-1" x1="12" y1="0.5" x2="12" y2="11.04"></line>
                                            <line class="cls-1" x1="8.17" y1="4.01" x2="15.83" y2="4.01"></line>
                                        </g>
                                    </svg>
                                    Prayer List
                                </SidebarItem>
                            </li>
                            <li v-if="$page.props.auth.user.isAdmin">
                                <span class="text-xs text-gray-600 dark:text-gray-400">
                                    Settings
                                </span>
                                <ul>
                                    <li>
                                        <SidebarItem :href="route('languages.index')"
                                                     :active="$page.component === 'Language/Index'">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                                            </svg>
                                            Languages
                                        </SidebarItem>
                                    </li>
                                    <li>
                                        <SidebarItem :href="route('translations.index')"
                                                     :active="$page.component === 'Translation/Index'">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                            </svg>
                                            Translations
                                        </SidebarItem>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<style scoped>
.cls-1 {
    fill: none;
    //stroke: #020202;
    stroke-miterlimit: 10;
    stroke-width: 1.5;
}
</style>
