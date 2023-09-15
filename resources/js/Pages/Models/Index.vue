<template>
    <AppLayout title="Model Manager">
        <div id="model-manager" class="lg:mx-20 text-[--blue]">
            <Filter :Forms="Forms" />
            <!-- Add Model Modal  -->
            <form
                id="add-model-modal"
                data-modal-backdrop="static"
                tabindex="-1"
                aria-hidden="true"
                @submit.prevent="submitForm"
                class="fixed top-0 left-0 right-0 z-50 hidden p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            >
                <div class="relative w-full max-w-2xl max-h-full">
                    <!-- Modal content -->
                    <div
                        class="p-6 md:px-20 relative bg-white rounded-lg shadow dark:bg-gray-700"
                    >
                        <!-- Modal header -->
                        <div
                            class="flex items-start justify-between rounded-t dark:border-gray-600"
                        >
                            <h3
                                class="text-3xl font-semibold text-gray-900 dark:text-white"
                            >
                                Create Model
                            </h3>
                        </div>

                        <!-- Modal body -->
                        <div class="">
                            <!-- Name of the Model input -->
                            <div class="mb-2">
                                <label
                                    for="model_name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    >Model Name</label
                                >
                                <input
                                    type="text"
                                    v-model="form.model_name"
                                    id="model_name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-1.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Model Name..."
                                    required
                                />
                            </div>

                            <!-- Checklists Appearance Checkbox -->

                            <div
                                id="checklists-search"
                                class="z-10 bg-white rounded-lg shadow w-full dark:bg-gray-700"
                            >
                                <!-- Checkboxes -->
                                <ul
                                    class="h-48 px-3 pb-3 overflow-y-auto text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownSearchButton"
                                >
                                    <li
                                        v-for="(formItem, index) in Forms"
                                        :key="index"
                                    >
                                        <div
                                            class="flex items-center p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-600"
                                        >
                                            <input
                                                :id="
                                                    'checkbox-item-' +
                                                    formItem.id
                                                "
                                                type="checkbox"
                                                :value="formItem.id"
                                                v-model="SelectedForms"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500"
                                            />
                                            <label
                                                :for="
                                                    'checkbox-item-' +
                                                    formItem.id
                                                "
                                                class="w-full ml-2 text-sm font-medium text-gray-900 rounded dark:text-gray-300"
                                            >
                                                {{ formItem.form_name }}
                                            </label>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div
                            class="flex flex-col sm:flex-row md:justify-end justify-center align-center items-center mt-3 space-x-2 rounded-b gap-1"
                        >
                            <button
                                type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                Create Model
                            </button>
                            <button
                                data-modal-hide="add-model-modal"
                                type="button"
                                class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-4 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                            >
                                Back
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Model Table  -->
            <section id="model-table-section">
                <div class="rounded-lg relative overflow-x-auto">
                    <table
                        class="w-full text-sm text-center text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-white uppercase bg-[--blue] dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th
                                    scope="col"
                                    class="align-center items-center flex mx-6 my-3"
                                >
                                    <input
                                        type="checkbox"
                                        v-model="selectAll"
                                    />
                                    <button
                                        v-if="selectedModels?.length > 0"
                                        @click="deleteSelected"
                                        class="mx-2 hover:bg-gray-500 duration-200 transition-transform ease-in-out p-1 flex-none"
                                    >
                                        <img
                                            src="@/Shared/Icons/delete.svg"
                                            alt="Delete"
                                            class="w-4 h-4 cursor-pointer"
                                        />
                                    </button>
                                </th>
                                <th scope="col" class="p-1">Model ID</th>
                                <th scope="col" class="p-1">Model Name</th>
                                <th scope="col" class="p-1">
                                    Checksheet Appearance
                                </th>
                                <th scope="col" class="p-1">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-xs">
                            <template v-if="models.length === 0">
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        No models available.
                                    </td>
                                </tr>
                            </template>
                            <template v-else>
                                <tr
                                    v-for="model in models.data"
                                    :key="model.model_id"
                                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 transition ease-in-out duration-200"
                                >
                                    <td>
                                        <input
                                            type="checkbox"
                                            v-model="selectedModels"
                                            :value="model.model_id"
                                        />
                                    </td>

                                    <td class="p-1">
                                        {{ model.model_id }}
                                    </td>

                                    <td class="p-1">
                                        {{ model.model_name }}
                                    </td>

                                    <td class="p-1">
                                        {{
                                            model.checksheet_appearance
                                                ? model.checksheet_appearance
                                                : "No Checksheet Appearance"
                                        }}
                                    </td>

                                    <td
                                        class="p-1 flex justify-center items-center mx-10"
                                    >
                                        <button
                                            href="#"
                                            @click.prevent="
                                                editModel(model.model_id)
                                            "
                                            type="button"
                                            class="hover:bg-gray-200 transition duration-200 ease-in-out p-2 flex-none"
                                        >
                                            <img
                                                src="@/Shared/Icons/edit.svg"
                                                alt="edit icon"
                                                class="w-4 h-4 cursor-pointer flex-none"
                                            />
                                        </button>

                                        <button
                                            href="#"
                                            @click.prevent="
                                                deleteModel(model.model_id)
                                            "
                                            type="button"
                                            class="hover:bg-gray-200 transition duration-200 ease-in-out p-2 flex-none"
                                        >
                                            <img
                                                src="@/Shared/Icons/delete.svg"
                                                alt="Delete"
                                                class="w-4 h-4 cursor-pointer"
                                            />
                                        </button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                    </table>
                </div>
            </section>

            <div
                v-if="showEditModal"
                class="fixed inset-0 bg-black bg-opacity-50 z-40"
            >
                <Modal
                    v-if="showEditModal"
                    :id="editedModelId"
                    :Forms="Forms"
                    :closeModalCallback="closeModal"
                />
            </div>
            <Pagination :data="models" :preservestate="false" />
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import Modal from "./Components/EditModal.vue";
import Pagination from "@/Shared/Pagination.vue";
import Filter from "./Components/Filter.vue";
import { Inertia } from "@inertiajs/inertia";
const { Forms, models } = defineProps(["Forms", "models"]);
const SelectedForms = ref([]);

const showEditModal = ref(false);
const editedModelId = ref(null);
const selectedModels = ref([]);
const form = useForm({
    model_name: "",
    form_id: "",
});
const submitForm = async () => {
    form.model_name = form.model_name.trim();
    form.form_id = SelectedForms.value;

    try {
        await axios.post(route("models.store"), form);
        form.reset();
        const success = await Swal.fire({
            icon: "success",
            title: "Success",
            text: "Model submitted successfully!",
            confirmButtonText: "OK",
        });
        if (success.isConfirmed) {
            window.location.reload(true);
        }
    } catch (error) {
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: error.response.data.message,
            confirmButtonText: "OK",
        });
    }
};

const editModel = (id) => {
    editedModelId.value = id;
    showEditModal.value = true;
};
const closeModal = () => {
    showEditModal.value = false;
};
const deleteModel = async (id) => {
    const confirmed = await Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this model!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!",
    });
    if (confirmed.isConfirmed) {
        try {
            await axios.delete(route("models.destroy"), {
                data: {
                    id: id,
                },
            });
            Swal.fire({
                title: "Deleted!",
                text: "The model has been deleted.",
                icon: "success",
                confirmButtonColor: "#3085d6",
                confirmButtonText: "OK",
            }).then(() => {
                window.location.reload(true);
            });
        } catch (error) {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: error.response.data.message,
                confirmButtonText: "OK",
            });
        }
    }
};
const selectAll = computed({
    get: () => {
        if (!models.data || !selectedModels.value) {
            return false;
        }
        return selectedModels.value.length === models.data.length;
    },
    set: (value) => {
        if (!models.data) {
            return;
        }
        selectedModels.value = value
            ? models.data.map((model) => model.model_id)
            : [];
    },
});

const deleteSelected = async () => {
    if (selectedModels.value.length === 0) {
        return;
    }
    const sure = Swal.fire({
        icon: "warning",
        title: "Are you sure?",
        text: "You will not be able to recover these models!",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete them!",
    });
    sure.then(async (result) => {
        if (result.isConfirmed) {
            try {
                await axios.delete(route("models.destroy"), {
                    data: {
                        ids: selectedModels.value,
                    },
                });
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "Selected models deleted successfully!",
                    confirmButtonText: "OK",
                }).then(() => {
                    window.location.reload(true);
                });
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.response.data.message,
                    confirmButtonText: "OK",
                });
            }
        }
    });
};
</script>
