<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Create Credit Note | Fast Forward</title>

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
                ['url' => '#', 'text' => 'Contacts'],
                ['url' => route('contacts.suppliers'), 'text' => 'Suppliers List'],
                ['url' => {{ route('contacts.createDebitNote') }}, 'text' => 'Debit Note Entry']
            ]" />

            <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">DEBIT NOTE DETAILS</h3>
                </div>
                <div class="py-5">
                    <form id="supplierForm" action="#" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 px-5">
                            <div>
                                <label for="date" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Date</label>
                                <input type="date" id="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="referral-no" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Referral No.</label>
                                <div class="flex">
                                    <input type="text" id="referral-no" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-l-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    <button type="button" id="generate-referral" class="whitespace-nowrap px-6 py-3 bg-[#8b8b8b] text-white rounded-r-lg hover:bg-[#797979] transition-colors duration-300 font-semibold cursor-pointer">
                                        Auto
                                    </button>
                                </div>
                            </div>
                            <div>
                                <label for="supplier" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Supplier</label>
                                <input type="text" id="gst-no" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="particular" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Particular</label>
                                <input type="text" id="particular" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="amount" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Amount</label>
                                <input type="number" id="amount" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <!-- Select Warehouse Start -->
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-[#8d8d8d] dark:text-white">TCS</label>
                                <select id="tcsSelect" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    <option value="">Select TCS</option>
                                    <option value="TCS@0.1%">TCS@0.1%</option>
                                    <option value="TCS@0.5%">TCS@0.5%</option>
                                    <option value="TCS@1%">TCS@1%</option>
                                    <option value="TCS@2%">TCS@2%</option>
                                </select>
                            </div>
                            <!-- Select Warehouse End -->
                            <div>
                                <label for="payment-note" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Note</label>
                                <textarea 
                                    id="payment-note" 
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
                console.log("Selected TCS:", selectedTcs);
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