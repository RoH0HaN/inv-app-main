<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Create Item | Fast Forward</title>

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
                ['url' => '#', 'text' => 'Item'],
                ['url' => '/items/items-list', 'text' => 'Item List'],
                ['url' => '/items/create-item', 'text' => 'Create Item']
            ]" />

            <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">ITEM DETAILS</h3>
                </div>
                <div class="py-5">
                    <form id="createItem" action="#" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5 px-5">
                            <div>
                                <label for="name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Name</label>
                                <input type="text" id="name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="hsn" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">HSN</label>
                                <input type="text" id="hsn" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="sku" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">SKU</label>
                                <input type="text" id="sku" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <!-- Select Brand Start -->
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-[#8d8d8d] dark:text-white">Brand</label>
                                <div class="flex items-center gap-2">
                                    <select id="brandSelect" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option disabled selected="" value="">Select Brand</option>
                                        <option value="Apple">Apple</option>
                                        <option value="Samsung">Samsung</option>
                                    </select>

                                    <!-- Create Brand Dialog Start -->
                                    <button type="button" class="py-[8px] px-4 inline-flex items-center border border-gray-300 rounded-lg transition-all duration-300 hover:bg-gray-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="create-brand-model" data-hs-overlay="#create-brand-model">
                                        <img src="/assets/items/add-square.svg" alt="" class="w-6 h-6">
                                    </button>
                                    <!-- Create Brand Dialog End -->
                                </div>
                            </div>
                            <!-- Select Brand End -->
                            <div>
                                <label for="item-code" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Item Code</label>
                                <div class="flex">
                                    <input type="text" id="item-code" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-l-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    <button type="button" id="generate-referral" class="whitespace-nowrap px-6 py-3 bg-[#8b8b8b] text-white rounded-r-lg hover:bg-[#797979] transition-colors duration-300 font-semibold cursor-pointer">
                                        Auto
                                    </button>
                                </div>
                            </div>
                            <!-- Select Category Start -->
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-[#8d8d8d] dark:text-white">Category</label>
                                <div class="flex items-center gap-2">
                                    <select id="categorySelect" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option disabled selected="" value="">Select Category</option>
                                        <option value="Smartphone">Smartphone</option>
                                        <option value="Headphone">Headphone</option>
                                    </select>

                                    <!-- Create Category Dialog Start -->
                                    <button type="button" class="py-[8px] px-4 inline-flex items-center border border-gray-300 rounded-lg transition-all duration-300 hover:bg-gray-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="create-category-model" data-hs-overlay="#create-category-model">
                                        <img src="/assets/items/add-square.svg" alt="" class="w-6 h-6">
                                    </button>
                                    <!-- Create Category Dialog End -->
                                </div>
                            </div>
                            <!-- Select Category End -->
                            <div>
                                <label for="payment-note" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Note</label>
                                <textarea 
                                    id="payment-note" 
                                    rows="3" 
                                    class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                                    required
                                ></textarea>
                            </div>
                            <!-- Select Supplier Start -->
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-[#8d8d8d] dark:text-white">Supplier</label>
                                <select id="supplierSelect" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    <option disabled selected="" value="">Select Supplier</option>
                                    <option value="Tim">Tim</option>
                                    <option value="Jack">Jack</option>
                                </select>
                            </div>
                            <!-- Select Supplier End -->

                            <div class="flex gap-x-20 items-center col-span-3">
                                <div class="flex items-center">
                                    <input type="radio" name="hs-radio-group" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-group-1" checked="">
                                    <label for="hs-radio-group-1" class="text-base font-bold text-black ms-2 dark:text-neutral-400">Batch Tracking</label>
                                </div>

                                <div class="flex items-center">
                                    <input type="radio" name="hs-radio-group" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-group-2">
                                    <label for="hs-radio-group-2" class="text-base font-bold text-black ms-2 dark:text-neutral-400">IMEI / Serial Tracking</label>
                                </div>
                            </div>
                        </div>

                        <!-- Tabs Section Start -->
                        <div class="border-b border-gray-200 dark:border-neutral-700 col-end-3 mx-5 mt-10">
                            <nav class="flex gap-x-1" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                                <button type="button" class="hs-tab-active:bg-white hs-tab-active:border-b-transparent hs-tab-active:border-[#03BC06] hs-tab-active:text-[#03BC06] dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-2 px-6 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-semibold cursor-pointer text-center border border-gray-200 text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-hidden focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200 active" id="card-type-tab-item-1" aria-selected="true" data-hs-tab="#card-type-tab-preview" aria-controls="card-type-tab-preview" role="tab">
                                    <img src="/assets/main/items/moneys.svg" alt="">
                                    Pricing
                                </button>
                                <button type="button" class="hs-tab-active:bg-white hs-tab-active:border-b-transparent hs-tab-active:border-blue-600 hs-tab-active:text-blue-600 dark:hs-tab-active:bg-neutral-800 dark:hs-tab-active:border-b-gray-800 dark:hs-tab-active:text-white -mb-px py-2 px-6 inline-flex items-center gap-x-2 bg-gray-50 text-sm font-semibold cursor-pointer text-center border border-gray-200 text-gray-500 rounded-t-lg hover:text-gray-700 focus:outline-hidden focus:text-gray-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 dark:focus:text-neutral-200" id="card-type-tab-item-2" aria-selected="false" data-hs-tab="#card-type-tab-2" aria-controls="card-type-tab-2" role="tab">
                                    <img src="/assets/main/items/box.svg" alt="">
                                    Stock
                                </button>
                            </nav>
                        </div>

                        <div class="mt-5 mx-5">
                            <!-- Tax 01 Start -->
                            <div id="card-type-tab-preview" role="tabpanel" aria-labelledby="card-type-tab-item-1" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                                <div>
                                    <label for="hs-inline-leading-pricing-select-label" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Sale Price</label>
                                    <div class="grid grid-cols-2">
                                        <input type="text" id="hs-inline-leading-pricing-select-label" name="inline-add-on" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-l-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <select id="hs-inline-leading-select-currency" name="" class="block border-gray-400 py-2.5 sm:py-3 px-4 w-full border rounded-r-lg focus:ring-blue-600 focus:border-blue-600 dark:text-neutral-500 dark:bg-neutral-900">
                                            <option selected="" disabled>Select Tax</option>
                                            <option value="Without Tax">Without Tax</option>
                                            <option value="With Tax">With Tax</option>
                                        </select>
                                    </div>
                                </div>
                                <div>
                                    <label for="hs-inline-leading-discount-select-label" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Discount</label>
                                    <div class="grid grid-cols-2">
                                        <input type="text" id="hs-inline-leading-discount-select-label" name="inline-add-on" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-l-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <select id="hs-inline-leading-select-currency" name="" class="block border-gray-400 py-2.5 sm:py-3 px-4 w-full border rounded-r-lg focus:ring-blue-600 focus:border-blue-600 dark:text-neutral-500 dark:bg-neutral-900">
                                            <option selected="" disabled>Select Discount Type</option>
                                            <option value="Percentage">Percentage</option>
                                            <option value="Fixed">Fixed</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-5">
                                    <div>
                                        <label for="maximum-retail-price" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Maximum Retail Price</label>
                                        <input type="text" id="maximum-retail-price" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    </div>
                                    <div>
                                        <label for="minimum-selling-price" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Minimum Selling Price</label>
                                        <input type="text" id="minimum-selling-price" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    </div>
                                </div>

                                <div>
                                    <label for="purchase-price" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Purchase Price</label>
                                    <input type="text" id="purchase-price" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                </div>
                                <!-- Select Tax Start -->
                                <div>
                                    <label class="block text-sm font-semibold mb-2 text-[#8d8d8d] dark:text-white">Tax</label>
                                    <div class="flex items-center gap-2">
                                        <select id="taxSelect" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option disabled selected="" value="">Select Tax</option>
                                            <option value="None">None</option>
                                            <option value="GST 18%">GST 18%</option>
                                        </select>
                                        <!-- Create Tax Dialog Start -->
                                        <button type="button" class="py-[8px] px-4 inline-flex items-center border border-gray-300 rounded-lg transition-all duration-300 hover:bg-gray-50 disabled:pointer-events-none" aria-haspopup="dialog" aria-expanded="false" aria-controls="create-tax-model" data-hs-overlay="#create-tax-model">
                                            <img src="/assets/items/add-square.svg" alt="" class="w-6 h-6">
                                        </button>
                                        <!-- Create Tax Dialog End -->
                                    </div>
                                </div>
                                <!-- Select Tax End -->
                            </div>
                            <!-- Tax 01 End -->

                            <!-- Tax 02 Start -->
                            <div id="card-type-tab-2" class="hidden" role="tabpanel" aria-labelledby="card-type-tab-item-2">
                                <section class="grid grid-cols-3 gap-x-8 gap-y-5">
                                    <div>
                                        <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Storage Location</label>
                                        <select id="storage-location" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                            <option selected="" disabled>Select Storage Loacation</option>
                                            <option vlaue="Warehouse">Warehouse</option>
                                            <option value="Shop One">Shop One</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="opening-quantity" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Opening Quantity</label>
                                        <div class="flex">
                                            <input type="text" id="imei-number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-l-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                            <button id="imei-batch-button" type="button" class="whitespace-nowrap px-6 py-3 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 transition-colors duration-300 font-semibold cursor-pointer">
                                                IMEI
                                            </button>
                                        </div>
                                    </div>
                                    <div>
                                        <label for="minimum-stock" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Minimum Stock</label>
                                        <input type="text" id="minimum-stock" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    </div>
                                </section>
                            </div>
                            <!-- Tax 02 End -->
                        </div>
                        <!-- Tabs Section End -->

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

                    <x-create-brand-dialog />
                    <x-create-category-dialog />
                    <x-create-tax-dialog />
                    <x-add-batch-details-dialog />
                    <x-add-imei-number-details />
                </div>
            </div>
        </section>
    @endsection

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize Select2 for Brand dropdown
            $('#brandSelect').select2({
                placeholder: "Select Brand",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#brandSelect').parent(),
                minimumResultsForSearch: 0 
            });
            // Handle Brand selection change
            $('#brandSelect').on('change', function() {
                const selectedBrand = $(this).val();
                console.log("Selected Brand:", selectedBrand);
            });

            // Initialize Select2 for Category dropdown
            $('#categorySelect').select2({
                placeholder: "Select Category",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#categorySelect').parent(),
                minimumResultsForSearch: 0 
            });
            // Handle Category selection change
            $('#categorySelect').on('change', function() {
                const selectedCategory = $(this).val();
                console.log("Selected Warehouse:", selectedCategory);
            });
            
            // Initialize Select2 for Supplier dropdown
            $('#supplierSelect').select2({
                placeholder: "Select Supplier",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#supplierSelect').parent(),
                minimumResultsForSearch: 0 
            });
            // Handle Supplier selection change
            $('#supplierSelect').on('change', function() {
                const selectedSupplier = $(this).val();
                console.log("Selected Warehouse:", selectedSupplier);
            });

            // Initialize Select2 for Tax dropdown
            $('#taxSelect').select2({
                placeholder: "Select Tax",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#taxSelect').parent(),
                minimumResultsForSearch: 0 
            });
            // Handle Tax selection change
            $('#taxSelect').on('change', function() {
                const selectedTax = $(this).val();
                console.log("Selected Warehouse:", selectedTax);
            });

            // Generate random Item Code (NOT ALLOWED)
            document.getElementById('generate-referral').addEventListener('click', function() {
                const randomNum = Math.floor(100000 + Math.random() * 900000);
                
                document.getElementById('item-code').value = randomNum;
                
                document.getElementById('item-code').dispatchEvent(new Event('change'));
            });

            // Radio button elements
            const batchRadio = $('#hs-radio-group-1');
            const imeiRadio = $('#hs-radio-group-2');
            const stockFieldsContainer = $('#card-type-tab-2 section > div:nth-child(2)');

            // Function to update the tracking fields based on selected mode
            function updateTrackingFields() {
                // Clear existing fields
                stockFieldsContainer.empty();
                
                if (batchRadio.is(':checked')) {
                    // Show batch field
                    stockFieldsContainer.append(`
                        <label for="opening-quantity" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Opening Quantity</label>
                        <div class="flex">
                            <input type="text" id="batch-number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-l-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            <button type="button" id="batch-button" class="whitespace-nowrap px-6 py-3 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 transition-colors duration-300 font-semibold cursor-pointer">
                                Batch
                            </button>
                        </div>
                    `);

                    // Add click handler for batch button
                    $(document).on('click', '#batch-button', function() {
                        const batchModal = document.getElementById('add-batch-details');
                        if (window.HSOverlay) {
                            // Properly initialize and show the modal
                            const modal = new HSOverlay(batchModal);
                            modal.open();
                        } else {
                            // Fallback if HSOverlay not available
                            $(batchModal).removeClass('hidden');
                        }
                    });
                    
                } else if (imeiRadio.is(':checked')) {
                    // Show IMEI field
                    stockFieldsContainer.append(`
                        <label for="opening-quantity" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Opening Quantity</label>
                        <div class="flex">
                            <input type="text" id="imei-number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-l-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            <button type="button" id="imei-button" class="whitespace-nowrap px-6 py-3 bg-blue-500 text-white rounded-r-lg hover:bg-blue-600 transition-colors duration-300 font-semibold cursor-pointer">
                                IMEI
                            </button>
                        </div>
                    `);

                    // Add click handler for IMEI button
                    $(document).on('click', '#imei-button', function() {
                        const imeiModal = document.getElementById('imei-details');
                        if (window.HSOverlay) {
                            // Properly initialize and show the modal
                            const modal = new HSOverlay(imeiModal);
                            modal.open();
                        } else {
                            // Fallback if HSOverlay not available
                            $(imeiModal).removeClass('hidden');
                        }
                    });
                }
            }

            // Event listeners for radio buttons
            batchRadio.on('change', updateTrackingFields);
            imeiRadio.on('change', updateTrackingFields);

            // Initial setup
            updateTrackingFields();

            // Generate random Item Code (your existing code)
            $('#generate-referral').on('click', function() {
                const randomNum = Math.floor(100000 + Math.random() * 900000);
                $('#item-code').val(randomNum).trigger('change');
            });
        });
    </script>
</body>
</html>