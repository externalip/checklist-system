<template>
    <Head :title="title" />
    <div id="mySidebar" class="sidebar" style="z-index: 3" @click.stop="toggleUserDropdown">
        <div id="e2" class="text-center" style="padding: 10px">
            <p class="text-3xl font-semibold">Hello,</p>
            <p class="text-xl">
                Employee ID#{{ `${$page.props.auth.employee?.id}` }}
            </p>
            <p class="self-center text-sm" style="padding-top: 20px">
                Production Checklist
            </p>
        </div>
        <button class="closebtn x" onclick="closeNav()" @click.stop="closeNav">
                        ×
                    </button>

        <ul class="space-y-2 font-medium">
            <div v-if="$page.props.auth.user.permissions.some(permission => permission.name === 'dashboard')" class="space-y-2">
                <!-- DASHBOARD -->
                <li class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <Link :href="route('dashboard')" :class="{ active: $page.url.startsWith('/dashboard') }" class="inline-flex items-center p-2 text-gray-900 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            d="M4 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5Zm10 0a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1V5ZM4 16a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3Zm10-3a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v6a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-6Z"
                                        />
                                    </svg>

                    <span class="ml-3">Dashboard</span>
                    </Link>
                </li>
            </div>
            <div v-if="$page.props.auth.user.permissions.some(permission => permission.name === 'manage-checksheet')" class="space-y-2">
                <!-- MANAGE CHECK SHEETS -->
                <li class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <Link :href="route('checksheet')" :class="{ active: $page.url.startsWith('/checksheet') }" class="inline-flex items-center p-2 text-gray-900 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 15 15">
                                        <path
                                            fill="currentColor"
                                            d="M4.5 6.995H4v1h.5v-1Zm6 1h.5v-1h-.5v1Zm-6 2.505H4v.5h.5v-.5Zm6 0v.5h.5v-.5h-.5Zm-6-6.503H4v1h.5v-1Zm6 1h.5v-1h-.5v1Zm3-1.497h.5v-.207l-.146-.147l-.354.354Zm-3-3l.354-.354L10.707 0H10.5v.5Zm-6 7.495h6v-1h-6v1ZM4.5 11h6v-1h-6v1Zm0-6.003h6v-1h-6v1Zm8 9.003h-10v1h10v-1ZM2 13.5v-12H1v12h1Zm11-10v10h1v-10h-1ZM2.5 1h8V0h-8v1Zm7.646-.146l3 3l.708-.708l-3-3l-.708.708ZM2.5 14a.5.5 0 0 1-.5-.5H1A1.5 1.5 0 0 0 2.5 15v-1Zm10 1a1.5 1.5 0 0 0 1.5-1.5h-1a.5.5 0 0 1-.5.5v1ZM2 1.5a.5.5 0 0 1 .5-.5V0A1.5 1.5 0 0 0 1 1.5h1Zm2 3v6h1v-6H4Zm3 0v6h1v-6H7Zm3 0v6h1v-6h-1Z"
                                        />
                                    </svg>
                    <span class="flex-1 ml-3 whitespace-nowrap">Manage Check Sheet</span
                                    >
                                </Link>
                            </li>
                        </div>
                        <div v-if="$page.props.auth.user.permissions.some(permission => permission.name === 'pending-reports')" class="space-y-2">
                        <!-- PENDING REPORTS -->
                        <li
                            class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        >
                            <Link
                                :href="route('Pending-Reports')"
                                :class="{
                                    active: $page.url.startsWith('/Pending-Reports'),
                                }"
                                class="inline-flex items-center p-2 text-gray-900 rounded-lg group"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M17 22q-2.075 0-3.538-1.463T12 17q0-2.075 1.463-3.538T17 12q2.075 0 3.538 1.463T22 17q0 2.075-1.463 3.538T17 22Zm1.675-2.625l.7-.7L17.5 16.8V14h-1v3.2l2.175 2.175ZM5 21q-.825 0-1.413-.588T3 19V5q0-.825.588-1.413T5 3h4.175q.275-.875 1.075-1.438T12 1q1 0 1.788.563T14.85 3H19q.825 0 1.413.588T21 5v6.25q-.45-.325-.95-.55T19 10.3V5h-2v3H7V5H5v14h5.3q.175.55.4 1.05t.55.95H5Zm7-16q.425 0 .713-.288T13 4q0-.425-.288-.713T12 3q-.425 0-.713.288T11 4q0 .425.288.713T12 5Z"
                                    />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap"
                                    >Pending Reports</span
                                >
                            </Link>
                        </li>
                        </div>
                        <div v-if="$page.props.auth.user.permissions.some(permission => permission.name === 'view-checklist')" class="space-y-2">
                        <!-- VIEW CHECKLISTS -->
                        <li
                            class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        >
                            <a
                                href="#"
                                class="items-center p-2 text-gray-900 rounded-lg group"
                            >
                                <button
                                    id="e3"
                                    class="inline-flex"
                                    type="button"
                                    aria-controls="dropdown-example"
                                    data-collapse-toggle="dropdown-example"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 36 36"
                                    >
                                        <path
                                            fill="currentColor"
                                            d="M15 8h9v2h-9z"
                                            class="clr-i-outline clr-i-outline-path-1"
                                        />
                                        <path
                                            fill="currentColor"
                                            d="M15 12h9v2h-9z"
                                            class="clr-i-outline clr-i-outline-path-2"
                                        />
                                        <path
                                            fill="currentColor"
                                            d="M15 16h9v2h-9z"
                                            class="clr-i-outline clr-i-outline-path-3"
                                        />
                                        <path
                                            fill="currentColor"
                                            d="M15 20h9v2h-9z"
                                            class="clr-i-outline clr-i-outline-path-4"
                                        />
                                        <path
                                            fill="currentColor"
                                            d="M15 24h9v2h-9z"
                                            class="clr-i-outline clr-i-outline-path-5"
                                        />
                                        <path
                                            fill="currentColor"
                                            d="M11 8h2v2h-2z"
                                            class="clr-i-outline clr-i-outline-path-6"
                                        />
                                        <path
                                            fill="currentColor"
                                            d="M11 12h2v2h-2z"
                                            class="clr-i-outline clr-i-outline-path-7"
                                        />
                                        <path
                                            fill="currentColor"
                                            d="M11 16h2v2h-2z"
                                            class="clr-i-outline clr-i-outline-path-8"
                                        />
                                        <path
                                            fill="currentColor"
                                            d="M11 20h2v2h-2z"
                                            class="clr-i-outline clr-i-outline-path-9"
                                        />
                                        <path
                                            fill="currentColor"
                                            d="M11 24h2v2h-2z"
                                            class="clr-i-outline clr-i-outline-path-10"
                                        />
                                        <path
                                            fill="currentColor"
                                            d="M28 2H8a2 2 0 0 0-2 2v28a2 2 0 0 0 2 2h20a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2Zm0 30H8V4h20Z"
                                            class="clr-i-outline clr-i-outline-path-11"
                                        />
                                        <path fill="none" d="M0 0h36v36H0z" />
                                    </svg>

                                    <span
                                        class="flex-1 ml-3 text-left whitespace-nowrap"
                                        sidebar-toggle-item
                                        >View Checklists</span
                                    >
                                    <svg
                                        sidebar-toggle-item
                                        class="w-6 h-6"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </button>
                            </a>
                            <ul
                                id="dropdown-example"
                                class="hidden py-2 space-y-2 max-h-60 overflow-y-auto"
                            >
                                <li>
                                    <Link
                                        :href="route('5S-Checklist')"
                                        :class="{
                                            active: $page.url.startsWith('/5S-Checklist'),
                                        }"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11"
                                    >
                                        5s Checklist
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        :href="route('PTouch-Solder')"
                                        :class="{
                                            active: $page.url.startsWith('/PTouch-Solder'),
                                        }"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11"
                                    >
                                        P-Touch Soldering
                                    </Link>
                                </li>
                                <li>
                                    <Link
                                        :href="route('PTouch-ICT')"
                                        :class="{
                                            active: $page.url.startsWith('/PTouch-ICT'),
                                        }"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11"
                                    >
                                        P-Touch ICT
                                    </Link>
                                </li>
                                <li v-for="form in $page.props.sharedForms">
                                    <Link
                                        :href="route('showForm', form.id)"
                                        :class="{
                                            active: $page.url.startsWith(
                                                '/Forms/' + form.id
                                            ),
                                        }"
                                        class="flex items-center w-full p-2 text-base font-normal text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700 pl-11"
                                    >
                                        {{ form.form_name }}
                                    </Link>
                                </li>
                            </ul>
                        </li>
                        </div>
                        <div v-if="$page.props.auth.user.permissions.some(permission => permission.name === 'archives')" class="space-y-2">
                        <!-- ARCHIVES -->
                        <li
                            class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        >
                            <Link
                                :href="route('archives')"
                                :class="{ active: $page.url.startsWith('/Archives') }"
                                class="inline-flex items-center p-2 text-gray-900 rounded-lg group"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        fill="currentColor"
                                        d="M2.75 2h18.5c.966 0 1.75.784 1.75 1.75v3.5A1.75 1.75 0 0 1 21.25 9H2.75A1.75 1.75 0 0 1 1 7.25v-3.5C1 2.784 1.784 2 2.75 2Zm18.5 1.5H2.75a.25.25 0 0 0-.25.25v3.5c0 .138.112.25.25.25h18.5a.25.25 0 0 0 .25-.25v-3.5a.25.25 0 0 0-.25-.25ZM2.75 10a.75.75 0 0 1 .75.75v9.5c0 .138.112.25.25.25h16.5a.25.25 0 0 0 .25-.25v-9.5a.75.75 0 0 1 1.5 0v9.5A1.75 1.75 0 0 1 20.25 22H3.75A1.75 1.75 0 0 1 2 20.25v-9.5a.75.75 0 0 1 .75-.75Z"
                                    />
                                    <path
                                        fill="currentColor"
                                        d="M9.75 11.5a.75.75 0 0 0 0 1.5h4.5a.75.75 0 0 0 0-1.5h-4.5Z"
                                    />
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Archives</span>
                    </Link>
                </li>
            </div>
            <div v-if="$page.props.auth.user.permissions.some(permission => permission.name === 'audit')" class="space-y-2">
                <!-- AUDIT TRACKING -->
                <li class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group mb-5">
                    <Link :href="route('audit')" :class="{ active: $page.url.startsWith('/audit') }" class="inline-flex items-center p-2 text-gray-900 rounded-lg group">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 2048 2048">
                                        <path
                                            fill="currentColor"
                                            d="M1033 1280q-14 30-21 62t-13 66H384v-128h649zm-649 384v-128h613q5 33 14 65t23 63H384zm-128 256h1349l127 128H128V0h1115l549 549v568q-29-26-61-47t-67-37V640h-512V128H256v1792zM1280 219v293h293l-293-293zm24 805q-109 41-187 128H384v-128h920zM384 512h640v128H384V512zm1152 256v128H384V768h1152zm512 1216q0 26-19 45t-45 19q-26 0-45-19l-291-290q-39 26-84 39t-92 14q-66 0-124-25t-102-68t-69-102t-25-125q0-66 25-124t68-101t102-69t125-26q66 0 124 25t101 69t69 102t26 124q0 47-13 92t-40 84l290 291q19 19 19 45zm-768-512q0 40 15 75t41 61t61 41t75 15q40 0 75-15t61-41t41-61t15-75q0-40-15-75t-41-61t-61-41t-75-15q-40 0-75 15t-61 41t-41 61t-15 75z"
                                        />
                                    </svg>

                    <span class="flex-1 ml-3 whitespace-nowrap">Audit Tracking</span
                                    >
                                </Link>
                            </li>
            </div>

                 <div v-if="$page.props.auth.user.permissions.some(permission => permission.name === 'models')" class="space-y-2">
                            <!-- MANAGE MODEL -->
                            <li
                                class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                            >
                                <Link
                                    :href="route('models.index')"
                                    :class="{ active: $page.url.startsWith('/Models') }"
                                    class="inline-flex items-center p-2 text-gray-900 rounded-lg group"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 32 32"
                                    >
                                        <path
                                            fill="currentColor"
                                            d="M16 25a6.99 6.99 0 0 1-5.833-3.129l1.666-1.107a5 5 0 0 0 8.334 0l1.666 1.107A6.99 6.99 0 0 1 16 25zm4-11a2 2 0 1 0 2 2a1.98 1.98 0 0 0-2-2zm-8 0a2 2 0 1 0 2 2a1.98 1.98 0 0 0-2-2z"
                                        />
                                        <path
                                            fill="currentColor"
                                            d="M30 16v-2h-2v-4a4.005 4.005 0 0 0-4-4h-2V2h-2v4h-8V2h-2v4H8a4.005 4.005 0 0 0-4 4v4H2v2h2v5H2v2h2v3a4.005 4.005 0 0 0 4 4h16a4.005 4.005 0 0 0 4-4v-3h2v-2h-2v-5Zm-4 10a2.002 2.002 0 0 1-2 2H8a2.002 2.002 0 0 1-2-2V10a2.002 2.002 0 0 1 2-2h16a2.002 2.002 0 0 1 2 2Z"
                                        />
                                    </svg>

                                    <span class="flex-1 ml-3 whitespace-nowrap"
                                        >Manage Models</span
                                    >
                                </Link>
                            </li>
                        </div>

                        <div v-if="$page.props.auth.user.permissions.some(permission => permission.name === 'users')" class="space-y-2">
                            <p class="text-center text-sm" style="padding-top: 20px">
                                User Configuration
                            </p>

                            <!-- MANAGE USERS -->
                            <li
                                class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                            >
                                <Link
                                    :href="route('users')"
                                    :class="{ active: $page.url.startsWith('/Users') }"
                                    class="inline-flex items-center p-2 text-gray-900 rounded-lg group"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        width="24"
                                        height="24"
                                        viewBox="0 0 256 256"
                                    >
                                        <g fill="currentColor">
                                            <path
                                                d="M136 108a52 52 0 1 1-52-52a52 52 0 0 1 52 52Z"
                                                opacity=".2"
                                            />
                                            <path
                                                d="M117.25 157.92a60 60 0 1 0-66.5 0a95.83 95.83 0 0 0-47.22 37.71a8 8 0 1 0 13.4 8.74a80 80 0 0 1 134.14 0a8 8 0 0 0 13.4-8.74a95.83 95.83 0 0 0-47.22-37.71ZM40 108a44 44 0 1 1 44 44a44.05 44.05 0 0 1-44-44Zm210.14 98.7a8 8 0 0 1-11.07-2.33A79.83 79.83 0 0 0 172 168a8 8 0 0 1 0-16a44 44 0 1 0-16.34-84.87a8 8 0 1 1-5.94-14.85a60 60 0 0 1 55.53 105.64a95.83 95.83 0 0 1 47.22 37.71a8 8 0 0 1-2.33 11.07Z"
                                            />
                                        </g>
                                    </svg>

                                    <span class="flex-1 ml-3 whitespace-nowrap"
                                        >Manage Personnel</span
                                    >
                                </Link>
                            </li>
                        </div>
                        <div v-if="$page.props.auth.user.permissions.some(permission => permission.name === 'user-manual')" class="space-y-2">
                        <p class="text-center text-sm" style="padding-top: 20px">
                            User Manual
                        </p>

                        <li
                            class="dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group"
                        >
                            <Link
                                :href="route('UserManual')"
                                :class="{ active: $page.url.startsWith('/user-manual') }"
                                class="inline-flex items-center p-2 text-gray-900 rounded-lg group"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    viewBox="0 0 48 48"
                                >
                                    <path
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8.4 6.5v35a2 2 0 0 0 2 2h2.33v-39H10.4a2 2 0 0 0-2 2Zm4.33-2v39H37.6a2 2 0 0 0 2-2v-35a2 2 0 0 0-2-2Z"
                                    />
                                    <ellipse
                                        cx="25.531"
                                        cy="33.668"
                                        fill="currentColor"
                                        rx=".823"
                                        ry=".75"
                                    />
                                    <path
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M18.301 20.049a6.432 6.432 0 0 1 1.959-4.763a7.274 7.274 0 0 1 5.224-1.786c3.918 0 7.183 2.977 7.183 6.548a6.432 6.432 0 0 1-1.959 4.763c-1.632 1.19-5.224 2.977-5.224 5.656"
                                    />
                                </svg>

                                <span class="flex-1 ml-3 whitespace-nowrap"
                                    >User Manual</span
                                >
                            </Link>
                        </li>
                        </div>
                    </ul>
                </div>

                <div
                    class="max-w-screen-l flex flex-wrap items-center justify-between mx-auto p-1"
                    style="background-color: #cccdcf"
                >
                    <nav
                        id="side"
                        class="flex fixed-top navbar navbar-dark"
                        aria-label="First navbar example"
                    >
                        <button
                            class="navbar-toggler inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#navbarsExample01"
                            aria-controls="navbarsExample01"
                            aria-expanded="false"
                            aria-label="Toggle navigation"
                            @click.stop="openNav"
                        >
                            <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                                <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M1 1h15M1 7h15M1 13h15"
                                />
                            </svg>
                    </button>
                    <div id="myComp" class="comp flex">
                        <img src="/Logo.png" class="h-9 mr-3" alt="MA Technology Logo" />
                        <p class="self-center text-xl font-semibold collapse md:visible">
                            MA Technology
                            <span class="text-xs bg-slate-100 p-1 px-2 rounded-full">Production Checklist</span
                                >
                            </p>
                        </div>
                    </nav>

                    <div class="p-2 flex items-center md:order-2">
                        <div class="ml-3 relative">
                            <Dropdown align="right" width="48">
                                <template #trigger>
                                    <button
                                        v-if="$page.props.jetstream.managesProfilePhotos"
                                        class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition"
                                    >
                                        <img
                                            class="h-8 w-8 rounded-full object-cover"
                                            :src="$page.props.auth.user.profile_photo_url"
                                            :alt="$page.props.auth.user.name"
                                        />
                                    </button>

                                    <span v-else class="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150"
                                        >
                                            {{
                                                `${$page.props.auth.employee?.first_name} ${$page.props.auth.employee?.last_name}`
                                            }}
                                            <svg
                                                class="ml-2 -mr-0.5 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                fill="none"
                                                viewBox="0 0 24 24"
                                                stroke-width="1.5"
                                                stroke="currentColor"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M19.5 8.25l-7.5 7.5-7.5-7.5"
                                                />
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
        <DropdownLink as="button"> Log Out </DropdownLink>
    </form>
</template>
                </Dropdown>
            </div>
        </div>
    </div>
    <main class="p-2 pb-4">
        <h6>{{ control_no }}</h6>
        <div class="mt-5">
            <h1 class="lg:mx-20 text-center text-4xl text-[--blue]">{{ title }}</h1>
        </div>
        <slot />
    </main>
</template>

<script setup>
import { onMounted, ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { initFlowbite } from "flowbite";

defineProps({
    title: String,
    control_no: String,
});

onMounted(() => {
    initFlowbite();
});

const logout = () => {
    router.post(route("logout"));
};

const openNav = () => {
    const sidebar = document.getElementById("mySidebar");
    const comp = document.getElementById("myComp");
    if (sidebar.style.width === "250px") {
        closeNav();
    } else {
        sidebar.style.width = "250px";
        comp.style.left = "260px";
        window.addEventListener("click", handleOutsideClick);
    }
};

const closeNav = () => {
    const sidebar = document.getElementById("mySidebar");
    const comp = document.getElementById("myComp");
    sidebar.style.width = "0";
    comp.style.left = "50px";
    window.removeEventListener("click", handleOutsideClick);
};

const toggleUserDropdown = (event) => {
    event.stopPropagation();
    // Toggle your dropdown menu here
};

const handleOutsideClick = (event) => {
    if (event.target.id !== "mySidebar") {
        closeNav();
    }
};
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
    background-color: #cccdcf;
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
    color: #3c5393;
}

.sidebar li {
    border-radius: 10px;
    margin: 0px 10px 0px 10px;
    background-color: white;
}

.sidebar a:hover {
    color: white;
    font-weight: bold;
    background-color: #3c5393;
}

.active {
    color: white !important;
    font-weight: bold;
    background-color: #3c5393;
}

.sidebar .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

#side {
    transition: margin-left 0.5s;
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
    transition: margin-left 0.5s;
}

@media (min-width: 62em) {
    .featurette-heading {
        margin-top: 7rem;
    }
}
</style>
