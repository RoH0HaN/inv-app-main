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

    <title>View Statement | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => '/main/dashboard/dashboard', 'text' => 'Home'],
                ['url' => '#', 'text' => 'Reports'],
                ['url' => '/main/reports/partyreport', 'text' => 'Party Report (Payment History)'],
                ['url' => '/main/reports/viewstatement', 'text' => 'Statement']
            ]" />

            <!-- Table Start -->
            <div class="shadow-md rounded-lg bg-[#fff]">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">NAME TO THE STATEMENT OWNER</h3>
                </div>

                <section class="grid grid-cols-3 px-5 py-3 gap-10">
                    <div>
                        <p>
                            <span class="text-base font-bold">Address :</span>
                            <span>Islampur, Islampur, MSD, WB, 0000000</span>
                        </p>
                        <p>
                            <span class="text-base font-bold">GSTIN :</span>
                            <span>GST0123456789</span>
                        </p>
                        <p>
                            <span class="text-base font-bold">State :</span>
                            <span>West Bengal</span>
                        </p>
                        <p>
                            <span class="text-base font-bold">Mobile :</span>
                            <span>7797063266</span>
                        </p>
                        <p>
                            <span class="text-base font-bold">Email :</span>
                            <span>admin@xyz.com</span>
                        </p>
                    </div>
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
                                    <th>Particuler</th>
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
                                    <td>Credit Card</td>
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

    <script>
        $(document).ready(function () {
            $("#myTable").DataTable();
        });
    </script>
    <!-- Main js For Table End -->
</body>
</html>