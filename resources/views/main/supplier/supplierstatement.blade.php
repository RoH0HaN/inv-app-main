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

    <title>Supplier Statement | Fast Forward</title>

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
                ['url' => '#', 'text' => 'Supplier'],
                ['url' => '/supplier/supplier-statement', 'text' => 'Supplier Statements']
            ]" />

            <!-- Table Start -->
            <div class="shadow-md rounded-lg bg-[#fff]">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">SUPPLIER STATEMENTS</h3>
                </div>

                <section class="grid grid-cols-4 items-center px-5 py-3 gap-10">
                    <div>
                        <label for="from-date" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">From Date</label>
                        <input type="date" id="from-date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                    </div>
                    <div>
                        <label for="to-date" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">To Date</label>
                        <input type="date" id="to-date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                    </div>
                    <!-- Select Supplier Start -->
                    <div>
                        <label class="block text-sm font-semibold mb-2 text-[#8d8d8d] dark:text-white">Supplier</label>
                        <select id="supplierSelect" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option value="">Select Supplier</option>
                            <option value="Shop One">Jack</option>
                            <option value="Shop Two">Devid</option>
                        </select>
                    </div>
                    <!-- Select Supplier End -->
                </section>

                <div class="px-5 py-5">
                    <div class="table-container">
                        <table id="myTable" class="custom-data-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Info.</th>
                                    <th>Voucher Type</th>
                                    <th>Voucher No</th>
                                    <th>Debit (₹)</th>
                                    <th>Credit (₹)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>INV-00123</td>
                                    <td>2025-04-16</td>
                                    <td>John Doe</td>
                                    <td>$250.00</td>
                                    <td>Debit Card</td>
                                    <td>Credit Card</td>
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
            $('#supplierSelect').select2({
                placeholder: "Select Supplier",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#supplierSelect').parent(),
                minimumResultsForSearch: 0 
            });
            
            // Handle Customer selection change
            $('#supplierSelect').on('change', function() {
                const selectedSupplier = $(this).val();
                console.log("Selected Customer:", selectedSupplier);
            });
        });
    </script>
    <!-- Main js For Table End -->
</body>
</html>