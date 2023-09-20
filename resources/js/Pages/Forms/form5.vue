<script setup>
        import AppLayout from '@/Layouts/AppLayout.vue';
        import { reactive, computed } from 'vue'
        import { router } from '@inertiajs/vue3'

        const props = defineProps({
            models: Array,
        });


        let form = reactive({
            // Form identifier
            form_id: 5,
            // Answers storage
            fieldAnswers: {
                ans1: null,
                ans2: null,
                ans3: null,
                ans4: null,ans5: null,ans6: null,ans7: null,ans8: null,ans9: null,ans10: null,ans11: null,ans12: null,ans13: null,ans14: null,ans15: null,ans16: null,ans17: null,ans18: null,ans19: null,ans20: null,ans21: null,ans22: null,ans23: null,ans24: null,ans25: null,ans26: null,ans27: null,ans28: null,ans29: null,ans30: null,
                ans31: null,
            }
        });

        function submit() {
            // Show confirmation modal
            Swal.fire({
                title: 'Submit response?',
                text: `You are about to submit your response. This action cannot be undone.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {

                // If user selects confirm button
                if (result.isConfirmed) {
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
                    router.post('/submit', form);

                    // Show success prompt
                    Swal.fire(
                        'Success!',
                        `Your response has been submitted.`,
                        'success'
                    );
                }
            });
        }
        const filteredModels = computed(() => {
            return props.models.filter((model) => model.form_id === form.form_id);
          });
        </script>

        <style scoped>
            .required::after {
                content: " *";
                color: red;
                font-size: 1em;
            }
        </style>

        <template>
            <AppLayout title="FFC" control_no="Control No.: QR-BIPH-103003ER0">
                <div class="5s lg:mx-[25%]">
                    <form @submit.prevent="submit()" method="post" id="1">

                        <!-- Hidden CSRF Token -->
                        <input type="hidden" name="_token" :value="csrf">

                        <!-- MODEL IDENTIFICATION -->
                        <section
                    id="form-section"
                    class="p-10 mt-5 mb-5 border-2 rounded-lg"
                >
                    <h2 id="section-name" class="mb-2">Model Identification</h2>

                    <div
                        id="model-identification"
                        class="grid grid-cols-1"
                    >
                        <!-- Model Name -->
                        <div
                            id="question"
                            class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                        >
                            <h5 id="question1">Model Name</h5>
                            <label
                                for="models"
                                class="required block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >
                                Select a model
                            </label>

                            <select
                            id="models"
                            v-model="form.fieldAnswers.ans1"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required
                        >
                            <option
                                v-for="model in filteredModels"
                                :value="model.model_name"
                                :key="model.id"
                            >
                                {{ model.model_name }}
                            </option>
                        </select>
                        </div>
                        </div>

                        <!-- Lot Number -->
                        <div id="model-identification" class="grid lg:grid-cols-2 lg:gap-3">
                            <div
                                id="question"
                                class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                            >
                                <h5 id="question2" class="required">Lot Number</h5>
                                <div class="">
                                    <label
                                        for="models"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        required
                                    >
                                        Input the Lot Number
                                    </label>
                                    <input
                                        v-model="form.fieldAnswers.ans2"
                                        type="text"
                                        id="ltnum" placeholder="Ex. 5/46"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required
                                    />
                                </div>
                            </div>
                            <div
                                id="question"
                                class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                            >
                                <h5 id="question3" class="required">Kit Number</h5>
                                <div class="">
                                    <label
                                        for="models"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                        required
                                    >
                                        Input the Kit Number
                                    </label>
                                    <input
                                        v-model="form.fieldAnswers.ans3"
                                        type="text"
                                        id="ltnum" placeholder="Ex. 36132-001"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required
                                    />
                                </div>
                            </div>
                    </div>

                </section>

        <section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">FFC</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question4" class="required">CN2 for LEK828001 (LK7470001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-1" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-1"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-2" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-2"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-3" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-3"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question5" class="required">CN2 for LEW508001 (LT3810001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans5" id="production-checksheet-radio-4" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-4"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans5" id="production-checksheet-radio-5" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-5"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans5" id="production-checksheet-radio-6" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-6"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question6" class="required">CN3 for LET665001 (LT3507001) no EMI Shielding tape</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans6" id="production-checksheet-radio-7" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion3"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-7"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans6" id="production-checksheet-radio-8" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion3"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-8"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans6" id="production-checksheet-radio-9" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion3"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-9"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question7" class="required">CN3 for LET665002 (LT3507001) with EMI Sheilding tape</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans7" id="production-checksheet-radio-10" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion4"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-10"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans7" id="production-checksheet-radio-11" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion4"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-11"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans7" id="production-checksheet-radio-12" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion4"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-12"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question8" class="required">CN1for D00CNJ001 (D009G7001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans8" id="production-checksheet-radio-13" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion5"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-13"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans8" id="production-checksheet-radio-14" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion5"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-14"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans8" id="production-checksheet-radio-15" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion5"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-15"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question9" class="required">CN2 for D00CNJ001 (D009G8001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans9" id="production-checksheet-radio-16" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion6"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-16"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans9" id="production-checksheet-radio-17" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion6"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-17"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans9" id="production-checksheet-radio-18" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion6"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-18"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question10" class="required">CN1 for D00AXM001 (D00CRF001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans10" id="production-checksheet-radio-19" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion7"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-19"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans10" id="production-checksheet-radio-20" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion7"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-20"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans10" id="production-checksheet-radio-21" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion7"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-21"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question11" class="required">CN2 for D00AXM001 (D00CRG001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans11" id="production-checksheet-radio-22" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion8"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-22"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans11" id="production-checksheet-radio-23" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion8"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-23"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans11" id="production-checksheet-radio-24" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion8"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-24"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question12" class="required">CN1 for D017C7003 (D0178G001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans12" id="production-checksheet-radio-25" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion9"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-25"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans12" id="production-checksheet-radio-26" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion9"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-26"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans12" id="production-checksheet-radio-27" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion9"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-27"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question13" class="required">CN2 for D017C7003 (D0178H001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans13" id="production-checksheet-radio-28" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion10"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-28"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans13" id="production-checksheet-radio-29" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion10"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-29"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans13" id="production-checksheet-radio-30" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion10"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-30"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question14" class="required">CN1 for D00AXM002 (D009KA001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans14" id="production-checksheet-radio-31" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion11"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-31"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans14" id="production-checksheet-radio-32" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion11"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-32"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans14" id="production-checksheet-radio-33" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion11"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-33"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question15" class="required">CN2 for D00AXM002 (D009KB001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans15" id="production-checksheet-radio-34" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion12"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-34"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans15" id="production-checksheet-radio-35" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion12"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-35"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans15" id="production-checksheet-radio-36" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion12"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-36"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question16" class="required">CN1 for D00SHL001 M17 (D004WN001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans16" id="production-checksheet-radio-37" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion13"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-37"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans16" id="production-checksheet-radio-38" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion13"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-38"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans16" id="production-checksheet-radio-39" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion13"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-39"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question17" class="required">CN3 for D00SHL001 M17 (D004WP001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans17" id="production-checksheet-radio-40" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion14"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-40"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans17" id="production-checksheet-radio-41" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion14"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-41"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans17" id="production-checksheet-radio-42" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion14"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-42"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question18" class="required">CN1 for D0031R001 B17 (D005HS001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans18" id="production-checksheet-radio-43" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion15"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-43"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans18" id="production-checksheet-radio-44" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion15"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-44"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans18" id="production-checksheet-radio-45" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion15"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-45"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question19" class="required">CN3 for D0031R001 B17 (D005HT001)</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans19" id="production-checksheet-radio-46" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion16"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-46"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans19" id="production-checksheet-radio-47" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion16"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-47"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans19" id="production-checksheet-radio-48" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion16"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-48"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question20" class="required">Actual reference VS Issued material</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Correct Part Number of FFC has been issued to the line.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans20" id="production-checksheet-radio-49" type="radio"
                                                value="✔" name="production-checksheet-radio-FFCquestion17"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-49"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans20" id="production-checksheet-radio-50" type="radio"
                                                value="✘" name="production-checksheet-radio-FFCquestion17"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-50"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans20" id="production-checksheet-radio-51" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFCquestion17"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-51"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Microscope</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question21" class="required">Set to 0.8 to 1 *10  magnification</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Write the actual value
                        </label>
                    
                                <div class="">
                                    <input v-model="form.fieldAnswers.ans21" type="text" id="ltnum"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                            </div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Jig</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question22" class="required">Designated jig is used with jig qualification reference.</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans22" id="production-checksheet-radio-52" type="radio"
                                                value="✔" name="production-checksheet-radio-Jigquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-52"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans22" id="production-checksheet-radio-53" type="radio"
                                                value="✘" name="production-checksheet-radio-Jigquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-53"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans22" id="production-checksheet-radio-54" type="radio"
                                                value="✔✘" name="production-checksheet-radio-Jigquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-54"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">FFC to PCB</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question23" class="required">CN2 for LEK828001</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            "The edge of FFC Cable (CN2) doesn't stick out from guide silk. "
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans23" id="production-checksheet-radio-55" type="radio"
                                                value="✔" name="production-checksheet-radio-FFC to PCBquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-55"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans23" id="production-checksheet-radio-56" type="radio"
                                                value="✘" name="production-checksheet-radio-FFC to PCBquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-56"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans23" id="production-checksheet-radio-57" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFC to PCBquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-57"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question24" class="required">CN2 for LEW508001</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            "The edge of FFC Cable (CN2) doesn't stick out from guide silk. "
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans24" id="production-checksheet-radio-58" type="radio"
                                                value="✔" name="production-checksheet-radio-FFC to PCBquestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-58"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans24" id="production-checksheet-radio-59" type="radio"
                                                value="✘" name="production-checksheet-radio-FFC to PCBquestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-59"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans24" id="production-checksheet-radio-60" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFC to PCBquestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-60"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question25" class="required">CN3 for LET665001/2</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            "The edge of FFC Cable (CN2) doesn't stick out from guide silk. "
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans25" id="production-checksheet-radio-61" type="radio"
                                                value="✔" name="production-checksheet-radio-FFC to PCBquestion3"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-61"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans25" id="production-checksheet-radio-62" type="radio"
                                                value="✘" name="production-checksheet-radio-FFC to PCBquestion3"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-62"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans25" id="production-checksheet-radio-63" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFC to PCBquestion3"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-63"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question26" class="required">CN1 for D00CNJ001</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            "The edge of FFC Cable (CN2) doesn't stick out from guide silk. "
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans26" id="production-checksheet-radio-64" type="radio"
                                                value="✔" name="production-checksheet-radio-FFC to PCBquestion4"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-64"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans26" id="production-checksheet-radio-65" type="radio"
                                                value="✘" name="production-checksheet-radio-FFC to PCBquestion4"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-65"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans26" id="production-checksheet-radio-66" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFC to PCBquestion4"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-66"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question27" class="required">CN1 for D00AXM001/2</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            "The edge of FFC Cable (CN2) doesn't stick out from guide silk. "
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans27" id="production-checksheet-radio-67" type="radio"
                                                value="✔" name="production-checksheet-radio-FFC to PCBquestion5"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-67"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans27" id="production-checksheet-radio-68" type="radio"
                                                value="✘" name="production-checksheet-radio-FFC to PCBquestion5"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-68"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans27" id="production-checksheet-radio-69" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFC to PCBquestion5"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-69"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question28" class="required">CN3 for D00SHL001 M17</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            "The edge of FFC Cable (CN2) doesn't stick out from guide silk. "
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans28" id="production-checksheet-radio-70" type="radio"
                                                value="✔" name="production-checksheet-radio-FFC to PCBquestion6"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-70"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans28" id="production-checksheet-radio-71" type="radio"
                                                value="✘" name="production-checksheet-radio-FFC to PCBquestion6"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-71"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans28" id="production-checksheet-radio-72" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFC to PCBquestion6"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-72"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question29" class="required">CN3 for D0031R001 B17</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            "The edge of FFC Cable (CN2) doesn't stick out from guide silk. "
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans29" id="production-checksheet-radio-73" type="radio"
                                                value="✔" name="production-checksheet-radio-FFC to PCBquestion7"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-73"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans29" id="production-checksheet-radio-74" type="radio"
                                                value="✘" name="production-checksheet-radio-FFC to PCBquestion7"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-74"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans29" id="production-checksheet-radio-75" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFC to PCBquestion7"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-75"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question30" class="required">CN2 for D017C7003</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            "The edge of FFC Cable (CN2) doesn't stick out from guide silk. "
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans30" id="production-checksheet-radio-76" type="radio"
                                                value="✔" name="production-checksheet-radio-FFC to PCBquestion8"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-76"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans30" id="production-checksheet-radio-77" type="radio"
                                                value="✘" name="production-checksheet-radio-FFC to PCBquestion8"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-77"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans30" id="production-checksheet-radio-78" type="radio"
                                                value="✔✘" name="production-checksheet-radio-FFC to PCBquestion8"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-78"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section>
                <!-- REMARKS -->
                <section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
                    <h2 class="mb-2">Remarks</h2>
                    <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                        <h5 id="question31">Remarks on the Model</h5>
                        <label for="message" class="block mb-2 text-sm font-medium dark:text-white">Please
                                    type
                                    possible problems regarding with the machine.</label>
                        <textarea v-model="form.fieldAnswers.ans31" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write here...">
                        </textarea>
                    </div>
                </section>
        
                            <section id="button-group"
                                class="place-content-end mt-5 mb-5 align-right justify-center lg:justify-end flex">
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
        