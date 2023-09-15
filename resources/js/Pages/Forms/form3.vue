<script setup>
        import AppLayout from '@/Layouts/AppLayout.vue';
        import { reactive, computed } from 'vue'
        import { router } from '@inertiajs/vue3'

        const props = defineProps({
            models: Array,
        });


        let form = reactive({
            // Form identifier
            form_id: 3,
            // Answers storage
            fieldAnswers: {
                ans1: null,
                ans2: null,
                ans3: null,
                ans4: null,ans5: null,ans6: null,ans7: null,ans8: null,ans9: null,ans10: null,ans11: null,ans12: null,ans13: null,ans14: null,ans15: null,ans16: null,ans17: null,ans18: null,ans19: null,ans20: null,ans21: null,ans22: null,ans23: null,
                ans24: null,
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
                    router.post('/submit', form)

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
            <AppLayout title="P-Touch ICT Start-Up Check Sheet" control_no="Control No.: QR-BIPH-103027FR1">
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

        <section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Type of Checking</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question4" class="required">Type of Check</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-1" type="radio"
                                                value="Start-Up" name="production-checksheet-radio-Type of Checkingquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-1"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Start-Up
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-2" type="radio"
                                                value="Change Model" name="production-checksheet-radio-Type of Checkingquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-2"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Change Model
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-3" type="radio"
                                                value="Power Failure" name="production-checksheet-radio-Type of Checkingquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-3"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Power Failure
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Main Breaker</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question5" class="required">Check if ON.</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans5" id="production-checksheet-radio-4" type="radio"
                                                value="✔" name="production-checksheet-radio-Main Breakerquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-4"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans5" id="production-checksheet-radio-5" type="radio"
                                                value="✘" name="production-checksheet-radio-Main Breakerquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-5"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans5" id="production-checksheet-radio-6" type="radio"
                                                value="✔✘" name="production-checksheet-radio-Main Breakerquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-6"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Power Switch</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question6" class="required">Functional if Light Indicator lights on when the switch is turned on</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans6" id="production-checksheet-radio-7" type="radio"
                                                value="✔" name="production-checksheet-radio-Power Switchquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-7"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans6" id="production-checksheet-radio-8" type="radio"
                                                value="✘" name="production-checksheet-radio-Power Switchquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-8"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans6" id="production-checksheet-radio-9" type="radio"
                                                value="✔✘" name="production-checksheet-radio-Power Switchquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-9"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Standard Pressure</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question7" class="required">Check the actual Value on the pressure gauge</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            (0.40 - 0.60 Mpa)
                        </label>
                    
                                <div class="">
                                    <input v-model="form.fieldAnswers.ans7" type="text" id="ltnum"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                            </div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">CPU</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question8" class="required">Check if ON.</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans8" id="production-checksheet-radio-10" type="radio"
                                                value="✔" name="production-checksheet-radio-CPUquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-10"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans8" id="production-checksheet-radio-11" type="radio"
                                                value="✘" name="production-checksheet-radio-CPUquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-11"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans8" id="production-checksheet-radio-12" type="radio"
                                                value="✔✘" name="production-checksheet-radio-CPUquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-12"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Monitor</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question9" class="required">Activates when CPU is on.</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans9" id="production-checksheet-radio-13" type="radio"
                                                value="✔" name="production-checksheet-radio-Monitorquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-13"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans9" id="production-checksheet-radio-14" type="radio"
                                                value="✘" name="production-checksheet-radio-Monitorquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-14"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans9" id="production-checksheet-radio-15" type="radio"
                                                value="✔✘" name="production-checksheet-radio-Monitorquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-15"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Operation Buttons</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question10" class="required">Check if functional.</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans10" id="production-checksheet-radio-16" type="radio"
                                                value="✔" name="production-checksheet-radio-Operation Buttonsquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-16"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans10" id="production-checksheet-radio-17" type="radio"
                                                value="✘" name="production-checksheet-radio-Operation Buttonsquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-17"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans10" id="production-checksheet-radio-18" type="radio"
                                                value="✔✘" name="production-checksheet-radio-Operation Buttonsquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-18"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Pneumatic</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question11" class="required">Functional when 2 green buttons are pressed.</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans11" id="production-checksheet-radio-19" type="radio"
                                                value="✔" name="production-checksheet-radio-Pneumaticquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-19"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans11" id="production-checksheet-radio-20" type="radio"
                                                value="✘" name="production-checksheet-radio-Pneumaticquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-20"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans11" id="production-checksheet-radio-21" type="radio"
                                                value="✔✘" name="production-checksheet-radio-Pneumaticquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-21"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Presence Pins</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question12" class="required">Check if the presence pin/s is/are available.</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Press each presence pins (3x) to check if it is still in good condition (NOT STUCK). (if applicable)
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans12" id="production-checksheet-radio-22" type="radio"
                                                value="✔" name="production-checksheet-radio-Presence Pinsquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-22"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans12" id="production-checksheet-radio-23" type="radio"
                                                value="✘" name="production-checksheet-radio-Presence Pinsquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-23"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans12" id="production-checksheet-radio-24" type="radio"
                                                value="✔✘" name="production-checksheet-radio-Presence Pinsquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-24"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Tray for NG and for confirmation units</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question13" class="required">Check if the red (NG) and yellow (for confirmation) boxes/trays are available on ICT station.</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans13" id="production-checksheet-radio-25" type="radio"
                                                value="✔" name="production-checksheet-radio-Tray for NG and for confirmation unitsquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-25"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans13" id="production-checksheet-radio-26" type="radio"
                                                value="✘" name="production-checksheet-radio-Tray for NG and for confirmation unitsquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-26"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans13" id="production-checksheet-radio-27" type="radio"
                                                value="✔✘" name="production-checksheet-radio-Tray for NG and for confirmation unitsquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-27"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Program Settings</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question14" class="required">Check if the program is correct based on the model</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                                <div class="">
                                    <input v-model="form.fieldAnswers.ans14" type="text" id="ltnum"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                            </div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">GOOD Master Sample</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question15" class="required">(1st) Result must be "PASS"</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans15" id="production-checksheet-radio-28" type="radio"
                                                value="Pass" name="production-checksheet-radio-GOOD Master Samplequestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-28"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pass
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans15" id="production-checksheet-radio-29" type="radio"
                                                value="Fail" name="production-checksheet-radio-GOOD Master Samplequestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-29"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fail
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question16" class="required">(2nd) Result must be "PASS"</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans16" id="production-checksheet-radio-30" type="radio"
                                                value="Pass" name="production-checksheet-radio-GOOD Master Samplequestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-30"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pass
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans16" id="production-checksheet-radio-31" type="radio"
                                                value="Fail" name="production-checksheet-radio-GOOD Master Samplequestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-31"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fail
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">NO GOOD Master Sample</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question17" class="required">(1st) Result must be "FAIL"</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans17" id="production-checksheet-radio-32" type="radio"
                                                value="Pass" name="production-checksheet-radio-NO GOOD Master Samplequestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-32"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pass
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans17" id="production-checksheet-radio-33" type="radio"
                                                value="Fail" name="production-checksheet-radio-NO GOOD Master Samplequestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-33"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fail
                                            </label>
                                        </div>
                                    </li>
                                </ul></div>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question18" class="required">(2nd) Result must be "FAIL"</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans18" id="production-checksheet-radio-34" type="radio"
                                                value="Pass" name="production-checksheet-radio-NO GOOD Master Samplequestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-34"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pass
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans18" id="production-checksheet-radio-35" type="radio"
                                                value="Fail" name="production-checksheet-radio-NO GOOD Master Samplequestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-35"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fail
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">ICT Good/Passed Mark</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question19" class="required">Must be present.</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Must be black and firm.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans19" id="production-checksheet-radio-36" type="radio"
                                                value="Pass" name="production-checksheet-radio-ICT Good/Passed Markquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-36"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Pass
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans19" id="production-checksheet-radio-37" type="radio"
                                                value="Fail" name="production-checksheet-radio-ICT Good/Passed Markquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-37"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Fail
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Lot Date Reference</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question20" class="required">Reference is correct and present in station.</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans20" id="production-checksheet-radio-38" type="radio"
                                                value="✔" name="production-checksheet-radio-Lot Date Referencequestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-38"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans20" id="production-checksheet-radio-39" type="radio"
                                                value="✘" name="production-checksheet-radio-Lot Date Referencequestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-39"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans20" id="production-checksheet-radio-40" type="radio"
                                                value="✔✘" name="production-checksheet-radio-Lot Date Referencequestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-40"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans20" id="production-checksheet-radio-41" type="radio"
                                                value="N/A" name="production-checksheet-radio-Lot Date Referencequestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-41"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">N/A
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Actual Lot Date Sticker</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question21" class="required">Actual lot date sticker is correct based on lot date reference.</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans21" id="production-checksheet-radio-42" type="radio"
                                                value="✔" name="production-checksheet-radio-Actual Lot Date Stickerquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-42"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans21" id="production-checksheet-radio-43" type="radio"
                                                value="✘" name="production-checksheet-radio-Actual Lot Date Stickerquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-43"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans21" id="production-checksheet-radio-44" type="radio"
                                                value="✔✘" name="production-checksheet-radio-Actual Lot Date Stickerquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-44"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans21" id="production-checksheet-radio-45" type="radio"
                                                value="N/A" name="production-checksheet-radio-Actual Lot Date Stickerquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-45"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">N/A
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Lot Date Sticker Box</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question22" class="required">Must be available.</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            No unnecessary items inside the box.
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans22" id="production-checksheet-radio-46" type="radio"
                                                value="✔" name="production-checksheet-radio-Lot Date Sticker Boxquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-46"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans22" id="production-checksheet-radio-47" type="radio"
                                                value="✘" name="production-checksheet-radio-Lot Date Sticker Boxquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-47"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans22" id="production-checksheet-radio-48" type="radio"
                                                value="✔✘" name="production-checksheet-radio-Lot Date Sticker Boxquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-48"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans22" id="production-checksheet-radio-49" type="radio"
                                                value="N/A" name="production-checksheet-radio-Lot Date Sticker Boxquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-49"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">N/A
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section><section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg"><h2 id="section-name" class="mb-2">Tweezers</h2>
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    
                            <h5 id="question23" class="required">Must be available and in good condition</h5>
                        
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans23" id="production-checksheet-radio-50" type="radio"
                                                value="✔" name="production-checksheet-radio-Tweezersquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-50"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans23" id="production-checksheet-radio-51" type="radio"
                                                value="✘" name="production-checksheet-radio-Tweezersquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-51"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans23" id="production-checksheet-radio-52" type="radio"
                                                value="✔✘" name="production-checksheet-radio-Tweezersquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-52"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔✘
                                            </label>
                                        </div>
                                    </li>
                                
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans23" id="production-checksheet-radio-53" type="radio"
                                                value="N/A" name="production-checksheet-radio-Tweezersquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-53"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">N/A
                                            </label>
                                        </div>
                                    </li>
                                </ul></div></section>
                <!-- REMARKS -->
                <section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
                    <h2 class="mb-2">Remarks</h2>
                    <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                        <h5 id="question24">Remarks on the Model</h5>
                        <label for="message" class="block mb-2 text-sm font-medium dark:text-white">Please
                                    type
                                    possible problems regarding with the machine.</label>
                        <textarea v-model="form.fieldAnswers.ans24" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
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
        