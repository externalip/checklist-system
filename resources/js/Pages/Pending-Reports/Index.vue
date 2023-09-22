<style>
.hidden_div {
    display: none;
}
</style>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { reactive, onMounted, watch } from "vue";

const showDiv = (selectedFormName) => {
    // Hide all hidden divs first
    const hiddenDivs = document.getElementsByClassName("hidden_div");
    for (let i = 0; i < hiddenDivs.length; i++) {
        hiddenDivs[i].style.display = "none";
    }

    // Show the selected hidden div
    const selectedDiv = document.getElementById(selectedFormName);
    if (selectedDiv) {
        selectedDiv.style.display = "block";
    }
};
let selectedForm = reactive({
    form_name: null,
});

watch(
    () => selectedForm.form_name,
    (newValue) => {
        setTimeout(() => {
            showDiv(newValue);
        }, 0);
    }
);

onMounted(() => {
    // Retrieve form_name from the query parameters
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const formNameFromQuery = urlParams.get("form_name");

    // Set the retrieved form_name to selectedForm
    if (formNameFromQuery) {
        selectedForm.form_name = formNameFromQuery;
    }
});
const parsedArray = (data) => {
    if (Array.isArray(data)) {
        return data.join(", ");
    } else {
        return data;
    }
};
//Validation
const submit = async (status, id) => {
    if (status === "OK" || status === "Rejected") {
        const { isConfirmed } = await Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText:
                status === "OK" ? "Yes, Approve it!" : "Yes, Reject it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true,
        });

        if (!isConfirmed) {
            return;
        }

        try {
            const response = await axios.put(
                route("Pending-Reports.update", { status, id })
            );
            if (response.data.status === "success") {
                Swal.fire({
                    icon: "success",
                    title: status === "OK" ? "Approved!" : "Rejected!",
                    text: `Checklist has been ${
                        status === "OK" ? "approved" : status.toLowerCase()
                    }.`,
                    confirmButtonText: "OK",
                }).then(() => window.location.reload(true));
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Failed!",
                    text: `Checklist has not been ${status.toLowerCase()}.`,
                    confirmButtonText: "OK",
                }).then(() => window.location.reload(true));
            }
        } catch (e) {
            Swal.fire({
                icon: "error",
                title: "Failed!",
                text: `Checklist has not been ${status.toLowerCase()}. error: ${e}`,
            });
        }
    }
};

// Returns color hex string
function colorCode(question, answer) {
    // Check if question type is text
    if (question.type == "text") {
        return "border-black text-black text-center";
    }

    // Loop through all answers
    for (const optionKey in question.options) {
        const option = question.options[optionKey];

        if (option.label === answer) {
            // Return corresponding color coding
            if (option.color == "clear") {
                return "border-black text-black text-center";
            } else {
                return "bg-[" + option.color + "] text-white text-center";
            }
        }
    }
}
</script>

<template>
    <AppLayout title="Pending Reports">
        <div id="pending-reports" class="2xl:mx-[30%] xl:mx-[25%] lg:mx-[20%]">
            <h4 class="text-[--blue]">Filter by:</h4>
            <section id="pending-filters" class="lg:flex lg:space-x-2 py-3">
                <!-- Dropdown  Select -->
                <section
                    id="checklist-dropdown"
                    class="lg:w-full mb-2 rounded-lg"
                >
                    <label
                        for="pending-checklists"
                        class="block mb-2 text-sm font-medium text-[--blue] dark:text-white"
                        >Choose a checklist</label
                    >
                    <select
                        v-model="selectedForm.form_name"
                        id="pending-checklists"
                        class="bg-gray-50 border border-gray-300 text-[#3182ce] text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        @change="showDiv(selectedForm.form_name)"
                    >
                        <option value="">Select a Form</option>
                        <option v-for="form in forms" :key="form.id" :value="form.id">{{ form.form_name }}</option>
                    </select>
                </section>

                <!-- Searchbar -->
                <section id="pending-search" class="lg:w-full mb-2 rounded-lg">
                    <label
                        for="pending-searchbar"
                        class="block mb-2 text-sm font-medium text-[--blue] dark:text-white"
                        >Search a Model</label
                    >
                    <form class="flex items-center">
                        <label for="pending-searchbar" class="sr-only"
                            >Search</label
                        >
                        <div class="relative w-full">
                            <div
                                class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                            >
                                <svg
                                    class="w-4 h-4 text-gray-500 dark:text-gray-400"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 18 20"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"
                                    />
                                </svg>
                            </div>
                            <input
                                type="text"
                                id="pending-searchbar"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Type here..."
                                required
                            />
                        </div>
                        <button
                            type="submit"
                            class="p-2.5 ml-2 text-sm font-medium text-white bg-[--blue] rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        >
                            <svg
                                class="w-4 h-4"
                                aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                                />
                            </svg>
                            <span class="sr-only">Search</span>
                        </button>
                    </form>
                </section>

                <section id="export-btn" class="lg:w-1/6 rounded-lg">
                    <label
                        for="export-dropdown"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Export Pending</label
                    >
                    <button
                        id="export-dropdown"
                        data-dropdown-toggle="dropdown"
                        class="text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button"
                    >
                        Export<svg
                            class="w-2.5 h-2.5 ml-2.5"
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
                                d="m1 1 4 4 4-4"
                            />
                        </svg>
                    </button>
                    <!-- Dropdown menu -->
                    <div
                        id="dropdown"
                        class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700"
                    >
                        <ul
                            class="py-2 text-sm text-gray-700 dark:text-gray-200"
                            aria-labelledby="dropdownDefaultButton"
                        >
                            <li>
                                <a
                                    href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    >to PDF</a
                                >
                            </li>
                            <li>
                                <a
                                    href="#"
                                    class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                                    >to MExcel</a
                                >
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- Export Button -->
            </section>
            <!-- Pending reports section -->
            <section id="pending-accordions">
                <div :id="selectedForm.form_name" class="hidden_div accordions">
                    <div v-for="formcount in formcount" :key="formcount.id">
                        <div v-if="formcount.id == selectedForm.form_name">
                            <h4 class="font-bold"><span class="text-[--overdue] font-bold">{{ formcount.pending_count
                            }}</span> Pending Reports on {{ formcount.form_name }}</h4>
                        </div>
                    </div>

                    <!-- Loop to display all pending reports -->
                    <div
                        v-for="(row, index) in data"
                        :key="index"
                        id="accordion-flush"
                        data-accordion="collapse"
                        data-active-classes="bg-white dark:bg-gray-900 text-blue-500 dark:text-white"
                        data-inactive-classes="text-gray-500 dark:text-gray-400" class="border-lg">
                        <ul v-show="row.form_id == selectedForm.form_name">
                            <h2 :id="'accordion-flush-heading-' + index.toString()">
                                <button type="button"
                                    class="flex items-center justify-between w-full py-5 text-lg font-regular antialiased text-left border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                                    :data-accordion-target="
                                        '#accordion-flush-body-' +
                                        index.toString()
                                    "
                                    aria-expanded="false"
                                    :aria-controls="
                                        'accordion-flush-body-' +
                                        index.toString()
                                    "
                                >
                                    <!-- {{ Name of the Submitted Model by the Operator }} -->
                                    <span
                                        >{{
                                            JSON.parse(row.response)
                                                .fieldAnswers["Model Name"]
                                        }}
                                        <span
                                            class="bg-orange-100 text-orange-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-2"
                                            >to be signed
                                        </span>
                                    </span>

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
                                :id="'accordion-flush-body-' + index.toString()"
                                class="hidden border-2 border-gray-100"
                                :aria-labelledby="
                                    'accordion-flush-heading-' +
                                    index.toString()
                                "
                            >
                                <!-- Record Details Lot Number ||  Operator || Type of Checking || Shift -->
                                <div
                                    id="pending-record-details"
                                    class="bg-gray-100 text-[--blue] p-3 px-12 grid grid-cols-3 lg:items-center text-center lg:justify-between"
                                >
                                    <div id="lot-number" class="">
                                        <label for="" class="text-sm"
                                            >Lot Number</label
                                        >
                                        <h5 class="font-bold">
                                            {{
                                                JSON.parse(row.response)
                                                    .fieldAnswers["Kit Number"]
                                            }}
                                            {{
                                                JSON.parse(row.response)
                                                    .fieldAnswers["Lot Number"]
                                            }}
                                        </h5>
                                    </div>

                                    <div id="performed-by" class="">
                                        <label for="" class="text-sm"
                                            >Performed by</label
                                        >
                                        <h5 class="font-bold">
                                            {{ row.first_name }}
                                            {{ row.last_name }}
                                        </h5>
                                    </div>

                                    <div id="shift" class="">
                                        <label for="" class="text-sm"
                                            >Shift</label
                                        >
                                        <h5 class="font-bold">
                                            {{ row.shift }}
                                        </h5>
                                    </div>
                                </div>

                                <!-- Record Section Checksheet -->
                                <div
                                    id="pending-record-section"
                                    class="p-3 lg:flex lg:flex-col"
                                >
                                    <!-- Header -->
                                    <div
                                        v-for="(
                                            section, sectionIndex
                                        ) in JSON.parse(row.form_data)
                                            ?.form_content"
                                        :key="sectionIndex"
                                    >
                                        <h3
                                            class="font-bold text-2xl pending-section-header px-5"
                                        >
                                            {{ section.section_name }}
                                        </h3>

                                        <!-- Table -->
                                        <div
                                            class="relative overflow-x-auto p-5"
                                        >
                                            <table
                                                class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                                            >
                                                <thead
                                                    class="text-s text-white uppercase bg-[--blue] dark:bg-gray-700 dark:text-gray-400"
                                                >
                                                    <tr>
                                                        <!-- Description coming from the Checklist -->
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3"
                                                        >
                                                            Description
                                                        </th>
                                                        <!-- Status OK | NG | NA Depends on the RadioButton of the Checklist -->
                                                        <th
                                                            scope="col"
                                                            class="px-6 py-3"
                                                        >
                                                            Status
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <!-- Displays pending reports data -->
                                                <tbody>
                                                    <tr
                                                        v-for="(
                                                            question,
                                                            questionIndex
                                                        ) in section.section_content"
                                                        :key="questionIndex"
                                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                                    >
                                                        <th
                                                            scope="row"
                                                            class="w-full text-[--blue] px-6 py-4 font-medium whitespace-wrap text-gray-900 dark:text-white"
                                                        >
                                                            {{ question.label }}
                                                        </th>

                                                        <td
                                                            :class="
                                                                colorCode(
                                                                    question,
                                                                    JSON.parse(
                                                                        row.response
                                                                    )
                                                                        .fieldAnswers[
                                                                        question
                                                                            .label
                                                                    ]
                                                                )
                                                            "
                                                        >
                                                            {{
                                                                parsedArray(
                                                                    JSON.parse(
                                                                        row.response
                                                                    )
                                                                        .fieldAnswers[
                                                                        question
                                                                            .label
                                                                    ]
                                                                )
                                                            }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <!-- Record Section Signatures -->
                                <div
                                    id="pending-record-signature"
                                    class="p-3 lg:flex lg:flex-col"
                                >
                                    <!-- Header -->
                                    <div class="pending-section-header px-5">
                                        <h3
                                            class="font-bold text-2xl text-[--blue]"
                                        >
                                            Signatures
                                        </h3>
                                    </div>

                                    <!-- Table -->
                                    <div class="relative overflow-x-auto p-5">
                                        <table
                                            class="rounded-full w-full text-sm text-left text-gray-500 dark:text-gray-400"
                                        >
                                            <thead
                                                class="text-s text-white uppercase bg-[--blue] dark:bg-gray-700 dark:text-gray-400"
                                            >
                                                <tr>
                                                    <!-- Description coming from the Checklist -->
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3"
                                                    >
                                                        Person to sign
                                                    </th>
                                                    <!-- Status OK | NG | NA Depends on the RadioButton of the Checklist -->
                                                    <th
                                                        scope="col"
                                                        class="px-6 py-3"
                                                    >
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Signature -->
                                                <tr
                                                    v-for="sign in signatures"
                                                    :key="sign.id"
                                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                                >
                                                    <th
                                                        v-if="
                                                            sign.response_id ==
                                                            row.id
                                                        "
                                                        scope="row"
                                                        class="w-full text-[--blue] px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white"
                                                    >
                                                        {{
                                                            sign.required_sign_role
                                                        }}
                                                    </th>
                                                    <td
                                                        v-if="
                                                            sign.response_id ==
                                                            row.id
                                                        "
                                                        :class="
                                                            sign.status == 'OK'
                                                                ? 'px-6 py-4 text-center text-[#FFFFFF] bg-[#1FAC3C]'
                                                                : 'px-6 py-4 text-center text-[#FFFFFF] bg-[#E33A3A]'
                                                        "
                                                    >
                                                        {{ sign.status }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div
                                    id="pending-record-remarks"
                                    class="p-3 lg:flex lg:flex-col"
                                >
                                    <!-- Header -->
                                    <div class="pending-section-header px-5">
                                        <h3 class="font-bold text-2xl">Remarks</h3>
                                    </div>

                                    <!-- Disabled TextArea -->
                                    <div class="pending-record-remark px-5">
                                        <label
                                            for="message"
                                            class="block mb-2 text-sm font-medium text-[--blue] dark:text-white"
                                            >Operator's Remark on the
                                            Model</label
                                        >
                                        <textarea
                                            id="message"
                                            rows="4"
                                            class="resize-none disabled:opacity-90 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            :placeholder="
                                                JSON.parse(row.response)
                                                    .fieldAnswers[
                                                    'Remarks on the Model'
                                                ]
                                            "
                                            disabled
                                        ></textarea>
                                    </div>
                                </div>

                                <div
                                    v-if="
                                        !$page.props.auth.user.roles.includes(
                                            'Operator'
                                        )
                                    "
                                    class="pb-5"
                                >
                                    <!-- Button -->
                                    <div
                                        id="pending-sign-btn"
                                        class="px-5 p-2 w-full flex justify-end"
                                    >
                                        <!-- Reject Button -->

                                        <button
                                            type="button"
                                            href="#"
                                            @click="submit('Rejected', row.id)"
                                            class="focus:outline-none text-white bg-[--red] hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"
                                        >
                                            Reject
                                        </button>

                                        <!-- </router-link> -->

                                        <!-- Approve Button -->
                                        <button
                                            type="button"
                                            href="#"
                                            @click="submit('OK', row.id)"
                                            class="text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                                        >
                                            Approve
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </div>
                </div>

                <!-- Pagination -->
            </section>
        </div>
    </AppLayout>
</template>

<script>
let configs = [];
export default {
    props: {
        forms: Array,
        formcount: Array,
        selectedFormName: Array,
        data: Array,
        signatures: Array,
        counts: Number,
        config: Array,
    },
    created() {
        let formData = this.config;

        configs = formData;
    },
};
</script>
