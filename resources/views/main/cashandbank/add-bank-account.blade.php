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
                ['url' => '/cash-bank/banks', 'text' => 'Bank Accounts'],
                ['url' => '/cash-bank/add-bank-account', 'text' => 'Create Bank Account']
            ]" />

            <!-- For error message -->
            @if (session('error'))
                <div class="mt-4 mb-4 p-4 rounded-lg text-sm text-red-800 bg-red-100 border border-red-300 dark:bg-red-900 dark:text-red-100 dark:border-red-700">
                    {{ session('error') }}
                </div>
            @endif

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
                    <h3 class="font-semibold text-2xl">ACCOUNT DETAILS</h3>
                </div>
                <div class="py-5">
                    <form id="createItem" action="{{ route('cash-bank.saveBankAccountToDatabase') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 px-5">
                            <div>
                                <label for="acc-holder-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Account Holder Name</label>
                                <input type="text" name="account_holder_name" id="acc-holder-name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="bank-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Bank Name</label>
                                <input type="text" name="bank_name" id="bank-name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="account-number" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Account Number</label>
                                <input type="number" name="account_number" id="account-number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="ifsc-code" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">IFSC Code</label>
                                <input type="text" name="ifsc_code" id="ifsc-code" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="opening-balance" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Opening Balance</label>
                                <input type="number" name="opening_balance" id="opening-balance" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            
                        </div>
                            
                        <label for="other-details" class="block text-base font-semibold mb-2 px-5 text-[#8d8d8d] dark:text-white">Select Operable Warehouse and outlet</label>
                        <div id="location-section" class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6 px-5">

                            <!-- Warehouses Section -->
                            <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl shadow-sm">
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <span class="inline-block px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 text-xs rounded-md">Warehouses</span>
                                </p>
                                <div class="space-y-3">
                                    @forelse($warehouses as $warehouse)
                                        <label for="warehouse_{{ $warehouse->id }}" class="flex items-center space-x-2 cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900 p-2 rounded-md transition">
                                            <input type="checkbox" name="location_ids[]" class="location-checkbox warehouse-checkbox text-blue-600 focus:ring-blue-500" 
                                                value="warehouse_{{ $warehouse->id }}" id="warehouse_{{ $warehouse->id }}">
                                            <span class="text-gray-800 dark:text-gray-100">{{ $warehouse->organization_name }}</span>
                                        </label>
                                    @empty
                                        <p class="text-sm text-gray-500">No warehouses available.</p>
                                    @endforelse
                                </div>
                            </div>

                            <!-- Outlets Section -->
                            <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl shadow-sm">
                                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                    <span class="inline-block px-2 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 text-xs rounded-md">Outlets</span>
                                </p>
                                <div class="space-y-3">
                                    @forelse($outlets as $outlet)
                                        <label for="outlet_{{ $outlet->id }}" class="flex items-center space-x-2 cursor-pointer hover:bg-green-50 dark:hover:bg-green-900 p-2 rounded-md transition">
                                            <input type="checkbox" name="location_ids[]" class="location-checkbox outlet-checkbox text-green-600 focus:ring-green-500" 
                                                value="outlet_{{ $outlet->id }}" id="outlet_{{ $outlet->id }}">
                                            <span class="text-gray-800 dark:text-gray-100">{{ $outlet->organization_name }}</span>
                                        </label>
                                    @empty
                                        <p class="text-sm text-gray-500">No outlets available.</p>
                                    @endforelse
                                </div>
                            </div>

                        </div>


                        <!-- Submit Button -->
                        <div class="pt-10 px-5 flex gap-5">
                            <button type="submit" class="w-fit bg-[#0084ff] text-white py-2 px-12 rounded-md hover:bg-[#0059ff] transition cursor-pointer">
                                Submit
                            </button>
                            <button class="py-2 px-12 w-fit inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                                <a href="{{ route('cash-bank.banks') }}">Close</a>
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