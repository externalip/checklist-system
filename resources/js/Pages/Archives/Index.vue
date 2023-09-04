<script>
export default {
    name: "App",
    //lets define the data
    data() {
        return {
            selectedOption: {},
            selectedUser: "default",
        };
    },
};
</script>

<template>
    <AppLayout title="Archives">
        <div class="lg:mx-20">
            <!-- Filter Section -->
            <section>
                <h4>Filter by:</h4>
                <div class="mb-4 grid md:grid-cols-3 gap-4">
                    <!-- User Name Filter -->
                    <div>
                        <label class="inline-block text-sm">Select Check sheet</label>
                        <div>
                            <select v-model="selectedOption" class="w-full rounded-lg">
                                <option value=""></option>
                                <option v-for="form in forms" :key="form.id" :value="form.form_name">
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
                                <option v-for="employee in employees" :employee="employee.id" :value="employee.first_name">
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

            <!-- 5S - Checklist -->
            <div v-if="selectedOption === '5S Start-Up Check Sheet'" class="relative overflow-x-auto shadow-md">
                <table id="myTable"
                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-solid border-2 border-black">
                    <thead style="background-color: #3c5393" class="border-solid border-2 border-black text-xs text-white">
                        <tr>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Date
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Shift
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Model Name
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Lot No.
                            </th>
                            <th colspan="3" class="border-solid border-2 border-black px-1 py-1">
                                Section Name
                            </th>
                            <th colspan="5" class="border-solid border-2 border-black px-1 py-1">
                                Checking Items
                            </th>
                            <th colspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Signatures
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                QC Confirmation
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Remarks
                            </th>
                        </tr>
                        <tr>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Start-up
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Re-startup
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Change Model
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Production Cheeksheets
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Procedures/OPL/Work Instructions
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Working Area
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Materials
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Tools/Jig Instrument
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Operator
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Lineleader/Technician /Supervisor/Engineer
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="response_field in response_fields.data">
                        <tr v-if="(response_field.form_id === 1 &&
                                selectedUser === 'default') ||
                            (response_field.form_id === 1 &&
                                response_field.first_name ===
                                selectedUser)
                            "
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <!-- Date -->
                            <th scope="row"
                                class="border-solid border-2 border-black px-1 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ response_field.created_at }}
                            </th>
                            <!-- Shift -->
                            <td class="border-solid border-2 border-black px-1 py-1">
                                {{ response_field.shift }}
                            </td>
                            <!-- Model Name -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Model Name"]
                                }}
                            </td>
                            <!-- Lot Number -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Lot Number"]
                                }}
                            </td>
                            <!-- Start-Up -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Type of Checking"] ===
                                    "Start-up"
                                    ? "OK"
                                    : ""
                                }}
                            </td>
                            <!-- Re-Startup -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Type of Checking"] ===
                                    "Re-startup"
                                    ? "OK"
                                    : ""
                                }}
                            </td>
                            <!-- Change Model -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Type of Checking"] ===
                                    "Change Model"
                                    ? "OK"
                                    : ""
                                }}
                            </td>
                            <!-- Production Checksheet -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Production Checksheet"]
                                }}
                            </td>
                            <!-- Procedures/OPL/Work Instructions -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers[
                                    "Procedures\/OPL\/Work Instructions"
                                    ]
                                }}
                            </td>
                            <!-- Working Area -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Working Area"]
                                }}
                            </td>
                            <!-- Materials -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Materials"]
                                }}
                            </td>
                            <!-- Tools/Jigs Instrument -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Tools\/Jigs Instrument"]
                                }}
                            </td>
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{ response_field.first_name }} {{ response_field.last_name }}
                            </td>
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{ response_field.line_leader_first_name }}
                            </td>
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{ response_field.qc_first_name }}
                            </td>
                            <!-- Remarks -->
                            <td class="border-solid border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Remarks on the Model"]
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- P-Touch Soldering -->
            <div v-if="selectedOption === 'P-Touch Soldering'" class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table id="myTable"
                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-solid border-2 border-black">
                    <thead style="background-color: #3c5393"
                        class="border-solid border-2 border-black text-xs text-white uppercase">
                        <tr>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Date
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Shift
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Model Name
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Lot No.
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Start_up
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Change Model
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Power Failure
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Change Tip
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Soldering Iron Set Condition
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Solder Machine Condeition
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Solder Wire
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Solder Wire Expiration Date
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Solder Tip Type
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Solder Tip Condition
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Solder Tip Temperature
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Resistance Value
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Leak Voltage Value
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Sponge/ Sponge Bin
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Soldering Jig ID Number
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Soldering Jig Appearance
                            </th>
                            <th colspan="1" rowspan="2"
                                class="whitespace-nowrap border-solid border-2 border-black px-1 py-1">
                                Component's Reference<br />
                                on Soldering Jig (if Applicable)
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Bamboo Stick
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Exhaust System
                            </th>
                            <th colspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Barcode Part No. (For D460 and D610 Main Only)
                            </th>
                            <th colspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Signatures
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                QC Confirmation
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Remarks
                            </th>
                        </tr>
                        <tr>
                            <th class="border-solid border-2 whitespace-nowrap border-black px-1 py-1">
                                D02484-D01 (D460 MAIN)
                            </th>
                            <th class="border-solid border-2 whitespace-nowrap border-black px-1 py-1">
                                D027CR-001 (D610 MAIN)
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Operator
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Lineleader/Technician /Supervisor/Engineer
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="response_field in response_fields.data">
                        <tr v-if="(response_field.form_id === 2 &&
                                selectedUser === 'default') ||
                            (response_field.form_id === 2 &&
                                response_field.submitted_by ===
                                selectedUser)
                            "
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <!-- Date -->
                            <th scope="row"
                                class="border-solid border-2 border-black px-1 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ response_field.created_at }}
                            </th>
                            <!-- Shift -->
                            <td class="border-solid border-2 border-black px-1 py-1">
                                {{ response_field.shift }}
                            </td>
                            <!-- Model Name -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Model Name"]
                                }}
                            </td>
                            <!-- Lot Number -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Lot Number"]
                                }}
                            </td>
                            <!-- Start-Up -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Type of Checking"] ===
                                    "Start-Up"
                                    ? "OK"
                                    : ""
                                }}
                            </td>
                            <!-- Re-Startup -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Type of Checking"] ===
                                    "Change Model"
                                    ? "OK"
                                    : ""
                                }}
                            </td>
                            <!-- Change Model -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Type of Checking"] ===
                                    "Power Failure"
                                    ? "OK"
                                    : ""
                                }}
                            </td>
                            <!-- Production Checksheet -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Type of Checking"] ===
                                    "Change Tip"
                                    ? "OK"
                                    : ""
                                }}
                            </td>
                            <!-- Soldering Iron Set -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Soldering Iron Set"]
                                }}
                            </td>
                            <!-- Soldering Machine Condition -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers[
                                    "Soldering Machine Condition"
                                    ]
                                }}
                            </td>
                            <!-- Solder Wires -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Solder Wire"]
                                }}
                            </td>
                            <!-- Solder Wire Expiration Date -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers[
                                    "Solder Wire Expiration Date"
                                    ]
                                }}
                            </td>
                            <!-- Solder Tip Type -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Solder Tip Type"]
                                }}
                            </td>
                            <!-- Solder Tip Condition -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Solder Tip Condition"]
                                }}
                            </td>
                            <!-- Solder Tip Temperature -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Solder Tip Temperature"]
                                }}
                            </td>
                            <!-- Resistance Value -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Resistance Value"]
                                }}
                            </td>
                            <!-- Leak Voltage Value -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Leak Voltage Value"]
                                }}
                            </td>
                            <!-- Sponge \/ Sponge Bin -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Sponge \/ Sponge Bin"]
                                }}
                            </td>
                            <!-- Soldering Jig ID Number -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Soldering Jig ID Number"]
                                }}
                            </td>
                            <!-- Soldering jig is clean and free from solder lead stains and flux. Use IPA, brush or savina to clean it.  -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers[
                                    "Soldering Jig Appearance"
                                    ]
                                }}
                            </td>
                            <!-- Component's Reference on Soldering Jig (if Applicable) -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers[
                                    "Components Reference on Soldering Jig (if Applicable) "
                                    ]
                                }}
                            </td>
                            <!-- Bamboo Stick -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Bamboo Stick"]
                                }}
                            </td>
                            <!-- Exhaust System -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Exhaust System"]
                                }}
                            </td>
                            <!-- Barcode Part No. (For D460 and D610 Main Only) -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["D02484-D01 (D460 MAIN)"]
                                }}
                            </td>
                            <!-- D027CR-001 (D610 MAIN) -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["D027CR-001 (D610 MAIN)"]
                                }}
                            </td>
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{ response_field.first_name }}
                            </td>
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{ response_field.line_leader_first_name }}
                            </td>
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{ response_field.qc_first_name }}
                            </td>
                            <!-- Remarks -->
                            <td class="border-solid border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Remarks on the Model"]
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- P-Touch ICT -->
            <div v-if="selectedOption === 'P-Touch ICT'" class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table id="myTable"
                    class="w-full text-sm text-left text-gray-500 dark:text-gray-400 border-solid border-2 border-black">
                    <thead style="background-color: #3c5393"
                        class="border-solid border-2 border-black text-xs text-white uppercase">
                        <tr>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Date
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Shift
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Model Name
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Lot No.
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Start_up
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Change Model
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Power Failure
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Main Breaker
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Power Switch
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Standard Pressure
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                CPU
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Monitor
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Operation Buttons(2)
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Pneumatic
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Text Fixture, Contact Pins/Probe
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Presence Pins
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Tray for NG and for confirmation units
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Program Settings
                            </th>
                            <th colspan="2" class="border-solid border-2 border-black px-1 py-1">
                                GOOD Master Sample
                            </th>
                            <th colspan="2" class="border-solid border-2 border-black px-1 py-1">
                                NO GOOD Master Sample
                            </th>
                            <th colspan="1" rowspan="2"
                                class="whitespace-nowrap border-solid border-2 border-black px-1 py-1">
                                ICT Good/Passed Mark
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Lot Date Reference
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Actual Lot Date Sticker
                            </th>
                            <th colspan="1" rowspan="2"
                                class="border-solid border-2 whitespace-nowrap border-black px-1 py-1">
                                Lot Date<br />Sticker Box
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Tweezers
                            </th>
                            <th colspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Signatures
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                QC Confirmation
                            </th>
                            <th colspan="1" rowspan="2" class="border-solid border-2 border-black px-1 py-1">
                                Remarks
                            </th>
                        </tr>
                        <tr>
                            <th class="border-solid border-2 whitespace-nowrap border-black px-1 py-1">
                                1st Result must be "Pass".
                            </th>
                            <th class="border-solid border-2 whitespace-nowrap border-black px-1 py-1">
                                2nd Result must be "Pass".
                            </th>
                            <th class="border-solid border-2 whitespace-nowrap border-black px-1 py-1">
                                1st Result must be "Fail".
                            </th>
                            <th class="border-solid border-2 whitespace-nowrap border-black px-1 py-1">
                                2nd Result must be "Fail".
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Operator
                            </th>
                            <th class="border-solid border-2 border-black px-1 py-1">
                                Lineleader/Technician /Supervisor/Engineer
                            </th>
                        </tr>
                    </thead>
                    <tbody v-for="response_field in response_fields.data">
                        <tr v-if="(response_field.form_id === 3 &&
                                selectedUser === 'default') ||
                            (response_field.form_id === 3 &&
                                response_field.submitted_by ===
                                selectedUser)
                            "
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <!-- Date -->
                            <th scope="row"
                                class="border-solid border-2 border-black px-1 py-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ response_field.created_at }}
                            </th>
                            <!-- Shift -->
                            <td class="border-solid border-2 border-black px-1 py-1">
                                {{ response_field.shift }}
                            </td>
                            <!-- Model Name -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Model Name"]
                                }}
                            </td>
                            <!-- Lot Number -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Lot Number"]
                                }}
                            </td>
                            <!-- Start-Up -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Type of Checking"] ===
                                    "Start-Up"
                                    ? "OK"
                                    : ""
                                }}
                            </td>
                            <!-- Re-Startup -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Type of Checking"] ===
                                    "Change Model"
                                    ? "OK"
                                    : ""
                                }}
                            </td>
                            <!-- Change Model -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Type of Checking"] ===
                                    "PowerFailure"
                                    ? "OK"
                                    : ""
                                }}
                            </td>
                            <!-- Production Checksheet -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Main Breaker"]
                                }}
                            </td>
                            <!--Power Switch -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Power Switch"]
                                }}
                            </td>
                            <!-- Standard Pressure -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Standard Pressure"]
                                }}
                            </td>
                            <!-- CPU -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["CPU"]
                                }}
                            </td>
                            <!-- Monitor -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Monitor"]
                                }}
                            </td>
                            <!-- Operation Buttons (2) -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Operation Buttons (2)"]
                                }}
                            </td>
                            <!-- Pneumatic -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Pneumatic"]
                                }}
                            </td>
                            <!-- Text Fixture, Contact Pins\/Probe -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers[
                                    "Text Fixture, Contact Pins\/Probe"
                                    ]
                                }}
                            </td>
                            <!-- "Presence Pins -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Presence Pins"]
                                }}
                            </td>
                            <!-- Tray for NG and for confirmation units -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers[
                                    "Tray for NG and for confirmation units"
                                    ]
                                }}
                            </td>
                            <!-- Program Settings -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Program Settings"]
                                }}
                            </td>
                            <!-- GOOD Master Sample -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers[
                                    "1st Result must be PASS. "
                                    ]
                                }}
                            </td>
                            <!-- 2nd Result must be PASS.   -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers[
                                    "2nd Result must be PASS. "
                                    ]
                                }}
                            </td>
                            <!-- 1st Result must be \"Fail\ -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers[
                                    "1st Result must be FAIL."
                                    ]
                                }}
                            </td>
                            <!-- 2nd Result must be FAIL. -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers[
                                    "2nd Result must be FAIL."
                                    ]
                                }}
                            </td>
                            <!-- ICT Good\/Passed Mark -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["ICT Good\/Passed Mark"]
                                }}
                            </td>
                            <!-- Lot Date Reference -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Lot Date Reference"]
                                }}
                            </td>
                            <!-- Actual Lot Date Sticker -->
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Actual Lot Date Sticker"]
                                }}
                            </td>
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Lot Date Sticker Box"]
                                }}
                            </td>
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Tweezers"]
                                }}
                            </td>
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{ response_field.submitted_by }}
                            </td>
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{ response_field.line_leader_first_name }}
                            </td>
                            <td class="border-solid whitespace-nowrap border-2 border-black px-1 py-1">
                                {{ response_field.qc_first_name }}
                            </td>

                            <!-- Remarks -->
                            <td class="border-solid border-2 border-black px-1 py-1">
                                {{
                                    JSON.parse(response_field.response)
                                        .fieldAnswers["Remarks on the Model"]
                                }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                <Pagination :data="response_fields" />
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import { ref, computed, reactive } from "vue";

import { Link } from "@inertiajs/vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Shared/Pagination.vue";

const selectedForm = reactive({
    form_name: null,
});
const props = defineProps({
    response_fields: Array,
    response_fields2: Array,
    response_fields3: Array,
    counts: Array,
    forms: Array,
    employees: Array,
    sign: Array,
});

const selectedAction = ref("");
const selectedDateRange = ref(null);
const isDropdownOpen = ref(false);

const toggleDropdown = () => {
    isDropdownOpen.value = !isDropdownOpen.value;
};

// const filteredAudits = computed(() => {
//     return props.audits.data.filter(audit => {
//         const userFilter = selectedUser.value === '' || audit.user_id === selectedUser.value;
//         const actionFilter = selectedAction.value === '' || audit.action_type === selectedAction.value;

//         let dateFilter = true;
//         if (selectedDateRange.value) {
//             const [startDate, endDate] = selectedDateRange.value;
//             const auditDate = new Date(audit.action_date);

//             dateFilter = auditDate >= startDate && auditDate <= endDate;
//         }
//         return userFilter && actionFilter && dateFilter;
//     });
// });

const currentPage = ref(1);

const pagedAudits = computed(() => {
    return props.audits.data.slice(
        (currentPage.value - 1) * 10,
        currentPage.value * 10
    );
});

const loadData = (page) => {
    currentPage.value = page;
};
</script>

<style>
.wrapper {
    max-width: 220px;
}

td {
    color: black;
    text-align: center;
}

th {
    text-align: center;
}
</style>
