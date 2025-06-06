<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Prepaid Amount Entry | Fast Forward</title>

    <style>
        .select2-container--default .select2-selection--single {
            height: 42px;
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.375rem 0.75rem;
        }
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            padding: 0.375rem 0.75rem;
        }
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #3b82f6;
        }
    </style>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Customer'],
                ['url' => '/main/customer/customeroutstandings', 'text' => 'Customer Outstandings'],
                ['url' => route('customer.prepaidAmountHistory', $selectedCustomerId), 'text' => 'Prepaid Amount History'],
                ['url' => route('customer.prepaidAmountEntry'), 'text' => 'Prepaid Amount Entry']
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
                    <h3 class="font-semibold text-2xl">PREPAID AMOUNT DETAILS</h3>
                </div>
                <div class="py-5">
                    <form id="supplierForm" action="{{ route('customer.savePrepaidAmountEntryToDatabase') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 px-5">
                            <div>
                                <label for="date" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Date</label>
                                <input type="date" name="date" id="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="referral-no" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Referral No.</label>
                                <div class="flex">
                                    <input type="text" name="referral_number" id="referral-no" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-l-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    <button type="button" id="generate-referral" class="whitespace-nowrap px-6 py-3 bg-[#8b8b8b] text-white rounded-r-lg hover:bg-[#797979] transition-colors duration-300 font-semibold cursor-pointer">
                                        Auto
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-[#8d8d8d] dark:text-white">Customer</label>
                                <select name="customer_id" id="customerSelect" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        @if (isset($selectedCustomerId) && $selectedCustomerId == $customer->id)
                                            selected
                                        @endif
                                    >
                                        {{ $customer->first_name }} {{ $customer->last_name }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="particular" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Particular</label>
                                <input type="text" name="particular" id="particular" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="amount" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Amount</label>
                                <input type="number" name="amount" id="amount" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <!-- Select TCS Start -->
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-[#8d8d8d] dark:text-white">TCS/TDS</label>
                                <select name="tcs_tds" id="tcsSelect" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    @foreach ($tcsTds as $rates)
                                        <option value="{{ $rates->rate }}">{{ $rates->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Select TCS End -->
                            <div>
                                <label for="payment-note" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Note</label>
                                <textarea 
                                    id="payment-note" 
                                    name="note"
                                    rows="3" 
                                    class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                                    required
                                ></textarea>
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {   
            $('#tcsSelect').select2({
                placeholder: "Select TCS",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#tcsSelect').parent()
            });
            
            $('#tcsSelect').on('change', function() {
                const selectedTcs = $(this).val();
                console.log("Selected Customer:", selectedTcs);
            });

            $('#customerSelect').select2({
                placeholder: "Select Customer",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#customerSelect').parent()
            });
            
            $('#customerSelect').on('change', function() {
                const selectedCustomer = $(this).val();
                console.log("Selected Customer:", selectedCustomer);
            });

            // Generate random referral code (NOT ALLOWED)
            document.getElementById('generate-referral').addEventListener('click', function() {
                const prefix = 'REF-';
                const randomNum = Math.floor(100000 + Math.random() * 900000);
                const referralCode = prefix + randomNum;
                
                document.getElementById('referral-no').value = referralCode;
                
                document.getElementById('referral-no').dispatchEvent(new Event('change'));
            });
        });
    </script>
</body>
</html>