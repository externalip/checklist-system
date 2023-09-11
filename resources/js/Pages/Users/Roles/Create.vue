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
                                <!-- First Name -->
                                <div class="col-span-1 p-1">
                                    <label for="first_name" class="block mb-1">First Name</label>
                                    <input v-model="form.first_name" type="text" id="first_name"
                                        class="text-gray-900 w-full rounded-lg border-2 border-gray-300 p-2" />
                                    <InputError class="mt-2" :message="form.errors.first_name" />
                                </div>

                                <!-- Last Name -->
                                <div class="col-span-1 p-1">
                                    <label for="last_name" class="block mb-1">Last Name</label>
                                    <input v-model="form.last_name" type="text" id="last_name"
                                        class="text-gray-900 w-full rounded-lg border-2 border-gray-300 p-2" />
                                    <InputError class="mt-2" :message="form.errors.last_name" />
                                </div>
                            </div>

                            <!-- DOB, CONTACT, SHIFT, GENDER -->
                            <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1">
                                <!-- DATE OF BIRTH -->
                                <div class="p-1">
                                    <label for="date_of_birth" class="block mb-1">Date of Birth</label>
                                    <input v-model="form.date_of_birth" type="date" id="date_of_birth"
                                        class="text-gray-900 w-full rounded-lg border-2 border-gray-300 p-2" />
                                    <InputError class="mt-2" :message="form.errors.date_of_birth" />
                                </div>

                                <!-- CONTACT -->
                                <div class="p-1">
                                    <label for="contact" class="block mb-1">Contact</label>
                                    <input v-model="form.contact" type="text" id="contact"
                                        class="text-gray-900 w-full rounded-lg border-2 border-gray-300 p-2" />
                                    <InputError class="mt-2" :message="form.errors.contact" />
                                </div>

                                <!-- SHIFT -->
                                <div class=" p-1">
                                    <label for="shift" class="block mb-1">Shift</label>
                                    <select v-model="form.shift" type="text" id="shift"
                                        class="text-gray-900 w-full rounded-lg border-2 border-gray-300 p-2">
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
                                    <select v-model="form.gender" type="text" id="gender"
                                        class="text-gray-900 w-full rounded-lg border-2 border-gray-300 p-2">
                                        <option value="" disabled>Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <InputError class="mt-2" :message="form.errors.gender" />
                                </div>


                            </div>
                        </div>
                    </div>

                    <!-- BUTTONS -->
                    <div class="flex justify-center p-10">
                        <button type="submit"
                            class="duration-200 text-white bg-[#3C5393] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Create
                            Account</button>
                             <Link :href="route('users')" type="button"
                                class="duration-200 py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            Back</Link>
                    </div>

                </div>
            </form>
    </AppLayout>
</template>
<script setup>
import { defineProps, ref, onMounted, computed } from 'vue';
import AppLayout from '@/Layouts/AppLayout.vue';
</script>
