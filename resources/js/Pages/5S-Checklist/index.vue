<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { reactive } from 'vue'
    import { router } from '@inertiajs/vue3'

    const props = defineProps({
        models: Array,
    });


    let form = reactive({
        // Form identifier
        form_id : 1,
        // Questions storage
        fieldNames: {

        },
        // Answers storage
        fieldAnswers: {
            ans1: null,
            ans2: null,
            ans3: null,
            ans4: null,
            ans5: null,
            ans6: null,
            ans7: null,
            ans8: null,
            ans9: null,
        }
    })

    function submit() {
        // Get no. of questions based on h5 tags with an id `question#`
        let questionInputs = document.querySelectorAll('h5[id^="question"]');
        let questionCount = questionInputs.length;

        // Get question text
        for (let i = 1; i <= questionCount; i++) {
            let key = "field".concat(i);
            let value = document.getElementById('question' + i).textContent;
            
            // Store question into object
            form.fieldNames[key] = value;
        }

        // Send user input to ResponseController
        router.post('/submit-response', form)
    }
</script>

<style scoped></style>

<template>
    <AppLayout>
        <div class="5s">
            <div id="header" class="lg:mx-20">
                <h1 class="">5S Checklist</h1>
            </div>
            <form @submit.prevent="submit()" method="post" id="1">
                
                <!-- Hidden CSRF Token -->
                <input type="hidden" name="_token" :value="csrf">
                
                <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                    <h2 class="mb-2">Model Identification</h2>
                    <!-- Model Name -->
                    <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                        <h5 id="question1">Model Name</h5>

                        <label 
                            for="models" 
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        > Select a model </label>

                        <select 
                            id="models"
                            v-model="form.fieldAnswers.ans1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                            <option v-for="model in models"  :value="model.model_name" :key="model.id" >{{ model.model_name }}</option>
                        </select>

                    </div>

                    <!-- Lot Number -->
                    <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                        <h5 id="question2">Lot Number</h5>
                        <div class="">
                            <label for="models" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Input the
                                Lot Number</label>
                            <input v-model="form.fieldAnswers.ans2" type="text" id="ltnum"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Type of Checking -->
                    <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                        <h5 id="question3">Type of Checking</h5>
                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans3" id="horizontal-list-radio-startup" type="radio" value="Start-Up"
                                        name="type-of-checking-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="horizontal-list-radio-startup"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Start-up
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans3" id="horizontal-list-radio-restartup" type="radio" value="Re-Startup"
                                        name="type-of-checking-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="horizontal-list-radio-restartup"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Re-Startup</label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans3" id="horizontal-list-radio-changemodel" type="radio" value="Change Model"
                                        name="type-of-checking-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="horizontal-list-radio-changemodel"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Change
                                        Model</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>

                <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                    <h2 class="mb-2">Checking Items</h2>

                    <!-- Production Checklist -->
                    <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                        <h5 id="question4">Production Checksheet</h5>

                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-ok" type="radio" value="OK"
                                        name="production-checksheet-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="production-checksheet-radio-ok"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-ng" type="radio" value="NG"
                                        name="production-checksheet-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="production-checksheet-radio-ng"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-na" type="radio" value="NA"
                                        name="production-checksheet-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="production-checksheet-radio-na"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Procedures/OPL/Work Instructions -->
                    <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                        <h5 id="question5">Procedures/OPL/Work Instructions</h5>

                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans5" id="powi-radio-ok" type="radio" value="OK" name="powi-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="powi-radio-ok"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans5" id="powi-radio-ng" type="radio" value="NG" name="powi-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="powi-radio-ng"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans5" id="powi-radio-na" type="radio" value="NA" name="powi-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="powi-radio-na"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Working Area -->
                    <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                        <h5 id="question6">Working Area</h5>

                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans6" id="working-area-radio-ok" type="radio" value="OK" name="working-area-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="working-area-radio-ok"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans6" id="working-area-radio-ng" type="radio" value="NG" name="working-area-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="working-area-radio-ng"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans6" id="working-area-radio-na" type="radio" value="NA" name="working-area-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="working-area-radio-na"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Materials -->
                    <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                        <h5 id="question7">Materials</h5>

                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans7" id="materials-radio-ok" type="radio" value="OK" name="materials-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="materials-radio-ok"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans7" id="materials-radio-ng" type="radio" value="NG" name="materials-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="materials-radio-ng"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans7" id="materials-radio-na" type="radio" value="NA" name="materials-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="materials-radio-na"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Tools/Jigs Instrument -->
                    <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                        <h5 id="question8">Tools/Jigs Instrument</h5>
                        <ul
                            class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans8" id="tools-radio-ok" type="radio" value="OK" name="tools-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="tools-radio-ok"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans8" id="tools-radio-ng" type="radio" value="NG" name="tools-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="tools-radio-ng"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                    </label>
                                </div>
                            </li>
                            <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                <div class="flex items-center pl-3">
                                    <input v-model="form.fieldAnswers.ans8" id="tools-radio-na" type="radio" value="NA" name="tools-radio"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                    <label for="tools-radio-na"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>

                <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                    <h2 class="mb-2">Remarks</h2>
                    <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                        <h5 id="question9">Remarks on the Model</h5>
                        <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Please type
                            possible problems regarding with the machine.</label>
                        <textarea v-model="form.fieldAnswers.ans9" id="message" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write here...">
                        </textarea>
                    </div>
                </section>

                <section id="button-group" class="place-content-end mt-5 mb-5 lg:mx-20 align-right justify-right flex">
                    <!-- Back Button -->
                    <button type="button"
                        class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>

                    <!-- Submit Button -->
                    <button type="btnSubmit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit
                    </button>
                </section>
            </form>
            
        </div>
    </AppLayout>
</template>
