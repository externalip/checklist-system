
<script setup >
import { ref, watch } from 'vue';
 import {  Link, router } from '@inertiajs/vue3';
import {Inertia} from '@inertiajs/inertia';
let searchUsername = ref('');
const selectedAccountStatus = ref([]);
let searchName = ref('');

let props = defineProps({
    filters: Object,
    searchName: String,
    searchUsername: String,
    selectedAccountStatus: Array,
})
watch([searchUsername, selectedAccountStatus, searchName], ([username, accountStatus, searchName]) => {
    const filters = { ...props.filters };

    if (username) {
        filters.searchUsername = username;
    }
    if (accountStatus.length > 0) {
        filters.accountStatus = accountStatus.join(',');
    }
    if (searchName) {
        filters.searchName = searchName;
    }

    router.get(route('users'), filters, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        append: true,
    });


});
</script>
<template>
    <div class="pl-2 mb-2">
        <div class="user-filter-header">
            <h4>Filter by:</h4>
        </div>

        <section id="user-filters" class="mb-5 grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-3">

            <div id="user-filter-checksheet-select">

                <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                                            an option</label>
                <button id="dropdownBgHoverButton" data-dropdown-toggle="dropdownBgHover" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">Account status<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                    </svg></button>


                <div id="dropdownBgHover" class="z-10 hidden w-48 bg-white rounded-lg shadow dark:bg-gray-700">
                    <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownBgHoverButton">
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input v-model="selectedAccountStatus" id="checkbox-item-4" type="checkbox" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="checkbox-item-4" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Active</label>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input v-model="selectedAccountStatus" id="checkbox-item-4" type="checkbox" value="0" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="checkbox-item-4" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">Inactive</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </div>

            <div id="user-filter-username-search">
                <form>
                    <label for="filter-username-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search by Username</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                                                    </svg>
                        </div>
                        <input v-model="searchUsername" type="search" id="default-search-name" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search Username" required>
                    </div>
                </form>

            </div>

            <div id="user-filter-id-search">
                <label for="filter-user-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search by Name</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                    </div>
                    <input v-model="searchName" type="search" id="default-search-name" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Search Name" required>
                </div>
            </div>

            <div id="user-add-btn">
                <label for="filter-user-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Click to add models</label>
                <Link :href="route('users.create')" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add User
                </Link>
            </div>
        </section>


    </div>
</template>