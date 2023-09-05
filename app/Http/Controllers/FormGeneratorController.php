<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class FormGeneratorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Create-Checklist/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $employee_id = auth()->user()->employee_id;
        $config = $request->only('form_name', 'form_content');
        $form_name = $request->input('form_name');

        DB::table('forms')
            ->insert([
                'created_by' => $employee_id,
                'form_name' => $form_name,
                'completed' => 1,
                'form_data' => json_encode($config),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

        // Get new form ID
        $row_id = DB::getPdo()->lastInsertId();

        // Create vue component based on form config
        $this->generateForm($row_id, $form_name, $config);

        return response()->json([
            'status' => 'success',
            'message' => 'Form added',
        ], 200);
    }

    private function checkIfFormExists($form_name)
    {
        $count = DB::table('forms')
            ->where('form_name', '=', $form_name)
            ->get()
            ->count();

        return $count > 0;
    }

    public function generateForm($form_id, $form_title, $config)
    {
        // Set directory, file name, and file extension type
        $file_name = 'form'.$form_id.'.vue';

        // Add response submission script to form
        $form_script = $this->generateStartingTags($form_id, $form_title, $config);

        // Create initial file in /storage/app/Forms directory
        Storage::disk('form_path')->put($file_name, $form_script);

        // Read Form JSON Config
        $questionIndex = 3;
        $answerIndex = 3;
        $radioTarget = 1;
        $checkboxTarget = 1;

        // Section Looper
        foreach ($config['form_content'] as $key => $value) {

            // Append Section Opening Tag
            Storage::disk('form_path')->append($file_name, '<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">');

            // Append Section Title
            Storage::disk('form_path')->append($file_name, '<h2 id="section-name" class="mb-2">'.$value['section_name'].'</h2>');

            // Check Section Type
            if (str_contains($value['section_type'], 'question')) {

                // Question Looper
                foreach ($value['section_content'] as $qKey => $qValue) {

                    // Check if question is required
                    $isRequired = $qValue['required'];

                    // Append Opening Question Div
                    Storage::disk('form_path')->append($file_name, '
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    ');

                    // Append Question Label
                    Storage::disk('form_path')->append($file_name, '
                        <h5 id="'.'question'.$questionIndex++.'">'.$value['section_content'][$qKey]['label'].'</h5>
                    ');

                    // Append Question Instruction (if any)
                    Storage::disk('form_path')->append($file_name, '
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            '.$value['section_content'][$qKey]['instruction'].'
                        </label>
                    ');

                    // Check Question Type
                    if (str_contains($value['section_content'][$qKey]['type'], 'text')) {
                        if ($isRequired) {

                            // Append Text Answer Field
                            Storage::disk('form_path')->append($file_name, '
                                <div class="">
                                    <input v-model="form.fieldAnswers.ans'.$answerIndex++.'" type="text" id="ltnum"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                            ');
                        } else {

                            // Append Text Answer Field
                            Storage::disk('form_path')->append($file_name, '
                                <div class="">
                                    <input v-model="form.fieldAnswers.ans'.$answerIndex++.'" type="text" id="ltnum"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                </div>
                            ');
                        }
                    } elseif (str_contains($value['section_content'][$qKey]['type'], 'radio')) {

                        // Append Opening Radio Group
                        Storage::disk('form_path')->append($file_name, '
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        ');

                        // Append Radio Options
                        foreach ($value['section_content'][$qKey]['options'] as $ansKey => $ansLabel) {
                            if ($isRequired) {
                                Storage::disk('form_path')->append($file_name, '
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.ans'.$answerIndex.'" id="production-checksheet-radio-'.$radioTarget.'" type="radio"
                                                value="'.$ansLabel.'" name="production-checksheet-radio-'.$value['section_name'].$qKey.'"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" required>
                                            <label for="production-checksheet-radio-'.$radioTarget++.'"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">'.$ansLabel.'
                                            </label>
                                        </div>
                                    </li>
                                ');
                            } else {
                                Storage::disk('form_path')->append($file_name, '
                                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                                        <div class="flex items-center pl-3">
                                            <input v-model="form.fieldAnswers.'.'ans'.$answerIndex.'" id="production-checksheet-radio-'.$radioTarget.'" type="radio"
                                                value="'.$ansLabel.'" name="production-checksheet-radio-'.$value['section_name'].$qKey.'"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                            <label for="production-checksheet-radio-'.$radioTarget++.'"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">'.$ansLabel.'
                                            </label>
                                        </div>
                                    </li>
                                ');
                            }
                        }
                        // Increment answerIndex after iterating through answer options that shares the same v-model (i.e: ans1)
                        $answerIndex++;

                        // Append Closing Radio Group
                        Storage::disk('form_path')->append($file_name, '</ul>');
                    } elseif (str_contains($value['section_content'][$qKey]['type'], 'dropdown')) {

                        // Check if field is required
                        if ($isRequired) {

                            // Append Opening Dropdown Group
                            Storage::disk('form_path')->append($file_name, '
                                <select id="models" v-model="form.fieldAnswers.ans'.$answerIndex.'" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            ');
                        } else {

                            // Append Opening Dropdown Group
                            Storage::disk('form_path')->append($file_name, '
                                <select id="models" v-model="form.fieldAnswers.ans'.$answerIndex.'" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            ');
                        }

                        // Append Dropdown Options
                        foreach ($value['section_content'][$qKey]['options'] as $ansKey => $ansLabel) {
                            Storage::disk('form_path')->append($file_name, '
                                <option value="'.$ansLabel.'">
                                    '.$ansLabel.'
                                </option>
                            ');
                        }

                        // Append Closing Dropdown Group
                        Storage::disk('form_path')->append($file_name, '</select>');
                    } else {

                        // Append Checkbox Options
                        foreach ($value['section_content'][$qKey]['options'] as $ansKey => $ansLabel) {
                            Storage::disk('form_path')->append($file_name, '
                                <div class="flex items-center mb-1">
                                    <input v-model="form.fieldAnswers.ans'.$answerIndex.'"
                                        id="checkbox'.$checkboxTarget.'" type="checkbox" value="'.$ansLabel.'"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox'.$checkboxTarget++.'"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >'.$ansLabel.'
                                    </label>
                                </div>
                                ');
                        }

                        $answerIndex++;
                    }

                    // Append Closing Question Label
                    Storage::disk('form_path')->append($file_name, '</div>');
                }
            } else {
                // For other section types, add code here...
            }

            // Append Section Closing Tag
            Storage::disk('form_path')->append($file_name, '</section>');
        }

        // Append Remarks Field
        Storage::disk('form_path')->append($file_name, '
                <!-- REMARKS -->
                <section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">
                    <h2 class="mb-2">Remarks</h2>
                    <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                        <h5 id="question'.$questionIndex++.'">Remarks on the Model</h5>
                        <label for="message" class="block mb-2 text-sm font-medium dark:text-white">Please
                                    type
                                    possible problems regarding with the machine.</label>
                        <textarea v-model="form.fieldAnswers.ans'.$answerIndex.'" id="message" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write here...">
                        </textarea>
                    </div>
                </section>
        ');

        // Append Final Closing Tags
        Storage::disk('form_path')->append($file_name, '
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
        ');
    }

    private function generateStartingTags($form_id, $form_title, $config)
    {
        /*
            FORM CONFIGURATION REFERENCE:

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
        */

        // Count number of questions in the form
        $fieldCount = 3;
        $fieldAnswersData = '';

        // section1 : {}
        foreach ($config['form_content'] as $sKey => $sValue) {

            // question1 : {}
            foreach ($sValue['section_content'] as $key => $value) {

                // Check if question type is checkbox
                if ($value['type'] == 'checkbox') {
                    $fieldAnswersData .= ('ans'.$fieldCount++.': [],');
                } else {
                    $fieldAnswersData .= ('ans'.$fieldCount++.': null,');
                }
            }
        }

        return '
        <script setup>
        import AppLayout from \'@/Layouts/AppLayout.vue\';
        import { reactive } from \'vue\'
        import { router } from \'@inertiajs/vue3\'

        const props = defineProps({
            models: Array,
        });


        let form = reactive({
            // Form identifier
            form_id: '.$form_id.',
            // Answers storage
            fieldAnswers: {
                ans1: null,
                ans2: null,
                '.$fieldAnswersData.'
                ans'.$fieldCount.': null,
            }
        })

        function submit() {
            // Get no. of questions based on h5 tags with an id `question#`
            let questionInputs = document.querySelectorAll(\'h5[id^="question"]\');
            let questionCount = questionInputs.length;

            // Get question text
            for (let i = 1; i <= questionCount; i++) {
                let ansKey = "ans".concat(i);
                let questionLabel = document.getElementById(\'question\' + i).textContent;

                // Store question into object
                form.fieldAnswers[questionLabel] = form.fieldAnswers[ansKey];
                delete form.fieldAnswers[ansKey];
            }

            // Send user input to ResponseController
            router.post(\'/submit\', form)
        }
        </script>

        <style scoped></style>

        <template>
            <AppLayout title="'.$form_title.'">
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
        ';
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
