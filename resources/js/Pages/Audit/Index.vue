<script setup>

</script>
<template>
    <div class="p-5">
        <Head title="Audit" />

        <div>
            <h1 class="text-2xl">Audit Trail</h1>
        </div>

        <div class="grid grid-rows-4 md:grid-rows-2 lg:grid-rows-1 grid-flow-col gap-0">
            
            <!-- User Name Filter -->
            <div>
                <label class="inline-block">User Name</label>
                <div>
                    <select name="" id="" style="width: 220px;">
                        <option v-for="user in users" value="{{ user.user_type }}">{{ user.user_type }}</option>
                    </select>
                </div>
            </div>

            <!-- Action Filter -->
            <div>
                <label class="inline-block">Action</label>
                <div>
                    <select name="" id="" style="width: 220px;">
                        <option v-for="event in events" value="{{ event.event }}">{{ event.event }}</option>
                    </select>
                </div>
            </div>

            <!-- Date Range Filter -->
            <div>
                <label class="inline-block">Choose Date Range</label>
                <div class="wrapper">
                    <ejs-daterangepicker placeholder="Select a Date Range"></ejs-daterangepicker>
                </div>
            </div>

            <!-- Export Options -->
            <div>
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Dropdown button <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Dashboard</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Settings</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Earnings</a>
                    </li>
                    <li>
                        <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Sign out</a>
                    </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="myTable" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            User ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            User Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date & Time
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Action
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Extra Details
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="audit in audits" :key="audit.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ audit.user_id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ audit.user_type }}
                        </td>
                        <td class="px-6 py-4">
                            {{ audit.created_at }}
                        </td>
                        <td class="px-6 py-4">
                            {{ audit.event }}
                        </td>
                        <td class="px-6 py-4">
                            {{ audit.auditable_type }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>


<script>
    import { DateRangePickerComponent } from '@syncfusion/ej2-vue-calendars';
    export default {
        props:{
            audits: Array,
            events: Array,
            users: Array,
        }, 
        components: {
            'ejs-daterangepicker' : DateRangePickerComponent
        }
    }
</script>

<style>
    @import './node_modules/@syncfusion/ej2-base/styles/material.css';
    @import './node_modules/@syncfusion/ej2-buttons/styles/material.css';
    @import './node_modules/@syncfusion/ej2-inputs/styles/material.css';
    @import './node_modules/@syncfusion/ej2-popups/styles/material.css';
    @import './node_modules/@syncfusion/ej2-lists/styles/material.css';
    @import "./node_modules/@syncfusion/ej2-vue-calendars/styles/material.css";
    .wrapper{
        max-width: 220px;
    }
</style>