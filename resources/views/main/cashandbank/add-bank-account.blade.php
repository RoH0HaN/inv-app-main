<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Account Details | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Cash & Bank'],
                ['url' => '/main/cashandbank/banks', 'text' => 'Bank Accounts'],
                ['url' => '/main/cashandbank/add-bank-account', 'text' => 'Create Bank Account']
            ]" />

            <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">ACCOUNT DETAILS</h3>
                </div>
                <div class="py-5">
                    <form id="createItem" action="#" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 px-5">
                            <div>
                                <label for="bank-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Bank Name</label>
                                <input type="text" id="bank-name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="account-number" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Account Number</label>
                                <input type="number" id="account-number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="ifsc-code" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">IFSC Code</label>
                                <input type="text" id="ifsc-code" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="opening-balance" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Opening Balance</label>
                                <input type="number" id="opening-balance" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="other-details" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Other Details</label>
                                <textarea 
                                    id="other-details" 
                                    rows="3" 
                                    class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                                    required
                                ></textarea>
                            </div>
                        </div>

                        <!-- Outlet Selection -->
                        <div class="flex gap-x-20 items-center col-span-3 px-5">
                            <p class="block text-base font-semibold text-[#8d8d8d] dark:text-white">Select Operable Outlet</p>

                            <div class="flex items-center">
                                <input type="radio" name="outlet-radio-group" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="outlet-radio-1" checked>
                                <label for="outlet-radio-1" class="text-base font-bold text-black ms-2 dark:text-neutral-400">Outlet One</label>
                            </div>

                            <div class="flex items-center">
                                <input type="radio" name="outlet-radio-group" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="outlet-radio-2">
                                <label for="outlet-radio-2" class="text-base font-bold text-black ms-2 dark:text-neutral-400">Outlet Two</label>
                            </div>
                        </div>

                        <!-- Warehouse Selection -->
                        <div class="flex gap-x-20 items-center col-span-3 px-5">
                            <p class="block text-base font-semibold text-[#8d8d8d] dark:text-white">Select Operable Warehouse</p>

                            <div class="flex items-center">
                                <input type="radio" name="warehouse-radio-group" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="warehouse-radio-1" checked>
                                <label for="warehouse-radio-1" class="text-base font-bold text-black ms-2 dark:text-neutral-400">Warehouse One</label>
                            </div>

                            <div class="flex items-center">
                                <input type="radio" name="warehouse-radio-group" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="warehouse-radio-2">
                                <label for="warehouse-radio-2" class="text-base font-bold text-black ms-2 dark:text-neutral-400">Warehouse Two</label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="pt-10 px-5 flex gap-5">
                            <button type="submit" class="w-fit bg-[#0084ff] text-white py-2 px-12 rounded-md hover:bg-[#0059ff] transition cursor-pointer">
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>