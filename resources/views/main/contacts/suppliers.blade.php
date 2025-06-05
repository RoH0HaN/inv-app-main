<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Custom Css For Table Start -->
    <link rel="stylesheet" href="/assets/table/css/style.css">
    <!-- Custom Css For Table End -->

    <title>Suppliers | Fast Forward</title>

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
                ['url' => route('contacts.suppliers'), 'text' => 'Suppliers List']
            ]" />
            
            <!-- Table Start -->
            <div class="shadow-md rounded-lg bg-[#fff]">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">SUPPLIER LIST</h3>
                    <button type="button" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <a href="{{ route('contacts.createSupplier') }}" class="text-[#fff] font-semibold text-sm uppercase py-2 px-5">Create Supplier</a>
                    </button>
                </div>

                <!-- Select Warehouse Start -->
                <div class="flex justify-end mt-5 mb-10 px-5">
                    <div class="w-96 shrink-0">
                        <label class="block text-sm font-semibold mb-2 text-[#8d8d8d] dark:text-white">Warehouse</label>
                        <select id="warehouseSelect" class="py-2 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option value="">Select Warehouse</option>
                            <option value="Warehouse 01">Warehouse 01</option>
                            <option value="Warehouse 02">Warehouse 02</option>
                            <option value="Warehouse 03">Warehouse 03</option>
                            <option value="Warehouse 04">Warehouse 04</option>
                            <option value="Warehouse 05">Warehouse 05</option>
                            <option value="Warehouse 06">Warehouse 06</option>
                            <option value="Warehouse 07">Warehouse 07</option>
                            <option value="Warehouse 08">Warehouse 08</option>
                        </select>
                    </div>
                </div>
                <!-- Select Warehouse End -->

                <!-- Table Start From Here -->
                <div class="px-5 py-5">
                    <div class="table-container">
                        <table id="myTable" class="custom-data-table">
                            <thead class="">
                                <tr>
                                    <th class="">Name</th>
                                    <th class="">Mobile</th>
                                    <th class="">Email</th>
                                    <th class="">Outstanding Balance</th>
                                    <th class="">Closing Stock Balance</th>
                                    <th class="">Stock Gap Balance</th>
                                    <th class="">Created By</th>
                                    <th class="">Created At</th>
                                    <th class="">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="">
                                    <td class="">INV-00123</td>
                                    <td class="">+1234567890</td>
                                    <td class="">john@example.com</td>
                                    <td class="">$250.00</td>
                                    <td class="">$1,200.00</td>
                                    <td class="">$50.00</td>
                                    <td class="">Admin</td>
                                    <td class="">2025-04-16 10:23 AM</td>
                                    <td>
                                        <div class="hs-dropdown relative inline-flex">
                                            <button type="button" class="py-1 px-6 inline-flex items-center gap-x-2 text-xs rounded-full bg-[#abd7ff] text-[#0084ff] hover:bg-[#9bc3ff] focus:outline-hidden focus:bg-[#9bc3ff] disabled:opacity-50 disabled:pointer-events-none cursor-pointer font-bold uppercase" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                See
                                            </button>
                                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 shadow-2xl" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-icons">
                                                <div class="p-1">
                                                    <button class="flex items-center w-full cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" aria-haspopup="dialog" aria-expanded="false" aria-controls="edit-supplier-dialog" data-hs-overlay="#edit-supplier-dialog">
                                                        <img src="/assets/table/edit.svg" alt="" class="w-4 h-4">
                                                        Edit
                                                    </button>
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="{{ route('contacts.paymentOut') }}">
                                                        <img src="/assets/table/wallet-money.svg" alt="" class="w-4 h-4">
                                                        Payment
                                                    </a>
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="{{ route('contacts.creditNoteHistory') }}">
                                                        <img src="/assets/table/wallet-money.svg" alt="" class="w-4 h-4">
                                                        Credit Note Entry
                                                    </a>
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="{{ route('contacts.debitNoteHistory') }}">
                                                        <img src="/assets/table/wallet-money.svg" alt="" class="w-4 h-4">
                                                        Debit Note Entry
                                                    </a>
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="{{ route('contacts.supplierPaymentHistory') }}">
                                                        <img src="/assets/table/wallet-money.svg" alt="" class="w-4 h-4">
                                                        Payment History
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
                <!-- Table Start From Here -->
            </div>
            <!-- Table End -->

            <x-edit-dialogs.supplier-edit-component />
        </section>
    @endsection

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#myTable').DataTable();
            
            $('#warehouseSelect').select2({
                placeholder: "Select Warehouse",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#warehouseSelect').parent()
            });
            
            // Filter table based on warehouse selection
            $('#warehouseSelect').on('change', function() {
                const selectedWarehouse = $(this).val();
                console.log("Selected Warehouse:", selectedWarehouse);
            });
        });
    </script>
</body>
</html>