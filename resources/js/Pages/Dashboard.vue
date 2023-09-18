<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { defineProps } from 'vue';

const props = defineProps({
    forms: Array,
    filteredAudits: Array,
    audits: Array,
    users: Number,
    models: Number,
    checksheets: Number,
    archives: Number,
});
</script>

<template>
    <AppLayout title="Dashboard">
        <div id="dashboard" class="lg:mx-20">
            <!-- Header Dashboard -->
            <div id="header" class="flex align-center justify-center">
                <h5 class="text-lg text-[--blue]">Hello, {{ `${$page.props.auth.employee?.first_name} ${$page.props.auth.employee?.last_name}` }}
                </h5>

            </div>

            <section v-if="$page.props.auth.user.permissions.some(permission => permission.name === 'pending-reports')" id="pending-review-checklist" class="my-3">
                <!-- Pending Review Header -->
                <div>
                    <h2 class="text-2xl text-[--blue]">Pending Reviews</h2>
                </div>

                <div id="pending-review-cards" class="grid 2xl:grid-cols-5 lg:grid-cols-3 md:grid-cols-2 grid-cols-2 gap-4">
                    <!-- Dynamic Card -->
                    <div v-for="form in forms" :key="form.id" class="hover:bg-gray-50 duration-200 max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
                        <div class="p-4 px-6 h-full flex flex-col">
                            <span class="text-[--blue] font-bold bg-clip-text text-2xl flex md:justify-end justify-center">{{ form.pending_count }}</span>
                            <Link href="/Pending-Reports" :data="{ form_name: form.form_name }" preserve-state>
                            <h5 class="mb-2 truncate text-lg font-bold tracking-tight text-[--blue] dark:text-white">
                                {{ form.form_name }}
                            </h5>
                            </Link>
                            <p class="mb-3 flex-grow font-normal text-sm text-[--blue] dark:text-gray-400 overflow-hidden overflow-ellipsis">
                                You have {{ form.pending_count }} pending reviews on this check sheet.
                            </p>
                        </div>
                    </div>
                </div>

            </section>

            <section v-if="$page.props.auth.user.permissions.some(permission => permission.name === 'users')" id="system-status-track" class="my-3">
                <!-- System Status Tracking Header -->
                <div>
                    <h2 class="text-2xl text-[--blue]">System Tracking</h2>
                </div>

                <div id="registered-status" class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-2 gap-4">

                    <div id="reg-personnel">

                        <div class="flex items-center flex-col block max-w-sm p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <svg class="w-12 h-12 mb-5 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="0.9"
                                        d="M4.333 6.764a3 3 0 1 1 3.141-5.023M2.5 16H1v-2a4 4 0 0 1 4-4m7.379-8.121a3 3 0 1 1 2.976 5M15 10a4 4 0 0 1 4 4v2h-1.761M13 7a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-4 6h2a4 4 0 0 1 4 4v2H5v-2a4 4 0 0 1 4-4Z" />
                                </svg>
                            <h5 class="text-center text-xl tracking-tight text-[--blue] dark:text-white">
                                Personnel
                                <span class="block text-2xl font-bold">{{ users }}</span>
                            </h5>
                        </div>

                    </div>

                    <div id="reg-models">

                        <div class="flex items-center flex-col block max-w-sm p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <svg class="w-12 h-12 mb-5 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="0.9"
                                        d="M4 12.25V1m0 11.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M4 19v-2.25m6-13.5V1m0 2.25a2.25 2.25 0 0 0 0 4.5m0-4.5a2.25 2.25 0 0 1 0 4.5M10 19V7.75m6 4.5V1m0 11.25a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5ZM16 19v-2" />
                                </svg>
                            <h5 class="text-center text-xl tracking-tight text-[--blue] dark:text-white">
                                Models
                                <span class="block text-2xl font-bold">{{ models }}</span>
                            </h5>
                        </div>

                    </div>

                    <div id="reg-checksheets">

                        <div class="flex items-center flex-col block max-w-sm p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <svg class="w-12 h-12 mb-5 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="18" height="20" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="0.9"
                                        d="M12 2h4a1 1 0 0 1 1 1v15a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h4m6 0v3H6V2m6 0a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1M5 5h8m-5 5h5m-8 0h.01M5 14h.01M8 14h5" />
                                </svg>
                            <h5 class="text-center text-xl tracking-tight text-[--blue] dark:text-white">
                                Check Sheets
                                <span class="block text-2xl font-bold">{{ checksheets }}</span>
                            </h5>
                        </div>

                    </div>

                    <div id="reg-archives">

                        <div class="flex items-center flex-col block max-w-sm p-3 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <svg class="w-12 h-12 text-gray-400 mb-5 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linejoin="round" stroke-width="0.9"
                                        d="M8 8v1h4V8m4 7H4a1 1 0 0 1-1-1V5h14v9a1 1 0 0 1-1 1ZM2 1h16a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1Z" />
                                </svg>
                            <h5 class="text-center text-xl tracking-tight text-[--blue] dark:text-white">
                                Archives
                                <span class="block text-2xl font-bold">{{ archives }}</span>
                            </h5>
                        </div>

                    </div>


                </div>

            </section>

            <section v-if="$page.props.auth.user.permissions.some(permission => permission.name === 'audit')" id="recent-actions" class="my-3">
                <!-- Recent Actions Header  -->
                <div>
                    <h2 class="text-2xl text-[--blue]">Recent Actions</h2>
                </div>

                <!-- Recent Actions Table -->
                <div class="relative overflow-x-auto rounded-lg">
                    <table id="audit-table" class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-white uppercase bg-[--blue] dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    User ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    User Name
                                </th>

                                <th scope="col" class="px-6 py-3">
                                    Log Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Log Description
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Properties
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date and Time
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="audit in audits" :key="audit.id" class="text-xs bg-white border-b dark:bg-gray-800 dark:border-gray-700 duration-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ audit.causer_id ?? 'No ID' }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ audit.causer_name ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ audit.log_name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ audit.description }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ audit.event }}
                                </td>
                                <td class="px-6 py-4">
                                    <Link :href="route('audit.data.view', audit.id)" class="text-blue-500 hover:underline">View Data</Link>

                                </td>

                                <td class="px-6 py-4">
                                    {{ audit.created_at }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </AppLayout>
</template>
