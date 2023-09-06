<style>
#content {
    display: none;
    /* Hide the content initially */
    margin-top: 20px;
}

.required::after {
    content: " *";
    color: red;
    font-size: 1em;
}
</style>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from '@inertiajs/vue3';
import { reactive } from 'vue';
const submit = async () => {
    try {
        const response = await axios.post(route('generate.store'), form_config);
        if (response.data.status === 'success') {

            await Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'The form was successfully created!',
                confirmButtonText: 'Okay',
            });
        } else if (response.data.status === 'error') {

            await Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        } else {

            await Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
            });
        }
    } catch (error) {
        // Use SweetAlert to show an error message
        await Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong!',
        });
    }
}
</script>

<template>
    <AppLayout title="Create Checksheet">
        <div class="lg:mx-[25%] mb-40">
            <div class="mx-auto">

                <!-- CHECKSHEET NAME -->
                <div class="mb-5">
                    <p class="text-xl mb-3">Check Sheet Name</p>
                    <div class="relative">

                        <!-- FORM NAME INPUT FIELD -->
                        <input v-model="form_config.form_name" type="text" id="checksheet-id" name="checksheet-name"
                            class="block px-2.5 pb-2.5 pt-4 w-5/6 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " required />
                        <label for="checksheet-id"
                            class="required absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Type
                            here the Checksheet name...
                        </label>
                    </div>
                </div>

                <!-- SECTION LOOPER -->
                <div v-for="key in Object.keys(form_config.form_content).length" :key="key">
                    <div :name="'section_' + key" class="border-gray-400 rounded-lg border-2 mb-10 p-4">
                        <div class="bg-white">
                            <div class="flex justify-between">

                                <!-- SECTION LABEL -->
                                <h2>Section {{ key }}</h2>

                                <!-- DELETE SECTION BUTTON -->
                                <div class="flex items-center align-center">
                                    <button @click="removeSection('section' + key)"
                                        class="duration-200 p-2 hover:bg-red-200 rounded-md">
                                        <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                            <path stroke="red" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                        </svg>
                                    </button>
                                </div>

                            </div>

                            <!-- TOP SECTION (Section Name) -->
                            <div class="grid grid-rows lg:grid-cols-5 gap-3 p-4 rounded-lg border-gray-200 border-2">
                                <div class="lg:col-span-4">
                                    <p class="text-md mb-1">Section Name</p>

                                    <!-- SECTION NAME INPUT -->
                                    <div class="relative">
                                        <input v-model="form_config.form_content['section' + key.toString()].section_name"
                                            type="text" :name="'section_name' + key" :id="'section_name' + key"
                                            class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                            placeholder=" " required />
                                        <label :for="'section_name' + key"
                                            class="required absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-3 scale-75 top-1 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 left-1">Type
                                            here the section name...</label>
                                    </div>

                                </div>
                            </div>
                            <!--End of Top Section (Section Name)-->

                            <!-- QUESTION SECTION LOOPER -->
                            <div>
                                <div v-for="qIndex in Object.keys(form_config.form_content['section' + key.toString()].section_content).length"
                                    :key="qIndex" class="pt-5" ref="questionRefs">
                                    <div :id="'question' + 'qIndex'"
                                        class="border-gray-200 border-2 p-4 flex flex-col rounded-lg">

                                        <!-- Question -->
                                        <div>
                                            <p class="text-md mb-2">Question</p>

                                            <!-- QUESTION LABEL INPUT -->
                                            <div class="relative">

                                                <input v-model="form_config
                                                    .form_content['section' + key.toString()]
                                                    .section_content['question' + qIndex.toString()].label" type="text"
                                                    :id="'question' + qIndex" class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent
                                                        rounded-lg border-1 border-gray-300 appearance-none dark:text-white
                                                        dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none
                                                        focus:ring-0 focus:border-blue-600 peer" placeholder=" "
                                                    required />

                                                <label :id="'question' + qIndex" :for="'question' + qIndex"
                                                    class="required absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-3 scale-75 top-1 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-1 peer-focus:scale-75 peer-focus:-translate-y-3 left-1">Type
                                                    here the question...</label>
                                            </div>
                                        </div>

                                        <!-- Instruction -->
                                        <div>
                                            <p class="text-md mb-2">
                                                Instruction
                                            </p>

                                            <!-- INSTRUCTION LABEL INPUT -->
                                            <div class="relative">
                                                <input v-model="form_config
                                                    .form_content['section' + key.toString()]
                                                    .section_content['question' + qIndex.toString()].instruction"
                                                    type="text" :name="'instruction' + qIndex" :id="'instruction' + qIndex"
                                                    class="block px-2.5 pb-1.5 pt-3 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " />
                                                <label :for="'instruction' + qIndex"
                                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Type
                                                    here your
                                                    instruction...</label>
                                            </div>
                                        </div>

                                        <!-- Question Type -->
                                        <div>
                                            <p class="required text-md mb-2">
                                                Question Type
                                            </p>
                                            <select
                                                @change="resetQuestionContent('section' + key.toString(), 'question' + qIndex.toString())"
                                                v-model="form_config.form_content['section' + key.toString()].section_content['question' + qIndex.toString()].type"
                                                :name="'v'"
                                                class="required border-1 border-gray-300 text-gray-900 text-m rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                required>
                                                <option selected>
                                                    Choose a type
                                                </option>
                                                <option :value="'radio'">
                                                    Multiple Choice
                                                </option>
                                                <option :value="'checkbox'">
                                                    Check
                                                </option>
                                                <option :value="'text'">
                                                    Text
                                                </option>
                                                <option :value="'dropdown'">
                                                    Dropdown
                                                </option>
                                            </select>
                                        </div>

                                        <!-- Question Type Options -->

                                        <!-- OPTION || Radio -->
                                        <div class="col-span-2"
                                            v-if="form_config.form_content['section' + key.toString()].section_content['question' + qIndex.toString()].type === 'radio'">

                                            <div class="mb-2">
                                                <p class="text-md">
                                                    Radio Options
                                                </p>
                                            </div>

                                            <!-- Radio Input Label -->
                                            <div v-for="ansIndex in Object.keys(form_config.form_content['section' + key.toString()].section_content['question' + qIndex.toString()].options).length"
                                                class="flex">
                                                <div class="w-full relative">
                                                    <input v-model="form_config
                                                        .form_content['section' + key.toString()]
                                                        .section_content['question' + qIndex.toString()]
                                                        .options['ans' + ansIndex.toString()]" type="text"
                                                        :name="'radio' + key" :id="'radio' + key"
                                                        class="mb-2 block px-2.5 pb-1.5 pt-3 w-5/6 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        placeholder="Enter answer option here" required />
                                                    <label :for="'radio' + key"
                                                        class="required absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-75 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-0 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Radio
                                                        Option
                                                    </label>
                                                </div>

                                                <!-- Delete answer option button -->
                                                <button
                                                    @click="removeAnswer('section' + key.toString(), 'question' + qIndex.toString(), 'ans' + ansIndex.toString())"
                                                    class="p-3 hover:bg-red-100">
                                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                                                    </svg>

                                                </button>
                                            </div>

                                            <!-- Add answer option button -->
                                            <button
                                                @click="addAnswer('section' + key.toString(), 'question' + qIndex.toString())"
                                                v-if="answerType.includes(form_config.form_content['section' + key.toString()].section_content['question' + qIndex.toString()].type)"
                                                class="hover:bg-blue-500 bg-[#3c5393] text-white duration-200 p-2 rounded-md text-sm flex items-center align-center">
                                                <svg class="w-4 h-4 mr-2 text-white-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                                    viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                Add Option
                                            </button>

                                        </div>

                                        <!-- OPTION || Checkbox -->
                                        <div class="col-span-2"
                                            v-if="form_config.form_content['section' + key.toString()].section_content['question' + qIndex.toString()].type === 'checkbox'">
                                            <div class="mb-2">
                                                <p class="text-md">
                                                    Checkbox Options
                                                </p>
                                            </div>

                                            <!-- Checkbox Input Label -->
                                            <div v-for="ansIndex in Object.keys(form_config.form_content['section' + key.toString()].section_content['question' + qIndex.toString()].options).length"
                                                class="flex">
                                                <div class="w-full relative">
                                                    <input type="text" :name="'check' + key" :id="'check' + key"
                                                        class="mb-2 block px-2.5 pb-1.5 pt-3 w-5/6 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        placeholder="Enter answer option here" v-model="form_config
                                                            .form_content['section' + key.toString()]
                                                            .section_content['question' + qIndex.toString()]
                                                            .options['ans' + ansIndex.toString()]
                                                            " required />
                                                    <label :for="'check' + key"
                                                        class="required absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-75 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-0 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Checkbox
                                                        Option</label>
                                                </div>

                                                <!-- Delete Answer Option Button -->
                                                <button
                                                    @click="removeAnswer('section' + key.toString(), 'question' + qIndex.toString(), 'ans' + ansIndex.toString())"
                                                    class="p-3 hover:bg-red-100">
                                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                                                    </svg>

                                                </button>
                                            </div>

                                            <button
                                                @click="addAnswer('section' + key.toString(), 'question' + qIndex.toString())"
                                                class="hover:bg-blue-500 bg-[#3c5393] text-white duration-200 p-2 rounded-md text-sm flex items-center align-center">
                                                <svg class="w-4 h-4 mr-2 text-white-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                                    viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                Add Option
                                            </button>
                                        </div>

                                        <!-- OPTION || Textbox -->
                                        <div class="col-span-2"
                                            v-if="form_config.form_content['section' + key.toString()].section_content['question' + qIndex.toString()].type === 'text'">
                                            <div class="">
                                                <p class="text-md mb-2">
                                                    Textbox
                                                </p>
                                            </div>

                                            <!-- Text Input Label -->
                                            <div class="relative">
                                                <input type="text" :name="'text' + key"
                                                    class="bg-[--disabled] border-[--disabled-outline] block px-2.5 pb-1.5 pt-3 w-5/6 text-sm text-gray-900 rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                    placeholder=" " disabled />
                                                <label for="section_name"
                                                    class="bg-[--disabled] absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Type
                                                    here...</label>
                                            </div>
                                        </div>

                                        <!-- OPTION || Dropdown Options -->
                                        <div class="col-span-2"
                                            v-if="form_config.form_content['section' + key.toString()].section_content['question' + qIndex.toString()].type === 'dropdown'">
                                            <div class="">
                                                <p class="text-md mb-2">
                                                    Dropdown Options
                                                </p>
                                            </div>

                                            <!-- Dropdown Option Label -->
                                            <div v-for="ansIndex in Object.keys(form_config.form_content['section' + key.toString()].section_content['question' + qIndex.toString()].options).length"
                                                class="flex">
                                                <div class="w-full relative">
                                                    <input v-model="form_config
                                                        .form_content['section' + key.toString()]
                                                        .section_content['question' + qIndex.toString()]
                                                        .options['ans' + ansIndex.toString()]" type="text"
                                                        :name="'drop' + key" :id="'drop' + key"
                                                        class="mb-2 block px-2.5 pb-1.5 pt-3 w-5/6 text-sm text-gray-900 bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        placeholder=" " required />
                                                    <label :for="'drop' + key"
                                                        class="required absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-75 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-0 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1">Dropbox
                                                        Option</label>
                                                </div>
                                                <button
                                                    @click="removeAnswer('section' + key.toString(), 'question' + qIndex.toString(), 'ans' + ansIndex.toString())"
                                                    class="p-3 hover:bg-red-100">
                                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                                        viewBox="0 0 20 20">
                                                        <path
                                                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                                                    </svg>

                                                </button>
                                            </div>

                                            <button
                                                @click="addAnswer('section' + key.toString(), 'question' + qIndex.toString())"
                                                class="hover:bg-blue-500 bg-[#3c5393] text-white duration-200 p-2 rounded-md text-sm flex items-center align-center">
                                                <svg class="w-4 h-4 mr-2 text-white-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none"
                                                    viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M10 5.757v8.486M5.757 10h8.486M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                </svg>
                                                Add Option
                                            </button>
                                        </div>

                                        <!-- Is Required? && Delete-->
                                        <div
                                            class="space-x-7 align-center justify-end flex border-t mt-10 pt-5 border-gray-200">

                                            <!-- Delete Question -->
                                            <div class="flex items-center align-center">
                                                <button
                                                    @click="removeQuestion('section' + key.toString(), 'question' + qIndex.toString())"
                                                    class="duration-200 p-2 hover:bg-red-200 rounded-md">
                                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                                                    </svg>
                                                </button>
                                            </div>

                                            <!-- Is Required Option -->
                                            <div class="flex space-x-2 align-center items-center">
                                                <p class="text-sm">Is Required?</p>
                                                <label class="relative inline-flex items-center cursor-pointer">
                                                    <input v-model="form_config
                                                        .form_content['section' + key.toString()]
                                                        .section_content['question' + qIndex.toString()]
                                                        .required" type="checkbox" value="" class="sr-only peer" />
                                                    <div
                                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                    </div>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- End of Question Block Section -->
                                </div>
                                <!-- ADD QUESTION BUTTON -->
                                <div class="p-5 flex flex-col items-center justify-center"
                                    v-if="form_config.form_content['section' + key.toString()].section_type == 'question'">
                                    <p class="text-md mb-1">Add a Question</p>
                                    <button
                                        class="pb-1.5 duration-200 border-[#3C5393]-200 border-2 rounded-md hover:bg-[#3C5393] hover:text-white font-bold py-2 px-4 w-[7rem]"
                                        @click="addQuestion('section' + key.toString())">
                                        +
                                    </button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- End of Adding Section section -->
            </div>
        </div>

        <!-- ADD BUTTONS -->

        <!-- Bottom Navigation (Mobile View) -->
        <div
            class="visible md:invisible fixed z-50 w-5/6 h-16 max-w-lg -translate-x-1/2 bg-white border border-gray-200 rounded-full bottom-4 left-1/2 dark:bg-gray-700 dark:border-gray-600">
            <div class="grid h-full max-w-lg grid-cols-3 mx-auto">
                <button type="button" @click="redirectBack"
                    class="inline-flex flex-col items-center justify-center px-5 rounded-l-full hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-5 h-5 mb-1 text-gray-500 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                    </svg>
                    <span class="sr-only">Back</span>
                </button>

                <div class="flex items-center justify-center">
                    <button data-tooltip-target="tooltip-new" type="button" href="#" @click="addSection"
                        class="inline-flex items-center justify-center w-10 h-10 font-medium bg-blue-600 rounded-full hover:bg-blue-700 group focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                        <span class="sr-only">New item</span>
                    </button>
                </div>

                <!-- Confirm and Save -->
                <div class="flex items-center justify-center">
                    <button  @click.prevent="submit" type="submit" data-tooltip-target="tooltip-save" class="inline-flex items-center justify-center w-10 h-10 font-medium bg-blue-600 rounded-full hover:bg-blue-700 group focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M1 5.917 5.724 10.5 15 1.5" />
                                </svg>
                    <span class="sr-only">New item</span>
                    </button>
                </div>

            </div>
        </div>

        <!-- Sticky Form Controller (Desktop View) -->
        <div
            class="h-2/6 invisible md:visible fixed z-50 max-w-lg bg-white border border-gray-200 rounded-2xl bottom-6 right-6 dark:bg-gray-700 dark:border-gray-600">
            <div class="grid h-full max-w-lg grid-rows-3 mx-auto">

                <!-- Back Button -->
                <button type="button" @click="redirectBack"
                    class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50 dark:hover:bg-gray-800 group">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 16 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 8h11m0 0-4-4m4 4-4 4m-5 3H3a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h3" />
                    </svg>
                    <span class="sr-only">Back</span>
                </button>

                <!-- Add Section -->
                <div class="flex items-center justify-center">
                    <button @click="addSection" data-tooltip-target="tooltip-new" type="button" href="#"
                        class="inline-flex items-center justify-center w-10 h-10 font-medium bg-blue-600 rounded-full hover:bg-blue-700 group focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 18 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 1v16M1 9h16" />
                        </svg>
                        <span class="sr-only">New item</span>
                    </button>
                </div>

                <div id="tooltip-new" role="tooltip"
                    class="absolute invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Add Section
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>

                <!-- Confirm and Save -->
                <div class="flex items-center justify-center">
                    <button @click.prevent="submit" type="submit" class="inline-flex items-center justify-center w-10 h-10 font-medium bg-blue-600 rounded-full hover:bg-blue-700 group focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800" data-tooltip-target="tooltip-save">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 16 12">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M1 5.917 5.724 10.5 15 1.5" />
                            </svg>
                            <span class="sr-only">New item</span>
                    </button>
                </div>

                <div id="tooltip-save" role="tooltip"
                    class="absolute invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                    Save & Create
                    <div class="tooltip-arrow" data-popper-arrow></div>
                </div>

            </div>
        </div>

    </AppLayout>
</template>

<script>
import { router } from "@inertiajs/vue3";
const answerType = ['radio', 'checkbox', 'dropdown'];

// Form JSON Structure
let form_config = reactive({
    form_name: null,
    form_content: {
        section1: {
            section_name: null,
            section_type: 'question',
            section_content: {
                question1: {
                    label: null,
                    instruction: null,
                    type: null,
                    required: false,
                    options: {
                        ans1: null
                    }
                }
            }
        }
    }
});

export default {
    name: 'App',
    methods: {
        removeSection(sectionName) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete section. This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Get index of section from form config
                    let config = form_config.form_content;
                    let removedSectionIndex = Object.keys(config).indexOf(sectionName);

                    // Delete the section from the form configuration
                    delete config[sectionName];

                    // To maintain the consecutive numbering of sections,
                    // We re-index the sections.
                    // 1. Get all the keys from the form content object
                    let sectionKeys = Object.keys(config);

                    // 2. Loop through the keys from removed section `i` to `n`
                    for (let i = removedSectionIndex; i < sectionKeys.length; i++) {
                        // 3. Re-index the section names
                        config['section' + (i + 1)] = config[sectionKeys[i]];

                        // 4. Delete the original section names
                        delete config[sectionKeys[i]];
                    }

                    Swal.fire(
                        'Deleted!',
                        `Section ${sectionName} has been deleted.`,
                        'success'
                    );
                }
            });
        },
        removeQuestion(sectionName, questionName) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete the question from ${sectionName}. This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Get question index in section content
                    let config = form_config.form_content[sectionName].section_content;
                    let removedQuestionIndex = Object.keys(config).indexOf(questionName);

                    // Delete the question
                    delete config[questionName];

                    // To maintain the consecutive numbering of questions,
                    // We re-index the questions.
                    // 1. Get all the keys from the section content object
                    let questionKeys = Object.keys(config);

                    // 2. Loop through the keys from removed question `i` to `n`
                    for (let i = removedQuestionIndex; i < questionKeys.length; i++) {
                        // 3. Re-index the question names
                        config['question' + (i + 1)] = config[questionKeys[i]];

                        // 4. Delete the original question names
                        delete config[questionKeys[i]];
                    }

                    Swal.fire(
                        'Deleted!',
                        `Question ${questionName} has been deleted from section ${sectionName}.`,
                        'success'
                    );
                }
            });
        },
        removeAnswer(sectionName, questionName, answerName) {
            // Get answer index in options object
            let config = form_config.form_content[sectionName].section_content[questionName].options;
            let removedAnswerIndex = Object.keys(config).indexOf(answerName);

            // Delete the question
            delete config[answerName];

            // To maintain the consecutive numbering of answers,
            // We re-index the answers.
            // 1. Get all the keys from the options object
            let answerKeys = Object.keys(config);

            // 2. Loop through the keys from removed answer `i` to `n`
            for (let i = removedAnswerIndex; i < answerKeys.length; i++) {
                // 3. Re-index the answer names
                config['ans' + (i + 1)] = config[answerKeys[i]];

                // 4. Delete the original answer names
                delete config[answerKeys[i]];
            }
        },
        addSection() {
            // Get number of sections
            let formContentSize = Object.keys(form_config.form_content).length;

            // Append new section to form content
            form_config
                .form_content['section' + (formContentSize + 1)] = {
                section_name: null,
                section_type: 'question',
                section_content: {

                }
            };
        },
        addQuestion(sectionName) {
            // Get number of questions
            let sectionContentSize = Object.keys(form_config.form_content[sectionName].section_content).length;

            // Append new question with unique key identifier
            form_config
                .form_content[sectionName]
                .section_content['question' + (sectionContentSize + 1)] = {
                label: null,
                instruction: null,
                type: null,
                required: false,
                options: {
                    ans1: null
                }
            };

            // Use $nextTick to ensure the DOM has been updated
            this.$nextTick(() => {
                // Get a reference to the last added question
                const questionRefs = this.$refs.questionRefs;
                const lastQuestion = questionRefs[questionRefs.length - 1];
                // Scroll to the last added question element
                if (lastQuestion) {
                    lastQuestion.scrollIntoView({ behavior: 'smooth' });
                }

                // Focus on the input element of the last question
                const inputElement = lastQuestion.querySelector('input');
                if (inputElement) {
                    inputElement.focus();
                }
            });
        },
        addAnswer(sectionName, questionName) {
            // Get number of questions
            let questionContentSize = Object.keys(
                form_config
                    .form_content[sectionName]
                    .section_content[questionName]
                    .options
            ).length;

            // Append new answer with unique key identifier
            form_config
                .form_content[sectionName]
                .section_content[questionName]
                .options['ans' + (questionContentSize + 1)] = null;
        },
        resetQuestionContent(sectionName, questionName) {
            // Delete current options object
            delete form_config.form_content[sectionName].section_content[questionName].options;

            // Re-add options object
            form_config.form_content[sectionName].section_content[questionName]['options'] = {
                ans1: null
            };
        },
        redirectBack() {
            router.get('/checksheet');
        },
    },
};
</script>
