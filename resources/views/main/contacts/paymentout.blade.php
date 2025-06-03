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

    <title>Unpaid Bills Of Supplier | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => '/main/dashboard/dashboard', 'text' => 'Home'],
                ['url' => '#', 'text' => 'Contacts'],
                ['url' => '/main/contacts/suppliers', 'text' => 'Suppliers List'],
                ['url' => '/main/contacts/paymentout', 'text' => 'Unpaid Purchase Bills']
            ]" />

            <!-- Table Start -->
                 <div class="shadow-md rounded-lg bg-[#fff]">
                    <h3 class="border-b-[1.5px] border-[#dddddd] px-5 py-3 font-semibold text-2xl">UNPAID PURCHASE BILLS</h3>
                    <div class="px-5 mt-5 tracking-wide">
                        <p>
                            <span class="text-base font-bold">Supplier :</span>
                            <span>Jhon Dao</span>
                        </p>
                        <p>
                            <span class="text-base font-bold">Outstanding Balance :</span>
                            <span>10,000,0000</span>
                        </p>
                    </div>
                    <div class="px-5 py-5">
                        <div class="table-container">
                            <table id="myTable" class="custom-data-table">
                                <thead>
                                    <tr>
                                        <th>Purchase Code</th>
                                        <th>Seller Invoice No.</th>
                                        <th>Status</th>
                                        <th>Supplier</th>
                                        <th>Paid</th>
                                        <th>Created By</th>
                                        <th>Days Elapsed</th>
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
                                        <td>Paid</td>
                                        <td>Admin</td>
                                        <td>Credit Card</td>
                                        <td>2025-04-16 10:23 AM</td>
                                        <td>
                                        <div class="relative inline-flex">
                                            <a href="/main/contacts/supplierpayment" type="button" class="py-1 px-6 inline-flex items-center gap-x-2 text-xs rounded-full bg-[#abd7ff] text-[#0084ff] hover:bg-[#9bc3ff] focus:outline-hidden focus:bg-[#9bc3ff] disabled:opacity-50 disabled:pointer-events-none cursor-pointer font-bold uppercase">
                                                Pay Now
                                            </a>
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