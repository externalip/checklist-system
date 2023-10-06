<script>
export default {
    name: "App",
    //lets define the data
    data() {
        return {
            selectedOption: {},
            selectedUser: "",
            selectedStatus: "Default",
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
                            <VueMultiselect v-model="selectedOption" :options="checksheetOptions" :show-labels="false"
                                track-by="id" label="form" @searchChange="fetchChecksheetOptions" placeholder="Default"
                                class=""></VueMultiselect>
                        </div>
                    </div>

                    <!-- Operator Name -->
                    <div>
                        <label class="inline-block text-sm">Performed by</label>
                        <div>
                            <VueMultiselect v-model="selectedUser" :options="employeeOptions" :show-labels="false"
                                track-by="id" label="name" @searchChange="fetchEmployeeOptions" placeholder="Default"
                                class=""></VueMultiselect>
                        </div>
                    </div>

                    <!-- Status Name -->
                    <div>
                        <label class="inline-block text-sm">Status</label>
                        <div>
                            <select v-model="selectedStatus" class="text-sm w-full rounded-lg">
                                <option value="Default">Default</option>
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
                <div v-if="(selectedOption !== null)">
                    <div v-if="(selectedOption.id === row.id)">
                        <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                            <!-- Post Header of checksheet data -->                         
                            <thead style="background-color: #3c5393" class="text-xs text-white">
                                <tr>
                                    <th class="border-r-[2px] border-blue-900 whitespace-nowrap px-3 py-3" colspan="1" rowspan="2">Date</th>
                                    <th class="border-r-[2px] border-blue-900 whitespace-nowrap px-3 py-3" colspan="1" rowspan="2">Shift</th>
                                    <th class="border-r-[2px] border-blue-900 whitespace-nowrap px-3 py-3" colspan="1" rowspan="2">Model Name</th>
                                    <th class="border-r-[2px] border-blue-900 whitespace-nowrap px-3 py-3" colspan="1" rowspan="2">Lot No.</th>
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
                                        <th v-for="(question, questionIndex) in section.section_content"
                                            :key="questionIndex"
                                            class="whitespace-nowrap border-r-[2px] border-blue-900 p-2">
                                            {{ question.label }}
                                        </th>
                                    </template>
                                    <th class="border-r-[2px] border-blue-900 px-1 py-1">
                                        Operator
                                    </th>
                                    <th class="border-r-[2px] border-blue-900 px-1 py-1">
                                        Lineleader/Technician/Supervisor/Engineer
                                    </th>
                                </tr>
                            </thead>
                            <!-- Post OK or Rejected checksheet data -->
                            <tbody v-for="response_field in data.data">
                                <!-- <tr v-if="(response_field.form_id === selectedOption.id &&
                                    selectedUser === null && selectedStatus === 'Default') ||
                                    (response_field.form_id === selectedOption.id &&
                                        response_field.operator_employee_id ===
                                        selectedUser.id && selectedStatus === response_field.status) ||
                                    (response_field.form_id === selectedOption.id &&
                                        selectedUser === null && selectedStatus === response_field.status) ||
                                    (response_field.form_id === selectedOption.id &&
                                        response_field.operator_employee_id ===
                                        selectedUser.id && selectedStatus === 'Default')"
                                    class="hover:bg-gray-100 duration-200 bg-white border-b dark:bg-gray-800 dark:border-gray-700"> -->
                                <tr v-if="logConditions(response_field)" class="hover:bg-gray-100 duration-200 bg-white border-b dark:bg-gray-800 dark:border-gray-700">
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
                                        {{ JSON.parse(response_field.response).fieldAnswers["Kit Number"] }} {{
                                            JSON.parse(response_field.response).fieldAnswers["Lot Number"] }}
                                    </td>
                                    <template
                                        v-for="(section, sectionIndex) in JSON.parse(response_field.form_data)?.form_content">
                                        <td class="font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                            v-for="(question, questionIndex) in section.section_content"
                                            :key="questionIndex">
                                            {{
                                                parsedArray(JSON.parse(response_field.response).fieldAnswers[question.label])
                                            }}
                                        </td>
                                    </template>

                                    <td class="text-gray-900 whitespace-nowrap">
                                        {{ response_field.first_name }} {{ response_field.last_name }}
                                    </td>
                                    <td class="text-gray-900 whitespace-nowrap">
                                        {{ response_field.line_leader_first_name }} {{
                                            response_field.line_leader_last_name
                                        }}
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

            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <Pagination :data="data" />
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, onMounted, reactive, watch } from "vue";
import Pagination from "@/Shared/Pagination.vue";
import { Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";

import VueMultiselect from 'vue-multiselect';

const selectedDateRange = ref(null);

let employeeOptions = ref([]); //Initialize options ref
let checksheetOptions = ref([]);
let statusOptions = ref([]);
let selectedUser = ref("");
let selectedOption = ref([]);
let selectedStatus = ref("Default");


let selectedForm = reactive({
    form_name: null,
});

let props = defineProps({
    data: Object,
    formdata: Array,
    counts: Number,
    forms: Array,
    employees: Array,
    sign: Array,
});

const logConditions = (response_field) => {
    const condition1 = (response_field.form_id === selectedOption.value.id &&
        selectedUser.value === "" && selectedStatus.value === "Default");

    const condition2 = (response_field.form_id === selectedOption.value.id &&
        response_field.operator_employee_id === selectedUser.value &&
        selectedStatus.value === response_field.status);

    const condition3 = (response_field.form_id === selectedOption.value.id &&
        selectedUser.value === "" && selectedStatus.value === response_field.status);

    const condition4 = (response_field.form_id === selectedOption.value.id &&
        response_field.operator_employee_id === selectedUser.value &&
        selectedStatus.value === "Default");

    console.log('Selected Option:', selectedOption.value.id, 'Response Field:', response_field.form_id, 'Selected User:', selectedUser.value.id, 'Employee Id:', response_field.operator_employee_id, 'Selected Status:', selectedStatus.value, 'Selected Status:', response_field.status);

    console.log('Condition 1:', condition1);
    console.log('Condition 2:', condition2);
    console.log('Condition 3:', condition3);
    console.log('Condition 4:', condition4);

    // Return true if any condition is true, i.e., the row should be displayed
    return condition1 || condition2 || condition3 || condition4;
};

// Fetch employees from your database
const fetchEmployeeOptions = async (searchInput) => {
    try {

        let response;

        if (searchInput) {
            // Fetch limited options from the API    
            response = await fetch(`/api/archive-employees/${searchInput}`);;
        } else {
            //fetch only 5 options from api
            response = await fetch(`/api/archive-employees`);
        }

        const data = await response.json();
        //First 5 options
        if (data && data.employees) {
            // Set the fetched employees as options
            const fetchedEmployees = data.employees;

            // Transform the fetched employees into the desired structure
            const transformedEmployees = fetchedEmployees.map(employee => {
                return {
                    id: employee.id,
                    name: employee.name,
                };
            });

            // Set the transformed employees as options
            employeeOptions.value = transformedEmployees;

            console.log(employeeOptions.value);

        } else {
            console.error('Error fetching employees: Invalid data format');
        }
    } catch (error) {
        console.error('Error fetching employees:', error); //return error if data is not fetched properly
    }
};

// Fetch check sheet from your database
const fetchChecksheetOptions = async (searchInput) => {
    try {

        let response;

        if (searchInput) {
            // Fetch limited options from the API    
            response = await fetch(`/api/archive-checksheets/${searchInput}`);;
        } else {
            //fetch only 5 options from api
            response = await fetch(`/api/archive-checksheets`);
        }

        const data = await response.json();
        //First 5 options
        if (data && data.checksheets) {
            // Set the fetched check sheets as options
            const fetchedChecksheets = data.checksheets;

            // Transform the fetched check sheets into the desired structure
            const transformedChecksheets = fetchedChecksheets.map(checksheet => {
                return {
                    id: checksheet.id,
                    form: checksheet.form_name,
                };
            });

            // Set the transformed check sheets as options
            checksheetOptions.value = transformedChecksheets;


            console.log(checksheetOptions.value);
        } else {
            console.error('Error fetching check sheets: Invalid data format');
        }
    } catch (error) {
        console.error('Error fetching check sheets:', error); //return error if data is not fetched properly
    }
};

// Fetch status from your database
const fetchStatusOptions = async () => {
    try {
        // Simulated static data
        const status = [
            { id: 1, name: 'Default' },
            { id: 2, name: 'OK' },
            { id: 3, name: 'Rejected' },
        ];

        // Set the transformed status as options
        statusOptions.value = status;

        console.log(statusOptions.value);
        
    } catch (error) {
        console.error('Error fetching status:', error); //return error if data is not fetched properly
    }
};

// Watch for changes in selectedUser and log the changes; ***CONSOLE LOG***
watch(selectedOption, (newValue, oldValue) => {
    if (newValue && newValue.id) {
        console.log('Selected check sheet changed. New value:', newValue, 'Old value:', oldValue);
    } else {
        console.log('Selected check sheet changed to null or undefined.');
    }
});

// Watch for changes in selectedUser and log the changes; ***CONSOLE LOG***
watch(selectedUser, (newValue, oldValue) => {
    if (newValue && newValue.id) {
        console.log('Selected user changed. New value:', newValue, 'Old value:', oldValue);
    } else {
        console.log('Selected user changed to null or undefined.');
    }
});

// Watch for changes in selectedUser and log the changes; ***CONSOLE LOG***
watch(selectedStatus, (newValue, oldValue) => {
    if (newValue) {
        console.log('Selected status changed. New value:', newValue, 'Old value:', oldValue);
    } else {
        console.log('Selected status changed to null or undefined.');
    }
});

onMounted(fetchEmployeeOptions); // execute fetch function on page render
onMounted(fetchChecksheetOptions); // execute fetch function on page render
onMounted(fetchStatusOptions); // execute fetch function on page render

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

</script>

<style> .wrapper {
     max-width: 220px;
 }

 td {
     color: black;
     text-align: center;
 }

 th {
     text-align: center;
 }
</style>
