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

    <title>Account Details | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Cash & Bank'],
                ['url' => '/cash-bank/account-details', 'text' => 'Account Details']
            ]" />

            <!-- Table Start -->
                 <div class="shadow-md rounded-lg bg-[#fff]">
                    <h3 class="border-b-[1.5px] border-[#dddddd] px-5 py-3 font-semibold text-2xl">ACCOUNT DETAILS</h3>
                    
                    <section class="grid grid-cols-3 items-center px-5 py-3 gap-10">
                        <div class="px-5 mt-5 tracking-wide">
                            <p>
                                <span class="text-base font-bold">Bank Name :</span>
                                <span>State Bank of India</span>
                            </p>
                            <p>
                                <span class="text-base font-bold">Account Number :</span>
                                <span>168456315585</span>
                            </p>
                            <p>
                                <span class="text-base font-bold">IFSC Code :</span>
                                <span>SBIN001854</span>
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
                                        <th>Particular</th>
                                        <th>Voucher Type</th>
                                        <th>Voucher No</th>
                                        <th>Debit (₹)</th>
                                        <th>Credit (₹)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2025-04-16</td>
                                        <td>Sale</td>
                                        <td>UPI</td>
                                        <td>INVE-2656325</td>
                                        <td>0.00</td>
                                        <td>27,000,00</td>
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