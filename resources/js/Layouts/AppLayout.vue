<template>
    <div id="mySidebar" class="sidebar" style="z-index: 3;" @click.stop="toggleUserDropdown">
        <div id="e2" class="text-center" style="padding:10px;">
            <p class="text-3xl font-semibold">Hello,</p>
            <p class="text-xl">Employee ID#{{
                `${$page.props.auth
                    .employee
                    ?.id
                    }`
            }}</p>
            <p class="self-center text-sm" style="padding-top:20px;">Production Checklist</p>
        </div>
        <button class="closebtn x" onclick="closeNav()" @click.stop="closeNav">×</button>

        <ul class="space-y-2 font-medium">
            <li class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <a href="/test2" class="inline-flex items-center p-2 text-gray-900 rounded-lg group">
                    <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                        <path
                            d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                        <path
                            d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                    </svg>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <a href="#" class="inline-flex items-center p-2 text-gray-900 rounded-lg group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Manage Check Sheet</span>
                </a>
            </li>
            <li class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <a href="#" class="inline-flex items-center p-2 text-gray-900 rounded-lg group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                        <path
                            d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Pending Reports</span>
                </a>
            </li>
            <li class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <a href="#" class="items-center p-2 text-gray-900 rounded-lg group">
                    <button id="e3" class="inline-flex" type="button" aria-controls="dropdown-example"
                        data-collapse-toggle="dropdown-example">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                            <path
                                d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>View Checklists</span>
                        <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </a>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="/5S-Checklist"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">5s
                            Checklist</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">P-Touch
                            Soldering</a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11">P-Touch
                            ICT</a>
                    </li>
                </ul>

            </li>
            <li class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <a href="#" class="inline-flex items-center p-2 text-gray-900 rounded-lg group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Archives</span>
                </a>
            </li>
            <li class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <a href="/audit" class="inline-flex items-center p-2 text-gray-900 rounded-lg group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                        <path
                            d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z" />
                        <path
                            d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Audit Tracking</span>
                </a>
            </li>
            <li class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <a href="#" class="inline-flex items-center p-2 text-gray-900 rounded-lg group">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                        <path
                            d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z" />
                        <path
                            d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z" />
                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Manage Models</span>
                </a>
            </li>
            <p class="text-center text-sm" style="padding-top:20px;">User Configuration</p>
            <li class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <Link :href="route('users')" class="inline-flex items-center p-2 text-gray-900 rounded-lg group">
                <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 5V.13a2.96 2.96 0 0 0-1.293.749L.879 3.707A2.96 2.96 0 0 0 .13 5H5Z" />
                    <path
                        d="M6.737 11.061a2.961 2.961 0 0 1 .81-1.515l6.117-6.116A4.839 4.839 0 0 1 16 2.141V2a1.97 1.97 0 0 0-1.933-2H7v5a2 2 0 0 1-2 2H0v11a1.969 1.969 0 0 0 1.933 2h12.134A1.97 1.97 0 0 0 16 18v-3.093l-1.546 1.546c-.413.413-.94.695-1.513.81l-3.4.679a2.947 2.947 0 0 1-1.85-.227 2.96 2.96 0 0 1-1.635-3.257l.681-3.397Z" />
                    <path
                        d="M8.961 16a.93.93 0 0 0 .189-.019l3.4-.679a.961.961 0 0 0 .49-.263l6.118-6.117a2.884 2.884 0 0 0-4.079-4.078l-6.117 6.117a.96.96 0 0 0-.263.491l-.679 3.4A.961.961 0 0 0 8.961 16Zm7.477-9.8a.958.958 0 0 1 .68-.281.961.961 0 0 1 .682 1.644l-.315.315-1.36-1.36.313-.318Zm-5.911 5.911 4.236-4.236 1.359 1.359-4.236 4.237-1.7.339.341-1.699Z" />
                </svg>
                <span class="flex-1 ml-3 whitespace-nowrap">Manage Personnel</span>
                </Link>
            </li>
        </ul>
    </div>

    <div class="max-w-screen-l flex flex-wrap items-center justify-between mx-auto p-1" style="background-color:#CCCDCF;">
        <nav id="side" class="flex fixed-top navbar navbar-dark" aria-label="First navbar example">
            <button
                class="navbar-toggler inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01"
                aria-expanded="false" aria-label="Toggle navigation" @click.stop="openNav">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
            <div id="myComp" class="comp flex">
                <img src="/Logo.png" class="h-9 mr-3" alt="MA Technology Logo" />
                <p class="self-center text-3xl font-semibold collapse  md:visible">MA Technology</p>
            </div>
        </nav>

        <div class="p-2 flex items-center md:order-2">
            <div class="ml-3 relative">
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <button v-if="$page.props.jetstream
                            .managesProfilePhotos
                            "
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                            <img class="h-8 w-8 rounded-full object-cover" :src="$page.props.auth.user
                                .profile_photo_url
                                " :alt="$page.props.auth.user.name
        " />
                        </button>

                        <span v-else class="inline-flex rounded-md">
                            <button type="button"
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                {{
                                    `${$page.props.auth.user
                                        .name ??
                                        $page.props.auth
                                            .employee
                                            ?.first_name
                                        } ${$page.props.auth
                                            .employee?.last_name
                                        }`
                                }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                        </span>
                    </template>

                    <template #content>
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Manage Account
                        </div>

                        <DropdownLink :href="route('profile.show')">
                            Profile
                        </DropdownLink>

                        <div class="border-t border-gray-200" />

                        <!-- Authentication -->
                        <form @submit.prevent="logout">
                            <DropdownLink as="button">
                                Log Out
                            </DropdownLink>
                        </form>
                    </template>
                </Dropdown>
            </div>
        </div>
    </div>
    <main>
        <div class="mt-5">
            <h1 class=" mx-20 ">{{ title }}</h1>
        </div>
        <slot />
    </main>
</template>
<script setup>
import { onMounted } from 'vue'
import {
    initAccordions,
    initCarousels,
    initCollapses,
    initDials,
    initDismisses,
    initDrawers,
    initDropdowns,
    initModals,
    initPopovers,
    initTabs,
    initTooltips
} from 'flowbite'
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
// initialize components based on data attribute selectors
onMounted(() => {
    initAccordions();
    initCarousels();
    initCollapses();
    initDials();
    initDismisses();
    initDrawers();
    initDropdowns();
    initModals();
    initPopovers();
    initTabs();
    initTooltips();
})

defineProps({
    title: String,
});

const logout = () => {
    router.post(route("logout"));
};

// Define the JavaScript functions as Vue methods
const openNav = () => {
    var sidebar = document.getElementById("mySidebar");
    var comp = document.getElementById("myComp");
    const hamburgerButton = document.querySelector('[data-drawer-target="sidebar"]');
    if (sidebar.style.width == "250px") {
        closeNav();
    } else {
        sidebar.style.width = "250px";
        comp.style.left = "260px";
        window.addEventListener("click", handleOutsideClick); // Add the event listener to the window
    }
}

const closeNav = () => {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("myComp").style.left = "50px";
    window.removeEventListener("click", handleOutsideClick); // Remove the event listener from the window
}

const toggleUserDropdown = (event) => {
    event.stopPropagation(); // Prevent the click event from propagating to the window
    // Toggle your dropdown menu here
};

document.onclick = function (e) {
    if (e.target.id != 'mySidebar') {
        document.getElementById("mySidebar").style.width = "0px";
        document.getElementById("myComp").style.left = "50px";
    }
}
</script>

<style scoped>
body {
    margin: 0px;
}

.div12 {
    width: 15px;
    height: 2px;
    background-color: black;
    margin: 3px 0;
}

.comp {
    position: absolute;
    left: 50px;
    transition: 0.5s;
}


.badge {
    display: inline-block;
    padding: 0.25em 0.4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.25rem;
    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

@media (prefers-reduced-motion: reduce) {
    .badge {
        transition: none;
    }
}

.nav-bar {
    margin-bottom: px;
    padding-top: 10px;
    padding-bottom: 44px;
}

.x {
    position: relative;
    left: 150px;
}


/* SIDEBAR CSS */

.sidebar {
    height: 100%;
    width: 0%;
    position: fixed;
    z-index: 1;
    top: 0;
    left: 0;
    background-color: #CCCDCF;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 10px;
    border-right: 1px solid rgb(88, 74, 74);
    padding-bottom: 20px;
}

.sidebar a {
    display: flex;
    padding: 15px;
}

.sidebar a,
p {
    color: #3C5393;
}

.sidebar li {
    border-radius: 10px;
    margin: 0px 10px 0px 10px;
    background-color: white;

}

.sidebar a:hover {
    color: white;
    font-weight: bold;
    background-color: #3C5393;
}


.sidebar .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

#side {
    transition: margin-left .5s;
}

.openbtn {
    font-size: 20px;
    cursor: pointer;
    background-color: #111;
    color: white;
    padding: 10px 15px;
    border: none;
}

.openbtn:hover {
    background-color: #444;
}

#main {
    transition: margin-left .5s;

}


@media (min-width: 62em) {
    .featurette-heading {
        margin-top: 7rem;
    }
}
</style>
