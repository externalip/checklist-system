<template>
    <!-- MODEL PAGE FILTER -->
    <section id="model-filter-section">
        <div class="model-filter-header">
            <h4>Filter by:</h4>
        </div>

        <section
            id="model-filters"
            class="text-[--blue] mb-5 grid lg:grid-cols-5 sm:grid-cols-2 grid-cols-1 gap-3"
        >
            <!-- Search Model Name Filter -->
            <div class="lg:col-span-2">
                <form>
                    <label
                        for="filter-user-select"
                        class="block mb-2 text-sm font-medium dark:text-white"
                        >Search by Model Name</label
                    >
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                        >
                            <svg
                                class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                                />
                            </svg>
                        </div>  
                        <VueMultiselect v-model="modelName" :options="modelOptions" :show-labels="false" @searchChange="limitedModelNames" id="default-search-name" placeholder="Search Model Name" class="" required></VueMultiselect>
                    </div>
                </form>
            </div>

            <!-- Checksheet appearance filter -->
            <div>
                <label
                    for="countries"
                    class="block mb-2 text-sm font-medium dark:text-white"
                    >Select an option</label
                >
                <button
                    id="dropdownBgHoverButton"
                    data-dropdown-toggle="dropdownBgHover"
                    class="flex justify-center w-full duration-200 text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button"
                >
                    Checksheet
                    <svg
                        class="w-2.5 h-2.5 ml-2.5"
                        aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 10 6"
                    >
                        <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 4 4 4-4"
                        />
                    </svg>
                </button>

                <div
                    id="dropdownBgHover"
                    class="z-10 hidden w-48 h-60 overflow-y-scroll bg-white rounded-lg shadow dark:bg-gray-700"
                >
                    <ul
                        class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownBgHoverButton"
                    >
                        <li v-for="(formItem, index) in Forms" :key="index">
                            <div
                                class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
                            >
                                <input
                                    :id="'checkbox-filter-item-' + formItem.id"
                                    type="checkbox"
                                    :value="formItem.id"
                                    v-model="SelectedForms"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                />
                                <label
                                    :for="'checkbox-filter-item-' + formItem.id"
                                    class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                                >
                                    {{ formItem.form_name }}
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Add Models button -->
            <div>
                <label
                    for="filter-user-select"
                    class="block mb-2 text-sm font-medium dark:text-white"
                    >Click to add models</label
                >
                <button
                    type="button"
                    class="w-full duration-200 text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    data-modal-target="add-model-modal"
                    data-modal-toggle="add-model-modal"
                >
                    Add Model
                </button>
            </div>

            <!-- Export button -->
            <div>
                <label
                    for="filter-user-select"
                    class="block mb-2 text-sm font-medium dark:text-white"
                    >Export Table</label
                >
                <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown" class="text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Export
                    <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">to PDF</a>
                        </li>
                        <li>
                            <a href="/models/export" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">to Excel</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </section>
</template>
<script setup>
import {ref, watch, onMounted} from 'vue';
import {router} from '@inertiajs/vue3';
import VueMultiselect from 'vue-multiselect';

let modelName = ref('');
let SelectedForms = ref([]);
let modelOptions = ref([]);


let props  = defineProps({
    Forms: {
        type: Array,
        required: true,
    },
});

// Fetch model names from your database
const limitedModelNames = async (searchInput) => {

    if (searchInput) {
        try {
            const response = await fetch(`/api/model-names/${searchInput}`);
            const data = await response.json();
            
            // Set the fetched model names as options
            modelOptions.value = data.limitedModelNames;
        } catch (error) {
            console.error('Error fetching model names:', error);
        }
    }else{
        try {
            // Fetch model names from your Laravel API endpoint
            const response = await fetch(`/api/model-names`);
            const data = await response.json();
            
            // Set the fetched model names as options
            modelOptions.value = data.modelNames;
        } catch (error) {
            console.error('Error fetching model names:', error);
        } 
    }
};

watch([modelName, SelectedForms], ([modelName, SelectedForms]) => {
    const filters = { ...props.filters };
    if (modelName) {
        filters.modelName = modelName;
    }
    if (SelectedForms.length > 0) {
        filters.SelectedCheckSheet = SelectedForms.join(",");
    }
    router.get(route("models.index"), filters, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        append: true,
    });
});

onMounted(limitedModelNames);
</script>

<script>
export default {
  components: { VueMultiselect },
  data () {
    return {
    }
  }
}
</script>

<style src="">
</style>


