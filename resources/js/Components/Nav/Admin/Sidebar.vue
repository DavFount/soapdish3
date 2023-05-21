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
                            <li>
                                <SidebarItem :href="route('studies.index')"
                                             :active="$page.component === 'Studies/Index'">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                                    </svg>

                                    Studies
                                </SidebarItem>
                            </li>
                            <li>
                                <SidebarItem :href="route('prayerlist.index')"
                                             :active="$page.component === 'PrayerList/Index'">
                                    <svg class="h-6 w-6 stroke-gray-600 dark:stroke-gray-300" viewBox="0 0 24.00 24.00" id="Layer_1"
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
                            <li>
                                <SidebarItem :href="route('prayerrequests.index')"
                                             :active="$page.component === 'PrayerRequests/Index'">
                                    <svg class="h-6 w-6 fill-gray-600 dark:fill-gray-300" id="Capa_1"
                                         xmlns="http://www.w3.org/2000/svg"
                                         viewBox="0 0 263.976 263.976" xml:space="preserve"
                                         stroke-width="0.00263976"><g id="SVGRepo_bgCarrier"></g>
                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                           stroke-linejoin="round"></g>
                                        <g id="SVGRepo_iconCarrier"> <g> <path
                                            d="M149.763,36.21c3.01-3.811,4.871-8.616,4.871-13.837C154.634,10.036,144.628,0,132.291,0s-22.358,10.036-22.358,22.373 c0,5.222,1.597,10.026,4.605,13.837c-9.211,5.839-15.55,16.117-15.55,27.807v27.22c0,4.143,3.785,7.739,7.928,7.739h50.811 c4.143,0,7.262-3.597,7.262-7.739v-27.22C164.988,52.327,158.976,42.048,149.763,36.21z"></path>
                                            <path
                                                d="M81.988,124.539v-27.22c0-11.689-5.754-21.969-14.967-27.807c3.01-3.811,5-8.616,5-13.837 c0-12.337-9.942-22.373-22.279-22.373S27.416,43.339,27.416,55.676c0,5.222,1.855,10.026,4.863,13.837 c-9.212,5.839-15.292,16.117-15.292,27.807v27.22c0,4.143,3.301,7.437,7.443,7.437h50.811 C79.384,131.976,81.988,128.682,81.988,124.539z"></path>
                                            <path
                                                d="M232.034,69.513c3.008-3.811,5.006-8.616,5.006-13.837c0-12.337-9.939-22.373-22.276-22.373 c-12.337,0-22.325,10.036-22.325,22.373c0,5.222,1.843,10.026,4.852,13.837c-9.212,5.839-15.304,16.117-15.304,27.807v27.22 c0,4.143,3.326,7.437,7.469,7.437h50.811c4.143,0,6.721-3.294,6.721-7.437v-27.22C246.988,85.63,241.245,75.351,232.034,69.513z"></path>
                                            <path
                                                d="M149.763,201.464c3.01-3.811,4.871-8.615,4.871-13.836c0-12.337-10.006-22.373-22.343-22.373s-22.358,10.036-22.358,22.373 c0,5.221,1.597,10.026,4.605,13.837c-9.211,5.839-15.55,16.117-15.55,27.807v27.22c0,4.143,3.785,7.484,7.928,7.484h50.811 c4.143,0,7.262-3.342,7.262-7.484v-27.22C164.988,217.581,158.976,207.304,149.763,201.464z M132.321,180.255 c4.065,0,7.373,3.308,7.373,7.373c0,4.066-3.308,7.373-7.373,7.373s-7.373-3.308-7.373-7.373 C124.948,183.563,128.255,180.255,132.321,180.255z M149.988,248.976h-36v-19.704c0-9.874,8.127-17.906,18.001-17.906 c9.872,0,17.999,8.032,17.999,17.906V248.976z"></path>
                                            <path
                                                d="M138.988,138.555v-24.854c0-4.143-3.357-7.5-7.5-7.5c-4.143,0-7.5,3.357-7.5,7.5v24.854c0,4.143,3.357,7.5,7.5,7.5 C135.63,146.055,138.988,142.697,138.988,138.555z"></path>
                                            <path
                                                d="M59.331,140.177c-3.009-2.847-7.753-2.718-10.604,0.289c-2.848,3.008-2.718,7.755,0.289,10.604l37.709,35.707 c1.451,1.373,3.305,2.054,5.156,2.054c1.987,0,3.972-0.786,5.447-2.343c2.848-3.008,2.718-7.755-0.289-10.604L59.331,140.177z"></path>
                                            <path
                                                d="M205.241,140.071l-37.606,35.789c-3.001,2.855-3.118,7.603-0.263,10.603c1.474,1.55,3.452,2.33,5.434,2.33 c1.857,0,3.718-0.686,5.169-2.067l37.606-35.789c3.001-2.855,3.118-7.602,0.263-10.602 C212.989,137.332,208.241,137.217,205.241,140.071z"></path> </g> </g></svg>
                                    Prayer Requests
                                </SidebarItem>
                            </li>
                            <li>
                                <span class="text-xs text-gray-600 dark:text-gray-400">
                                    Settings
                                </span>
                                <ul>
                                    <li>
                                        <SidebarItem :href="route('categories.index')"
                                                     :active="$page.component === 'Categories/Index'">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M6 6h.008v.008H6V6z"/>
                                            </svg>
                                            Categories
                                        </SidebarItem>
                                    </li>
                                    <li v-if="$page.props.isAdmin">
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
                                    <li v-if="$page.props.isAdmin">
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
}
</style>
