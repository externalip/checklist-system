<template>
    <AppLayout title="Edit User">
        <form @submit.prevent="updateAccount">
            <div class=" lg:mx-20 rounded-lg grid grid-row-3 gap-5 text-[--blue]">
                <!-- First Section (Employee Info) -->
                <div class="mx-3 border-2 border-gray-200 lg:p-10 p-5 rounded-2xl">
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
                                <input v-model="form.first_name" type="text" id="first_name"
                                    class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-200 p-2" />
                                <InputError class="mt-2" :message="form.errors.first_name" />
                            </div>

                            <!-- Last Name -->
                            <div class="col-span-1 p-1">
                                <label for="last_name" class="block mb-1">Last Name</label>
                                <input v-model="form.last_name" type="text" id="last_name"
                                    class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-200 p-2" />
                                <InputError class="mt-2" :message="form.errors.last_name" />
                            </div>
                        </div>

                        <!-- DOB, CONTACT, SHIFT, GENDER -->
                        <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1">
                            <!-- Date of Birth -->
                            <div class="p-1">
                                <label for="date_of_birth" class="block mb-1">Date of Birth</label>
                                <input v-model="form.date_of_birth" type="date" id="date_of_birth"
                                    class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-200 p-2" />
                                <InputError class="mt-2" :message="form.errors.date_of_birth" />
                            </div>

                            <!-- Contact -->
                            <div class="p-1">
                                <label for="contact" class="block mb-1">Contact</label>
                                <input v-model="form.contact" type="text" id="contact"
                                    class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-200 p-2" />
                                <InputError class="mt-2" :message="form.errors.contact" />
                            </div>

                            <!-- Shift -->
                            <div class=" p-1">
                                <label for="shift" class="block mb-1">Shift</label>
                                <select v-model="form.shift" type="text" id="shift"
                                    class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-200 p-2">
                                    <option value="0">None</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                    <option value="3rd">3rd</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.shift" />
                            </div>

                            <!-- Gender -->
                            <div class="p-1">
                                <label for="gender" class="block mb-1">Gender</label>
                                <select v-model="form.gender" type="text" id="gender"
                                    class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-200 p-2">
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
                <div class="mx-3 border-2 border-gray-200 lg:p-10 p-5 rounded-2xl">
                    <h3 class="text-2xl font-semibold mb-2 md:text-left text-center">
                        Account Details
                    </h3>

                    <!-- INPUTS -->
                    <div class="space-y-4">
                        <!-- USERNAME & PASSWORD -->
                        <div class="grid lg:grid-cols-2 md:grid-cols-2">
                            <!-- Username -->
                            <div class="p-1">
                                <label for="username" class="block mb-1">Username</label>
                                <input v-model="form.username" type="text" id="username"
                                    class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-200 p-2" />
                                <InputError class="mt-2" :message="form.errors.username" />
                            </div>

                            <!-- Password -->
                            <div class="p-1">
                                <label for="password" class="block mb-1">Password</label>
                                <input v-model="form.password" type="password" id="password"
                                    class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-200 p-2" />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>
                        </div>

                        <!-- CONFIRM PASSWORD, ROLE, ACCOUNT STATUS -->
                        <div class="grid lg:grid-cols-2 md:grid-cols-2">
                            <!-- Confirm Password -->
                            <div class="p-1">
                                <label for="password_confirmation" class="block mb-1">Confirm Password</label>
                                <input v-model="form.password_confirmation" type="password" id="password_confirmation"
                                    class="text-sm text-gray-900 w-full rounded-lg border-1 border-gray-200 p-2" />
                                <InputError class="mt-2" :message="form.errors.password_confirmation" />
                            </div>

                            <!-- Role -->
                            <div class="col-span-0 p-1">
                                <label for="role_id" class="block mb-1">Role</label>
                                <select v-model="form.role_id" type="text" id="role_id"
                                    class="text-gray-900 w-full rounded-lg border-2 border-gray-300 p-2">
                                    <option v-for="role in roles" :key="role.id" :value="role.id">
                                      {{ role.name }}
                                    </option>
                                    <InputError class="mt-2" :message="form.errors.role_id" />
                                </select>
                            </div>

                            <!-- Account Status -->
                            <div class="col-span-0 p-1">
                                <label for="active" class="block mb-1">Active</label>
                                <select v-model="form.active" type="text" id="active"
                                    class="text-sm w-full rounded-lg border-1 border-gray-200 p-2">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                                <InputError class="mt-2" :message="form.errors.active" />
                            </div>
                        </div>

                    </div>

                </div>

                <!-- Third Section (BUTTONS) -->
                <div class="flex justify-center p-10">
                    <button type="submit"
                        class="text-white bg-[#3C5393] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Update
                        Account</button>
                    <Link :href="route('users')" type="button"
                        class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                    Back</Link>

                </div>

            </div>
        </form>

    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import { ref, defineProps } from 'vue';
import { useForm, Link } from "@inertiajs/vue3";

const { user, roles } = defineProps(['user', 'roles']);
const form = useForm({
    username: user.username,
    first_name: user.employee.first_name,
    last_name: user.employee.last_name,
    gender: user.employee.gender,
    date_of_birth: user.employee.date_of_birth,
    contact: user.employee.contact,
    shift: user.employee.shift,
    role_id: user.role_id,
    employee_id: user.employee.id,
    active: user.active,
    password: '',
    password_confirmation: '',
});
const onlyNumbers = (event) => {
    const charCode = (event.which) ? event.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        event.preventDefault();
    }
};
const updateAccount = async () => {
    try {
        const response = await axios.put(route('users.update', user.id), form);
        console.log(response.data.status);
        if (response.data.status === 'success') {
            await Swal.fire({
                title: 'Success!',
                text: 'User has been updated!',
                icon: 'success',
                confirmButtonText: 'OK'
            });
            window.location.href = route('users');
        } else {
             const errors = response.data.errors;
            Object.keys(errors).forEach(field => {
                form.errors[field] = errors[field][0];
            });
            console.log(form.errors);
            await Swal.fire({
                title: 'Error!',
                text: 'Failed to update user.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    } catch (error) {
        console.log(error);
        await Swal.fire({
            title: 'Error!',
            text: 'Failed to update user.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    }
};

</script>
