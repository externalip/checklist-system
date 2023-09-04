<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    models: Array,
});

let form = reactive({
    // Form identifier
    form_id: 50,
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
    },
});

function submit() {
    // Get no. of questions based on h5 tags with an id `question#`
    let questionInputs = document.querySelectorAll('h5[id^="question"]');
    let questionCount = questionInputs.length;

    // Get question text
    for (let i = 1; i <= questionCount; i++) {
        let ansKey = "ans".concat(i);
        let questionLabel = document.getElementById("question" + i).textContent;

        // Store question into object
        form.fieldAnswers[questionLabel] = form.fieldAnswers[ansKey];
        delete form.fieldAnswers[ansKey];
    }

    // Send user input to ResponseController
    router.post("/submit", form);
}
</script>

<style scoped></style>

<template>
    <AppLayout title="5S Checklist">
        <div class="5s lg:mx-[25%] text-[--blue]">
            <form @submit.prevent="submit()" method="post" id="1">
                <!-- Hidden CSRF Token -->
                <input type="hidden" name="_token" :value="csrf" />

                <!-- MODEL IDENTIFICATION -->
                <section
                    id="form-section"
                    class="p-10 mt-5 mb-5 border-2 rounded-lg"
                >
                    <h2 id="section-name" class="mb-2">Model Identification</h2>

                    <div
                        id="model-identification"
                        class="grid lg:grid-cols-2 lg:gap-3"
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
                                    v-for="model in models"
                                    :value="model.model_name"
                                    :key="model.id"
                                >
                                    {{ model.model_name }}
                                </option>
                            </select>
                        </div>

                        <!-- Lot Number -->
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
                                    id="ltnum"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    required
                                />
                            </div>
                        </div>
                    </div>
                </section>

                <section
                    id="form-section"
                    class="p-10 mt-5 mb-5 border-2 rounded-lg"
                >
                    <h2 id="section-name" class="mb-2">Type of Checking</h2>

                    <div
                        id="question"
                        class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                    >
                        <h5 id="question3">Type of Checking</h5>

                        <label
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >
                            Select a type of checking
                        </label>

                        <ul
                            class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >
                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans3"
                                        id="production-checksheet-radio-1"
                                        type="radio"
                                        value="Start-up"
                                        name="production-checksheet-radio-Type of Checkingquestion1"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-1"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >Start-up
                                    </label>
                                </div>
                            </li>

                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans3"
                                        id="production-checksheet-radio-2"
                                        type="radio"
                                        value="Re-startup"
                                        name="production-checksheet-radio-Type of Checkingquestion1"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-2"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >Re-startup
                                    </label>
                                </div>
                            </li>

                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans3"
                                        id="production-checksheet-radio-3"
                                        type="radio"
                                        value="Change Model"
                                        name="production-checksheet-radio-Type of Checkingquestion1"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-3"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >Change Model
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>
                <section
                    id="form-section"
                    class="p-10 mt-5 mb-5 border-2 rounded-lg"
                >
                    <h2 id="section-name" class="mb-2">Checking Items</h2>

                    <div
                        id="question"
                        class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                    >
                        <h5 id="question4">Production Checksheet</h5>

                        <div id="accordion-collapse" data-accordion="collapse">
                            <h2 id="accordion-collapse-heading-1">
                                <button
                                    type="button"
                                    class="flex items-center justify-between w-full p-3 my-2 text-sm text-left text-gray-500 border rounded-md border-b dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100"
                                    data-accordion-target="#accordion-collapse-body-1"
                                    aria-expanded="false"
                                    aria-controls="accordion-collapse-body-1"
                                >
                                    <span>Instructions</span>
                                    <svg
                                        data-accordion-icon
                                        class="w-3 h-3 transition-transform shrink-0"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 10 6"
                                    >
                                        <path
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5 5 1 1 5"
                                        />
                                    </svg>
                                </button>
                            </h2>
                            <div
                                id="accordion-collapse-body-1"
                                class="hidden"
                                aria-labelledby="accordion-collapse-heading-1"
                            >
                                <div
                                    class="p-5 my-2 border border-b border-gray-200 dark:border-gray-700 rounded-md"
                                >
                                    <h6
                                        class="text-lg text-gray-500 font-bold text-center"
                                    >
                                        Production Checksheet Instructions
                                    </h6>
                                    <!-- Intructions -->
                                    <ul
                                        class="mb-3 max-w-full space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400"
                                    >
                                        <li>
                                            Is it the correct checksheet
                                            corresponding to the lot?
                                        </li>
                                        <li>
                                            Are all information required to fill
                                            up are correct and complete?
                                        </li>
                                        <li>
                                            Is it the correct checksheet
                                            corresponding to the lot?
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <ul
                            class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >
                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans4"
                                        id="production-checksheet-radio-4"
                                        type="radio"
                                        value="OK"
                                        name="production-checksheet-radio-Checking Itemsquestion1"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-4"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >OK
                                    </label>
                                </div>
                            </li>

                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans4"
                                        id="production-checksheet-radio-5"
                                        type="radio"
                                        value="NG"
                                        name="production-checksheet-radio-Checking Itemsquestion1"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-5"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >NG
                                    </label>
                                </div>
                            </li>

                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans4"
                                        id="production-checksheet-radio-6"
                                        type="radio"
                                        value="NA"
                                        name="production-checksheet-radio-Checking Itemsquestion1"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-6"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >NA
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div
                        id="question"
                        class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                    >
                        <h5 id="question5">Procedures/OPL/Work Instructions</h5>

                        <div id="accordion-collapse" data-accordion="collapse">
                            <h2 id="accordion-collapse-heading-2">
                                <button
                                    type="button"
                                    class="flex items-center justify-between w-full p-3 my-2 text-sm text-left text-gray-500 border rounded-md border-b dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100"
                                    data-accordion-target="#accordion-collapse-body-2"
                                    aria-expanded="false"
                                    aria-controls="accordion-collapse-body-1"
                                >
                                    <span>Instructions</span>
                                    <svg
                                        data-accordion-icon
                                        class="w-3 h-3 transition-transform shrink-0"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 10 6"
                                    >
                                        <path
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5 5 1 1 5"
                                        />
                                    </svg>
                                </button>
                            </h2>
                            <div
                                id="accordion-collapse-body-2"
                                class="hidden"
                                aria-labelledby="accordion-collapse-heading-2"
                            >
                                <div
                                    class="p-5 my-2 border border-b border-gray-200 dark:border-gray-700 rounded-md"
                                >
                                    <h6
                                        class="text-lg text-gray-500 font-bold text-center"
                                    >
                                        Procedures/OPL/Work Instructions
                                    </h6>
                                    <!-- Intructions -->
                                    <ul
                                        class="mb-3 max-w-full space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400"
                                    >
                                        <label
                                            class="mb-2 text-sm font-semibold text-gray-900 dark:text-white"
                                            >Instructions</label
                                        >
                                        <li>
                                            Are all SOP/OPL/ WORK INSTRUCTION
                                            posted properly according to correct
                                            model running?
                                        </li>
                                        <li>
                                            Are all visual aid required on the
                                            stations present?
                                        </li>
                                        <li>
                                            Are all visible, accessible and easy
                                            to open in case posted in area only?
                                        </li>
                                        <li>
                                            Are all SOP/OPL/WORK INSTRUCTION has
                                            complete signatories, complete pages
                                            and were issued by DOC?
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <ul
                            class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >
                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans5"
                                        id="production-checksheet-radio-7"
                                        type="radio"
                                        value="OK"
                                        name="production-checksheet-radio-Checking Itemsquestion2"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-7"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >OK
                                    </label>
                                </div>
                            </li>

                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans5"
                                        id="production-checksheet-radio-8"
                                        type="radio"
                                        value="NG"
                                        name="production-checksheet-radio-Checking Itemsquestion2"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-8"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >NG
                                    </label>
                                </div>
                            </li>

                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans5"
                                        id="production-checksheet-radio-9"
                                        type="radio"
                                        value="NA"
                                        name="production-checksheet-radio-Checking Itemsquestion2"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-9"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >NA
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div
                        id="question"
                        class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                    >
                        <h5 id="question6">Working Area</h5>

                        <div id="accordion-collapse" data-accordion="collapse">
                            <h2 id="accordion-collapse-heading-3">
                                <button
                                    type="button"
                                    class="flex items-center justify-between w-full p-3 my-2 text-sm text-left text-gray-500 border rounded-md border-b dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100"
                                    data-accordion-target="#accordion-collapse-body-3"
                                    aria-expanded="false"
                                    aria-controls="accordion-collapse-body-3"
                                >
                                    <span>Instructions</span>
                                    <svg
                                        data-accordion-icon
                                        class="w-3 h-3 transition-transform shrink-0"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 10 6"
                                    >
                                        <path
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5 5 1 1 5"
                                        />
                                    </svg>
                                </button>
                            </h2>
                            <div
                                id="accordion-collapse-body-3"
                                class="hidden"
                                aria-labelledby="accordion-collapse-heading-3"
                            >
                                <div
                                    class="p-5 my-2 border border-b border-gray-200 dark:border-gray-700 rounded-md"
                                >
                                    <h6
                                        class="text-lg text-gray-500 font-bold text-center"
                                    >
                                        Working Area Instructions
                                    </h6>
                                    <!-- Intructions -->
                                    <ul
                                        class="mb-3 max-w-full space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400"
                                    >
                                        <label
                                            class="mb-2 text-sm font-semibold text-gray-900 dark:text-white"
                                            >Instructions</label
                                        >
                                        <li>
                                            Is the work area clean and free from
                                            any items not required on station?
                                        </li>
                                        <li>
                                            Is the work set-up are defined and
                                            labelled?
                                        </li>
                                        <li>
                                            Are tools, jigs, supplies located on
                                            defined areas?
                                        </li>
                                        <li>
                                            Are the tray slots for WIP units in
                                            GOOD condition?
                                        </li>
                                        <li>
                                            Are grounding wires on working
                                            tables connected?
                                        </li>
                                        <li>
                                            Are grounding strap properly worn in
                                            the working area?
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <ul
                            class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >
                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans6"
                                        id="production-checksheet-radio-10"
                                        type="radio"
                                        value="OK"
                                        name="production-checksheet-radio-Checking Itemsquestion3"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-10"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >OK
                                    </label>
                                </div>
                            </li>

                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans6"
                                        id="production-checksheet-radio-11"
                                        type="radio"
                                        value="NG"
                                        name="production-checksheet-radio-Checking Itemsquestion3"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-11"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >NG
                                    </label>
                                </div>
                            </li>

                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans6"
                                        id="production-checksheet-radio-12"
                                        type="radio"
                                        value="NA"
                                        name="production-checksheet-radio-Checking Itemsquestion3"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-12"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >NA
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div
                        id="question"
                        class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                    >
                        <h5 id="question7">Materials</h5>

                        <div id="accordion-collapse" data-accordion="collapse">
                            <h2 id="accordion-collapse-heading-4">
                                <button
                                    type="button"
                                    class="flex items-center justify-between w-full p-3 my-2 text-sm text-left text-gray-500 border rounded-md border-b dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100"
                                    data-accordion-target="#accordion-collapse-body-4"
                                    aria-expanded="false"
                                    aria-controls="accordion-collapse-body-4"
                                >
                                    <span>Instructions</span>
                                    <svg
                                        data-accordion-icon
                                        class="w-3 h-3 transition-transform shrink-0"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 10 6"
                                    >
                                        <path
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5 5 1 1 5"
                                        />
                                    </svg>
                                </button>
                            </h2>
                            <div
                                id="accordion-collapse-body-4"
                                class="hidden"
                                aria-labelledby="accordion-collapse-heading-4"
                            >
                                <div
                                    class="p-5 my-2 border border-b border-gray-200 dark:border-gray-700 rounded-md"
                                >
                                    <h6
                                        class="text-lg text-gray-500 font-bold text-center"
                                    >
                                        Materials Instructions
                                    </h6>
                                    <!-- Instructions -->
                                    <ul
                                        class="mb-3 max-w-full space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400"
                                    >
                                        <label
                                            class="mb-2 text-sm font-semibold text-gray-900 dark:text-white"
                                            >Instructions</label
                                        >
                                        <li>Are the materials correct?</li>
                                        <li>
                                            Is the validity date/ manufacturing
                                            date expiry per standard?
                                        </li>
                                        <li>
                                            Are these place and label on defined
                                            control area?
                                        </li>
                                        <li>
                                            Are tool, jigs, supplies localed on
                                            defined areas?
                                        </li>
                                        <li>
                                            Are the wip products store on place
                                            required by standard?
                                        </li>
                                        <li>
                                            In case of Change Model, there
                                            should no wip on the working table
                                            as well as NG / For Rework units on
                                            reject bins.
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <ul
                            class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >
                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans7"
                                        id="production-checksheet-radio-13"
                                        type="radio"
                                        value="OK"
                                        name="production-checksheet-radio-Checking Itemsquestion4"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-13"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >OK
                                    </label>
                                </div>
                            </li>

                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans7"
                                        id="production-checksheet-radio-14"
                                        type="radio"
                                        value="NG"
                                        name="production-checksheet-radio-Checking Itemsquestion4"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-14"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >NG
                                    </label>
                                </div>
                            </li>

                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans7"
                                        id="production-checksheet-radio-15"
                                        type="radio"
                                        value="NA"
                                        name="production-checksheet-radio-Checking Itemsquestion4"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-15"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >NA
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div
                        id="question"
                        class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                    >
                        <h5 id="question8">Tools/Jigs Instrument</h5>

                        <div id="accordion-collapse" data-accordion="collapse">
                            <h2 id="accordion-collapse-heading-5">
                                <button
                                    type="button"
                                    class="flex items-center justify-between w-full p-3 my-2 text-sm text-left text-gray-500 border rounded-md border-b dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100"
                                    data-accordion-target="#accordion-collapse-body-5"
                                    aria-expanded="false"
                                    aria-controls="accordion-collapse-body-5"
                                >
                                    <span>Instructions</span>
                                    <svg
                                        data-accordion-icon
                                        class="w-3 h-3 transition-transform shrink-0"
                                        aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 10 6"
                                    >
                                        <path
                                            stroke="currentColor"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M9 5 5 1 1 5"
                                        />
                                    </svg>
                                </button>
                            </h2>

                            <div
                                id="accordion-collapse-body-5"
                                class="hidden"
                                aria-labelledby="accordion-collapse-heading-5"
                            >
                                <div
                                    class="p-5 my-2 border border-b border-gray-200 dark:border-gray-700 rounded-md"
                                >
                                    <h6
                                        class="text-lg text-gray-500 font-bold text-center"
                                    >
                                        Tools/Jigs Instrument Instructions
                                    </h6>
                                    <!-- Instructions -->
                                    <ul
                                        class="mb-3 max-w-full space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400"
                                    >
                                        <label
                                            class="mb-2 text-sm font-semibold text-gray-900 dark:text-white"
                                            >Instructions</label
                                        >
                                        <li>
                                            Are correct tools/ jigs /
                                            instruments used as per standard?
                                        </li>
                                        <li>
                                            Are tools / jig in good condition?
                                        </li>
                                        <li>
                                            Are tools / jig calibration not
                                            expired?
                                        </li>
                                        <li>
                                            Arecalibration validity of
                                            instruments within standard?
                                        </li>
                                        <li>
                                            Are inspection jigs/tyemplates used
                                            is not worn out?
                                        </li>
                                        <li>
                                            Are ground strap already worn out?
                                        </li>
                                        <li>
                                            Are instruments/machine wires are
                                            properly harnessed?
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <ul
                            class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        >
                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans8"
                                        id="production-checksheet-radio-16"
                                        type="radio"
                                        value="OK"
                                        name="production-checksheet-radio-Checking Itemsquestion5"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-16"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >OK
                                    </label>
                                </div>
                            </li>

                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans8"
                                        id="production-checksheet-radio-17"
                                        type="radio"
                                        value="NG"
                                        name="production-checksheet-radio-Checking Itemsquestion5"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-17"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >NG
                                    </label>
                                </div>
                            </li>

                            <li
                                class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                            >
                                <div class="flex items-center pl-3">
                                    <input
                                        v-model="form.fieldAnswers.ans8"
                                        id="production-checksheet-radio-18"
                                        type="radio"
                                        value="NA"
                                        name="production-checksheet-radio-Checking Itemsquestion5"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                        required
                                    />
                                    <label
                                        for="production-checksheet-radio-18"
                                        class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        >NA
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- REMARKS -->
                <section
                    id="form-section"
                    class="p-10 mt-5 mb-5 border-2 rounded-lg"
                >
                    <h2 class="mb-2">Remarks</h2>
                    <div
                        id="question"
                        class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                    >
                        <h5 id="question9">Remarks on the Model</h5>
                        <label
                            for="message"
                            class="block mb-2 text-sm font-medium dark:text-white"
                            >Please type possible problems regarding with the
                            machine.</label
                        >
                        <textarea
                            v-model="form.fieldAnswers.ans9"
                            id="message"
                            rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write here..."
                        >
                        </textarea>
                    </div>
                </section>

                <section
                    id="button-group"
                    class="place-content-end mt-5 mb-5 align-right justify-center lg:justify-end flex"
                >
                    <!-- Back Button -->
                    <button
                        type="button"
                        class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                    >
                        Back
                    </button>

                    <!-- Submit Button -->
                    <button
                        type="btnSubmit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                    >
                        Submit
                    </button>
                </section>
            </form>
        </div>
    </AppLayout>
</template>
