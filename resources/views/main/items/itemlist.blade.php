<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

    <!-- Custom Css For Table Start -->
    <link rel="stylesheet" href="/assets/table/css/style.css">
    <!-- Custom Css For Table End -->

    <title>Item List | Fast Forward</title>

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
                ['url' => '/main/items/itemlist', 'text' => 'Item List']
            ]" />

            <!-- Table Start -->
            <div class="shadow-md rounded-lg bg-[#fff]">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">ITEM LIST</h3>
                    <button type="button" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <a href="/main/items/createitem" class="text-[#fff] font-semibold text-sm uppercase py-2 px-5">Create Item</a>
                    </button>
                </div>

                <section class="grid grid-cols-3 items-center px-5 py-3 gap-10">
                    <!-- Select Warehouse Start -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-[#8d8d8d] dark:text-white">Warehouse</label>
                        <select id="warehouseSelect" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option value="">Select Warehouse</option>
                            <option value="Warehouse One">Warehouse One</option>
                            <option value="Warehouse Two">Warehouse Two</option>
                        </select>
                    </div>
                    <!-- Select Warehouse End -->
                    <!-- Select Brand Start -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-[#8d8d8d] dark:text-white">Brand</label>
                        <select id="brandSelect" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option value="">Select Brand</option>
                            <option value="Apple">Apple</option>
                            <option value="Samsung">Samsung</option>
                        </select>
                    </div>
                    <!-- Select Brand End -->
                    <!-- Select Category Start -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-[#8d8d8d] dark:text-white">Category</label>
                        <select id="categorySelect" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option value="">Select Category</option>
                            <option value="Smartphone">Smartphone</option>
                            <option value="Headphone">Headphone</option>
                        </select>
                    </div>
                    <!-- Select Category End -->
                </section>

                <div class="px-5 py-5">
                    <div class="table-container">
                        <table id="myTable" class="custom-data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Item Code</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Sale Price</th>
                                    <th>Purchase Price</th>
                                    <th>Quantity</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>INV-00123</td>
                                    <td>2025-04-16</td>
                                    <td>John Doe</td>
                                    <td>$250.00</td>
                                    <td><span class="status-paid">Paid</span></td>
                                    <td>Credit Card</td>
                                    <td>Credit Card</td>
                                    <td>Credit Card</td>
                                    <td>2025-04-16 10:23 AM</td>
                                    <td>
                                        <div class="hs-dropdown relative inline-flex">
                                            <button type="button" class="py-1 px-6 inline-flex items-center gap-x-2 text-xs rounded-full bg-[#abd7ff] text-[#0084ff] hover:bg-[#9bc3ff] focus:outline-hidden focus:bg-[#9bc3ff] disabled:opacity-50 disabled:pointer-events-none cursor-pointer font-bold uppercase" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                See
                                            </button>
                                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 shadow-2xl" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-icons">
                                                <div class="p-1">
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                        <img src="/assets/main/sale/printer.svg" alt="" class="w-4 h-4">
                                                        Edit
                                                    </a>
                                                    <button class="flex items-center gap-x-3.5 py-2 px-3 min-w-full cursor-pointer rounded-lg text-sm text-red-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700">
                                                        <img src="/assets/table/trash.svg" alt="" class="w-4 h-4">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Table End -->
        </section>
    @endsection

    <!-- Main js For Table Start -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#myTable").DataTable();

            // Initialize Select2 for Supplier dropdown
            $('#brandSelect').select2({
                placeholder: "Select Brand",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#brandSelect').parent(),
                minimumResultsForSearch: 0 
            });
            
            // Initialize Select2 for Warehouse dropdown
            $('#warehouseSelect').select2({
                placeholder: "Select Warehouse",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#warehouseSelect').parent(),
                minimumResultsForSearch: 0 
            });
            
            // Initialize Select2 for Category dropdown
            $('#categorySelect').select2({
                placeholder: "Select Category",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#categorySelect').parent(),
                minimumResultsForSearch: 0 
            });
            
            // Handle Brand selection change
            $('#brandSelect').on('change', function() {
                const selectedBrand = $(this).val();
                console.log("Selected Brand:", selectedBrand);
            });
            
            // Handle Warehouse selection change
            $('#warehouseSelect').on('change', function() {
                const selectedWarehouse = $(this).val();
                console.log("Selected Warehouse:", selectedWarehouse);
            });

            // Handle Category selection change
            $('#categorySelect').on('change', function() {
                const selectedCategory = $(this).val();
                console.log("Selected Warehouse:", selectedCategory);
            });
        });
    </script>
    <!-- Main js For Table End -->
</body>
</html>