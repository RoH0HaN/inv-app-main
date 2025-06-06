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

    <title>Daybook | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Reports'],
                ['url' => '/reports/daybook', 'text' => 'Daybook']
            ]" />

            <!-- Table Start -->
            <div class="shadow-md rounded-lg bg-[#fff]">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">DAYBOOK</h3>
                </div>

                <section class="grid grid-cols-3 items-center px-5 py-3 gap-10">
                    <div>
                        <label for="from-date" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">From Date</label>
                        <input type="date" id="from-date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                    </div>
                    <div>
                        <label for="to-date" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">To Date</label>
                        <input type="date" id="to-date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                    </div>
                </section>

                <div class="px-5 py-5">
                    <div class="table-container">
                        <table id="myTable" class="custom-data-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Transaction Type</th>
                                    <th>Invoice / Recipt No.</th>
                                    <th>Party Name</th>
                                    <th>Debit (₹)</th>
                                    <th>Credit (₹)</th>
                                    <th>Created By</th>
                                    <th>Payment Mode</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2025-04-16</td>
                                    <td>Sales Invoice</td>
                                    <td>INVC-123456</td>
                                    <td>Jhon Dao</td>
                                    <td>4500.00</td>
                                    <td>4500.00</td>
                                    <td>Outlet One</td>
                                    <td>Cash</td>
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

    <script>
        $(document).ready(function () {
            $("#myTable").DataTable();
        });
    </script>
    <!-- Main js For Table End -->
</body>
</html>