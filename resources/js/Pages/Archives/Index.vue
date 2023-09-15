<script>

export default {
    name: "App",
    //lets define the data
    data() {
        return {
            selectedOption: {},
            selectedUser: "default",
            selectedStatus: "default",

        };
    },
};
</script>

<template>
    <AppLayout title="Archives">
        <div class="lg:mx-20">
            <!-- Filter Section -->
            <section>
                <h4>Filter by:</h4>
                <div class="mb-4 grid md:grid-cols-4 gap-4">
                    <!-- User Name Filter -->
                    <div>
                        <label class="inline-block text-sm">Select Check sheet</label>
                        <div>
                            <select v-model="selectedOption" class="text-sm w-full rounded-lg">
                                <option value=""></option>
                                <option v-for="form in forms" :key="form.id" :value="form.id">
                                    {{ form.form_name }}
                                </option>
                            </select>
                        </div>
                    </div>


                    <!-- Operator Name -->
                    <div>
                        <label class="inline-block text-sm">Performed by</label>
                        <div>
                            <select v-model="selectedUser" class="text-sm w-full rounded-lg">
                                <option value="default">Default</option>
                                <option v-for="employee in employees" :employee="employee.id" :value="employee.id">
                                    {{ employee.last_name }},
                                    {{ employee.first_name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Status Name -->
                    <div>
                        <label class="inline-block text-sm">Status</label>
                        <div>
                            <select v-model="selectedStatus" class="text-sm w-full rounded-lg">
                                <option value="default">Default</option>
                                <option value="OK">OK</option>
                                <option value="Rejected">Rejected</option>
                            </select>
                        </div>
                    </div>

                    <!-- Date Range Filter -->
                    <div>
                        <label class="inline-block text-sm">Choose Date Range</label>
                        <div class="w-full">
                            <VueDatePicker placeholder="Select a Date Range" v-model="selectedDateRange" range />
                        </div>
                    </div>
                </div>
            </section>

            <!-- Table -->
            <div v-for="(row, index) in formdata" :key="index" class="rounded-xl relative overflow-x-auto shadow-md">
                <div v-if="selectedOption === row.id">
                    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                        <!-- Post Header of checksheet data -->
                        <thead style="background-color: #3c5393" class="text-xs text-white">
                            <tr>
                                <th class="border-r-[2px] border-blue-900 whitespace-nowrap px-3 py-3" colspan="1"
                                    rowspan="2">Date</th>
                                <th class="border-r-[2px] border-blue-900 whitespace-nowrap px-3 py-3" colspan="1"
                                    rowspan="2">Shift</th>
                                <th class="border-r-[2px] border-blue-900 whitespace-nowrap px-3 py-3" colspan="1"
                                    rowspan="2">Model Name</th>
                                <th class="border-r-[2px] border-blue-900 whitespace-nowrap px-3 py-3" colspan="1"
                                    rowspan="2">Lot No.</th>
                                    <!-- Loop for Dynamic Header -->
                                <th class="border-r-[2px] border-b-[2px] border-blue-900 px-1 py-1"
                                    v-for="(section, sectionIndex) in JSON.parse(row.form_data)?.form_content"
                                    :key="sectionIndex" :colspan="getQuestionCount(section)">
                                    {{ section.section_name }}
                                </th>
                                <th colspan="2" class="border-r-[2px] border-b-[2px] border-blue-900 px-1 py-1">
                                    Signatures
                                </th>
                                <th colspan="1" rowspan="2" class="border-r-[2px] border-blue-900 px-1 py-1">
                                    QC Confirmation
                                </th>
                                <th colspan="1" rowspan="2" class="border-r-[2px] border-blue-900 px-1 py-1">
                                    Remarks
                                </th>
                                <th colspan="1" rowspan="2" class="px-1 py-1">
                                    Status
                                </th>
                            </tr>
                            <tr>
                                <template v-for="(section, sectionIndex) in JSON.parse(row.form_data)?.form_content">
                                    <th v-for="(question, questionIndex) in section.section_content" :key="questionIndex"
                                        class="whitespace-nowrap border-r-[2px] border-blue-900 p-2">
                                        {{ question.label }}
                                    </th>
                                </template>
                                <th class="border-r-[2px] border-blue-900 px-1 py-1">
                                    Operator
                                </th>
                                <th class="border-r-[2px] border-blue-900 px-1 py-1">
                                    Lineleader/Technician /Supervisor/Engineer
                                </th>
                            </tr>
                        </thead>
                        <!-- Post OK or Rejected checksheet data -->
                        <tbody v-for="response_field in data">
                            <tr v-if="(response_field.form_id === selectedOption &&
                                selectedUser === 'default' && selectedStatus === 'default') ||
                                (response_field.form_id === selectedOption &&
                                    response_field.operator_employee_id ===
                                    selectedUser && selectedStatus === response_field.status) ||
                                (response_field.form_id === selectedOption &&
                                    selectedUser === 'default' && selectedStatus === response_field.status) ||
                                (response_field.form_id === selectedOption &&
                                    response_field.operator_employee_id ===
                                    selectedUser && selectedStatus === 'default')"
                                class="hover:bg-gray-100 duration-200 bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ response_field.created_at }}
                                </td>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ response_field.shift }}
                                </td>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ JSON.parse(response_field.response).fieldAnswers["Model Name"] }}
                                </td>
                                <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white px-3">
                                    {{ JSON.parse(response_field.response).fieldAnswers["Kit Number"] }} {{ JSON.parse(response_field.response).fieldAnswers["Lot Number"] }}
                                </td>
                                <template
                                    v-for="(section, sectionIndex) in JSON.parse(response_field.form_data)?.form_content">
                                    <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                        v-for="(question, questionIndex) in section.section_content" :key="questionIndex">
                                        {{ parsedArray(JSON.parse(response_field.response).fieldAnswers[question.label]) }}
                                    </td>
                                </template>

                                <td class="text-gray-900 whitespace-nowrap">
                                    {{ response_field.first_name }} {{ response_field.last_name }}
                                </td>
                                <td class="text-gray-900 whitespace-nowrap">
                                    {{ response_field.line_leader_first_name }} {{ response_field.line_leader_last_name }}
                                </td>
                                <td class="text-gray-900 whitespace-nowrap">
                                    {{ response_field.qc_first_name }} {{ response_field.qc_last_name }}
                                </td>

                                <td class="text-gray-900">
                                    {{ JSON.parse(response_field.response).fieldAnswers["Remarks on the Model"] }}
                                </td>
                                <td class="text-gray-900">
                                    {{ response_field.status }}
                                </td>
                            </tr>
                        </tbody>

                    </table>

                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-4">

            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed, reactive } from "vue";

import { Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";


let selectedForm = reactive({
    form_name: null,
});

let props = defineProps({
    data: Array,
    formdata: Array,
    counts: Array,
    forms: Array,
    employees: Array,
    sign: Array,
});

const parsedArray = (data) => {
    if (Array.isArray(data)) {
        return data.join(', ');
    } else {
        return data;
    }
};
const getQuestionCount = (section) => {
    if (section && section.section_content) {
        return Object.keys(section.section_content).length;
    }
    return 0; // Default to 0 if section or section_content is missing
};

const selectedDateRange = ref(null);

</script>

<style>
.wrapper {
    max-width: 220px;
}

td {
    color: black;
    text-align: center;
}

th {
    text-align: center;
}</style>
