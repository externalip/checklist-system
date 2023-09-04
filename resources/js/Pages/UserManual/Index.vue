<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
</script>

<template>
    <AppLayout title="User Manual">
        <p class="mb-10 lg:mx-[25%] text-center text-gray-500">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Error et
            beatae quod maxime, repellendus saepe fugiat numquam, obcaecati
            architecto, sit quos doloremque accusantium velit porro.
            Voluptatibus animi culpa nesciunt cupiditate.
        </p>
        <section
            class="text-[--blue] grid lg:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-5"
        >
            <!-- Add a Personnel -->
            <div
                class="flex flex-col items-center border-2 border-gray-100 rounded-2xl p-5 hover:bg-gray-100 duration-200"
            >
                <span
                    class="bg-blue-100 text-blue-800 text-md font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 w-max"
                >
                    Account Management
                </span>
                <h2 class="text-center">How to</h2>
                <h5 class="mb-5 font-normal text-md text-gray-500 text-center">
                    Register a Personnel
                </h5>
                <iframe
                    src="https://scribehow.com/embed/Creating_a_new_user_account__Uk8Dmx80RGefVX8Yxv5oAA"
                    width="100%"
                    height="640"
                    allowfullscreen
                    frameborder="0"
                ></iframe>
            </div>

            <!-- Deletion / Setting Active of Users -->
            <div
                class="flex flex-col items-center border-2 border-gray-100 rounded-2xl p-5 hover:bg-gray-100 duration-200"
            >
                <span
                    class="bg-blue-100 text-blue-800 text-md font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 w-max"
                >
                    Account Management
                </span>
                <h2 class="text-center">How to</h2>
                <h5 class="mb-5 font-normal text-md text-gray-500 text-center">
                    Delete / Set Active a Personnel
                </h5>
                <iframe
                    src="https://scribehow.com/embed/DeletingSet_the_User_inactive__agNJcL8tR9-8WSIgsVbe5A"
                    width="100%"
                    height="640"
                    allowfullscreen
                    frameborder="0"
                ></iframe>
            </div>

            <!-- Create a Model -->
            <div
                class="flex flex-col items-center border-2 border-gray-100 rounded-2xl p-5 hover:bg-gray-100 duration-200"
            >
                <span
                    class="bg-blue-100 text-blue-800 text-md font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 w-max"
                >
                    Model Manager
                </span>
                <h2 class="text-center">How to</h2>
                <h5 class="mb-5 font-normal text-md text-gray-500 text-center">
                    Create a Model
                </h5>
                <iframe
                    src="https://scribehow.com/embed/Create_a_model__r4DkFCffT2-jFyxOAvx87A"
                    width="100%"
                    height="640"
                    allowfullscreen
                    frameborder="0"
                ></iframe>
            </div>

            <!-- Create a new checklist -->
            <div
                class="flex flex-col items-center border-2 border-gray-100 rounded-2xl p-5 hover:bg-gray-100 duration-200"
            >
                <span
                    class="bg-blue-100 text-blue-800 text-md font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 w-max"
                >
                    Checksheet Manager
                </span>
                <h2 class="text-center">How to</h2>
                <h5 class="mb-5 font-normal text-md text-gray-500 text-center">
                    Create a new checklist
                </h5>
                <iframe
                    src="https://scribehow.com/embed/Creating_a_Check_sheet__UCzJFUReQD2OYFKHX8DTBg"
                    width="100%"
                    height="640"
                    allowfullscreen
                    frameborder="0"
                ></iframe>
            </div>

            <!-- Edit Delete a Check sheet -->
            <div
                class="flex flex-col items-center border-2 border-gray-100 rounded-2xl p-5 hover:bg-gray-100 duration-200"
            >
                <span
                    class="bg-blue-100 text-blue-800 text-md font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 w-max"
                >
                    Checksheet Manager
                </span>
                <h2 class="text-center">How to</h2>
                <h5 class="mb-5 font-normal text-md text-gray-500 text-center">
                    Edit / Delete a Check sheet
                </h5>
                <iframe
                    src="https://scribehow.com/embed/Edit_and_Delete_a_check_sheet__xJV4Q14LT3qmEB9XuWVdDw"
                    width="100%"
                    height="640"
                    allowfullscreen
                    frameborder="0"
                ></iframe>
            </div>

            <!-- Answer a checklist -->
            <div
                class="flex flex-col items-center border-2 border-gray-100 rounded-2xl p-5 hover:bg-gray-100 duration-200"
            >
                <span
                    class="bg-blue-100 text-blue-800 text-md font-semibold px-2.5 py-0.5 rounded-full dark:bg-blue-200 dark:text-blue-800 w-max"
                >
                    Checklist
                </span>
                <h2 class="text-center">How to</h2>
                <h5 class="mb-5 font-normal text-md text-gray-500 text-center">
                    Answer a checklist
                </h5>
                <iframe
                    src="https://scribehow.com/embed/Dashboard_Try__AWVAY5kCQeq4Vv-w_Gqmsw"
                    width="100%"
                    height="540"
                    allowfullscreen
                    frameborder="0"
                ></iframe>
            </div>
        </section>
    </AppLayout>
</template>
