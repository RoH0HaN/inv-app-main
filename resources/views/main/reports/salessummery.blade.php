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

    <title>Sales Summery | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Reports'],
                ['url' => '/reports/sales-summery', 'text' => 'Sales Summery']
            ]" />

            <!-- Table Start -->
            <div class="shadow-md rounded-lg bg-[#fff]">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">SALES SUMMERY</h3>
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
                    <div>
                        <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Outlet</label>
                        <select id="credit-period" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            <option selected="">Select Outlet</option>
                            <option vlaue="Shop One">Shop One</option>
                            <option value="Shop Two">Shop Two</option>
                        </select>
                    </div>
                </section>

                <div class="px-5 py-5">
                    <div class="table-container">
                        <table id="myTable" class="custom-data-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Total Sales Amount</th>
                                    <th>Total Items Sold</th>
                                    <th>Total Discount</th>
                                    <th>Total Taxes</th>
                                    <th>Net Sales (After Tax)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>2025-04-16</td>
                                    <td>50,000.00</td>
                                    <td>120</td>
                                    <td>1000.00</td>
                                    <td>350</td>
                                    <td>45000.00</td>
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