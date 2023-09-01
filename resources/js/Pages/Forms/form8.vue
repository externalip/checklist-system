
        <script setup>
        import AppLayout from '@/Layouts/AppLayout.vue';
        import { reactive } from 'vue'
        import { router } from '@inertiajs/vue3'
        
        const props = defineProps({
            models: Array,
        });
        
        
        let form = reactive({
            // Form identifier
            form_id: 8,
            // Answers storage
            fieldAnswers: {
                ans1: null,
                ans2: null,
                ans3: null,
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
            <AppLayout title="test1">
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
<h2 id="section-name" class="mb-2">test2</h2>

                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    

                        <h5 id="question3">test3</h5>
                    

                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            
                        </label>
                    

                                <div class="">
                                    <input v-model="form.fieldAnswers.ans3" type="text" id="ltnum"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
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
        