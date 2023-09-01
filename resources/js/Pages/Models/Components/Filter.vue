<template>
    <section id="model-filter-section">
        <div class="model-filter-header">
            <h4>Filter by:</h4>
        </div>

        <section id="model-filters" class="text-[--blue] mb-5 grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-3">

            <!-- Search Model Filter -->
            <div id="model-filter-name-search" class="lg:col-span-2">
                <form>
                    <label for="filter-user-select" class="block mb-2 text-sm font-medium dark:text-white">Search by Model Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input v-model="modelName" type="search" id="default-search-name" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search Model Name" required>
                    </div>
                </form>
            </div>

            <!-- Checksheet appearance filter -->
            <div id="model-filter-checksheet-select">

                    <label for="countries" class="block mb-2 text-sm font-medium dark:text-white">Select
                                                                an option</label>
                    <button id="dropdownBgHoverButton" data-dropdown-toggle="dropdownBgHover" class="flex justify-center w-full duration-200 text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-20 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">Checksheet
                        <svg class="w-2.5 h-2.5 ml-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>


                    <div id="dropdownBgHover" class="z-10 hidden w-48 bg-white rounded-lg shadow dark:bg-gray-700">
                        <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownBgHoverButton">
                             <li v-for="(formItem, index) in Forms" :key="index">
                                <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <input :id="'checkbox-filter-item-' + formItem.id" type="checkbox" :value="formItem.id" v-model="SelectedForms" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label :for="'checkbox-filter-item-' + formItem.id" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                        {{ formItem.form_name }}
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>

            </div>

            <!-- Add Models button -->
            <div id="model-add-btn">
                <label for="filter-user-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Click to add models</label>
                <button type="button" class="duration-200 text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" data-modal-target="add-model-modal"
                    data-modal-toggle="add-model-modal">Add Model
                </button>
            </div>
        </section>
    </section>
</template>
<script setup>
import {ref, watch} from 'vue';
import {router} from '@inertiajs/vue3';
let modelName = ref('');
let SelectedForms = ref([]);
let props  = defineProps({
    model: {
        type: Object,
        required: true
    },
    Forms: {
        type: Array,
        required: true
    },
    filters: {
        type: Object,
        required: true
    }
});
watch([modelName, SelectedForms], ([modelName, SelectedForms]) => {
    const filters = {...props.filters};
    if (modelName) {
        filters.modelName = modelName;
    }
    if (SelectedForms.length > 0) {
        filters.SelectedCheckSheet = SelectedForms.join(',');
    }
    router.get(route('models.index'), filters, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
        append: true,
    });
});
</script>
