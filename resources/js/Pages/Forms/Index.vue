<template>
    <AppLayout :title="formData.form_name">
        <div class="5s lg:mx-[25%]">
            <h3 class="text-center">
                Control No: {{ JSON.parse(formData.form_data).control_no }}
            </h3>
            <form @submit.prevent="submit()" method="post" id="1">
                <section
                    id="form-section"
                    class="p-10 mt-5 mb-5 border-2 rounded-lg"
                >
                    <h2 id="section-name" class="mb-2">Model Identification</h2>
                    <div id="model-identification" class="grid grid-cols-1">
                        <!-- Model Name -->
                        <div
                            id="model-identification"
                            class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                        >
                            <h5 id="question1">Model Name</h5>
                            <label
                                for="models"
                                class="required block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >
                                Select a model
                                <span class="text-sm" style="color: red">
                                    *
                                </span>
                            </label>
                            <select
                                id="models"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required
                                v-model="form.fieldAnswers['Model Name']"
                            >
                                <option selected>Select an Option</option>
                                <option
                                    v-for="model in models"
                                    :value="model.model_name"
                                    :key="model.id"
                                >
                                    {{ model.model_name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <!-- Lot Number -->
                    <div
                        id="model-identification"
                        class="grid lg:grid-cols-2 lg:gap-3"
                    >
                        <div
                            id="Lot Number"
                            class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                        >
                            <h5 id="Lot Number" class="required">Lot Number</h5>
                            <div class="">
                                <label
                                    for="models"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    required
                                >
                                    Input the Lot Number
                                    <span class="text-sm" style="color: red">
                                        *
                                    </span>
                                </label>
                                <input
                                    type="text"
                                    id="ltnum"
                                    placeholder="Ex. 5/46"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.fieldAnswers['Lot Number']"
                                    required
                                />
                            </div>
                        </div>
                        <div
                            id="Kit Number"
                            class="border-2 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md"
                        >
                            <h5 id="Kit Number" class="required">Kit Number</h5>
                            <div class="">
                                <label
                                    for="models"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    required
                                >
                                    Input the Kit Number
                                    <span class="text-sm" style="color: red">
                                        *
                                    </span>
                                </label>
                                <input
                                    type="text"
                                    id="ltnum"
                                    placeholder="Ex. 36132-001"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    v-model="form.fieldAnswers['Kit Number']"
                                    required
                                />
                            </div>
                        </div>
                    </div>
                </section>
                <div
                    v-for="(section, sectionIndex) in JSON.parse(
                        formData.form_data
                    )?.form_content"
                    :key="sectionIndex"
                >
                    <section
                        id="form-section"
                        class="p-10 mt-5 mb-5 border-2 rounded-lg"
                    >
                        <!-- {{ section }} -->
                        <h2>{{ section.section_name }}</h2>
                        <!-- inside section get the question  -->
                        <div
                            v-for="(
                                question, questionNumber
                            ) in section.section_content"
                            :key="questionNumber"
                            class="p-5 mt-5 mb-5 border-2 rounded-lg"
                        >
                            <h3 class="text-lg">
                                Question: {{ question.label }}
                                <span
                                    v-if="question.required"
                                    style="color: red"
                                    class="text-sm"
                                >
                                    *
                                </span>
                            </h3>
                            <h5
                                class="text-lg bold"
                                v-if="question.instruction != null"
                            >
                                Instruction: {{ question.instruction }}
                            </h5>
                            <template v-if="question.type === 'text'">
                                <input
                                    type="text"
                                    v-model="form.fieldAnswers[question.label]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    :required="question.required"
                                />
                            </template>
                            <!-- If the question type is radio-symbol -->
                            <template v-if="question.type === 'radio-symbol'">
                                <ul
                                    class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                >
                                    <li
                                        v-for="(
                                            option, optionIndex
                                        ) in question.options"
                                        :key="optionIndex"
                                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                                    >
                                        <div class="flex items-center pl-3">
                                            <input
                                                :id="
                                                    'production-checksheet-radio-symbol-' +
                                                    sectionIndex +
                                                    '-' +
                                                    questionNumber +
                                                    '-' +
                                                    optionIndex
                                                "
                                                :name="
                                                    'production-checksheet-radio-symbol' +
                                                    sectionIndex +
                                                    '-' +
                                                    questionNumber
                                                "
                                                v-model="
                                                    form.fieldAnswers[
                                                        question.label
                                                    ]
                                                "
                                                :value="option.label"
                                                type="radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                                :required="question.required"
                                            />
                                            <label
                                                :for="
                                                    'production-checksheet-radio-symbol-' +
                                                    sectionIndex +
                                                    '-' +
                                                    questionNumber +
                                                    '-' +
                                                    optionIndex
                                                "
                                                :style="{ color: option.color }"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >
                                                {{ option.label }}
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </template>
                            <!-- If the question type is radio -->
                            <template v-if="question.type === 'radio'">
                                <ul
                                    class="bottom-0 items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                                >
                                    <li
                                        v-for="(
                                            option, optionIndex
                                        ) in question.options"
                                        :key="optionIndex"
                                        class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600"
                                    >
                                        <div class="flex items-center pl-3">
                                            <input
                                                :id="
                                                    'production-checksheet-radio-' +
                                                    sectionIndex +
                                                    '-' +
                                                    questionNumber +
                                                    '-' +
                                                    optionIndex
                                                "
                                                :name="
                                                    'production-checksheet-radio-' +
                                                    sectionIndex +
                                                    '-' +
                                                    questionNumber
                                                "
                                                v-model="
                                                    form.fieldAnswers[
                                                        question.label
                                                    ]
                                                "
                                                :value="option.label"
                                                type="radio"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                                :required="question.required"
                                            />
                                            <label
                                                :for="
                                                    'production-checksheet-radio-' +
                                                    sectionIndex +
                                                    '-' +
                                                    questionNumber +
                                                    '-' +
                                                    optionIndex
                                                "
                                                :style="{ color: option.color }"
                                                class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                            >
                                                {{ option.label }}
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </template>
                            <!-- If the question type is checkbox -->
                            <template v-if="question.type === 'checkbox'">
                                <div
                                    v-for="(
                                        option, optionIndex
                                    ) in question.options"
                                    :key="optionIndex"
                                    class="flex items-center mb-1"
                                >
                                    <input
                                        :id="'checkbox' + optionIndex"
                                        type="checkbox"
                                        :value="option.label"
                                        :checked="
                                            form.fieldAnswers[question.label] &&
                                            form.fieldAnswers[
                                                question.label
                                            ].includes(option.label)
                                        "
                                        @change="
                                            toggleCheckbox(
                                                option.label,
                                                question.label
                                            )
                                        "
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                    />
                                    <label
                                        :for="'checkbox' + optionIndex"
                                        class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                                        :required="question.required"
                                        >{{ option.label }}</label
                                    >
                                </div>
                            </template>

                            <template v-if="question.type === 'dropdown'">
                                <!-- Dropdown (select) rendering -->
                                <select
                                    :id="
                                        'production-checksheet-select-' +
                                        sectionIndex +
                                        '-' +
                                        questionNumber +
                                        '-' +
                                        optionIndex
                                    "
                                    :name="
                                        'production-checksheet-select-' +
                                        sectionIndex +
                                        '-' +
                                        questionNumber +
                                        '-' +
                                        optionIndex
                                    "
                                    v-model="form.fieldAnswers[question.label]"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                >
                                    <option value=""></option>
                                    <option
                                        v-for="(
                                            option, optionName
                                        ) in question.options"
                                        :key="optionName"
                                        :value="option.label"
                                    >
                                        {{ option.label }}
                                    </option>
                                </select>
                            </template>
                        </div>
                    </section>
                </div>
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
                        <h5 id="question8">Remarks on the Model</h5>
                        <label
                            for="message"
                            class="block mb-2 text-sm font-medium dark:text-white"
                            >Please type possible problems regarding with the
                            machine.
                            <span class="text-sm" style="color: red"> * </span>
                        </label>
                        <textarea
                            v-model="form.fieldAnswers['Remarks on the Model']"
                            id="message"
                            rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Write here..."
                        ></textarea>
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

<script setup>
import {  onMounted, reactive } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
const { formData, models } = defineProps({
    formData: Object,
    models: Array,
});
let form = reactive({
    form_id: formData.id,
    fieldAnswers: {},
});
const submit = async () => {
    // Show a confirmation dialog before submitting
    const confirmResult = await Swal.fire({
        title: "Before Submitting",
        text: "Please confirm that every field is filled up and correct before submitting. \
                    After submitting, it will be reviewed by a Line Leader and QC.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Submit",
        cancelButtonText: "Cancel",
    });
    if (confirmResult.isConfirmed) {
        try {
            const response = await axios.post("/submit", form);

            if (response.status == 200) {
                const success = await Swal.fire({
                    title: "Success",
                    text: "The form was successfully submitted.",
                    icon: "success",
                    confirmResultText: "OK",
                });
            } else {
                const error = await Swal.fire({
                    title: "Error",
                    text: "There was an error submitting the form.",
                    icon: "error",
                    confirmResultText: "OK",
                });
            }

            form.fieldAnswers = {};
        } catch (error) {
            console.error("Form submission error", error);
        }
    }
};
onMounted(() => {
    // Initialize fieldAnswers for checkbox questions
    const formContent = JSON.parse(formData.form_data).form_content;
    for (const section of Object.values(formContent)) {
        for (const question of Object.values(section.section_content)) {
            if (question.type === "checkbox") {
                form.fieldAnswers[question.label] = [];
            }
        }
    }
});
const toggleCheckbox = (optionLabel, questionLabel) => {
    const selectedOptions = form.fieldAnswers[questionLabel];
    const optionIndex = selectedOptions.indexOf(optionLabel);
    if (optionIndex === -1) {
        // If not found in the array, add it
        selectedOptions.push(optionLabel);
    } else {
        // If found in the array, remove it
        selectedOptions.splice(optionIndex, 1);
    }
};
</script>
