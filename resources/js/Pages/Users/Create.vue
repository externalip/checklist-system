<template>
    <AppLayout title="Add User">
        <form @submit.prevent="createAccount">
            <!-- ADD USER LAYOUT -->
            <div class=" lg:mx-20 rounded-lg grid grid-row-3 gap-5 text-[--blue]">
                <!-- First Section (Employee Info) -->
                <div class="mx-3 border-2 border-gray-200 lg:p-4 p-5 rounded-2xl">
                    <h3 class="text-2xl font-semibold mb-2 md:text-left text-center">
                        Employee Info
                    </h3>

                    <!-- INPUTS -->
                    <div class="space-y-4">
                        <!-- FIRST NAME & LAST NAME -->
                        <div class="grid md:grid-cols-2 grid-cols-1">
                            <!-- First Name -->
                            <div class="col-span-1 p-1">
                                <label for="first_name" class="block mb-1">First Name</label>
                                <input v-model="form.first_name" type="text" id="first_name" class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-300 p-2" />
                                <InputError class="mt-2" :message="form.errors.first_name" />
                            </div>

                            <!-- Last Name -->
                            <div class="col-span-1 p-1">
                                <label for="last_name" class="block mb-1">Last Name</label>
                                <input v-model="form.last_name" type="text" id="last_name" class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-300 p-2" />
                                <InputError class="mt-2" :message="form.errors.last_name" />
                            </div>
                        </div>

                        <!-- DOB, CONTACT, SHIFT, GENDER -->
                        <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1">
                            <!-- DATE OF BIRTH -->
                            <div class="p-1">
                                <label for="date_of_birth" class="block mb-1">Date of Birth</label>
                                <input v-model="form.date_of_birth" type="date" id="date_of_birth" class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-300 p-2" />
                                <InputError class="mt-2" :message="form.errors.date_of_birth" />
                            </div>

                            <!-- CONTACT -->
                            <div class="p-1">
                                <label for="contact" class="block mb-1">Contact</label>
                                <input v-model="form.contact" type="text" id="contact" class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-300 p-2" />
                                <InputError class="mt-2" :message="form.errors.contact" />
                            </div>

                            <!-- SHIFT -->
                            <div class=" p-1">
                                <label for="shift" class="block mb-1">Shift</label>
                                <select v-model="form.shift" type="text" id="shift" class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-300 p-2">
                                        <option value="0">None</option>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                        <option value="3rd">3rd</option>
                                    </select>
                                <InputError class="mt-2" :message="form.errors.shift" />
                            </div>

                            <!-- GENDER -->
                            <div class="p-1">
                                <label for="gender" class="block mb-1">Gender</label>
                                <select v-model="form.gender" type="text" id="gender" class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-300 p-2">
                                        <option value="" disabled>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                <InputError class="mt-2" :message="form.errors.gender" />
                            </div>


                        </div>
                    </div>
                </div>

                <!-- Second Section (Account Details) -->
                <div class="mx-3 border-2 border-gray-200 lg:p-4 p-5 rounded-2xl">
                    <h3 class="text-2xl font-semibold mb-2 md:text-left text-center">
                        Account Details
                    </h3>

                    <!-- INPUTS -->
                    <div class="space-y-4">
                        <div class="grid lg:grid-cols-2 md:grid-cols-2">
                            <!-- USERNAME -->
                            <div class="p-1">
                                <label for="username" class="block mb-1">Username</label>
                                <input v-model="form.username" type="text" id="username" class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-300 p-2" />
                                <InputError class="mt-2" :message="form.errors.username" />
                            </div>

                            <!-- PASSWORD -->
                            <div class="p-1">
                                <label for="password" class="block mb-1">Password</label>
                                <input v-model="form.password" type="password" id="password" class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-300 p-2" />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>

                        </div>

                        <div class="grid lg:grid-cols-2 md:grid-cols-2">
                            <!-- CONFIRM PASSWORD -->
                            <div class="p-1">
                                <label for="password_confirmation" class="block mb-1">Confirm Password</label>
                                <input v-model="form.password_confirmation" type="password" id="password_confirmation" class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-300 p-2" />
                                <InputError class="mt-2" :message="form.errors.password_confirmation" />
                            </div>

                            <!-- ROLE -->
                            <div class="p-1">
                                <label for="password_confirmation" class="block mb-1">Role</label>
                                <select v-model="form.role_id" type="text" id="role_id" class="text-gray-900 w-full rounded-lg border-2 border-gray-300 p-2">
                                    <option v-for="role in roles" :key="role.id" :value="role.id">{{ role.name }}
                                    </option>
                                    <InputError class="mt-2" :message="form.errors.role_id" />
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Third Section (Buttons) -->
                <div class="flex justify-center p-10">
                    <!-- create account button -->
                    <button type="submit" class="duration-200 text-white bg-[#3C5393] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Create Account
                    </button>

                    <!-- back button -->
                    <Link :href="route('users')" type="button" class="duration-200 py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        Back
                    </Link>
                </div>

            </div>
        </form>
        <div v-if="showAddRole" class="fixed inset-0 bg-black bg-opacity-50 z-40">
            <AddRoleModal v-if="showAddRole" :closeModalCallback="closeModal" />
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import AddRoleModal from '@/Pages/Users/Components/Modal.vue';
import { ref, defineProps } from 'vue';
import { useForm, Link } from "@inertiajs/vue3";
const { roles } = defineProps(['roles']);
const form = useForm({
    username: '',
    password: '',
    password_confirmation: '',
    first_name: '',
    last_name: '',
    gender: '',
    date_of_birth: '',
    contact: '',
    shift: '',
    role_id: '',
});
const showAddRole = ref(false);
const addRole = () => {
    showAddRole.value = true;
}
const closeModal = () => {
    showAddRole.value = false;
}
const createAccount = async () => {
    try {
        const response = await axios.post(route('users.store'), form);
        if (response.data.status === 'success') {
            await Swal.fire({
                title: 'Successfully created!',
                text: 'User has been created!',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            window.location.href = route('users');
        } else {
            const errors = response.data.errors;
            Object.keys(errors).forEach(field => {
                form.errors[field] = errors[field][0];
            });
            await Swal.fire({
                title: 'Error!',
                text: `Failed to create user`,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    } catch (error) {
        console.log(error);
        await Swal.fire({
            title: 'Error!',
            text: 'Failed to create user.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
};
</script>
