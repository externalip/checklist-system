<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Filter from "./Filter.vue";
import Pagination from "@/Shared/Pagination.vue";
import { Link, router } from "@inertiajs/vue3";

const props = defineProps({
    forms: Object,
});
const confirmDelete = async (formID) => {
    try {
        const confirmation = await Swal.fire({
            title: "Confirm Delete",
            text: "Are you sure you want to delete this form?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
        });

        if (!confirmation.isConfirmed) {
            return;
        }

        const deleteLink = route("checksheet.delete");
        const result = await axios.delete(deleteLink, { data: { id: formID } });

        if (result.status == 200) {
            await Swal.fire({
                title: "Deleted!",
                text: "The form has been deleted.",
                icon: "success",
                timer: 1500,
                showConfirmButton: true,
            });

            setTimeout(() => {
                window.location.reload(true);
            }, 500);
        } else {
            await Swal.fire({
                title: "Error!",
                text: "An error occurred while deleting the form.",
                icon: "error",
                showCancelButton: false,
                confirmButtonText: "OK",
            });
        }
    } catch (error) {
        await Swal.fire({
            title: "Error!",
            text: `An error occurred while deleting the form. ${error}`,
            icon: "error",
            showCancelButton: false,
            confirmButtonText: "OK",
        });
    }
};
</script>

<template>
    <AppLayout title="Checksheet Manager">
        <!-- Checksheet Manager Container -->
        <div class="lg:mx-20 mx-3">
            <Filter />

            <section id="checksheet-registered-table">
                <section id="checksheet-table-section">
                    <div class="rounded-lg relative overflow-x-auto">
                        <!-- Table -->
                        <table
                            class="rounded-lg w-full text-sm text-center text-gray-500 dark:text-gray-400"
                        >
                            <!-- Table Headers -->
                            <thead
                                class="text-xs text-white uppercase bg-[--blue] dark:bg-gray-700 dark:text-gray-400"
                            >
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Checksheet ID
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Checksheet Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Created by
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Date Created
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Last Edited
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Actions
                                    </th>
                                </tr>
                            </thead>

                            <!-- Table Content -->
                            <tbody class="text-xs">
                                <tr
                                    v-for="form in forms.data" :key="form.id"
                                    class="text-gray-700 bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 transition ease-in-out duration-200"
                                >
                                    <td
                                        scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                    >
                                        {{ form.id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="/revision" class="font-bold text-[--blue] hover:text-black underline">
                                            {{ form.form_name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ form.created_by_name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ form.created_at }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ form.updated_at }}
                                    </td>

                                    <!-- Action Buttons -->
                                    <td
                                        class=" flex justify-center align-center items-center mx-10"
                                    >
                                        <!-- DCC Redirect Button -->
                                        <button
                                            @click="callDCC()"
                                            class="hover:bg-gray-200 transition duration-200 ease-in-out p-4"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"
                                                class="w-4 h-4"
                                            >
                                                <g fill="none">
                                                    <path
                                                        d="M24 0v24H0V0h24ZM12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035c-.01-.004-.019-.001-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427c-.002-.01-.009-.017-.017-.018Zm.265-.113l-.013.002l-.185.093l-.01.01l-.003.011l.018.43l.005.012l.008.007l.201.093c.012.004.023 0 .029-.008l.004-.014l-.034-.614c-.003-.012-.01-.02-.02-.022Zm-.715.002a.023.023 0 0 0-.027.006l-.006.014l-.034.614c0 .012.007.02.017.024l.015-.002l.201-.093l.01-.008l.004-.011l.017-.43l-.003-.012l-.01-.01l-.184-.092Z"
                                                    />
                                                    <path
                                                        fill="currentColor"
                                                        d="M11 6a1 1 0 1 1 0 2H5v11h11v-6a1 1 0 1 1 2 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6Zm9-3a1 1 0 0 1 1 1v5a1 1 0 1 1-2 0V6.414l-8.293 8.293a1 1 0 0 1-1.414-1.414L17.586 5H15a1 1 0 1 1 0-2Z"
                                                    />
                                                </g>
                                            </svg>
                                        </button>
                                        <!-- Edit Button -->
                                        <Link
                                            type="button"
                                            :href="
                                                route(
                                                    'checksheet.edit',
                                                    form.id
                                                )
                                            "
                                            class="hover:bg-gray-200 transition duration-200 ease-in-out p-4"
                                        >
                                            <svg
                                                class="w-4 h-4 text-gray-800 dark:text-white"
                                                aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 20 20"
                                            >
                                                <g
                                                    stroke="currentColor"
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                >
                                                    <path
                                                        d="M19 11V9a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L12 2.757V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L2.929 4.343a1 1 0 0 0 0 1.414l.536.536L2.757 8H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535L8 17.243V18a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H18a1 1 0 0 0 1-1Z"
                                                    />
                                                    <path
                                                        d="M10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"
                                                    />
                                                </g>
                                            </svg>
                                        </Link>

                                        <!-- Delete Button -->
                                        <button
                                            type="button"
                                            @click="confirmDelete(form.id)"
                                            class="hover:bg-gray-200 transition duration-200 ease-in-out p-4"
                                        >
                                            <svg
                                                class="w-4 h-4 text-gray-800 dark:text-white"
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
                                                    d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z"
                                                />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </section>
            <Pagination :data="forms" />
        </div>
    </AppLayout>
</template>

<script>
export default {
    name: "checksheet",
    methods: {
        callEditor(form_id, form_config) {
            router.get("checksheet/editor", { form_id, form_config });
        },
        callCreator() {
            router.get("/generate");
        },
        callDCC() {
            router.get("/dcc");
        }
    },
};
</script>
