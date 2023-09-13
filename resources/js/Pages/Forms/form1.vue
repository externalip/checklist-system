
        <script setup>
        import AppLayout from '@/Layouts/AppLayout.vue';
        import { reactive, computed } from 'vue'
        import { router } from '@inertiajs/vue3'

        const props = defineProps({
            models: Array,
        });


        let form = reactive({
            // Form identifier
            form_id: 1,
            // Answers storage
            fieldAnswers: {
                ans1: null,
                ans2: null,
                ans3: null,
                ans4: null,ans5: null,ans6: null,ans7: null,ans8: null,ans9: null,
                ans10: null,
            }
        })

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
            <AppLayout title="PRODUCTION 5S START-UP CHECK SHEET">
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
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
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
                                <h5 id="question2">Lot Number</h5>
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
                                <h5 id="question3">Kit Number</h5>
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

        
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">Type of Checking</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                            <h5 id="question4" class="required">Type of Check</h5>
                        

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-1" type="radio"
                                                value="Start-up" name="production-checksheet-radio-Type of Checkingquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-1"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Start-up
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-2" type="radio"
                                                value="Re-startup" name="production-checksheet-radio-Type of Checkingquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-2"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Re-startup
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-3" type="radio"
                                                value="Change Model" name="production-checksheet-radio-Type of Checkingquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-3"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Change Model
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">Checking Items</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                            <h5 id="question5" class="required">Production Checksheet</h5>
                        

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans5" id="production-checksheet-radio-4" type="radio"
                                                value="OK" name="production-checksheet-radio-Checking Itemsquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-4"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans5" id="production-checksheet-radio-5" type="radio"
                                                value="NG" name="production-checksheet-radio-Checking Itemsquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-5"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans5" id="production-checksheet-radio-6" type="radio"
                                                value="NA" name="production-checksheet-radio-Checking Itemsquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-6"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                            <h5 id="question6" class="required">Procedures / OPL / Work Instructions</h5>
                        

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans6" id="production-checksheet-radio-7" type="radio"
                                                value="OK" name="production-checksheet-radio-Checking Itemsquestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-7"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans6" id="production-checksheet-radio-8" type="radio"
                                                value="NG" name="production-checksheet-radio-Checking Itemsquestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-8"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans6" id="production-checksheet-radio-9" type="radio"
                                                value="NA" name="production-checksheet-radio-Checking Itemsquestion2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-9"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                            <h5 id="question7" class="required">Working Area</h5>
                        

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans7" id="production-checksheet-radio-10" type="radio"
                                                value="OK" name="production-checksheet-radio-Checking Itemsquestion3"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-10"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans7" id="production-checksheet-radio-11" type="radio"
                                                value="NG" name="production-checksheet-radio-Checking Itemsquestion3"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-11"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans7" id="production-checksheet-radio-12" type="radio"
                                                value="NA" name="production-checksheet-radio-Checking Itemsquestion3"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-12"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                            <h5 id="question8" class="required">Materials</h5>
                        

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans8" id="production-checksheet-radio-13" type="radio"
                                                value="OK" name="production-checksheet-radio-Checking Itemsquestion4"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-13"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans8" id="production-checksheet-radio-14" type="radio"
                                                value="NG" name="production-checksheet-radio-Checking Itemsquestion4"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-14"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans8" id="production-checksheet-radio-15" type="radio"
                                                value="NA" name="production-checksheet-radio-Checking Itemsquestion4"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-15"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                            <h5 id="question9" class="required">Tools / Jigs Instrument</h5>
                        

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans9" id="production-checksheet-radio-16" type="radio"
                                                value="OK" name="production-checksheet-radio-Checking Itemsquestion5"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-16"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans9" id="production-checksheet-radio-17" type="radio"
                                                value="NG" name="production-checksheet-radio-Checking Itemsquestion5"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-17"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans9" id="production-checksheet-radio-18" type="radio"
                                                value="NA" name="production-checksheet-radio-Checking Itemsquestion5"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-18"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>

                <!-- REMARKS -->
                <section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
                    <h2 class="mb-2">Remarks</h2>
                    <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                        <h5 id="question10">Remarks on the Model</h5>
                        <label for="message" class="block mb-2 text-sm font-medium dark:text-white">Please
                                    type
                                    possible problems regarding with the machine.</label>
                        <textarea v-model="form.fieldAnswers.ans10" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
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
        