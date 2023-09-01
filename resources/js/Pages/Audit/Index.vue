
<template>
    <AppLayout title="Audit Tracking">
        <div id="audit-track" class="lg:mx-20">
            <section id="audit-filter">
                <div class="audit-filter-header">
                    <h4>Filter by:</h4>
                </div>

                <section id="io-audit-filter" class="mb-5 grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-2 gap-3">
                    <div id="filter-user">

                        <label for="filter-user-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filter by user</label>
                        <select id="filter-user-select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            v-model="selectedUser">
                                    <option value="">Choose a User
                                    </option>
                                    <option v-for="user in users" :value="user.id" :key="user.id">
                                   {{ user.first_name[0] }}. {{ user.last_name }}
                                    </option>
                                </select>

                    </div>

                    <div id="filter-action">

                        <label for="filter-action-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filter by action</label>
                        <select id="filter-action-select" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            v-model="selectedAction">
                                    <option value="">Choose a User
                                    </option>
                                    <option v-for="event in events" :value="event.action_type" :key="event.id">{{
                                        event.action_type
                                    }}</option>
                                </select>

                    </div>

                    <div id="filter-datepicker">
                        <label for="filter-datepick" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Filter by Date</label>

                        <div class="bg-gray-50  text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <div class=" absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">

                            </div>
                            <!-- <DateRangePickerComponent placeholder="Select a Date Range" v-model="selectedDateRange" /> -->
                            <VueDatePicker v-model="selectedDateRange" range @range-start="onRangeStart" @range-end="onRangeEnd"></VueDatePicker>
                        </div>

                    </div>

                    <div id="export-button" class="place-items-end">
                        <label for="export-btn" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Export
                                    to</label>

                        <button id="export-btn" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            type="button">Export <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="m1 1 4 4 4-4" />
                                    </svg></button>
                        <!-- Dropdown menu -->
                        <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">to
                                                PDF</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">to
                                                Excel</a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </section>

            </section>
            <div class="relative overflow-x-auto rounded-lg">
                <table id="audit-table" class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                User ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                User Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date and Time
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action Details
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="audit in audits.data" :key="audit.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ audit.user_id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ audit.first_name + '. ' + audit.last_name }}
                            </td>
                            <td class="px-6 py-4">
                                {{ audit.action_date }}
                            </td>
                            <td class="px-6 py-4">
                                {{ audit.action_type }}
                            </td>
                            <td class="px-6 py-4">
                                {{ audit.action_details }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="p-5 flex flex-col items-center">
            <Pagination :data="audits" />
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed, watch} from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
import Pagination from '@/Shared/Pagination.vue';
import { Link, router } from '@inertiajs/vue3';
const props = defineProps({
    audits: Array,
    events: Array,
    users: Array,
    filters: Object,
});
const selectedUser = ref('');
const selectedAction = ref('');
const selectedDateRange = ref('');
const isDropdownOpen = ref(false);

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};


watch([selectedUser, selectedAction, selectedDateRange], ([user, action, date]) => {
    const filter = { ...props.filters };

    if (user) {
        filter.user = user;
    }
    if (action) {
        filter.action = action;
    }
    if (date) {
        filter.date = date;
    }

    console.log(filter);

    router.get(route('audit'), filter, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        append: true,
    });
});
</script >



<style>
.wrapper {
    max-width: 220px;
}
</style>
