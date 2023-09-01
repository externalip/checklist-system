
        <script setup>
        import AppLayout from '@/Layouts/AppLayout.vue';
        import { reactive } from 'vue'
        import { router } from '@inertiajs/vue3'
        
        const props = defineProps({
            models: Array,
        });
        
        
        let form = reactive({
            // Form identifier
            form_id: 45,
            // Answers storage
            fieldAnswers: {
                ans1: null,
                ans2: null,
                ans3: null,ans4: null,ans5: null,ans6: null,ans7: null,ans8: null,ans9: null,ans10: null,ans11: null,ans12: null,ans13: null,ans14: null,ans15: null,ans16: null,ans17: null,ans18: null,ans19: null,ans20: null,
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
            router.post('/submit', form)
        }
        </script>
        
        <style scoped></style>
        
        <template>
            <AppLayout title="P-TOUCH SOLDERING IRON START-UP CHECK SHEET">
                <div class="5s lg:mx-[25%]">
                    <form @submit.prevent="submit()" method="post" id="1">

                        <!-- Hidden CSRF Token -->
                        <input type="hidden" name="_token" :value="csrf">

                        <!-- MODEL IDENTIFICATION -->
                        <section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
                            <h2 id="section-name" class="mb-2">Model Identification</h2>
        
                            <div id="model-identification" class="grid lg:grid-cols-2 lg:gap-3">
                                <!-- Model Name -->
                                <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                                    <h5 id="question1">Model Name</h5>
        
                                    <label for="models" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                        Select a model
                                    </label>
        
                                    <select id="models" v-model="form.fieldAnswers.ans1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        <option v-for="model in models" :value="model.model_name" :key="model.id">
                                            {{ model.model_name }}
                                        </option>
                                    </select>
                                  
                                </div>
        
        
                                <!-- Lot Number -->
                                <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                                    <h5 id="question2">Lot Number</h5>
                                    <div class="">
                                        <label for="models" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" required>
                                            Input the Lot Number
                                        </label>
                                        <input v-model="form.fieldAnswers.ans2" type="text" id="ltnum" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                    </div>
                                    
                                </div>
                            </div>
                        </section>
        
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">SOLDERING IRON SET CONDITION</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question3">Machine is working and the light indicator is ON.</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            LCD is working after turning on the machine.
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans3" id="production-checksheet-radio-1" type="radio"
                                                value="✔" name="production-checksheet-radio-SOLDERING IRON SET CONDITIONquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-1"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans3" id="production-checksheet-radio-2" type="radio"
                                                value="x" name="production-checksheet-radio-SOLDERING IRON SET CONDITIONquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-2"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans3" id="production-checksheet-radio-3" type="radio"
                                                value="✔x" name="production-checksheet-radio-SOLDERING IRON SET CONDITIONquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-3"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔x
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">SOLDERING MACHINE CONDITION</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question4">switch must be in correct place. LCD is shown "Load"</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-4" type="radio"
                                                value="✔" name="production-checksheet-radio-SOLDERING MACHINE CONDITIONquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-4"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-5" type="radio"
                                                value="x" name="production-checksheet-radio-SOLDERING MACHINE CONDITIONquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-5"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans4" id="production-checksheet-radio-6" type="radio"
                                                value="✔x" name="production-checksheet-radio-SOLDERING MACHINE CONDITIONquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-6"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔x
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">SOLDER WIRE</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question5">Solder wire diameter is 0.80mm.</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Solder wire amount can be assumed to be enough for the daily plan.
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans5" id="production-checksheet-radio-7" type="radio"
                                                value="✔" name="production-checksheet-radio-SOLDER WIREquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-7"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans5" id="production-checksheet-radio-8" type="radio"
                                                value="x" name="production-checksheet-radio-SOLDER WIREquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-8"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans5" id="production-checksheet-radio-9" type="radio"
                                                value="✔x" name="production-checksheet-radio-SOLDER WIREquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-9"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔x
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">SOLDER WIRE EXPIRATION DATE</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question6">Expiration date label is attached on the solder wire spool or holder.</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Not beyond the declared expiration date
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans6" id="production-checksheet-radio-10" type="radio"
                                                value="✔" name="production-checksheet-radio-SOLDER WIRE EXPIRATION DATEquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-10"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans6" id="production-checksheet-radio-11" type="radio"
                                                value="x" name="production-checksheet-radio-SOLDER WIRE EXPIRATION DATEquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-11"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans6" id="production-checksheet-radio-12" type="radio"
                                                value="✔x" name="production-checksheet-radio-SOLDER WIRE EXPIRATION DATEquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-12"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔x
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">SOLDER TIP TYPE</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question7">Write actual tip type</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            [KH] - High Temp Knife Tip [KL] - Low Temp Knife Tip [C] - C-Type Tip
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans7" id="production-checksheet-radio-13" type="radio"
                                                value="KH" name="production-checksheet-radio-SOLDER TIP TYPEquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-13"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">KH
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans7" id="production-checksheet-radio-14" type="radio"
                                                value="KL" name="production-checksheet-radio-SOLDER TIP TYPEquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-14"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">KL
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans7" id="production-checksheet-radio-15" type="radio"
                                                value="C" name="production-checksheet-radio-SOLDER TIP TYPEquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-15"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">C
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">SOLDER TIP CONDITION</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question8">Have no damage or deformation</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans8" id="production-checksheet-radio-16" type="radio"
                                                value="✔" name="production-checksheet-radio-SOLDER TIP CONDITIONquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-16"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans8" id="production-checksheet-radio-17" type="radio"
                                                value="x" name="production-checksheet-radio-SOLDER TIP CONDITIONquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-17"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans8" id="production-checksheet-radio-18" type="radio"
                                                value="✔x" name="production-checksheet-radio-SOLDER TIP CONDITIONquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-18"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔x
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">SOLDER TIP TEMPERATURE</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question9">Write actual value</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                                <div class="">
                                    <input v-model="form.fieldAnswers.ans9" type="text" id="ltnum"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                            
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">RESISTANCE VALUE</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question10">Measure the actual solder tip temperature using the Hakko Thermometer with melted lead.</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Required Value: Max of 4 Ohms. Frequency: Once a week.
                        </label>
                    

                                <div class="">
                                    <input v-model="form.fieldAnswers.ans10" type="text" id="ltnum"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                            
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">LEAK VOLTAGE VALUE</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question11">Measure the leak voltage using the Hakko Thermometer.</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Req. Value: Max 2mV. Freq.: Once a Week.
                        </label>
                    

                                <div class="">
                                    <input v-model="form.fieldAnswers.ans11" type="text" id="ltnum"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                            
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">SPONGE / SPONGE BIN</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question12">Sponge bin must be clean.</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Sponge is damped with water
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans12" id="production-checksheet-radio-19" type="radio"
                                                value="✔" name="production-checksheet-radio-SPONGE / SPONGE BINquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-19"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans12" id="production-checksheet-radio-20" type="radio"
                                                value="x" name="production-checksheet-radio-SPONGE / SPONGE BINquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-20"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans12" id="production-checksheet-radio-21" type="radio"
                                                value="✔x" name="production-checksheet-radio-SPONGE / SPONGE BINquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-21"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔x
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">SOLDERING JIG ID NO.</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question13">Write soldering jig ID no.</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                                <div class="">
                                    <input v-model="form.fieldAnswers.ans13" type="text" id="ltnum"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                            
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">SOLDERING JIG APPEARANCE</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question14">Soldering jig is clean and free from solder lead stains and flux.</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Use IPA, brush, or savina cloth to clean it.
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans14" id="production-checksheet-radio-22" type="radio"
                                                value="✔" name="production-checksheet-radio-SOLDERING JIG APPEARANCEquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-22"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans14" id="production-checksheet-radio-23" type="radio"
                                                value="x" name="production-checksheet-radio-SOLDERING JIG APPEARANCEquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-23"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans14" id="production-checksheet-radio-24" type="radio"
                                                value="✔x" name="production-checksheet-radio-SOLDERING JIG APPEARANCEquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-24"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔x
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">COMPONENT'S REFERENCE ON SOLDERING JIG (IF APPLICABLE)</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question15">Component's reference must be correct and complete</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans15" id="production-checksheet-radio-25" type="radio"
                                                value="✔" name="production-checksheet-radio-COMPONENT'S REFERENCE ON SOLDERING JIG (IF APPLICABLE)question1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-25"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans15" id="production-checksheet-radio-26" type="radio"
                                                value="x" name="production-checksheet-radio-COMPONENT'S REFERENCE ON SOLDERING JIG (IF APPLICABLE)question1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-26"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans15" id="production-checksheet-radio-27" type="radio"
                                                value="✔x" name="production-checksheet-radio-COMPONENT'S REFERENCE ON SOLDERING JIG (IF APPLICABLE)question1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-27"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔x
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">BAMBOO STICK</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question16">"Applicable for Harness Soldering on Main PCB"</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Available and must be in good condition.
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans16" id="production-checksheet-radio-28" type="radio"
                                                value="✔" name="production-checksheet-radio-BAMBOO STICKquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-28"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans16" id="production-checksheet-radio-29" type="radio"
                                                value="x" name="production-checksheet-radio-BAMBOO STICKquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-29"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans16" id="production-checksheet-radio-30" type="radio"
                                                value="✔x" name="production-checksheet-radio-BAMBOO STICKquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-30"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔x
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">EXHAUST SYSTEM</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question17">Available in the station and is properly working.</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans17" id="production-checksheet-radio-31" type="radio"
                                                value="✔" name="production-checksheet-radio-EXHAUST SYSTEMquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-31"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans17" id="production-checksheet-radio-32" type="radio"
                                                value="x" name="production-checksheet-radio-EXHAUST SYSTEMquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-32"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans17" id="production-checksheet-radio-33" type="radio"
                                                value="✔x" name="production-checksheet-radio-EXHAUST SYSTEMquestion1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-33"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔x
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">BARCODE PART NO. (FOR D460 AND D610 MAIN ONLY)</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question18">D02484-001 [D460 Main]</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans18" id="production-checksheet-radio-34" type="radio"
                                                value="✔" name="production-checksheet-radio-BARCODE PART NO. (FOR D460 AND D610 MAIN ONLY)question1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-34"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans18" id="production-checksheet-radio-35" type="radio"
                                                value="x" name="production-checksheet-radio-BARCODE PART NO. (FOR D460 AND D610 MAIN ONLY)question1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-35"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans18" id="production-checksheet-radio-36" type="radio"
                                                value="✔x" name="production-checksheet-radio-BARCODE PART NO. (FOR D460 AND D610 MAIN ONLY)question1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-36"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans18" id="production-checksheet-radio-37" type="radio"
                                                value="N/A" name="production-checksheet-radio-BARCODE PART NO. (FOR D460 AND D610 MAIN ONLY)question1"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-37"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">N/A
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question19">D027CR-001 [D610 Main]</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans19" id="production-checksheet-radio-38" type="radio"
                                                value="✔" name="production-checksheet-radio-BARCODE PART NO. (FOR D460 AND D610 MAIN ONLY)question2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-38"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans19" id="production-checksheet-radio-39" type="radio"
                                                value="x" name="production-checksheet-radio-BARCODE PART NO. (FOR D460 AND D610 MAIN ONLY)question2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-39"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans19" id="production-checksheet-radio-40" type="radio"
                                                value="✔x" name="production-checksheet-radio-BARCODE PART NO. (FOR D460 AND D610 MAIN ONLY)question2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-40"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">✔x
                                            </label>
                                        </div>
                                    </li>
                                

                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans19" id="production-checksheet-radio-41" type="radio"
                                                value="N/A" name="production-checksheet-radio-BARCODE PART NO. (FOR D460 AND D610 MAIN ONLY)question2"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-41"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">N/A
                                            </label>
                                        </div>
                                    </li>
                                
</ul>
</div>
</section>
<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
<h2 id="section-name" class="mb-2">Remarks</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question20">Enter any notable remarks on the model</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                                <div class="">
                                    <input v-model="form.fieldAnswers.ans20" type="text" id="ltnum"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            
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
        