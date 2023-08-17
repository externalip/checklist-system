<template>
    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="p-6 md:px-20 relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start justify-between rounded-t dark:border-gray-600">
                    <h3 class="text-3xl font-semibold text-gray-900 dark:text-white">
                        Edit Model
                    </h3>
                </div>
                <form @submit.prevent="updateUser">
                    <div class="mb-2">
                        <label for="model_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Model
                            Name</label>
                        <input type="text" id="model_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Model Name..." required>
                    </div>
                    <!-- Checkboxes -->
                    <ul class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownSearchButton">
                        <li v-for="(formItem, index) in Forms" :key="index">
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                <input :id="'checkbox-item-' + formItem.id" type="checkbox" :value="formItem.id"
                                    v-model="SelectedForms"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label :for="'checkbox-item-' + formItem.id"
                                    class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300">
                                    {{ formItem.form_name }}
                                </label>
                            </div>
                        </li>
                    </ul>
                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Save</button>
                        <button @click="closeModal" type="button" class="ml-2 border rounded-lg px-4 py-2">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps, onMounted } from 'vue';
import axios from 'axios';

const { id: userId, closeModalCallback } = defineProps(['id', 'closeModalCallback']);
const Forms = ref([]);
const editModels = ref({
    id: 0,
    model_name: '',
    form_id: '',
});

const showModal = ref(false);
const fetchForms = async () => {
    try {
        const response = await axios.get('api/forms');
        Forms.value = response.data;
    } catch (error) {
        console.error('Error fetching forms:', error);
    }
};
const fetchUserData = async () => {
    try {
        const response = await axios.get(`api/user/${userId}`);
        const model = response.data;
        editedUser.value = {
            id: model.id,
            model_name: model.model_name,
            form_id: model.form_id,
        };
        showModal.value = true;
    } catch (error) {
        console.error('Error fetching user data:', error);
        showModal.value = true;

    }
};

onMounted(async () => {
    await fetchUserData();
});

const updateUser = () => {

};

const closeModal = () => {
    closeModalCallback();
};
</script>
