<script setup>
import { ref, watch } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import Switch from './Switch.vue';
let searchUsername = ref('');
const selectedAccountStatus = ref([]);
let searchName = ref('');
const FilterRole = ref('');

let props = defineProps({
    filters: Object,
    searchName: String,
    searchUsername: String,
    selectedAccountStatus: Array,
    roles: Array,
});
watch([searchUsername, selectedAccountStatus, searchName, FilterRole], ([username, accountStatus, searchName, FilterRole]) => {
    const filter = { ...props.filters };
    if (username) {
        filter.username = username;
    }
    if (accountStatus.length > 0) {
        filter.accountStatus = accountStatus.join(',');
    }
    if (searchName) {
        filter.name = searchName;
    }
    if (FilterRole) {
        filter.role = FilterRole;
    }

    router.get(route('users'), filter, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        append: true,
    });

});
</script>

<template>
    <div class="pl-2 mb-2">
        <Switch />

        <!-- MANAGE PERSONNEL FILTER SECTION -->
        <section id="user-filters"  class="mb-5 grid lg:grid-cols-5 sm:grid-cols-2 grid-cols-2 gap-3">

            <!-- filter (active & inactive) account states -->
            <div>
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Select Account Status
                </label>

                <!-- dropdown button -->
                <button id="dropdownBgHoverButton" data-dropdown-toggle="dropdownBgHover" class="w-full flex justify-center text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-20  text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">Account status
                    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>

                <!-- dropdown button selection -->
                <div id="dropdownBgHover" class="z-10 hidden w-48 bg-white rounded-lg shadow dark:bg-gray-700">
                    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownBgHoverButton">
                        <!-- active -->
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input v-model="selectedAccountStatus" id="checkbox-item-active" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="checkbox-item-active" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Active</label>
                            </div>
                        </li>

                        <!-- inactive -->
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input v-model="selectedAccountStatus" id="checkbox-item-inactive" type="checkbox" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="checkbox-item-inactive" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Inactive</label>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- filter (username) -->
            <div>
                <form>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Search by Username
                    </label>

                    <!-- filter username textbox -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input
                            v-model="searchUsername" type="search" id="default-search-name" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Username" required>
                    </div>
                </form>

            </div>

            <!-- filter (personnel name)-->
            <div>
                <label for="filter-user-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search by Name</label>

                <!-- filter personnel name textbox -->
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"  stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                        </svg>
                    </div>

                    <input v-model="searchName" type="search" id="default-search-name" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search Name" required>
                </div>

            </div>

            <!-- filter (role) -->
            <div>
                <label for="filter-user-role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filter by Role</label>

                <!-- filter role textbox -->
                <div class="relative">
                    <select v-model="FilterRole" id="filter-user-role" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Select Role</option>
                        <option v-for="role in roles" :key="role.id" :value="role.id">
                            {{ role.name }}
                        </option>
                    </select>
                </div>
            </div>

            <!-- filter (add personnel) -->
            <div id="user-add-btn">
                <label for="filter-user-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                    Click to Add User
                </label>

                <Link :href="route('users.create')" type="button" class="text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">+
                </Link>
            </div>
        </section>
    </div>
</template>
