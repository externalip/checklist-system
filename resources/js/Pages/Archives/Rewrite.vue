<template>
    <AppLayout title="Archives">
        <!-- Select option -->
        <section>
            <h4>Filter by:</h4>
            <div class="mb-4 grid md:grid-cols-3 gap-4">
                <!-- User Name Filter -->
                <div>
                    <label class="inline-block text-sm">Select Check sheet</label>
                    <div>
                        <select v-model="selectedOption" class="w-full rounded-lg">
                            <option value=""></option>
                            <option v-for="form in forms" :key="form.id" :value="form.id">
                                {{ form.form_name }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Operator Name -->
                <div>
                    <label class="inline-block text-sm">Performed by</label>
                    <div>
                        <select v-model="selectedUser" class="w-full rounded-lg">
                            <option value="default">Default</option>
                            <option v-for="employee in employees" :key="employee.id" :employee="employee.id" :value="employee.first_name">
                                {{ employee.last_name }},
                                {{ employee.first_name }}
                            </option>
                        </select>
                    </div>
                </div>

                <!-- Date Range Filter -->
                <div>
                    <label class="inline-block text-sm">Choose Date Range</label>
                    <div class="w-full">
                        <VueDatePicker placeholder="Select a Date Range" v-model="selectedDateRange" range />
                    </div>
                </div>
            </div>
        </section>
        <table>
            <thead>
                <!-- Loop through the json response from response_field.data.form_data -->
                <tr>
                    <th v-for="field in response_fields.data" :key="field.id">
                        {{ JSON.parse(field.form_data).form_content.section1.section_name }}
                    </th>
                </tr>
            </thead>
        </table>
    </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
const props = defineProps({
    response_fields: Array,
    counts: Array,
    forms: Array,
    employees: Array,
    sign: Array,
});
</script>
