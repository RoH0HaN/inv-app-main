<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Create Supplier | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => '/main/dashboard/dashboard', 'text' => 'Home'],
                ['url' => '#', 'text' => 'Contacts'],
                ['url' => '/main/contacts/suppliers', 'text' => 'Supplier List'],
                ['url' => '/main/contacts/createsupplier', 'text' => 'Create Supplier']
            ]" />

            <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">SUPPLIER DETAILS</h3>
                </div>
                <div class="py-5">
                    <form id="supplierForm" action="#" class="space-y-6">
                        <!-- Personal Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 px-5">
                            <div>
                                <label for="first-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">First Name</label>
                                <input type="text" id="first-name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="last-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Last Name</label>
                                <input type="text" id="last-name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="gst-no" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">GST No.</label>
                                <input type="text" id="gst-no" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="pan-no" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">PAN No.</label>
                                <input type="text" id="pan-no" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="email" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Email</label>
                                <input type="email" id="email" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="address" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Adderss</label>
                                <input type="text" id="address" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="modile" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Mobile</label>
                                <input type="number" id="modile" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="whatsapp-number" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Whatsapp Number</label>
                                <input type="number" id="whatsapp-number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                        </div>

                        <!-- Credit Info -->
                        <div class="pt-4">
                            <h3 class="font-semibold text-2xl uppercase border-b mb-5 border-gray-200 px-5 py-3">Credit Info</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 px-5">
                                <div>
                                    <label for="opening-balance" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Opening Balance</label>
                                    <input type="text" id="opening-balance" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                </div>
                                <div class="grid sm:grid-cols-2 gap-2 h-fit self-end">
                                    <label for="hs-radio-in-form" class="flex p-3 w-full bg-white border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                        <input type="radio" name="hs-radio-in-form" class="shrink-0 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-in-form">
                                        <span class="text-sm text-gray-800 font-bold ms-3 dark:text-neutral-400">To Pay</span>
                                    </label>

                                    <label for="hs-radio-checked-in-form" class="flex p-3 w-full bg-white border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                        <input type="radio" name="hs-radio-in-form" class="shrink-0 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-checked-in-form" checked="">
                                        <span class="text-sm text-gray-800 font-bold ms-3 dark:text-neutral-400">To Receive</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Credit Period (Days)</label>
                                    <select id="credit-period" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option selected="" disabled>Select credit period</option>
                                        <option vlaue="5">5</option>
                                        <option value="10">10</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Credit Limit</label>
                                    <select id="credit-limit" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option selected="" disabled>Select credit limit</option>
                                        <option vlaue="10000">10000</option>
                                        <option value="2000">2000</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-10 px-5 flex gap-5">
                            <button type="submit" class="w-fit bg-indigo-600 text-white py-2 px-12 rounded-md hover:bg-indigo-700 transition cursor-pointer">
                                Submit
                            </button>
                            <button class="py-2 px-12 w-fit inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                                <a href="/main/contacts/customers">Close</a>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @endsection


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('supplierForm');
            
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    function getValue(id) {
                        const el = document.getElementById(id);
                        return el ? el.value : null;
                    }
                    
                    const formData = {
                        personalInfo: {
                            firstName: getValue('first-name'),
                            lastName: getValue('last-name'),
                            gstNo: getValue('gst-no'),
                            panNo: getValue('pan-no'),
                            email: getValue('email'),
                            address: getValue('address'),
                            mobile: getValue('modile'),
                            whatsappNumber: getValue('whatsapp-number')
                        },
                        creditInfo: {
                            openingBalance: getValue('opening-balance'),
                            creditType: document.querySelector('input[name="hs-radio-in-form"]:checked')?.nextElementSibling?.textContent?.trim() || null,
                            creditPeriod: getValue('credit-period'),
                            creditLimit: getValue('credit-limit')
                        }
                    };
                    
                    console.log('Form Data:', formData);

                    form.reset();
                });
            } else {
                console.warn('Form element not found');
            }
        });
    </script>
</body>
</html>