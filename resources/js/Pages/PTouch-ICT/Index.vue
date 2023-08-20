<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { reactive } from 'vue'
    import { router } from '@inertiajs/vue3'

    const props = defineProps({
        models: Array,
    });


    let form = reactive({
        // Form identifier
        form_id : 3,
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
            ans10: null,
            ans11: null,
            ans12: null,
            ans13: null,
            ans14: null,
            ans15: null,
            ans16: null,
            ans17: null,
            ans18: null,
            ans19: null,
            ans20: null,
            ans21: null,
            ans22: null,
            ans23: null,
            ans24: null,
        }
    })

    function submit() {
        // Get no. of questions based on h5 tags with an id `question#`
        let questionInputs = document.querySelectorAll('h5[id^="question"]');
        let questionCount = questionInputs.length;

        // Get question text
        for (let i = 1; i <= questionCount; i++) {
            let ansKey = "ans".concat(i);
            let questionLabel = document.getElementById('question' + i).textContent;
            
            // Store question into object
            form.fieldAnswers[questionLabel] = form.fieldAnswers[ansKey];
            delete form.fieldAnswers[ansKey];
        }

        // Send user input to ResponseController
        router.post('/submit-response', form)
    }
</script>


<style scoped></style>

<template>
    <AppLayout title="P-Touch ICT Start-Up">
        <div class="ptouch-ict grid lg:grid-cols-1">
            <form @submit.prevent="submit()" method="post" id="1">  
                <!-- Hidden CSRF Token -->
                <input type="hidden" name="_token" :value="csrf">
            <!-- MODEL IDENTIFICATION SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <!-- Section || Section Name -->
                <h2 id="section-name" class="mb-2">Model Identification</h2>

                <!-- Question || Model Name -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question1">Model Name</h5>

                    <label for="models" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a
                        model</label>
                    <select 
                        id="models"
                        v-model="form.fieldAnswers.ans1"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    >
                        <option v-for="model in models"  :value="model.model_name" :key="model.id" >{{ model.model_name }}</option>
                    </select>

                </div>

                <!-- Question || Lot Number -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question2">Lot Number</h5>
                    <div class="">
                        <label for="models" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Input the
                            Lot Number</label>
                        <input v-model="form.fieldAnswers.ans2" type="text" id="ltnum"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>

                <!-- Question || Type of Checking -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question3">Type of Checking</h5>


                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option || Startup -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans3" id="toc-radio-startup" type="radio" value="Start-Up" name="toc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="toc-radio-startup"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Start-up
                                </label>
                            </div>
                        </li>
                        <!-- Radio Option || Change Model -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans3" id="toc-radio-changemodel" type="radio" value="Change Model" name="toc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="toc-radio-changemodel"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Change
                                    Model</label>
                            </div>
                        </li>
                        <!-- Radio Option || Power Failure -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans3" id="toc-radio-powerfailure" type="radio" value="Power Failure" name="toc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="toc-radio-powerfailure"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Power
                                    Failure</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- MAIN BREAKER SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question4" class="mb-2">Main Breaker</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Check if ON.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans4" id="mb-radio-check" type="radio" value="✔" name="mb-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="mb-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans4" id="mb-radio-x" type="radio" value="X" name="mb-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="mb-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans4" id="mb-radio-checkX" type="radio" value="X✔" name="mb-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="mb-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✔</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans4" id="mb-radio-na" type="radio" value="NA" name="mb-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="mb-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- POWER SWITCH SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question5" class="mb-2">Power Switch</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Functional if Light indicator lights on when switch is turned on.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans5" id="ps-radio-check" type="radio" value="✔" name="ps-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ps-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans5" id="ps-radio-x" type="radio" value="X" name="ps-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ps-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans5" id="ps-radio-checkX" type="radio" value="X✔" name="ps-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ps-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✔</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans5" id="ps-radio-na" type="radio" value="NA" name="ps-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ps-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- STANDARD PRESSURE SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question6" class="mb-2">Standard Pressure</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Check the actual value on the pressure gauge
                        <span
                            class="font-bold underline underline-offset-3 decoration-3 decoration-blue-400 dark:decoration-blue-600">(0.40
                            - 0.60)</span>
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <div>
                        <input v-model="form.fieldAnswers.ans6" type="text" id="sp-input"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Actual Value in Celsius" required>
                    </div>

                </div>

            </section>

            <!-- CPU SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question7" class="mb-2">CPU</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Check if ON.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans7" id="cpu-radio-check" type="radio" value="✔" name="cpu-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="cpu-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans7" id="cpu-radio-x" type="radio" value="X" name="cpu-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="cpu-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans7" id="cpu-radio-checkX" type="radio" value="X✔" name="cpu-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="cpu-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✔</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans7" id="cpu-radio-na" type="radio" value="NA" name="cpu-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="cpu-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- MONITOR SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question8" class="mb-2">Monitor</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Activates when the CPU is ON.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans8" id="monitor-radio-check" type="radio" value="✔" name="monitor-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="monitor-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans8" id="monitor-radio-x" type="radio" value="X" name="monitor-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="monitor-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans8" id="monitor-radio-checkX" type="radio" value="X✔" name="monitor-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="monitor-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✔</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans8" id="monitor-radio-na" type="radio" value="NA" name="monitor-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="monitor-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- OPERATION BUTTONS SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question9" class="mb-2">Operation Buttons (2)</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Check if Functional.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans9" id="ob-radio-check" type="radio" value="✔" name="ob-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ob-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans9" id="ob-radio-x" type="radio" value="X" name="ob-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ob-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans9" id="ob-radio-checkX" type="radio" value="X✔" name="ob-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ob-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✔</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans9" id="ob-radio-na" type="radio" value="NA" name="ob-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ob-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- PNEUMATIC SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question10" class="mb-2">Pneumatic</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Functional when 2 green buttons are pressed.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans10" id="pneumatic-radio-check" type="radio" value="✔" name="pneumatic-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="pneumatic-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans10" id="pneumatic-radio-x" type="radio" value="X" name="pneumatic-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="pneumatic-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans10" id="pneumatic-radio-checkX" type="radio" value="X✔" name="pneumatic-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="pneumatic-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✔</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans10" id="pneumatic-radio-na" type="radio" value="NA" name="pneumatic-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="pneumatic-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- TEST FIXTURE, CONTACT PINS/PROBE SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question11" class="mb-2">Text Fixture, Contact Pins/Probe</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Check if correct fixture is used and in good condition.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans11" id="tfcp-radio-check" type="radio" value="✔" name="tfcp-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tfcp-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans11" id="tfcp-radio-x" type="radio" value="X" name="tfcp-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tfcp-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans11" id="tfcp-radio-checkX" type="radio" value="X✔" name="tfcp-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tfcp-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✔</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans11" id="tfcp-radio-na" type="radio" value="NA" name="tfcp-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tfcp-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- PRESENCE PINS SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question12" class="mb-2">Presence Pins</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Check if the presence pin/s is/are available. Press each pressence pins
                        (3x) to check if it is still in good condition (NOT STUCK). (If Applicable).
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans12" id="pp-radio-check" type="radio" value="✔" name="pp-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="pp-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans12" id="pp-radio-x" type="radio" value="X" name="pp-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="pp-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans12" id="pp-radio-checkX" type="radio" value="X✔" name="pp-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="pp-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✔</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans12" id="pp-radio-na" type="radio" value="NA" name="pp-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="pp-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- TRAY FOR NG AND FOR CONFIRMATION UNITS SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question13" class="mb-2">Tray for NG and for confirmation units</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Check if the red (NG) and yellow (for confirmation) boxes/trays are
                        available on ICT Station.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans13" id="tray-radio-check" type="radio" value="✔" name="tray-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tray-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans13" id="tray-radio-x" type="radio" value="X" name="tray-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tray-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans13" id="tray-radio-checkX" type="radio" value="X✔" name="tray-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tray-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✔</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans13" id="tray-radio-na" type="radio" value="NA" name="tray-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tray-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>











            <!-- PROGRAM SETTINGS SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question14" class="mb-2">Program Settings</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Check if the program is correct based on the model for process (Check
                        ICT
                        Program Matrix).
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Write Actual Program</h6>

                    <!-- Question Type || Radio -->
                    <div>
                        <input v-model="form.fieldAnswers.ans14" type="text" id="program-settings"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Type here actual program..." required>
                    </div>

                </div>

            </section>

            <!-- GOOD MASTER SAMPLE SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question" class="mb-2">GOOD Master Sample</h2>

                <!-- Question || 1st Result Good Master Section -->
                <div id="" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question15" class="mb-2">1st Result must be PASS.
                    </h5>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans15" id="1good-MS-radio-pass" type="radio" value="PASS" name="1good-MS-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="1good-MS-radio-pass"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pass
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans15" id="1good-MS-radio-fail" type="radio" value="FAIL" name="1good-MS-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="1good-MS-radio-fail"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fail
                                </label>
                            </div>
                        </li>

                    </ul>
                </div>

                <!-- Question || 2nd Result Good Master Section -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question16" class="mb-2">2nd Result must be PASS.
                    </h5>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans16" id="2good-MS-radio-pass" type="radio" value="PASS" name="2good-MS-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="2good-MS-radio-pass"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pass
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans16" id="2good-MS-radio-fail" type="radio" value="FAIL" name="2good-MS-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="2good-MS-radio-fail"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fail
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>

            </section>

            <!-- NO GOOD MASTER SAMPLE SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="" class="mb-2">NO GOOD Master Sample</h2>

                <!-- Question || 1st Result No Good Master Sample Section -->
                <div id="" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question17" class="mb-2">1st Result must be FAIL.</h5>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans17" id="nogood-MS-radio-pass" type="radio" value="PASS" name="nogood-MS-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="nogood-MS-radio-pass"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pass
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans17" id="1nogood-MS-radio-fail" type="radio" value="FAIL" name="nogood-MS-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="1nogood-MS-radio-fail"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fail
                                </label>
                            </div>
                        </li>

                    </ul>
                </div>

                <!-- Question || 2nd Result No Good Master Sample Section -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question18" class="mb-2">2nd Result must be FAIL.</h5>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans18" id="2nogood-MS-radio-pass" type="radio" value="PASS" name="2nogood-MS-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="2nogood-MS-radio-pass"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pass
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans18" id="2nogood-MS-radio-fail" type="radio" value="FAIL" name="2nogood-MS-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="2nogood-MS-radio-fail"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fail
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>

            </section>

            <!-- ICT GOOD/PASSED MARK SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question19" class="mb-2">ICT Good/Passed Mark</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Must be present. Must be black and firm.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Attach Sample of ICT Mark</h6>

                    <!-- !!!TEMPORARY!!! -->
                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans19" id="ICT-good-MS-radio-pass" type="radio" value="PASS" name="ICT-good-MS-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ICT-good-MS-radio-pass"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pass
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans19" id="ICT-good-MS-radio-fail" type="radio" value="FAIL" name="ICT-good-MS-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ICT-good-MS-radio-fail"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fail
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>

            </section>











            <!-- LOT DATE REFERENCE SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question20" class="mb-2">Lot Date Reference</h2>

                <!-- Question || Lot Date Reference -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Reference is correct and present in station.</h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans20" id="ldref-radio-check" type="radio" value="✔" name="ldref-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ldref-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans20" id="ldref-radio-x" type="radio" value="X" name="ldref-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ldref-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans20" id="ldref-radio-checkX" type="radio" value="X✔" name="ldref-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ldref-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✔</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="ldref-radio-na" type="radio" value="NA" name="ldref-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ldref-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>
            </section>

            <!-- ACTUAL LOT DATE STICKER SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question21" class="mb-2">Actual Lot Date Sticker</h2>

                <!-- Question || Main Breaker -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Actual lot date sticker is correct based on lot date reference.</h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Attach 1 Lot Date Sticker</h6>

                    <!-- Question Type || Radio -->


                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="text-center mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                        class="font-semibold">Click
                                        to upload</span> or drag and drop</p>
                                <p class="text-center text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX.
                                    800x400px)
                                </p>
                                <button id="camera-capture"
                                    class="mt-2 px-4 py-2 text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 rounded-md focus:outline-none focus:ring focus:ring-blue-300" disabled>
                                    Capture using Camera
                                </button>
                            </div>
                            <input id="dropzone-file" type="file" class="hidden" />
                            <input id="camera-input" type="file" accept="image/*" capture="camera" class="hidden" />
                        </label>
                    </div>


                </div>
            </section>

            <!-- LOT DATE STICKER BOX SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question22" class="mb-2">Lot Date Sticker Box</h2>

                <!-- Question || Lot Date Sticker Box -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Must be available. No unnecessary items inside the box.</h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans22" id="ldbox-radio-check" type="radio" value="✔" name="ldbox-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ldbox-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans22" id="ldbox-radio-x" type="radio" value="X" name="ldbox-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ldbox-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans22" id="ldbox-radio-checkX" type="radio" value="X✔" name="ldbox-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ldbox-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✔</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.an22" id="ldbox-radio-na" type="radio" value="NA" name="ldbox-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ldbox-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>
            </section>

            <!-- TWEEZERS SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question23" class="mb-2">Tweezers</h2>

                <!-- Question || Tweezers -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question" class="mb-2">Must be available and in good condition.</h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✔), Abnormality Found(x), Found & Fixed
                        Abnormalities(✔X), or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans23" id="tweezers-radio-check" type="radio" value="✔" name="tweezers-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tweezers-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans23" id="tweezers-radio-x" type="radio" value="X" name="tweezers-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tweezers-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✔ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans23" id="tweezers-radio-checkX" type="radio" value="X✔" name="tweezers-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tweezers-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✔</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans23" id="tweezers-radio-na" type="radio" value="NA" name="tweezers-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tweezers-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>
            </section>


            <!-- REMARKS SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="section-name" class="mb-2">Remarks</h2>
                <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question24">Remarks on the Model</h5>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Please type
                        possible problems regarding with the machine.</label>
                    <textarea v-model="form.fieldAnswers.ans24" id="message" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write here...">
                    </textarea>
                </div>
            </section>

            <section id="button-group" class="place-content-end mt-5 mb-5 align-right justify-right flex">
                <!-- Back Button -->
                <button type="button"
                    class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>

                <!-- Submit Button -->
                <button type="btnSubmit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    data-modal-toggle="submit-confirmation-modal">Submit
                </button>
            </section>
            </form>
        </div>
    </AppLayout>
</template>
