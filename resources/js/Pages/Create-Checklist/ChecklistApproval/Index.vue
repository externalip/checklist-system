<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <AppLayout title="Checklists Approval">
        <div class="lg:mx-20">
            <!-- Approval Accordion -->
            <section>
                <div
                    id="accordion-flush"
                    data-accordion="collapse"
                    data-active-classes="bg-white dark:bg-gray-900 text-blue-900 dark:text-white"
                    data-inactive-classes="text-gray-500 dark:text-gray-400"
                >
                    <!-- Name of the to be approve checksheet -->
                    <h2 id="accordion-flush-heading-1">
                        <button
                            type="button"
                            class="flex items-center justify-between w-full py-5 font-medium text-left text-blue-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                            data-accordion-target="#accordion-flush-body-1"
                            aria-expanded="true"
                            aria-controls="accordion-flush-body-1"
                        >
                            <span class="text-xl font-bold">
                                Test to be approve checksheet
                                <span
                                    class="bg-orange-100 text-orange-800 text-sm font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 ml-2"
                                    >to be approve
                                </span>
                            </span>
                            <svg
                                data-accordion-icon
                                class="w-3 h-3 rotate-180 transition-transform shrink-0"
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
                        id="accordion-flush-body-1"
                        class="hidden"
                        aria-labelledby="accordion-flush-heading-1"
                    >
                        <!-- Checklist Preparer -->
                        <div
                            id="checklist-pending-review-preparedBy"
                            class="grid md:grid-cols-3 gap-4 text-center p-4 bg-gray-200"
                        >
                            <!-- Prepared by Name -->
                            <div id="preparedBy">
                                <label for="" class="text-sm"
                                    >Prepared by:</label
                                >
                                <h5 class="font-bold">
                                    Ferdinand Carlo Molina Palo Jr. Sr. Mentor
                                </h5>
                            </div>

                            <!-- Prepared by Datetime -->
                            <div id="preparedBy-datetime">
                                <label for="" class="text-sm"
                                    >Date Created</label
                                >
                                <h5 class="font-bold">09-05-2023:12:12:12</h5>
                            </div>

                            <!-- Prepared by Form -->
                            <div
                                id="preparedBy-forms"
                                class="flex flex-col align-center justify-center items-center"
                            >
                                <label for="" class="text-sm"
                                    >See Created Form</label
                                >
                                <a
                                    href=""
                                    class="flex underline underline-offset-2 text-[--blue] font-bold visited:text-purple-600 ..."
                                >
                                    Click here
                                    <span
                                        ><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            width="18"
                                            height="18"
                                            viewBox="0 0 24 24"
                                        >
                                            <g fill="none">
                                                <path
                                                    d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"
                                                />
                                                <path
                                                    fill="currentColor"
                                                    d="M11 6a1 1 0 1 1 0 2H5v11h11v-6a1 1 0 1 1 2 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6Zm9-3a1 1 0 0 1 1 1v5a1 1 0 1 1-2 0V6.414l-8.293 8.293a1 1 0 0 1-1.414-1.414L17.586 5H15a1 1 0 1 1 0-2Z"
                                                />
                                            </g></svg
                                    ></span>
                                </a>
                            </div>
                        </div>

                        <!-- Checklist Signees -->
                        <div
                            id="checklist-pending-review-Signees"
                            class="p-4 border-b-2 border-x-2 border-gray-100"
                        >
                            <h4 class="font-bold">Signees</h4>
                            <div class="rounded-lg relative overflow-x-auto">
                                <table
                                    class="w-full text-sm text-center text-gray-500 dark:text-gray-400"
                                >
                                    <thead
                                        class="text-xs text-white uppercase bg-[--blue] dark:bg-gray-700 dark:text-gray-400"
                                    >
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Description
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Designation
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Signature
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Date
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Checked by: -->
                                        <tr
                                            class="duration-200 hover:bg-gray-100 bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                        >
                                            <th
                                                scope="row"
                                                class="px-6 py-3 font-medium text-gray-900 dark:text-white"
                                            >
                                                Checked by
                                            </th>
                                            <td class="px-6 py-3">
                                                Ferdinand Carlo Molina Palo Jr.
                                                Sr. Mentor
                                            </td>
                                            <td class="px-6 py-3">
                                                Production Sr. Supervisor
                                            </td>
                                            <td class="px-6 py-3">Signed</td>
                                            <td class="px-6 py-3">
                                                09-05-2023:12:12:12
                                            </td>
                                        </tr>

                                        <!-- Approved by: -->
                                        <tr
                                            class="duration-200 hover:bg-gray-100 bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                        >
                                            <th
                                                scope="row"
                                                class="px-6 py-3 font-medium text-gray-900 dark:text-white"
                                            >
                                                Approved by
                                            </th>
                                            <td class="px-6 py-3">
                                                Ferdinand Carlo Molina Palo Jr.
                                                Sr. Mentor 2
                                            </td>
                                            <td class="px-6 py-3">
                                                Production Section Head
                                            </td>
                                            <td class="px-6 py-3">Signed</td>
                                            <td class="px-6 py-3">
                                                09-05-2023:12:12:12
                                            </td>
                                        </tr>

                                        <!-- Approved by: -->
                                        <tr
                                            class="duration-200 hover:bg-gray-100 bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                        >
                                            <th
                                                scope="row"
                                                class="px-6 py-3 font-medium text-gray-900 dark:text-white"
                                            >
                                                Approved by
                                            </th>
                                            <td class="px-6 py-3">
                                                Ferdinand Carlo Molina Palo Jr.
                                                Sr. Mentor 3
                                            </td>
                                            <td class="px-6 py-3">
                                                Production Asst. Manager
                                            </td>
                                            <td class="px-6 py-3">Signed</td>
                                            <td class="px-6 py-3">
                                                09-05-2023:12:12:12
                                            </td>
                                        </tr>

                                        <!-- Approved by: -->
                                        <tr
                                            class="duration-200 hover:bg-gray-100 bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                        >
                                            <th
                                                scope="row"
                                                class="px-6 py-3 font-medium text-gray-900 dark:text-white"
                                            >
                                                Approved by
                                            </th>
                                            <td class="px-6 py-3">
                                                Ferdinand Carlo Molina Palo Jr.
                                                Sr. Mentor 4
                                            </td>
                                            <td class="px-6 py-3">
                                                Production Adviser
                                            </td>
                                            <td class="px-6 py-3">Signed</td>
                                            <td class="px-6 py-3">
                                                09-05-2023:12:12:12
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Checklist Distribution List -->
                        <div
                            id="distribution-list"
                            class="p-4 border-b-2 border-x-2 border-gray-100"
                        >
                            <h4 class="font-bold">Distribution List</h4>
                            <div class="rounded-lg relative overflow-x-auto">
                                <table
                                    class="w-full text-sm text-center text-gray-500 dark:text-gray-400"
                                >
                                    <thead
                                        class="text-xs text-white uppercase bg-[--blue] dark:bg-gray-700 dark:text-gray-400"
                                    >
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                MATECH-1
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                MATECH-2
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <!-- Checked by: -->
                                        <tr
                                            class="duration-200 hover:bg-gray-100 bg-white border-b dark:bg-gray-800 dark:border-gray-700"
                                        >
                                            <!-- TABLE DATA FOR MATECH-1 -->
                                            <td class="px-6 py-3"></td>
                                            <!-- TABLE DATA FOR MATECH-2 -->
                                            <td class="px-6 py-3">
                                                Brother Assembly Line
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Checklist Signees Buttons -->
                        <div
                            id="checklist-pending-Sign"
                            class="border-b-2 border-x-2 border-gray-100 p-4 flex place-content-end"
                        >
                            <button
                                type="button"
                                class="duration-200 text-white bg-[--blue] hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                            >
                                Sign
                            </button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </AppLayout>
</template>
