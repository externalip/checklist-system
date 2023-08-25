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
        $userId = $this->getUserId();
        $config = $request->only('form_name', 'form_content');
        $form_name = $request->input('form_name');

        DB::table('forms')
            ->insert([
                'created_by' => $userId,
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

        return response()->json('Form Added');
    }

    private function checkIfFormExists($form_name)
    {
        $count = DB::table('forms')
            ->where('form_name', '=', $form_name)
            ->get()
            ->count();

        return $count > 0;
    }

    private function generateForm($form_id, $form_title, $config)
    {
        // Set directory, file name, and file extension type
        $file_name = 'form'.$form_id.'.vue';

        // Count number of questions in the form
        $fieldCount = 0;
        foreach ($config['form_content'] as $key => $value) {
            $fieldCount += count($value['section_content']);
        }

        // Add response submission script to form
        $form_script = $this->generateStartingTags($form_id, $form_title, $fieldCount);

        // Create initial file in /storage/app/Forms directory
        Storage::disk('form_path')->put($file_name, $form_script);

        // Read Form JSON Config
        $questionIndex = 1;
        $answerIndex = 1;
        $radioTarget = 1;

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

                    // Append Opening Question Div
                    Storage::disk('form_path')->append($file_name, '
                        <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    ');

                    // Append Question Label
                    Storage::disk('form_path')->append($file_name, '
                        <h5 id="'.'question'.$questionIndex++.'">'.$value['section_content'][$qKey]['label'].'</h5>
                    ');

                    // Check Question Type
                    if (str_contains($value['section_content'][$qKey]['type'], 'text')) {

                        // Append Text Answer Field
                        Storage::disk('form_path')->append($file_name, '
                            <div class="">
                                <input v-model="form.fieldAnswers.'.'ans'.$answerIndex++.'" type="text" id="ltnum"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            </div>
                        ');
                    } elseif (str_contains($value['section_content'][$qKey]['type'], 'radio')) {

                        // Append Opening Radio Group
                        Storage::disk('form_path')->append($file_name, '
                            <ul class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        ');

                        // Append Radio Options
                        foreach ($value['section_content'][$qKey]['options'] as $ansKey => $ansLabel) {
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
                        // Increment answerIndex after iterating through answer options that shares the same v-model (i.e: ans1)
                        $answerIndex++;

                        // Append Closing Radio Group
                        Storage::disk('form_path')->append($file_name, '</ul>');
                    }

                    // Append Closing Question Label
                    Storage::disk('form_path')->append($file_name, '</div>');
                }
            } else {
            }

            // Append Section Closing Tag
            Storage::disk('form_path')->append($file_name, '</section>');
        }

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

    private function generateStartingTags($form_id, $form_title, $fieldCount)
    {
        /* 
            Populate reactive answer field objects.

            Since there are 2 questions included in the initial tags
            (Model Name and Lot no.), we start indexing at 3.
        */
        $fieldAnswersData = '';
        for ($index = 1; $index <= $fieldCount; $index++) {
            $fieldAnswersData .= ('ans'.$index.': null,');
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
            form_id: ' . $form_id . ',
            // Answers storage
            fieldAnswers: {
                ans1: null,
                ans2: null,
                '.$fieldAnswersData.'
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
            router.post(\'/submit-response\', form)
        }
        </script>
        
        <style scoped></style>
        
        <template>
            <AppLayout title="'.$form_title.'">
                <div class="5s lg:mx-20">
                    <form @submit.prevent="submit()" method="post" id="1">

                        <!-- Hidden CSRF Token -->
                        <input type="hidden" name="_token" :value="csrf">

        ';
    }

    public function getUserId()
    {
        // Return session user id
        return auth()->user()->id;
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
