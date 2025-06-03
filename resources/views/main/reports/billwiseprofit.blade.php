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

    <title>Bill-Wise Profit | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => '/main/dashboard/dashboard', 'text' => 'Home'],
                ['url' => '#', 'text' => 'Reports'],
                ['url' => '/main/reports/billwiseprofit', 'text' => 'Bill-Wise Profit']
            ]" />

            <!-- Table Start -->
            <div class="shadow-md rounded-lg bg-[#fff]">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">BILL-WISE PROFIT</h3>
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

                <section class="grid grid-cols-1 sm:grid-cols-2 gap-5 px-5 py-8">
                    <!-- Box 01 -->
                    <div class="flex items-center justify-between border-l-4 border-[#00a800] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-base font-bold tracking-wide text-[#949494]">Total Profit In (₹)</p>
                            <h1 class="text-[#00a800] font-bold text-xl">43,0000.00</h1>
                        </div>

                        <div class="bg-gradient-to-br from-[#7cff7c] to-[#00a800] p-5 rounded-full">
                            <img src="/assets/main/dashboard/money-recive.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 02 -->
                    <div class="flex items-center justify-between border-l-4 border-[#FF6600] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-base font-bold tracking-wide text-[#949494]">Total Profit In (%)</p>
                            <h1 class="text-[#FF6600] font-bold text-xl">34%</h1>
                        </div>

                        <div class="bg-gradient-to-br from-[#FFCFB0] to-[#FF6600] p-5 rounded-full">
                            <img src="/assets/main/dashboard/money-recive.svg" alt="">
                        </div>
                    </div>
                </section>

                <div class="px-5 py-5">
                    <div class="table-container">
                        <table id="myTable" class="custom-data-table">
                            <thead>
                                <tr>
                                    <th>Invoice No.</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Total Sale Price</th>
                                    <th>Total Cost Price</th>
                                    <th>Profit (₹)</th>
                                    <th>Profit (%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>INV-00123</td>
                                    <td>2025-04-16</td>
                                    <td>John Doe</td>
                                    <td>₹250.00</td>
                                    <td>₹350</td>
                                    <td>4000</td>
                                    <td>30</td>
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