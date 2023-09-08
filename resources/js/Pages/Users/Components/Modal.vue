<template>
    <div v-if="showModal" class="text-[--blue] fixed inset-0 flex items-center justify-center z-50">
        <div class="relative w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="p-6 md:px-5 relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-start pb-3 justify-between rounded-t dark:border-gray-600">
                    <h3 class="text-3xl text-center md:text-left font-semibold dark:text-white">
                        Add Role
                    </h3>
                </div>
                <form @submit.prevent="submit">
                    <div class="mb-2">
                        <label for="role_position" class="block mb-2 text-sm font-medium dark:text-white">Role
                            Position</label>
                        <input type="text" id="role_position"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Role Position..." v-model="Roles.position" required>
                    </div>
                    <div class="mb-2">
                            <label for="add_role" class="block mb-2 text-sm font-medium dark:text-white">Role Description</label>
                            <input type="text" id="role_description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Role Description..." v-model="Roles.description" required>
                        </div>
                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="bg-[--blue] duration-200 hover:bg-blue-600 text-white px-4 py-2 rounded-lg">Add Role</button>
                        <button @click="closeModal" type="button" class="duration-200 hover:bg-gray-100 ml-2 border rounded-lg px-4 py-2">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, defineProps} from 'vue';
import axios from 'axios';
import { useForm } from '@inertiajs/inertia-vue3';
const { closeModalCallback  } = defineProps(['closeModalCallback']);

const Roles = useForm({
    position: '',
    description: '',
});
const submit = async () => {
    try {
        const response = await axios.post(route('role.store'), Roles);
        if (response.status === 201) {
            Swal.fire({
                icon: 'success',
                title: 'Role created successfully',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.reload(true);
                }
            });
        }
    } catch (error) {
        console.error(error.response);
         const errors = error.response.data.errors;
        const errorText = Object.values(errors).join('\n');
        if (error.response && error.response.status === 422) {
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error',
                text: errorText,
            });
        }
    }
};
const showModal = ref(true);
const closeModal = () => {
    closeModalCallback();
};

</script>
