<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import { reactive } from 'vue'
    import { router } from '@inertiajs/vue3'

    const props = defineProps({
        models: Array,
    });


    let form = reactive({
        // Form identifier
        form_id : 2,
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
    <AppLayout title="P-Touch Soldering Iron Start-Up">
        <div class="ptouch-solder">
            <form @submit.prevent="submit()" method="post" id="1">
                
                <!-- Hidden CSRF Token -->
                <input type="hidden" name="_token" :value="csrf">
            <!-- MODEL IDENTIFICATION SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <!-- Section || Section Name -->
                <h2 id="question" class="mb-2">Model Identification</h2>

                <!-- Question || Model Name -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
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

                <!-- Question || Lot Number -->
                <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                        <h5 id="question2">Lot Number</h5>
                        <div class="">
                            <label for="models" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Input the
                                Lot Number</label>
                            <input v-model="form.fieldAnswers.ans2" type="text" id="ltnum"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    </div>

                <!-- Question || Type of Checking -->
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
                                <input v-model="form.fieldAnswers.ans3" id="horizontal-list-radio-changemodel" type="radio" value="Change Model"
                                    name="type-of-checking-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="horizontal-list-radio-changemodel"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Change Model</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans3" id="horizontal-list-radio-powerfailure" type="radio" value="Power Failure"
                                    name="type-of-checking-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="horizontal-list-radio-powerfailure"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Power Failure</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans3" id="horizontal-list-radio-changetip" type="radio" value="Change Tip"
                                    name="type-of-checking-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="horizontal-list-radio-changetip"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Change
                                    Tip</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- SOLDERING IRON SET SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question4" class="mb-2">Soldering Iron Set</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Machine is working and the light is ON. LCD is working after turning ON
                        the machine.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x), Abnormality Found(✓X), Load or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans4" id="sir-radio-check" type="radio" value="✔" name="sir-radio"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sir-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✓
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans4" id="sir-radio-x" type="radio" value="X" name="sir-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sir-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans4" id="sir-radio-checkX" type="radio" value="✔X" name="sir-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sir-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✓</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || Load -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans4" id="sir-radio-load" type="radio" value="LOAD" name="sir-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sir-radio-load"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Load</label>
                            </div>
                        </li>

                        <!-- Radio Option 5 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans4" id="sir-radio-na" type="radio" value="na" name="sir-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sir-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>


                    </ul>
                </div>

            </section>

            <!-- SOLDERING MACHINE CONDITION SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question5" class="mb-2">Soldering Machine Condition</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Switch must be in correct place. LCD is shown "LOAD".
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x), Abnormality Found(✓X), Load or
                        No Answer (NA)</h6>
                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans5" id="smc-radio-check" type="radio" value="✔" name="smc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="smc-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✓
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans5" id="smc-radio-x" type="radio" value="X" name="smc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="smc-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans5" id="smc-radio-checkX" type="radio" value="✔X" name="smc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="smc-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✓</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || Load -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans5" id="smc-radio-load" type="radio" value="LOAD" name="smc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="smc-radio-load"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Load</label>
                            </div>
                        </li>

                        <!-- Radio Option 5 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans5" id="smc-radio-na" type="radio" value="na" name="smc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="smc-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- SOLDER WIRE SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question6" class="mb-2">Solder Wire</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Solder wire diameter is 0.80mm. Solder wire amount can be assume to be
                        anough for the daily plan.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x), Abnormality Found(✓X), Load or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans6" id="sw-radio-check" type="radio" value="✔" name="sw-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sw-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✓
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans6" id="sw-radio-x" type="radio" value="X" name="sw-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sw-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans6" id="sw-radio-checkX" type="radio" value="✔X" name="sw-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sw-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✓</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || Load -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans6" id="sw-radio-load" type="radio" value="LOAD" name="sw-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sw-radio-load"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Load</label>
                            </div>
                        </li>

                        <!-- Radio Option 5 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans6" id="sw-radio-na" type="radio" value="na" name="sw-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sw-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- SOLDER WIRE EXPIRATION DATE SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question7" class="mb-2">Solder Wire Expiration Date</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Expiration Date Label is attached on the solder wire spool or holder. Not
                        beyond the declared expiration date.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x), Abnormality Found(✓X), Load or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans7" id="swed-radio-check" type="radio" value="✔" name="swed-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="swed-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✓
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans7" id="swed-radio-x" type="radio" value="X" name="swed-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="swed-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans7" id="swed-radio-checkX" type="radio" value="✔X" name="swed-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="swed-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✓</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || Load -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans7" id="swed-radio-load" type="radio" value="LOAD" name="swed-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="swed-radio-load"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Load</label>
                            </div>
                        </li>

                        <!-- Radio Option 5 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans7" id="swed-radio-na" type="radio" value="na" name="swed-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="swed-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- SOLDER TIP TYPE SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question8" class="mb-2">Solder Tip Type</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Write actual tip type.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are High Temp Knife Tip(KH), Low Temp Knife Tip(KL),
                        C-Type Tip (C) or No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || KH -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans8" id="stt-radio-check" type="radio" value="KH" name="stt-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="stt-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">KH
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || KL -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans8" id="stt-radio-x" type="radio" value="kl" name="stt-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="stt-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">KL
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || C -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans8" id="stt-radio-checkX" type="radio" value="c" name="stt-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="stt-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">C</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans8" id="stt-radio-na" type="radio" value="na" name="stt-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="stt-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- SOLDER TIP CONDITION SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question9" class="mb-2">Solder Tip Condition</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Have no damage or deformation.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x), Abnormality Found(✓X), Load or
                        No Answer (NA)</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans9" id="stc-radio-check" type="radio" value="✔" name="stc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="stc-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✓
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans9" id="stc-radio-x" type="radio" value="X" name="stc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="stc-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans9" id="stc-radio-checkX" type="radio" value="✔X" name="stc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="stc-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✓</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || Load -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans9" id="stc-radio-load" type="radio" value="LOAD" name="stc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="stc-radio-load"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Load</label>
                            </div>
                        </li>

                        <!-- Radio Option 5 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans9" id="stc-radio-na" type="radio" value="na" name="stc-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="stc-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- SOLDER TIP TEMPERATURE SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question10" class="mb-2">Solder Tip Temperature</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Measure the actual solder tip temperature using Hakko Thermometer with
                        melted lead. Temperature is within the specific range of 350-398℃.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Method is the actual value in Celsius</h6>

                    <!-- Question Type || Text Input -->
                    <div>
                        <input v-model="form.fieldAnswers.ans10" type="text" id="sttemp"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Actual Value in Celsius" required>
                    </div>
                </div>

            </section>

            <!-- RESISTANCE VALUE SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question11" class="mb-2">Resistance Value</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Measure the tip-to-ground resistance using the Hakko Thermometer.
                        <span
                            class="font-bold underline underline-offset-3 decoration-3 decoration-blue-400 dark:decoration-blue-600">Required
                            Value:</span> Maximum of 40
                        <span
                            class="font-bold underline underline-offset-3 decoration-3 decoration-blue-400 dark:decoration-blue-600">Frequency</span>
                        once a week
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x) or NA</h6>

                    <!-- Question Type || Text Input -->
                    <div>
                        <input v-model="form.fieldAnswers.ans11" type="text" id="rvalue"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Actual Value in Celsius" required>
                    </div>

                </div>

            </section>

            <!-- LEAK VOLTAGE VALUE SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question12" class="mb-2">Leak Voltage Value</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Measure the leak voltage using the Hakko Thermometer.
                        <span
                            class="font-bold underline underline-offset-3 decoration-3 decoration-blue-400 dark:decoration-blue-600">Required
                            Value:</span> Maximum of 2mV
                        <span
                            class="font-bold underline underline-offset-3 decoration-3 decoration-blue-400 dark:decoration-blue-600">Frequency:</span>
                        Once
                        a week.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x) or NA</h6>

                    <!-- Question Type || Text Input -->
                    <div>
                        <input v-model="form.fieldAnswers.ans12" type="text" id="rvalue"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Actual Value in Celsius" required>
                    </div>

                </div>

            </section>

            <!-- SPONGE / SPONGE BIN SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question13" class="mb-2">Sponge / Sponge Bin</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Sponge bin must be clea. Sponge is demped with water.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x) or NA</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans13" id="sponge-radio-check" type="radio" value="✔" name="sponge-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sponge-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✓
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans13" id="sponge-radio-x" type="radio" value="x" name="sponge-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sponge-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans13" id="sponge-radio-checkX" type="radio" value="✔X" name="sponge-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sponge-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✓</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || Load -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans13" id="sponge-radio-load" type="radio" value="LOAD" name="sponge-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sponge-radio-load"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Load</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- SOLDERING JIG ID NO. SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question14" class="mb-2">Soldering Jig ID Number</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Write soldering ID no.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x) or NA</h6>

                    <!-- Question Type || Radio -->
                    <div>
                        <input v-model="form.fieldAnswers.ans14" type="text" id="sjid"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Actual Value in Celsius" required>
                    </div>

                </div>

            </section>

            <!-- SOLDERING JIG APPEARANCE SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question15" class="mb-2">Soldering Jig Appearance</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Soldering jig is clean and free from solder lead stains and flux. Use
                        IPA, brush or savina to clean it.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x) or NA</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans15" id="sja-radio-check" type="radio" value="✔" name="sja-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sja-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✓
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans15" id="sja-radio-x" type="radio" value="x" name="sja-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sja-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans15" id="sja-radio-checkX" type="radio" value="✔X" name="sja-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sja-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✓</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || Load -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans15" id="sja-radio-load" type="radio" value="LOAD" name="sja-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sja-radio-load"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Load</label>
                            </div>
                        </li>

                        <!-- Radio Option 5 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans15" id="sja-radio-na" type="radio" value="na" name="sja-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="sja-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>


                    </ul>

                </div>

            </section>

            <!-- COMPONENT'S REFERENCE ON SOLDERING JIG SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question16" class="mb-2">Component's Reference on Soldering Jig (if Applicable)</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Component's reference must be correct and complete.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x) or NA</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans16" id="crsj-radio-check" type="radio" value="✔" name="crsj-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="crsj-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✓
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans16" id="crsj-radio-x" type="radio" value="X" name="crsj-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="crsj-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans16" id="crsj-radio-checkX" type="radio" value="✔X" name="crsj-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="crsj-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✓</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || Load -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans16" id="crsj-radio-load" type="radio" value="LOAD" name="crsj-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="crsj-radio-load"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Load</label>
                            </div>
                        </li>

                        <!-- Radio Option 5 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans16" id="crsj-radio-na" type="radio" value="na" name="crsj-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="crsj-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>


                    </ul>
                </div>

            </section>

            <!-- BAMBOO STICK SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question17" class="mb-2">Bamboo Stick</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Applicable for Harness Soldering on Main PCB Available and must be in
                        good condition.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x) or NA</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans17" id="bs-radio-check" type="radio" value="✔" name="bs-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="bs-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✓
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans17" id="bs-radio-x" type="radio" value="X" name="bs-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="bs-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans17" id="bs-radio-checkX" type="radio" value="✔X" name="bs-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="bs-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✓</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || Load -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans17" id="bs-radio-load" type="radio" value="LOAD" name="bs-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="bs-radio-load"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Load</label>
                            </div>
                        </li>

                        <!-- Radio Option 5 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans17" id="bs-radio-na" type="radio" value="na" name="bs-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="bs-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- EXHAUST SYSTEM SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question18" class="mb-2">Exhaust System</h2>

                <!-- Question || Soldering Iron Set -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question" class="mb-2">Available in the station and is properly working.
                    </h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x) or NA</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans18" id="es-radio-check" type="radio" value="✔" name="es-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="es-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✓
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans18" id="es-radio-x" type="radio" value="X" name="es-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="es-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans18" id="es-radio-checkX" type="radio" value="✔X" name="es-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="es-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✓</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || Load -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans18" id="es-radio-load" type="radio" value="LOAD" name="es-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="es-radio-load"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Load</label>
                            </div>
                        </li>

                        <!-- Radio Option 5 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans18" id="es-radio-na" type="radio" value="na" name="es-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="es-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>

                    </ul>
                </div>

            </section>

            <!-- BARCODE PART NO. (FOR D460 AND D610 MAIN ONLY) SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg gap-10">
                <h2 id="question" class="mb-2">Barcode Part No. (For D460 and D610 Main Only)</h2>

                <!-- Question || D02484-D01 (D460 MAIN) -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question19" class="mb-2">D02484-D01 (D460 MAIN)</h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x) or NA</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans19" id="D460-radio-check" type="radio" value="✔" name="D460-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="D460-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✓
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans19" id="D460-radio-x" type="radio" value="X" name="D460-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="D460-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans19" id="D460-radio-checkX" type="radio" value="✔X" name="D460-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="D460-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✓</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || Load -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans19" id="D460-radio-load" type="radio" value="LOAD" name="D460-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="D460-radio-load"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Load</label>
                            </div>
                        </li>

                        <!-- Radio Option 5 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans19" id="D460-radio-na" type="radio" value="na" name="D460-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="D460-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>


                    </ul>
                </div>

                <!-- Question || D027CR-001 (D610 MAIN) -->
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5 id="question20" class="mb-2">D027CR-001 (D610 MAIN)</h5>

                    <!-- Instruction || Soldering Iron Set -->
                    <h6 id="instruction" class="mb-2">Writing Methods are Check(✓), Wrong(x) or NA</h6>

                    <!-- Question Type || Radio -->
                    <ul id="question-type-radio"
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <!-- Radio Option 1 || ✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans20" id="D610-radio-check" type="radio" value="✔" name="D610-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="D610-radio-check"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✓
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 2 || X -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans20" id="D610-radio-x" type="radio" value="X" name="D610-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="D610-radio-x"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X
                                </label>
                            </div>
                        </li>

                        <!-- Radio Option 3 || X✓ -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans20" id="D610-radio-checkX" type="radio" value="✔X" name="D610-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="D610-radio-checkX"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">X✓</label>
                            </div>
                        </li>

                        <!-- Radio Option 4 || Load -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans20" id="D610-radio-load" type="radio" value="LOAD" name="D610-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="D610-radio-load"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Load</label>
                            </div>
                        </li>

                        <!-- Radio Option 5 || NA -->
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input v-model="form.fieldAnswers.ans20" id="D610-radio-na" type="radio" value="na" name="D610-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="D610-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>


                    </ul>
                </div>

            </section>

            <!-- REMARKS SECTION -->
            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 id="question" class="mb-2">Remarks</h2>
                <div class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5 id="question21">Remarks on the Model</h5>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Please type
                        possible problems regarding with the machine.</label>
                    <textarea v-model="form.fieldAnswers.ans21" id="message" rows="4"
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
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >Submit
                </button>
            </section>
            </form>
        </div>
    </AppLayout>
</template>

