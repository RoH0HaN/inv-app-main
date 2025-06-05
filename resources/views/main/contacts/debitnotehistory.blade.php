<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

    <!-- Custom Css For Table Start -->
    <link rel="stylesheet" href="/assets/table/css/style.css">
    <!-- Custom Css For Table End -->

    <title>Debit Note Entry | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Contacts'],
                ['url' => route('contacts.suppliers'), 'text' => 'Suppliers List'],
                ['url' => {{ route('contacts.debitNoteHistory') }}, 'text' => 'Debit Note History']
            ]" />

            <!-- Table Start -->
                 <div class="shadow-md rounded-lg bg-[#fff]">
                    <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                        <h3 class="font-semibold text-2xl">DEBIT NOTE HISTORY</h3>
                        <button type="button" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            <a href="{{ route('contacts.createDebitNote') }}" class="text-[#fff] font-semibold text-sm uppercase py-2 px-5">Create Debit Note</a>
                        </button>
                    </div>
                    <section class="flex px-5 mt-5 tracking-wide gap-x-20">
                        <div class="shrink-0">
                            <p>
                                <span class="text-base font-bold">Supplier :</span>
                                <span>Jhon Dao</span>
                            </p>
                            <p>
                                <span class="text-base font-bold">Address :</span>
                                <span>Islampur, Islampur, MSD, WB, 0000000</span>
                            </p>
                            <p>
                                <span class="text-base font-bold">GSTIN :</span>
                                <span>GST123456789</span>
                            </p>
                        </div>
                        <div class="shrink-0">
                            <p>
                                <span class="text-base font-bold">State Name :</span>
                                <span>West Bengal</span>
                            </p>
                            <p>
                                <span class="text-base font-bold">Phone :</span>
                                <span>7797063266</span>
                            </p>
                            <p>
                                <span class="text-base font-bold">Email :</span>
                                <span>admin@gmail.com</span>
                            </p>
                        </div>
                    </section>
                    <div class="px-5 py-5">
                        <div class="table-container">
                            <table id="myTable" class="custom-data-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Referral No.</th>
                                        <th>Amount</th>
                                        <th>Supplier</th>
                                        <th>Particular</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>INV-00123</td>
                                        <td>2025-04-16</td>
                                        <td>John Doe</td>
                                        <td>$250.00</td>
                                        <td>Paid</td>
                                        <td>Admin</td>
                                        <td>
                                            <div class="hs-dropdown relative inline-flex">
                                                <button type="button" class="py-1 px-6 inline-flex items-center gap-x-2 text-xs rounded-full bg-[#abd7ff] text-[#0084ff] hover:bg-[#9bc3ff] focus:outline-hidden focus:bg-[#9bc3ff] disabled:opacity-50 disabled:pointer-events-none cursor-pointer font-bold uppercase" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                    See
                                                </button>
                                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 shadow-2xl" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-icons">
                                                    <div class="p-1">
                                                        <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                            <img src="/assets/table/edit.svg" alt="" class="w-4 h-4">
                                                            Print
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
</body>
</html>