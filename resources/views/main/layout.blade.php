<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Main Layout</title>
</head>

<body class="bg-white dark:bg-black">
    <!-- Main Header Section Start -->
    <header
        class="sticky top-0 inset-x-0 flex flex-wrap md:justify-start md:flex-nowrap z-48 w-full bg-white border-b border-gray-200 text-sm h-[62px] lg:ps-65 shadow">
        <nav class="px-4 sm:px-6 flex basis-full items-center w-full mx-auto">
            <!-- Logo Start (Big Size Screen) -->
            <div class="me-5 lg:me-0 lg:hidden">
                 <a class="flex justify-between items-center gap-3" href="{{ route('dashboard') }}">
                    <div class="w-8 h-8 aspect-square">
                        <img src="/assets/sidebar/inv-logo.png" />
                    </div>
                    <div class="shrink-0 text-base font-bold text-white">FAST FORWARD</div>
                </a>
                <div class="lg:hidden ms-1"></div>
            </div>
            <!-- Logo End (Big Size Screen) -->

            <div class="w-full flex items-center justify-end ms-auto gap-x-1 md:gap-x-3">
                <div class="flex flex-row items-center justify-end gap-3">
                    <a href="/main/sale/createsale" class="flex items-center justify-center gap-3 border-2 border-[#03ad00] text-[#03ad00] w-36 box-border px-2 py-1 rounded-full cursor-pointer">
                        <img src="/assets/sidebar/add-circle.svg" alt="Add Sale" class="w-[18px] h-[18px] aspect-square">
                        <span class="text-sm">Add Sale</span>
                    </a>

                    <a href="/main/purchase/createpurchase" class="flex items-center justify-center gap-3 border-2 border-[#0084ff] text-[#0084ff] w-36 box-border px-2 py-1 rounded-full cursor-pointer">
                        <img src="/assets/sidebar/add-circle1.svg" alt="Add Sale" class="w-[18px] h-[18px] aspect-square">
                        <span class="text-sm shrink-0">Add Purchase</span>
                    </a>

                    <label class="relative inline-flex items-center cursor-pointer rounded-full ml-3 mr-2">
                        <input type="checkbox" class="sr-only peer" value="" />
                        <div
                            class="group peer rounded-full duration-300 w-12 h-6 bg-[#03ad0049] after:duration-300 after:bg-[#03AD00] peer-checked:after:bg-green-500 peer-checked:ring-green-500 after:rounded-full after:absolute after:h-4 after:w-4 after:top-[4.5px] after:left-1 after:flex after:justify-center after:items-center peer-checked:after:translate-x-6 peer-hover:after:scale-95" style="box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);"
                        ></div>
                    </label>

                    <button type="button" class="hs-dark-mode-active:hidden block hs-dark-mode font-medium rounded-full cursor-pointer" data-hs-theme-click-value="dark">
                        <span class="group inline-flex shrink-0 justify-center items-center size-9">
                            <svg class="shrink-0 size-[23px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"></path>
                            </svg>
                        </span>
                        </button>
                        <button type="button" class="hs-dark-mode-active:block hidden hs-dark-mode font-medium rounded-full cursor-pointer" data-hs-theme-click-value="light">
                        <span class="group inline-flex shrink-0 justify-center items-center size-9">
                            <svg class="shrink-0 size-[23px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="4"></circle>
                            <path d="M12 2v2"></path>
                            <path d="M12 20v2"></path>
                            <path d="m4.93 4.93 1.41 1.41"></path>
                            <path d="m17.66 17.66 1.41 1.41"></path>
                            <path d="M2 12h2"></path>
                            <path d="M20 12h2"></path>
                            <path d="m6.34 17.66-1.41 1.41"></path>
                            <path d="m19.07 4.93-1.41 1.41"></path>
                            </svg>
                        </span>
                    </button>

                    <div class="hs-dropdown relative inline-flex">
                        <button id="hs-dropdown-custom-trigger" type="button"  class="hs-dropdown-toggle size-9.5 mr-4 cursor-pointer relative inline-flex justify-center items-center gap-x-2 text-sm font-semibold bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44] disabled:opacity-50 disabled:pointer-events-none shadow">
                            <img src="/assets/sidebar/notification-bing.svg" alt="Notification" />
                            <span class="absolute top-0 right-0 -translate-y-1/2 translate-x-1/2 bg-red-600 text-white text-[10px] font-bold px-2 py-1 rounded-full leading-none shadow-md">
                                3
                            </span>
                        </button>   

                        <!-- Notification Box Dropdown Start -->
                        <div class="hs-dropdown-menu translate-y-2 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-custom-trigger">
                            <div class="p-1 space-y-0.5 max-w-96">
                                <div class="flex flex-col items-start gap-y-1.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700">
                                    <h4 class="text-sm font-bold">Newsletter</h4>
                                    <p class="text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, quas!</p>
                                </div>
                                <div class="flex flex-col items-start gap-y-1.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700">
                                    <h4 class="text-sm font-bold">Newsletter</h4>
                                    <p class="text-xs">Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati, quas!</p>
                                </div>
                            </div>
                        </div>
                        <!-- Notification Box Dropdown End -->
                    </div>


                    <div class="h-[62px] w-[1px] bg-[#9c9c9c]"></div>

                    <!-- Profile Dropdown Section Start -->
                    <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                        <div class="flex items-center gap-3 cursor-pointer hover:bg-gray-100 box-border py-1 px-2 rounded-lg">
                            <button id="hs-dropdown-contacts" type="button"
                            class="size-11 cursor-pointer inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 focus:outline-hidden disabled:opacity-50 disabled:pointer-events-none dark:text-white"
                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                <img class="shrink-0 size-11 rounded-full"
                                    src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
                                    alt="Avatar">
                            </button>

                            <div class="flex flex-col items-center">
                                <span class="font-bold text-[14.5px]">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span>
                                <span>{{ strtoupper(Auth::user()->role)
                                }}</span>
                            </div>
                        </div>

                        <div class="hs-dropdown-menu translate-y-2 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full"
                            role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-contacts">
                            <div class="py-3 px-5 bg-gray-100 rounded-t-lg dark:bg-neutral-700">
                                <p class="text-sm text-gray-500 dark:text-neutral-500">Signed in as</p>
                                <p class="text-sm font-medium text-gray-800 dark:text-neutral-200">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="p-1.5 space-y-0.5">
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                    href="/main/users/profile">
                                    <img src="/assets/sidebar/profile-1user.svg" alt="">
                                    Profile
                                </a>
                                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
                                    href="{{ route('admin.logout') }}">
                                    <img src="/assets/sidebar/logout.svg" alt="">
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Profile Dropdown Section End -->
                </div>
            </div>
        </nav>
    </header>
    <!-- Main Header Section End -->

    <!-- Navigation Toggle Start -->
    <div class="-mt-px">
        <div
            class="sticky top-0 inset-x-0 z-20 bg-white border-y border-gray-200 px-4 sm:px-6 lg:px-8 lg:hidden shadow">
            <div class="flex items-center py-2">
                <button type="button"
                    class="size-8 flex justify-center items-center gap-x-2 border border-gray-200 text-gray-800 hover:text-gray-500 rounded-lg focus:outline-hidden focus:text-gray-500 disabled:opacity-50 disabled:pointer-events-none dark:border-neutral-700 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
                    aria-haspopup="dialog" aria-expanded="false" aria-controls="hs-application-sidebar"
                    aria-label="Toggle navigation" data-hs-overlay="#hs-application-sidebar">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect width="18" height="18" x="3" y="3" rx="2" />
                        <path d="M15 3v18" />
                        <path d="m8 9 3 3-3 3" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Navigation Toggle End -->

    <!-- Sidebar Start -->
    <div id="hs-application-sidebar"
        class="hs-overlay  [--auto-close:lg]
        hs-overlay-open:translate-x-0
        -translate-x-full transition-all duration-300 transform
        w-65 h-full
        hidden
        fixed inset-y-0 start-0 z-60
        bg-white border-e border-gray-200
        lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 shadow"
        role="dialog" tabindex="-1" aria-label="Sidebar">
        <div class="relative flex flex-col h-full max-h-full">
            <div class="px-6 py-[11px] flex items-center border-b border-gray-400">
                <!-- Logo -->
                <a class="flex justify-between items-center gap-3" href="{{ route('dashboard') }}">
                    <div class="w-10 h-10">
                        <img src="/assets/sidebar/inv-logo.png" />
                    </div>
                    <div class="shrink-0 text-lg font-bold text-black">FAST FORWARD</div>
                </a>
                <!-- End Logo -->
                <div class="hidden lg:block ms-2"></div>
            </div>

            <!-- Content -->
            <div
                class="h-full overflow-y-auto [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">
                <nav class="hs-accordion-group p-3 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
                    <ul class="flex flex-col space-y-1">
                        <li class="mt-3">
                            <a class="flex items-center gap-x-3.5 py-2 px-2.5 bg-gray-100 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100"
                                href="{{ route('dashboard') }}">
                                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                    <polyline points="9 22 9 12 15 12 15 22" />
                                </svg>
                                Dashboard
                            </a>
                        </li>

                        <div class="flex items-center gap-2 my-3">
                            <div class="flex-1 h-px bg-[#8a8a8a]"></div>
                            <span class="text-[10px] text-[#8a8a8a] whitespace-nowrap font-bold">Main Section</span>
                            <div class="flex-1 h-px bg-[#8a8a8a]"></div>
                        </div>

                        <li class="hs-accordion" id="contacts-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"                                aria-expanded="true" aria-controls="contacts-accordion-child">
                                <img src="/assets/sidebar/user-search.svg" alt="">
                                Contacts

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="contacts-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="contacts-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="{{ route('contacts.customers') }}">
                                            Customers
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="{{ route('contacts.suppliers') }}">
                                            Suppliers
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="hs-accordion" id="sale-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"
                                aria-expanded="true" aria-controls="sale-accordion-child">
                                <img src="/assets/sidebar/shopping-cart.svg" alt="">
                                Sale

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="sale-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="sale-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/sale/invoices">
                                            Invoice
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/sale/paymentin">
                                            Payment In
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="#">
                                            Sale Return
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="hs-accordion" id="purchase-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"
                                aria-expanded="true" aria-controls="purchase-accordion-child">
                                <img src="/assets/sidebar/receipt-text.svg" alt="">
                                Purchase

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="purchase-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="purchase-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/purchase/purchasebills">
                                            Purchase Bill
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/purchase/paymentout">
                                            Payment Out
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="#">
                                            Purchase Return
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="hs-accordion" id="customer-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"
                                aria-expanded="true" aria-controls="customer-accordion-child">
                                <img src="/assets/sidebar/user-search.svg" alt="">
                                Customer

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="customer-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="customer-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/customer/reportbyitem">
                                            Report By Item
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/customer/customerstatement">
                                            Customer Statement
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/customer/customeroutstandings">
                                            Customer Outstanding's
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/customer/prepaidamountentryfrom">
                                            Prepaid Amount Entry
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/customer/returnamountentryfrom">
                                            Return Amount Entry
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="hs-accordion" id="supplier-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"
                                aria-expanded="true" aria-controls="supplier-accordion-child">
                                <img src="/assets/sidebar/user-search.svg" alt="">
                                Supplier

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="supplier-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="supplier-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/supplier/reportbyitem">
                                            Report By Item
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/supplier/supplierstatement">
                                            Supplier Statement
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/supplier/supplieroutstandings">
                                            Supplier Outstanding's
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="{{ route('contacts.paymentOut') }}">
                                            Unpaid Purchase Bills
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="{{ route('contacts.supplierPayment') }}">
                                            Supplier Payment
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="{{ route('contacts.supplierPaymentHistory') }}">
                                            Supplier Payment History
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="{{ route('contacts.createCreditNote') }}">
                                            Credit Note Entry
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="{{ route('contacts.createDebitNote') }}">
                                            Debit Note Entry
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="hs-accordion" id="items-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"
                                aria-expanded="true" aria-controls="items-accordion-child">
                                <img src="/assets/sidebar/box.svg" alt="">
                                Items

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="items-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="items-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/items/itemlist">
                                            Item List
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/items/categorylist">
                                            Category List
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/items/brandlist">
                                            Brand List
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="hs-accordion" id="warehouse-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"
                                aria-expanded="true" aria-controls="warehouse-accordion-child">
                                <img src="/assets/sidebar/shop.svg" alt="">
                                Warehouse

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="warehouse-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="warehouse-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="{{ route('warehouse.warehousesList') }}">
                                            Warehouses
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="{{ route('warehouse.outletsList') }}">
                                            Outlets
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="{{ route('warehouse.stockTransferList') }}">
                                            Stock Transfer
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="hs-accordion" id="reports-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"
                                aria-expanded="true" aria-controls="reports-accordion-child">
                                <img src="/assets/sidebar/document-text.svg" alt="">
                                Reports

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="reports-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="reports-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/reports/billwiseprofit">
                                            Bill-Wise Profit
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/reports/salessummery">
                                            Sales Summery
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/reports/purchasesummery">
                                            Purchase Summery
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/reports/daybook">
                                            Daybook
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/reports/stockreport">
                                            Stock Report
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/reports/partyreport">
                                            Party Report
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/reports/gstreport">
                                            GST Report
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/reports/expensereport">
                                            Expenses Report
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="hs-accordion" id="expenses-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"
                                aria-expanded="true" aria-controls="expenses-accordion-child">
                                <img src="/assets/sidebar/empty-wallet-time.svg" alt="">
                                Expenses

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="expenses-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="expenses-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/expenses/expenselist">
                                            Expenses
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/expenses/expensetype">
                                            Expenses Types
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="hs-accordion" id="cashandbank-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"
                                aria-expanded="true" aria-controls="cashandbank-accordion-child">
                                <img src="/assets/sidebar/bank.svg" alt="">
                                Cash & Bank

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="cashandbank-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="cashandbank-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/cashandbank/cashinhand">
                                            Cash In Hand
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/cashandbank/banks">
                                            Banks
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="hs-accordion" id="users-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"
                                aria-expanded="true" aria-controls="users-accordion-child">
                                <img src="/assets/sidebar/profile-2user.svg" alt="">
                                Users

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="users-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="users-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/users/profile">
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="{{ route('users.usersList') }}">
                                            All Users
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/users/employeelist">
                                            Employees
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="hs-accordion" id="target-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"
                                aria-expanded="true" aria-controls="target-accordion-child">
                                <img src="/assets/sidebar/send.svg" alt="">
                                Target

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="target-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="target-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/target/organizationtarget">
                                            Organization Target
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/target/outlettarget">
                                            Outlet Target
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="hs-accordion" id="settings-accordion">
                            <button type="button"
                                class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 text-[14.5px] tracking-wide text-[#006eff] bg-[#0084ff31] rounded-lg hover:bg-[#0084ff44] focus:outline-hidden focus:bg-[#0084ff44]"
                                aria-expanded="true" aria-controls="settings-accordion-child">
                                <img src="/assets/sidebar/setting-3.svg" alt="">
                                Settings

                                <svg class="hs-accordion-active:block ms-auto hidden size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>

                                <svg class="hs-accordion-active:hidden ms-auto block size-4"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <div id="settings-accordion-child"
                                class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden"
                                role="region" aria-labelledby="settings-accordion">
                                <ul class="ps-8 pt-1 space-y-1">
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/settings/organization">
                                            Organization
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/settings/tax-rates">
                                            Tax Rates
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/settings/unitlist">
                                            Unit List
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/settings/tcs-tds-rates">
                                            TDS/TCS List
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/settings/payment-options">
                                            Payment Options
                                        </a>
                                    </li>
                                    <li>
                                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-gray-800 rounded-lg hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 dark:text-neutral-200"
                                            href="/main/settings/finances-list">
                                            Finance Details
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- End Content -->
        </div>
    </div>
    <!-- Sidebar End -->

    <!-- Main Content Section Start -->
    <div class="w-full lg:ps-64">
        <div class="p-4 sm:p-6 space-y-4 sm:space-y-6 bg-[#0084ff11] min-h-svh">
            @yield("content")
        </div>
    </div>
    <!-- Main Content Section End -->

    <script src="/assets/sidebar/js/theme-toggle.js"></script>
</body>

</html>