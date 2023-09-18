<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <AppLayout title="Amendment Record Sheet">
        <div class="lg:mx-20">
            <!-- Amendment Information Section -->
            <section class="text-center mb-4">
                <h2 class="text-2xl">{{}}FORM NAME (FFC Alignment Procedure)</h2>
            </section>

            <!-- Amendment Table Section -->
            <section>
                <div class="rounded-lg relative overflow-x-auto">
                    <table
                        class="w-full text-sm text-center text-wrap text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-white uppercase bg-[--blue] dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Amendment Number
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Page No. Affected
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Effectivity Date
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Description of Change
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Originator
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Date Issue
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                class="bg-white hover:bg-gray-100 duration-200 border-b dark:bg-gray-800 dark:border-gray-700"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-wrap dark:text-white"
                                >
                                    1
                                </th>
                                <td class="px-6 py-4"></td>
                                <td class="px-6 py-4">11-Jun-14</td>
                                <td class="px-6 py-4 flex flex-col">
                                    <h5 class="text-xs">
                                        1.0 Initial Release
                                    </h5>
                                    <span>Tried Changing Colors</span>
                                    <span>Tried Changing red</span>
                                    <span>Tried Changing green</span>
                                    <span>Tried Changing green</span>
                                    <span>Tried Changing violet</span>
                                </td>
                                <td class="px-6 py-4">G. Alipor</td>
                                <td class="px-6 py-4">19-Mar-15:12:12:12</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Pagination -->
            <section></section>
        </div>
    </AppLayout>
</template>
