<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Pending Reports">
        <div id="pending-reports">
            <div id="header" class="lg:mx-20">
                <h1 class="">Pending Reports</h1>
            </div>

            <h4 class="lg:mx-20">Filter by:</h4>
            <section id="pending-filters" class="lg:mx-20 lg:flex lg:space-x-2 py-3">

                <!-- Dropdown  Select -->
                <section id="checklist-dropdown" class="lg:w-6/12 mb-2 rounded-lg">

                    <label for="pending-checklists"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Choose a
                        checklist</label>
                    <select id="pending-checklists"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>None</option>
                        <option value="US">5S Checklist</option>
                        <option value="CA">Checklist#2</option>
                        <option value="FR">Checklist#3</option>
                        <option value="DE">Checklist#4</option>
                    </select>

                </section>

                <!-- Searchbar -->
                <section id="pending-search" class="lg:w-full mb-2  rounded-lg">
                    <label for="pending-searchbar"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search a
                        Model</label>
                    <form class="flex items-center">
                        <label for="pending-searchbar" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                                </svg>
                            </div>
                            <input type="text" id="pending-searchbar"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Type here..." required>
                        </div>
                        <button type="submit"
                            class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </form>


                </section>

                <section id="export-btn" class="lg:w-1/6 rounded-lg">
                    <label for="export-dropdown" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Export
                        Pending</label>
                    <button id="export-dropdown" data-dropdown-toggle="dropdown"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">Export<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg></button>
                    <!-- Dropdown menu -->
                    <div id="dropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">to
                                    PDF</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">to
                                    MExcel</a>
                            </li>
                        </ul>
                    </div>

                </section>

                <!-- Export Button -->
            </section>

            <section id="pending-accordions" class="lg:mx-20">
                <!-- {{ Number of Pending Reports }} Pending Reports on {{ Checksheet Selected }}-->
                <h4>{{ }} Pending Reports on {{ }}</h4>


                <div class="accordions">
                    <!-- First Accordion -->
                    <div id="accordion-flush" data-accordion="collapse"
                        data-active-classes="bg-white dark:bg-gray-900 text-blue-500 dark:text-white"
                        data-inactive-classes="text-gray-500 dark:text-gray-400" class="border-lg">
                        <h2 id="accordion-flush-heading-1">
                            <button type="button"
                                class="flex items-center justify-between w-full py-5 text-2xl text-lg font-regular antialiased text-left border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                                data-accordion-target="#accordion-flush-body-1" aria-expanded="false"
                                aria-controls="accordion-flush-body-1">

                                <!-- {{ Name of the Submitted Model by the Operator }} -->
                                <span>M001DASAAFTRY
                                    <span
                                        class="bg-orange-100 text-orange-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-2">to
                                        be signed
                                    </span>
                                </span>

                                <svg data-accordion-icon class="w-3 h-3 transition-transform shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>

                        <div id="accordion-flush-body-1" class="hidden border-2 border-gray-100"
                            aria-labelledby="accordion-flush-heading-1">
                            <!-- Record Details Lot Number ||  Operator || Type of Checking || Shift -->
                            <div id="pending-record-details"
                                class="bg-gray-100 p-3 px-12 lg:flex lg:items-center text-center lg:justify-between">
                                <div id="lot-number" class="">
                                    <label for="" class="text-sm">Lot Number</label>
                                    <h5 class="font-bold">{{ }}LT5293952E42424242424</h5>
                                </div>

                                <div id="check-type" class="">
                                    <label for="" class="text-sm">Type of Checking</label>
                                    <h5 class="font-bold">{{ }}Startup</h5>
                                </div>

                                <div id="performed-by" class="">
                                    <label for="" class="text-sm">Performed by</label>
                                    <h5 class="font-bold">{{ }}Operator Name</h5>
                                </div>

                                <div id="shift" class="">
                                    <label for="" class="text-sm">Shift</label>
                                    <h5 class="font-bold">{{ }}1</h5>
                                </div>
                            </div>

                            <!-- Record Section Checksheet -->
                            <div id="pending-record-section" class="p-3 lg:flex lg:flex-col">
                                <!-- Header -->
                                <div class="pending-section-header px-5">
                                    <h3 class="font-bold text-2xl">Checking Items</h3>
                                </div>

                                <!-- Table -->
                                <div class="relative overflow-x-auto p-5">
                                    <table class="rounded-full w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-s text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <!-- Description coming from the Checklist -->
                                                <th scope="col" class="px-6 py-3">
                                                    Description
                                                </th>
                                                <!-- Status OK | NG | NA Depends on the RadioButton of the Checklist -->
                                                <th scope="col" class="px-6 py-3">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    Production Checksheet
                                                </th>
                                                <td class="px-6 py-4 bg-red-200 text-center">
                                                    NG
                                                </td>
                                            </tr>

                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    Procedures/OPL/Work Instruction
                                                </th>
                                                <td class="px-6 py-4 bg-green-200 text-center">
                                                    OK
                                                </td>
                                            </tr>

                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    Working Area
                                                </th>
                                                <td class="px-6 py-4 bg-green-200 text-center">
                                                    OK
                                                </td>
                                            </tr>

                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    Materials
                                                </th>
                                                <td class="px-6 py-4 bg-green-200 text-center">
                                                    OK
                                                </td>
                                            </tr>

                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    Tools/Jig Instrument
                                                </th>
                                                <td class="px-6 py-4 bg-green-200 text-center">
                                                    OK
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <!-- Record Section Signatures -->
                            <div id="pending-record-signature" class="p-3 lg:flex lg:flex-col">
                                <!-- Header -->
                                <div class="pending-section-header px-5">
                                    <h3 class="font-bold text-2xl">Signatures</h3>
                                </div>

                                <!-- Table -->
                                <div class="relative overflow-x-auto p-5">
                                    <table class="rounded-full w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-s text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <!-- Description coming from the Checklist -->
                                                <th scope="col" class="px-6 py-3">
                                                    Person to sign
                                                </th>
                                                <!-- Status OK | NG | NA Depends on the RadioButton of the Checklist -->
                                                <th scope="col" class="px-6 py-3">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Line Leader Signature -->
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    Line Leader
                                                </th>
                                                <td class="px-6 py-4 bg-green-200 text-center">
                                                    OK
                                                </td>
                                            </tr>

                                            <!-- QC Confirmation Signature-->
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    QC Confirmation
                                                </th>
                                                <td class="px-6 py-4 bg-green-200 text-center">
                                                    OK
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div id="pending-record-remarks" class="p-3 lg:flex lg:flex-col">
                                <!-- Header -->
                                <div class="pending-section-header px-5">
                                    <h3 class="font-bold text-2xl">Remarks</h3>
                                </div>

                                <!-- Disabled TextArea -->
                                <div class="pending-record-remark px-5">

                                    <label for="message"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Operator's
                                        Remark on the Model</label>
                                    <textarea id="message" rows="4"
                                        class="resize-none disabled:opacity-90 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="{{operator remarks goes here}}" disabled></textarea>

                                </div>
                            </div>

                            <!-- Button -->
                            <div id="pending-sign-btn" class="px-5 p-2 w-full flex justify-end">
                                <button type="button"
                                    class="focus:outline-none text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Reject</button>
                                <button type="button"
                                    class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Approve</button>

                            </div>

                        </div>
                    </div>

                    <!-- Second Accordion -->
                    <div id="accordion-flush" data-accordion="collapse"
                        data-active-classes="bg-white dark:bg-gray-900 text-blue-500 dark:text-white"
                        data-inactive-classes="text-gray-500 dark:text-gray-400" class="border-lg">
                        <h2 id="accordion-flush-heading-2">
                            <button type="button"
                                class="flex items-center justify-between w-full py-5 text-2xl text-lg font-regular antialiased text-left border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                                data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
                                aria-controls="accordion-flush-body-2">

                                <!-- {{ Name of the Submitted Model by the Operator }} -->
                                <span>M001DASAAFTRY
                                    <span
                                        class="bg-orange-100 text-orange-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-2">to
                                        be signed
                                    </span>
                                </span>

                                <svg data-accordion-icon class="w-3 h-3 transition-transform shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>

                        <div id="accordion-flush-body-2" class="hidden border-2 border-gray-100"
                            aria-labelledby="accordion-flush-heading-2">
                            <!-- Record Details Lot Number ||  Operator || Type of Checking || Shift -->
                            <div id="pending-record-details"
                                class="bg-gray-100 p-3 px-12 lg:flex lg:items-center text-center lg:justify-between">
                                <div id="lot-number" class="">
                                    <label for="" class="text-sm">Lot Number</label>
                                    <h5 class="font-bold">{{ }}LT5293952E42424242424</h5>
                                </div>

                                <div id="check-type" class="">
                                    <label for="" class="text-sm">Type of Checking</label>
                                    <h5 class="font-bold">{{ }}Startup</h5>
                                </div>

                                <div id="performed-by" class="">
                                    <label for="" class="text-sm">Performed by</label>
                                    <h5 class="font-bold">{{ }}Operator Name</h5>
                                </div>

                                <div id="shift" class="">
                                    <label for="" class="text-sm">Shift</label>
                                    <h5 class="font-bold">{{ }}1</h5>
                                </div>
                            </div>

                            <!-- Record Section Checksheet -->
                            <div id="pending-record-section" class="p-3 lg:flex lg:flex-col">
                                <!-- Header -->
                                <div class="pending-section-header px-5">
                                    <h3 class="font-bold text-2xl">Checking Items</h3>
                                </div>

                                <!-- Table -->
                                <div class="relative overflow-x-auto p-5">
                                    <table class="rounded-full w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-s text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <!-- Description coming from the Checklist -->
                                                <th scope="col" class="px-6 py-3">
                                                    Description
                                                </th>
                                                <!-- Status OK | NG | NA Depends on the RadioButton of the Checklist -->
                                                <th scope="col" class="px-6 py-3">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    Production Checksheet
                                                </th>
                                                <td class="px-6 py-4 bg-red-200 text-center">
                                                    NG
                                                </td>
                                            </tr>

                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    Procedures/OPL/Work Instruction
                                                </th>
                                                <td class="px-6 py-4 bg-green-200 text-center">
                                                    OK
                                                </td>
                                            </tr>

                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    Working Area
                                                </th>
                                                <td class="px-6 py-4 bg-green-200 text-center">
                                                    OK
                                                </td>
                                            </tr>

                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    Materials
                                                </th>
                                                <td class="px-6 py-4 bg-green-200 text-center">
                                                    OK
                                                </td>
                                            </tr>

                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    Tools/Jig Instrument
                                                </th>
                                                <td class="px-6 py-4 bg-green-200 text-center">
                                                    OK
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <!-- Record Section Signatures -->
                            <div id="pending-record-signature" class="p-3 lg:flex lg:flex-col">
                                <!-- Header -->
                                <div class="pending-section-header px-5">
                                    <h3 class="font-bold text-2xl">Signatures</h3>
                                </div>

                                <!-- Table -->
                                <div class="relative overflow-x-auto p-5">
                                    <table class="rounded-full w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                        <thead
                                            class="text-s text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <!-- Description coming from the Checklist -->
                                                <th scope="col" class="px-6 py-3">
                                                    Person to sign
                                                </th>
                                                <!-- Status OK | NG | NA Depends on the RadioButton of the Checklist -->
                                                <th scope="col" class="px-6 py-3">
                                                    Status
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Line Leader Signature -->
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    Line Leader
                                                </th>
                                                <td class="px-6 py-4 bg-green-200 text-center">
                                                    OK
                                                </td>
                                            </tr>

                                            <!-- QC Confirmation Signature-->
                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <th scope="row"
                                                    class="w-full px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                    QC Confirmation
                                                </th>
                                                <td class="px-6 py-4 bg-green-200 text-center">
                                                    OK
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Operators Remark -->
                            <div id="pending-record-remarks" class="p-3 lg:flex lg:flex-col">
                                <!-- Header -->
                                <div class="pending-section-header px-5">
                                    <h3 class="font-bold text-2xl">Remarks</h3>
                                </div>

                                <!-- Disabled TextArea -->
                                <div class="pending-record-remark px-5">

                                    <label for="message"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Operator's
                                        Remark on the Model</label>
                                    <textarea id="message" rows="4"
                                        class="resize-none disabled:opacity-90 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="{{operator remarks goes here}}" disabled></textarea>

                                </div>
                            </div>

                            <!-- Button -->
                            <div id="pending-sign-btn" class="px-5 p-2 w-full flex justify-end">
                                <button type="button"
                                    class="focus:outline-none text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Reject</button>
                                <button type="button"
                                    class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Approve</button>

                            </div>


                        </div>
                    </div>

                </div>

                <!-- Pagination -->
                <div class="pagination flex p-10 items-center justify-center">
                    <nav aria-label="Page navigation example">
                        <ul class="flex items-center -space-x-px h-8 text-sm">
                            <li class="pagination-button">
                                <a href="#"
                                    class="flex items-center justify-center px-3 h-8 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Previous</span>
                                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 1 1 5l4 4" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                            </li>
                            <li>
                                <a href="#" aria-current="page"
                                    class="z-10 flex items-center justify-center px-3 h-8 leading-tight text-blue-600 border border-blue-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    <span class="sr-only">Next</span>
                                    <svg class="w-2.5 h-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 6 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 9 4-4-4-4" />
                                    </svg>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </section>
        </div>
    </AppLayout>
</template>
