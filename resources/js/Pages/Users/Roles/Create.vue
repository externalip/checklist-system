<template>
    <AppLayout title="Roles">
        <form @submit.prevent="createRole">
            <div class=" lg:mx-20 rounded-lg grid grid-row-3 gap-5 text-[--blue]">
                <!-- Employee Info -->
                <div class="mx-3 border-2 border-gray-300 lg:p-10 p-5 rounded-2xl">
                    <h3 class="text-2xl font-semibold mb-2 md:text-left text-center">
                        Roles
                    </h3>

                    <!-- INPUTS -->
                    <div class="space-y-4">
                        <!-- FIRST NAME & LAST NAME -->
                        <div class="grid md:grid-cols-2 grid-cols-1">
                            <!-- Role Name -->
                            <div class="col-span-1 p-1">
                                <label for="role_name" class="block mb-1">Role Name</label>
                                <input v-model="form.name" type="text" id="role_name" class="text-gray-900 w-full rounded-lg border-2 border-gray-300 p-2" required />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </div>

                            <!-- Last Name -->
                            <div class="col-span-1 p-1">
                                <label for="role_description" class="block mb-1">Role Description</label>
                                <input v-model="form.description" type="text" id="role_description" class="text-gray-900 w-full rounded-lg border-2 border-gray-300 p-2" required />
                                <InputError class="mt-2" :message="form.errors.description" />
                            </div>
                        </div>
                            <div>
                                <multiselect v-model="selectedPermission" :options="permissions" :multiple="true" :close-on-select="false" :clear-on-select="false" placeholder="Select an option" label="name" track-by="id" select-label="id" groupSelect="true" @select="onOptionSelect"></multiselect>
                                <span v-if="!selectedPermission.length" class="text-red-600 text-sm">Please select at least one option.</span>
                            </div>
                    </div>
                </div>

                <!-- BUTTONS -->
                <div class="flex justify-center p-10">
                    <button type="submit" class="duration-200 text-white bg-[#3C5393] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create
                                    Role</button>
                    <Link :href="route('roles.index')" type="button" class="duration-200 py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"> Back
                    </Link>
                </div>

            </div>
        </form>
    </AppLayout>
</template>

<script setup>
import { defineProps, ref } from 'vue';
import { useForm, Link } from '@inertiajs/vue3';
import Multiselect from 'vue-multiselect';
import AppLayout from '@/Layouts/AppLayout.vue';
defineProps({ permissions: Array });

const form = useForm({
    name: '',
    description: '',
});

const selectedPermission = ref([]);
const createRole = async () => {
    try {
        const response = await axios.post(route('roles.store'), {
            name: form.name,
            description: form.description,
            permissions: selectedPermission.value,
        });

        // Handle successful response
        Swal.fire({
            icon: 'success',
            title: 'Role Created!',
            text: 'The role has been created successfully.',
        });

        // Reset the form and selected permissions
        form.reset();
        selectedPermission.value = [];

    } catch (error) {
        // Handle error
        console.error('Error creating role:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'There was an error creating the role.',
        });
    }
};
</script>
