<style>
.hidden_div {
    display: none;
}
</style>

<script setup>

import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';
import { reactive, ref, onMounted, watch } from 'vue';

const showDiv = (selectedFormName) => {
  // Hide all hidden divs first
  const hiddenDivs = document.getElementsByClassName('hidden_div');
  for (let i = 0; i < hiddenDivs.length; i++) {
    hiddenDivs[i].style.display = 'none';
  }

  // Show the selected hidden div
  const selectedDiv = document.getElementById(selectedFormName);
  if (selectedDiv) {
    selectedDiv.style.display = 'block';
  }
};
let selectedForm = reactive({
    form_name: null,
});

let props = defineProps({
    forms: Array,
    selectedFormName: Array,
    data: Array,
    signatures: Array,
    counts: Array,
    formtable: Array
});
watch(() => selectedForm.form_name, (newValue) => {
    setTimeout(() => {
        showDiv(newValue);
    }, 0);
});

onMounted(() => {
    // Retrieve form_name from the query parameters
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const formNameFromQuery = urlParams.get('form_name');

    // Set the retrieved form_name to selectedForm
    if (formNameFromQuery) {
        selectedForm.form_name = formNameFromQuery;
    }

});

</script>

<template>
    <AppLayout title="Pending Reports">
        <div id="pending-reports">

            <h4 class="lg:mx-20 text-[--blue]">Filter by:</h4>
            <section id="pending-filters" class="lg:mx-20 lg:flex lg:space-x-2 py-3">

                <!-- Dropdown  Select -->
                <section id="checklist-dropdown" class="lg:w-6/12 mb-2 rounded-lg">

                    <label for="pending-checklists" class="block mb-2 text-sm font-medium text-[--blue] dark:text-white">Choose a
                            checklist</label>
                    <select v-model="selectedForm.form_name" id="pending-checklists" class="bg-gray-50 border border-gray-300 text-[#3182ce] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    @change="showDiv(selectedForm.form_name)">
                            <option value="">Select a Form</option>
                            <option
                            v-for="form in forms"
                            :key="form.id"
                            :value="form.form_name"

                           >{{ form.form_name }}</option>
                        </select>
                </section>

                <!-- Searchbar -->
                <section id="pending-search" class="lg:w-full mb-2  rounded-lg">
                    <label for="pending-searchbar" class="block mb-2 text-sm font-medium text-[--blue] dark:text-white">Search a
                            Model</label>
                    <form class="flex items-center">
                        <label for="pending-searchbar" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                                    </svg>
                            </div>
                            <input type="text" id="pending-searchbar" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Type here..." required>
                        </div>
                        <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-[--blue] rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
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
                    <button id="export-dropdown" data-dropdown-toggle="dropdown"  class="text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">Export<svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true"
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
                                        MExcel</a>
                            </li>
                        </ul>
                    </div>

                </section>

                <!-- Export Button -->
            </section>

            <section id="pending-accordions" class="lg:mx-20">
                <!-- {{ Number of Pending Reports }} Pending Reports on {{ Checksheet Selected }}-->

                <!-- First Accordion -->
                <div :id="selectedForm.form_name" class="hidden_div accordions">
                    <!-- Pending Counts -->

                    <div v-for="(row, index) in data" :key="index" id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white dark:bg-gray-900 text-blue-500 dark:text-white" data-inactive-classes="text-gray-500 dark:text-gray-400" class="border-lg">
                        <ul v-show="row.form_name === selectedForm.form_name">

                            <h2 :id="'accordion-flush-heading-' + index.toString()">
                                <button type="button" class="flex items-center justify-between w-full py-5 text-lg font-regular antialiased text-left border-b border-gray-200 dark:border-gray-700 dark:text-gray-400" :data-accordion-target="'#accordion-flush-body-' + index.toString()"
                                    aria-expanded="false" :aria-controls="'accordion-flush-body-' + index.toString()">

                                        <!-- {{ Name of the Submitted Model by the Operator }} -->
                                        <span>{{ JSON.parse(row.response).fieldAnswers['Model Name'] }}
                                            <span
                                                class="bg-orange-100 text-orange-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-2">to
                                                be signed
                                            </span>
                                        </span>

                                        <svg data-accordion-icon class="w-3 h-3 transition-transform shrink-0"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 10 6">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M9 5 5 1 1 5" />
                                        </svg>
                                    </button>
                            </h2>

                            <div :id="'accordion-flush-body-' + index.toString()" class="hidden border-2 border-gray-100" :aria-labelledby="'accordion-flush-heading-' + index.toString()">
                                <!-- Record Details Lot Number ||  Operator || Type of Checking || Shift -->
                                <div id="pending-record-details" class="bg-gray-100 text-[--blue] p-3 px-12 lg:flex lg:items-center text-center lg:justify-between">
                                    <div id="lot-number" class="">
                                        <label for="" class="text-sm">Lot Number</label>
                                        <h5 class="font-bold">{{ JSON.parse(row.response).fieldAnswers['Lot Number'] }}</h5>
                                    </div>

                                    <div id="performed-by" class="">
                                        <label for="" class="text-sm">Performed by</label>
                                        <h5 class="font-bold">{{ row.first_name }}</h5>
                                    </div>

                                    <div id="shift" class="">
                                        <label for="" class="text-sm">Shift</label>
                                        <h5 class="font-bold">{{ row.shift }}</h5>
                                    </div>
                                </div>

                                <!-- Record Section Checksheet -->
                                <div id="pending-record-section" class="p-3 lg:flex lg:flex-col">
                                    <!-- Header -->
                                    <div v-for="(section, sectionIndex) in JSON.parse(row.form_data)?.form_content" :key="sectionIndex">
                                        <h3 class="font-bold text-2xl pending-section-header px-5">{{ section.section_name }}
                                        </h3>


                                        <!-- Table -->
                                        <div class="relative overflow-x-auto p-5">
                                             <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                <thead class="text-s text-white uppercase bg-[--blue] dark:bg-gray-700 dark:text-gray-400">
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
                                                    <tr v-for="(question, questionIndex) in section.section_content" :key="questionIndex" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                        <th scope="row" class="w-full text-[--blue] px-6 py-4 font-medium whitespace-wrap text-gray-900 dark:text-white">
                                                            {{ question.label }}
                                                        </th>
                                                        <td :class="(JSON.parse(row.response).fieldAnswers[question.label] === 'OK' || JSON.parse(row.response).fieldAnswers[question.label] === 'PASS' || JSON.parse(row.response).fieldAnswers[question.label] === '✔') ? 'px-6 py-4 text-center text-[#FFFFFF] bg-[#1FAC3C]' : 'px-6 py-4 text-center text-[#FFFFFF] bg-[#E33A3A]'">
                                                            {{ JSON.parse(row.response).fieldAnswers[question.label] }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Record Section Signatures -->
                                <div id="pending-record-signature" class="p-3 lg:flex lg:flex-col">
                                    <!-- Header -->
                                    <div class="pending-section-header px-5">
                                         <h3 class="font-bold text-2xl text-[--blue]">Signatures</h3>
                                    </div>

                                    <!-- Table -->
                                    <div class="relative overflow-x-auto p-5">
                                        <table class="rounded-full w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead class="text-s text-white uppercase bg-[--blue] dark:bg-gray-700 dark:text-gray-400">
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
                                                <!-- Signature -->
                                                <tr v-for="sign in signatures" :key="sign.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                    <th v-if="sign.response_id == row.id" scope="row" class="w-full text-[--blue] px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white">
                                                        {{ sign.required_sign_role }}
                                                    </th>
                                                    <td v-if="sign.response_id == row.id" :class="(sign.status == 'OK') ?
                                                            'px-6 py-4 text-center text-[#FFFFFF] bg-[#1FAC3C]' :
                                                            'px-6 py-4 text-center text-[#FFFFFF] bg-[#E33A3A]'">
                                                        {{ sign.status }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div id="pending-record-remarks" class="p-3 lg:flex lg:flex-col">
                                    <!-- Header -->
                                    <div class="pending-section-header px-5">
                                        <h3 class="font-bold text-2xl">{{ Object.keys(JSON.parse(row.response).fieldAnswers)[8] }}</h3>
                                    </div>

                                    <!-- Disabled TextArea -->
                                    <div class="pending-record-remark px-5">

                                        <label for="message"  class="block mb-2 text-sm font-medium text-[--blue] dark:text-white">Operator's
                                                Remark on the Model</label>
                                        <textarea id="message" rows="4" class="resize-none disabled:opacity-90 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            :placeholder="JSON.parse(row.response).fieldAnswers['Remarks on the Model']" disabled></textarea>
                                    </div>
                                </div>
                                <div v-if="$page.props.auth.employee.role_id ==! 1 " class="pb-5">
                                <!-- Button -->
                                <div id="pending-sign-btn" class="px-5 p-2 w-full flex justify-end">

                                    <!-- Reject Button -->
                                    <Link :href="route('Pending-Reports.update', {
                                            status: 'Rejected',
                                            id: row.id
                                        })" as="button" method="PUT">
                                    <button type="button" class="focus:outline-none text-white bg-[--red] hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Reject
                                        </button>
                                    </Link>
                                    <!-- </router-link> -->

                                    <!-- Approve Button -->
                                    <Link :href="route('Pending-Reports.update', {
                                            status: 'OK',
                                            id: row.id
                                        })" as="button" method="PUT">
                                    <button type="button" class="text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Approve
                                        </button>
                                    </Link>
                                </div>
                                </div>
                            </div>
                        </ul>

                    </div>
                </div>

                <!-- Pagination -->

            </section>
        </div>
    </AppLayout>
</template>
