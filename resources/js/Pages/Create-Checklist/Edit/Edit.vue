<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link, router } from '@inertiajs/vue3';

const props = defineProps({
        forms: Array,
    });
</script>

<template>
    <AppLayout title="Checksheet Manager">
        <!-- Checksheet Manager Container -->
        <div class="lg:mx-20 mx-3">
            <section id="checksheet-filter-section">
                <div class="model-filter-header">
                    <h4>Filter by:</h4>
                </div>

                <section id="checksheet-filters" class="mb-5 grid lg:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-3">

                    <div id="checksheet-filter-name-search">

                        <form>
                            <label for="filter-user-select"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search by Checksheet
                                Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" id="default-search-name"
                                    class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search Model Name" required>
                            </div>
                        </form>

                    </div>

                    <div id="checksheet-add-btn">
                        <label for="filter-user-select"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Click to add models</label>
                        <button type="button" @click="callCreator"
                            class="w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 flex items-center gap-3 justify-center">
                            Create Form
                            <svg class="w-3 h-3 text-gray-100 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
                            </svg>
                        </button>
                    </div>
                </section>
            </section>

            <section id="checksheet-registered-table">
                <section id="checksheet-table-section">

                    <div class="relative overflow-x-auto">

                        <!-- Table -->
                        <table class="rounded-lg w-full text-sm text-center text-gray-500 dark:text-gray-400">

                            <!-- Table Headers -->
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Checksheet ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Checksheet Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created by
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date Created
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Last Edited
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <!-- Table Content -->
                            <tbody>
                                <tr v-for="form in forms"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 transition ease-in-out duration-200">
                                    <td scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ form.id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ form.form_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ form.created_by }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ form.created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ form.updated_at }}
                                    </td>

                                    <!-- Action Buttons -->
                                    <td class="px-6 flex justify-center mx-10">

                                        <!-- Edit Button -->
                                        <Link type="button" :href="route('checksheet.edit', form.id)"
                                            class="hover:bg-gray-200 transition duration-200 ease-in-out p-4">
                                            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2">
                                                    <path
                                                        d="M19 11V9a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L12 2.757V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L2.929 4.343a1 1 0 0 0 0 1.414l.536.536L2.757 8H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535L8 17.243V18a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H18a1 1 0 0 0 1-1Z" />
                                                    <path d="M10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                </g>
                                            </svg>
                                        </Link>

                                        <!-- Delete Button -->
                                        <button type="button"
                                            class="hover:bg-gray-200 transition duration-200 ease-in-out p-4">
                                            <svg class="w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                            </svg>
                                        </button>

                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>

                </section>

            </section>

            <section id="pagination">

                <div class="flex flex-col items-center">
                    <!-- Help text -->
                    <span class="text-sm text-gray-700 dark:text-gray-400">
                        Showing <span class="font-semibold text-gray-900 dark:text-white">1</span> to <span
                            class="font-semibold text-gray-900 dark:text-white">10</span> of <span
                            class="font-semibold text-gray-900 dark:text-white">100</span> Entries
                    </span>
                    <div class="inline-flex mt-2 xs:mt-0">
                        <!-- Buttons -->
                        <button
                            class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 5H1m0 0 4 4M1 5l4-4" />
                            </svg>
                            Prev
                        </button>
                        <button
                            class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            Next
                            <svg class="w-3.5 h-3.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                    </div>
                </div>

            </section>



        </div>

    </AppLayout>
</template>

<script>
    export default {
        name: 'checksheet',
        methods: {
            callEditor (form_id, form_config) {
                router.get('checksheet/editor', {form_id, form_config});
            },
            callCreator () {
                router.get('/generate');
            }
        },
    }
</script>
