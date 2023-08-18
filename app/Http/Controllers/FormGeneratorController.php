<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
                'updated_at' => Carbon::now()
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
        $file_directory = 'Forms/'.$file_name;

        // Add response submission script to form
        $form_script = $this->generateStartingTags($form_title);

        // Create initial file in /storage/app/Forms directory
        Storage::put($file_directory, $form_script);

        // Read Form JSON Config
        $questionIndex = 1;
        $answerIndex = 1;
        foreach ($config['form_content'] as $key => $value) {
            // dd(sizeof($value['section_content']));
            // Append Section Opening Tag
            Storage::append($file_directory, '<section id="form-section" class="p-10 mt-5 mb-5 border-2 rounded-lg">');

            // Append Section Title
            Storage::append($file_directory, '<h2 id="section-name" class="mb-2">'.$value['section_name'].'</h2>');

            // Check Section Type
            if (str_contains($value['section_type'], "question")) {
                /*
                    Initialize id name for question and answer.
                    This is used for v-model for loop 
                */
                $questionId = 'question'.$questionIndex;
                $answerId = 'ans'.$answerIndex;

                // Append Opening Question Div
                Storage::append($file_directory, '
                    <div id="question" class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                ');

                // Append Question Label
                Storage::append($file_directory, '
                    <h5 id="'.$questionId.'">'.$value['section_content']['question'].'</h5>
                ');

                // Check Question Type
                if (str_contains($value['section_content']['type'], 'text')) {

                    // Append Text Field
                    Storage::append($file_directory, '
                        <div class="">
                            <input v-model="form.fieldAnswers.'.$answerId.'" type="text" id="ltnum"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>
                    ');
                } else if (str_contains($value['section_content']['type'], 'radio')) {

                }

                // Append Closing Question Label
                Storage::append($file_directory, '</div>');

            } else {

            }

            // Append Section Closing Tag
            Storage::append($file_directory, '</section>');
        }

        // Append Final Closing Tags
        Storage::append($file_directory, '
                        </form>
                    </div>
                </AppLayout>
            </template>
        ');
    }

    private function countQuestions($config)
    {
        foreach ($config['form_content'] as $key => $value) {

        }
    }

    private function generateStartingTags($form_title)
    {
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
            form_id: 1,
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
