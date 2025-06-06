<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Create Customer | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Contacts'],
                ['url' => route('contacts.customers'), 'text' => 'Customer List'],
                ['url' => route('contacts.createCustomer'), 'text' => 'Create Customer']
            ]" />

             <!-- For success message -->
             @if (session('success'))
                <div class="mt-4 mb-4 p-4 rounded-lg text-sm text-green-800 bg-green-100 border border-green-300 dark:bg-green-900 dark:text-green-100 dark:border-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <!-- For error message -->
            @if ($errors->any())
                <div class="mt-4 mb-4">
                    <div class="bg-red-50 border border-red-200 text-red-800 text-sm rounded-lg p-4 dark:bg-red-900 dark:border-red-800 dark:text-red-200">
                        <h2 class="font-semibold mb-2">There were some problems with your input:</h2>
                        <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">CUSTOMER DETAILS</h3>
                </div>
                <div class="py-5">
                    <form action="{{ route('contacts.saveCustomerToDatabase') }}" method="POST" class="space-y-6">
                        @csrf
                        <!-- Personal Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 px-5">
                            <div>
                                <label for="first-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">First Name</label>
                                <input type="text" id="first-name" name="first_name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="last-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Last Name</label>
                                <input type="text" id="last-name" name="last_name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="email" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Email</label>
                                <input type="email" id="email" name="email" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="address" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Adders</label>
                                <input type="text" id="address" name="address" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="mobile" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Mobile</label>
                                <input type="number" id="mobile" name="mobile" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="whatsapp-number" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Whatsapp Number</label>
                                <input type="number" id="whatsapp-number" name="whatsapp_number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                        </div>

                        <!-- Credit Info -->
                        <div class="pt-4">
                            <h3 class="font-semibold text-2xl uppercase border-b mb-5 border-gray-200 px-5 py-3">Credit Info</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 px-5">
                                <div>
                                    <label for="opening-balance" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Opening Balance</label>
                                    <input type="text" id="opening-balance" name="opening_balance" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                </div>
                                <div class="grid sm:grid-cols-2 gap-2 h-fit self-end">
                                    <label for="opening_balance_type_pay" class="flex p-3 w-full bg-white border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                        <input type="radio" value="to_pay" name="opening_balance_type" class="shrink-0 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-in-form">
                                        <span class="text-sm text-gray-800 font-bold ms-3 dark:text-neutral-400">To Pay</span>
                                    </label>

                                    <label for="opening_balance_type_receive" class="flex p-3 w-full bg-white border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                                        <input type="radio" value="to_receive" name="opening_balance_type" class="shrink-0 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-checked-in-form" checked="">
                                        <span class="text-sm text-gray-800 font-bold ms-3 dark:text-neutral-400">To Receive</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Credit Period (Days)</label>
                                    <select name="credit_period" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option selected="" disabled>Select credit period</option>
                                        <option value="5">5 Days</option>
                                        <option value="10">10 Days</option>
                                        <option value="10">15 Days</option>
                                        <option value="10">20 Days</option>
                                        <option value="10">25 Days</option>
                                        <option value="10">30 Days</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Credit Limit</label>
                                    <select name="credit_limit" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option selected="" disabled>Select credit limit</option>
                                        <option value="500">₹ 500</option>
                                        <option value="1000">₹ 1000</option>
                                        <option value="1500">₹ 1500</option>
                                        <option value="2000">₹ 2000</option>
                                        <option value="2500">₹ 2500</option>
                                        <option value="3000">₹ 3000</option>
                                        <option value="3500">₹ 3500</option>
                                        <option value="4000">₹ 4000</option>
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
                                <a href="{{ route('contacts.customers') }}">Close</a>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @endsection
</body>
</html>