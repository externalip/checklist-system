<template>
    <AppLayout title="Model Manager">
        <div id="model-manager" class="lg:mx-20">
            <section id="model-filter-section">
                <div class="model-filter-header">
                    <h4>Filter by:</h4>
                </div>

                <section id="model-filters" class="mb-5 grid lg:grid-cols-4 sm:grid-cols-2 grid-cols-1 gap-3">

                    <div id="model-filter-checksheet-select">

                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select
                                        an option</label>
                        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option selected>Choose a country</option>
                                        <option value="US">United States</option>
                                        <option value="CA">Canada</option>
                                        <option value="FR">France</option>
                                        <option value="DE">Germany</option>
                                    </select>

                    </div>

                    <div id="model-filter-name-search">

                        <form>
                            <label for="filter-user-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search by Model
                                            Name</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                                </svg>
                                </div>
                                <input type="search" id="default-search-name" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search Model Name" required>
                            </div>
                        </form>

                    </div>

                    <div id="model-filter-id-search">
                        <form>
                            <label for="filter-user-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search by ID</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                                </svg>
                                </div>
                                <input type="search" id="default-search-id" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search Model ID" required>
                            </div>
                        </form>

                    </div>

                    <div id="model-add-btn">
                        <label for="filter-user-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Click to add models</label>
                        <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" data-modal-target="add-model-modal"
                            data-modal-toggle="add-model-modal">Add
                                        Model</button>

                        <!-- Add Model Modal  -->
                        <form id="add-model-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" @submit.prevent="submitForm" class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative w-full max-w-2xl max-h-full">
                                <!-- Modal content -->
                                <div class="p-6 md:px-20 relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-start justify-between rounded-t dark:border-gray-600">
                                        <h3 class="text-3xl font-semibold text-gray-900 dark:text-white">
                                            Create Model
                                        </h3>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="">

                                        <!-- Name of the Model input -->
                                        <div class="mb-2">
                                            <label for="model_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Model
                                                            Name</label>
                                            <input type="text" v-model="form.model_name" id="model_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                placeholder="Model Name..." required>
                                        </div>

                                        <!-- Checklists Appearance Checkbox -->
                                        <label for="checklists-search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Displayed
                                                        on
                                                        Checklists</label>
                                        <div id="checklists-search" class="z-10 bg-white rounded-lg shadow w-full dark:bg-gray-700">
                                            <div class="p-3">
                                                <label for="input-group-search" class="sr-only">Search</label>
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                                        <path stroke="currentColor" stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                                                    </svg>
                                                    </div>
                                                    <input type="text" id="input-group-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        placeholder="Search Available Checklists...">
                                                </div>
                                            </div>

                                            <!-- Checkboxes -->
                                            <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownSearchButton">
                                                <li v-for="(formItem, index) in Forms" :key="index">
                                                    <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                                        <input :id="'checkbox-item-' + formItem.id" type="checkbox" :value="formItem.id" v-model="SelectedForms" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                        <label :for="'checkbox-item-' + formItem.id" class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                                                        {{ formItem.form_name }}
                                                                    </label>
                                                    </div>
                                                </li>
                                            </ul>

                                        </div>
                                    </div>
                                    <!-- Modal footer -->
                                    <div class="flex flex-col sm:flex-row md:justify-end justify-center align-center items-center mt-3 space-x-2 rounded-b gap-2">
                                        <button data-modal-hide="add-model-modal" type="button" @click="submitForm" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create
                                                        Model</button>
                                        <button data-modal-hide="add-model-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-4 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Back</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </section>
            </section>

            <section id="model-table-section">

                <div class="relative overflow-x-auto">
                    <table class="rounded-lg w-full text-sm text-center text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3" >
                                    <input type="checkbox" v-model="selectAll">
                                     <button v-if="selectedModels?.length > 0" @click="deleteSelected" class="hover:bg-gray-200 transition duration-200 ease-in-out p-4 flex-none">
                                                    <img src="@/Shared/Icons/delete.svg" alt="Delete" class="w-5 h-5 cursor-pointer " />
                                    </button>
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Model ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Model Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Checksheet Appearance
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="models.length === 0">
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        No models available.
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr v-for="model in models" :key="model.model_id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 transition ease-in-out duration-200">
                                    <td>
                                    <input type="checkbox" v-model="selectedModels" :value="model.model_id">
                                    </td>
                                    <td class="px-6 py-4">{{ model.model_id }}</td>
                                    <td class="px-6 py-4">{{ model.model_name }}</td>
                                    <td class="px-6 py-4">{{ model.checksheet_appearance ? model.checksheet_appearance : 'No Checksheet Appearance' }}</td>
                                    <td class="px-6 py-4 flex justify-center items-center space-x-4 mx-10">
                                        <button href="#" @click.prevent="editModel(model.model_id)" type="button" class="hover:bg-gray-200 transition duration-200 ease-in-out p-4 flex-none">
                                                                                <img src="@/Shared/Icons/edit.svg" alt="edit icon"
                                                                                    class="w-5 h-5 cursor-pointer flex-none">
                                                                            </button>
                                        <button href="#" @click.prevent="deleteModel(model.model_id)" type="button" class="hover:bg-gray-200 transition duration-200 ease-in-out p-4 flex-none">
                                                                                <img src="@/Shared/Icons/delete.svg" alt="Delete" class="w-5 h-5 cursor-pointer " />
                                                                            </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </section>


            <div v-if="showEditModal" class="fixed inset-0 bg-black bg-opacity-50 z-40">
                <Modal v-if="showEditModal" :id="editedModelId" :Forms="Forms" :closeModalCallback="closeModal" />
            </div>
            <section id="pagination">

                <div class="flex flex-col items-center">
                    <!-- Help text -->
                    <span class="text-sm text-gray-700 dark:text-gray-400">
                            Showing <span class="font-semibold text-gray-900 dark:text-white">1</span> to <span class="font-semibold text-gray-900 dark:text-white">10</span> of <span class="font-semibold text-gray-900 dark:text-white">100</span>                Entries
                    </span>
                    <div class="inline-flex mt-2 xs:mt-0">
                        <!-- Buttons -->
                        <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-l hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-3.5 h-3.5 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 5H1m0 0 4 4M1 5l4-4" />
                                </svg>
                                Prev
                            </button>
                        <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-l border-gray-700 rounded-r hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
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


<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from '@inertiajs/vue3';
import axios from 'axios';
import { defineProps, ref, onMounted, provide, computed, watch  } from 'vue';
import Modal from './EditModal.vue';

const { Forms } = defineProps(['Forms']);
const SelectedForms = ref([]);
const models = ref([]);
const showEditModal = ref(false);
const editedModelId = ref(null);
const selectedModels = ref([]);
const form = useForm({
    model_name: '',
    form_id: ''
});
onMounted(async () => {
    TableView();
});
const TableView = async () => {
    try {
        const response = await axios.get('/api/TableView');
        models.value = response.data;
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

const submitForm = async () => {

    form.model_name = form.model_name.trim();
    form.form_id = SelectedForms.value;

    try {
        await axios.post(route('models.store'), form);
        form.reset();
        const success = await Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Form submitted successfully!',
            confirmButtonText: 'OK'
        });
        if (success.isConfirmed) {
           TableView();
        }
    } catch (error) {
        console.error("Error submitting form:", error);
    }
};

const editModel = (id) => {
    editedModelId.value = id;
    showEditModal.value = true;
}
const closeModal = () => {
    showEditModal.value = false;
}
const deleteModel = async (id) => {
    const confirmed = await Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this model!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    });
    if (confirmed.isConfirmed) {
        try {
            await axios.delete(route('models.destroy'), {
                data: {
                    id: id
                }
            });
            TableView();
            Swal.fire({
                title: 'Deleted!',
                text: 'The model has been deleted.',
                icon: 'success',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        } catch (error) {
            console.error('Error deleting model:', error);
        }
    }
}
provide("TableView", TableView);
const selectAll = computed({
    get: () => selectedModels.value.length === models.value.length,
    set: (value) => {
        selectedModels.value = value ? models.value.map(model => model.model_id) : [];
    }
});

const deleteSelected = async () => {
    if (selectedModels.value.length === 0) {
        return;
    }
    const sure = Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: 'You will not be able to recover these models!',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete them!'

    });
    sure.then(async (result) => {
        if (result.isConfirmed) {
          try {
                 await axios.delete(route('models.destroy'), {
                    data: {
                        ids: selectedModels.value
                    }
                    });

                TableView();
                selectedModels.value = [];
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Selected models deleted successfully!',
                    confirmButtonText: 'OK'
                });
            } catch (error) {
                console.error('Error deleting selected models:', error);
            }
        }
    });

}
</script>
