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

    <title>Prepaid Amount History | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Customer'],
                ['url' => '/main/customer/customeroutstandings', 'text' => 'Customer Outstandings'],
                ['url' => route('customer.prepaidAmountHistory', $customer->id), 'text' => 'Prepaid Amount History']
            ]" />

            <!-- Table Start -->
                 <div class="shadow-md rounded-lg bg-[#fff]">
                    <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                        <h3 class="font-semibold text-2xl">PREPAID AMOUNT HISTORY</h3>
                        <button type="button" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                            <a href="{{ route('customer.prepaidAmountEntry', $customer->id) }}" class="text-[#fff] font-semibold text-sm uppercase py-2 px-5">Prepaid Amount Entry</a>
                        </button>
                    </div>
                    <section class="flex px-5 mt-5 tracking-wide gap-x-20">
                        <div class="shrink-0">
                            <p>
                                <span class="text-base font-bold">Customer :</span>
                                <span>{{ $customer->first_name }} {{ $customer->last_name }}</span>
                            </p>
                            <p>
                                <span class="text-base font-bold">Address :</span>
                                <span>{{ $customer->address }}</span>
                            </p>
                        </div>
                        <div class="shrink-0">
                            <p>
                                <span class="text-base font-bold">Phone :</span>
                                <span>{{ $customer->mobile }}</span>
                            </p>
                            <p>
                                <span class="text-base font-bold">WhatsApp :</span>
                                <span>{{ $customer->whatsapp_number }}</span>
                            </p>
                            <p>
                                <span class="text-base font-bold">Email :</span>
                                <span>{{ $customer->email }}</span>
                            </p>
                        </div>
                    </section>
                    <div class="px-5 py-5">
                        <div class="table-container">
                        <div class="flex justify-end items-center space-x-4 mb-4">
                            <!-- Buttons -->
                            <x-export-controls />

                            <!-- Search -->
                            <div class="flex items-center space-x-2">
                                <form method="GET" action="{{ route('customer.prepaidAmountHistory', $customer->id) }}">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search prepaid amount history..." class="px-3 py-2 border rounded-md">
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Search</button>
                                </form>
                            </div>
                        </div>
                            <table id="myTable" class="custom-data-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Referral No.</th>
                                        <th>Amount</th>
                                        <th>Customer</th>
                                        <th>Particular</th>
                                        <th>Created By</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($prepaidAmountTransactions as $prepaidAmountTransaction)
                                    <tr>
                                        <td>{{ $prepaidAmountTransaction->date }}</td>
                                        <td>{{ $prepaidAmountTransaction->referral_number }}</td>
                                        <td>₹ {{ $prepaidAmountTransaction->amount }}</td>
                                        <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                        <td>{{ $prepaidAmountTransaction->particular }}</td>
                                        <td>{{ $prepaidAmountTransaction->created_by_first_name }} {{ $prepaidAmountTransaction->created_by_last_name }}</td>
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
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination Links (Preserve search param) -->
                            {{ $prepaidAmountTransactions->appends(['search' => request('search')])->links() }}

                        </div>
                    </div>
                 </div>
                <!-- Table End -->
        </section>
    @endsection

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   
</body>
</html>