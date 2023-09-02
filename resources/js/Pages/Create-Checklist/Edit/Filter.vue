<template>
    <section id="checksheet-filter-section">
        <div class="model-filter-header">
            <h4>Filter by:</h4>
        </div>
        <section id="checksheet-filters" class="mb-5 grid lg:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-3">
            <div id="checksheet-filter-name-search">
                <form>
                    <label for="filter-name-search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search by Checksheet Name</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                        </div>
                        <input v-model="name" type="search" id="default-search-name" class="block w-full p-2.5 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Search Checksheet Name" required>
                    </div>
                </form>
            </div>
            <div id="checksheet-add-btn">
                <label for="filter-user-select" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Click to Add Checksheet</label>
                <Link type="button" :href="route('generate')" class="w-60 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-12 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 flex items-center gap-3 justify-center"> Create Form <svg class="w-3 h-3 text-gray-100 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778" />
              </svg>
                </Link>
            </div>
        </section>
    </section>
</template>

<script setup>
import { Link, router } from "@inertiajs/vue3";
import { watch, ref } from "vue";

let name = ref('');
let props = defineProps({filters: Object});
const updateFilters = (name) => {
    const filter = { ...props.filters};
    if(name){
        filter.name = name;
    }
    router.get(route('checksheet'), filter, {
        preserveState: true,
        preserveScroll: true,
        replace: true,
    })
};
watch(name, updateFilters);
</script>
