<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<style scoped></style>

<template>
    <AppLayout title="5sChecklist">
        <div class="5s">
            <div id="header" class="lg:mx-20">
                <h1 class="">5s Checklist</h1>
            </div>

            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 class="mb-2">Model Identification</h2>
                <!-- Model Name -->
                <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5>Model Name</h5>

                    <label for="models" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a
                        model</label>
                    <select id="models"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Choose a model to check</option>
                        <option value="US">Model Example 1</option>
                        <option value="CA">Model Example 2</option>
                        <option value="FR">Model Example 3</option>
                        <option value="DE">Model Example 4</option>
                    </select>

                </div>

                <!-- Lot Number -->
                <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5>Lot Number</h5>
                    <div class="">
                        <label for="models" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Input the
                            Lot Number</label>
                        <input type="text" id="ltnum"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    </div>
                </div>

                <!-- Type of Checking -->
                <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5>Type of Checking</h5>


                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="horizontal-list-radio-startup" type="radio" value="startup"
                                    name="type-of-checking-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="horizontal-list-radio-startup"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Start-up
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="horizontal-list-radio-restartup" type="radio" value="restartup"
                                    name="type-of-checking-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="horizontal-list-radio-restartup"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Re-Startup</label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="horizontal-list-radio-changemodel" type="radio" value="changemodel"
                                    name="type-of-checking-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="horizontal-list-radio-changemodel"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Change
                                    Model</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 class="mb-2">Checking Items</h2>

                <!-- Production Checklist -->
                <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5>Production Checksheet</h5>

                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="production-checksheet-radio-ok" type="radio" value="ok"
                                    name="production-checksheet-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="production-checksheet-radio-ok"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="production-checksheet-radio-ng" type="radio" value="ng"
                                    name="production-checksheet-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="production-checksheet-radio-ng"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="production-checksheet-radio-na" type="radio" value="th"
                                    name="production-checksheet-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="production-checksheet-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Procedures/OPL/Work Instructions -->
                <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5>Procedures/OPL/Work Instructions</h5>

                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="powi-radio-ok" type="radio" value="ok" name="powi-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="powi-radio-ok"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="powi-radio-ng" type="radio" value="ng" name="powi-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="powi-radio-ng"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="powi-radio-na" type="radio" value="na" name="powi-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="powi-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Working Area -->
                <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5>Working Area</h5>

                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="working-area-radio-ok" type="radio" value="ok" name="working-area-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="working-area-radio-ok"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="working-area-radio-ng" type="radio" value="ng" name="working-area-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="working-area-radio-ng"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="working-area-radio-na" type="radio" value="na" name="working-area-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="working-area-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Materials -->
                <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5>Materials</h5>

                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="materials-radio-ok" type="radio" value="ok" name="materials-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="materials-radio-ok"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="materials-radio-ng" type="radio" value="ng" name="materials-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="materials-radio-ng"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="materials-radio-na" type="radio" value="na" name="materials-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="materials-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>
                    </ul>
                </div>

                <!-- Tools/Jigs Instrument -->
                <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 sm:py-5 rounded-md sm:rounded-md">
                    <h5>Tools/Jigs Instrument</h5>
                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg sm:flex dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="tools-radio-ok" type="radio" value="ok" name="tools-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tools-radio-ok"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">OK
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="tools-radio-ng" type="radio" value="ng" name="tools-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tools-radio-ng"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NG
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center pl-3">
                                <input id="tools-radio-na" type="radio" value="na" name="tools-radio"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="tools-radio-na"
                                    class="w-full py-3 ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">NA</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

            <section id="form-section" class="p-10 mt-5 mb-5 lg:mx-20 bg-gray-100 rounded-lg">
                <h2 class="mb-2">Remarks</h2>
                <div id="question" class="bg-gray-200 mb-3 py-5 px-10 md:px-10 md:py-5 rounded-md md:rounded-md">
                    <h5>Remarks on the Model</h5>
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Please type
                        possible problems regarding with the machine.</label>
                    <textarea id="message" rows="4"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write here...">
                    </textarea>
                </div>
            </section>

            <section id="button-group" class="place-content-end mt-5 mb-5 lg:mx-20 align-right justify-right flex">
                <!-- Back Button -->
                <button type="button"
                    class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Back</button>

                <!-- Submit Button -->
                <button type="button"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Submit
                </button>
            </section>
        </div>
    </AppLayout>
</template>
