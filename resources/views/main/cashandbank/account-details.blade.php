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

            <!-- For error message -->
            @if (session('error'))
                <div class="mt-4 mb-4 p-4 rounded-lg text-sm text-red-800 bg-red-100 border border-red-300 dark:bg-red-900 dark:text-red-100 dark:border-red-700">
                    {{ session('error') }}
                </div>
            @endif

            <!-- For success message -->
            @if (session('success'))
                <div class="mt-4 mb-4 p-4 rounded-lg text-sm text-green-800 bg-green-100 border border-green-300 dark:bg-green-900 dark:text-green-100 dark:border-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <!-- For error message -->
            @if ($errors->any())
                <div class="mt-4 mb-4">
                    <div class="bg-red-50 border border-red-200 text-red-800 text-sm rounded-lg p-4 dark:bg-red-900 dark:border-red-800 dark:text-red-200">
                        <h2 class="font-semibold mb-2">There were some problems with your input:</h2>
                        <ul class="list-disc list-inside space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Table Start -->
                 <div class="shadow-md rounded-lg bg-[#fff]">
                    <h3 class="border-b-[1.5px] border-[#dddddd] px-5 py-3 font-semibold text-2xl">ACCOUNT DETAILS</h3>
                    
                    <form action="{{ route('cash-bank.accountDetails') }}" method="GET" class="px-5 py-3">
                        <section class="grid grid-cols-3 gap-10 items-end">
                            <!-- Bank Info -->
                            <div class="px-5 mt-5 tracking-wide">
                                <p>
                                    <span class="text-base font-bold">Bank Name :</span>
                                    <span>{{ $bank->account_holder_name }}</span>
                                </p>
                                <p>
                                    <span class="text-base font-bold">Bank Name :</span>
                                    <span>{{ $bank->bank_name }}</span>
                                </p>
                                <p>
                                    <span class="text-base font-bold">Account Number :</span>
                                    <span>{{  $bank->account_number}}</span>
                                </p>
                                <p>
                                    <span class="text-base font-bold">IFSC Code :</span>
                                    <span>{{ $bank->ifsc_code }}</span>
                                </p>
                            </div>

                            <!-- Bank ID -->
                            <input type="hidden" name="bank_id" value="{{ request('bank_id') }}">

                            <!-- From Date -->
                            <div>
                                <label for="from-date" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">From Date</label>
                                <input type="date" id="from-date" name="from" value="{{ request('from') }}"
                                    class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>

                            <!-- To Date + Search Button (flex row) -->
                            <div class="flex items-end gap-3">
                                <div class="w-full">
                                    <label for="to-date" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">To Date</label>
                                    <input type="date" id="to-date" name="to" value="{{ request('to') }}"
                                        class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                </div>

                                <div>
                                    <button type="submit"
                                        class="mb-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 px-5 rounded-lg">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </section>
                    </form>



                    @if (!empty($transactions) && count($transactions))
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
                                        {{-- Opening Balance Row --}}
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse(request('from'))->format('Y-m-d') }}</td>
                                            <td>Opening Balance</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>₹ {{ number_format($openingBalance < 0 ? abs($openingBalance) : 0, 2) }}</td>
                                            <td>₹ {{ number_format($openingBalance > 0 ? $openingBalance : 0, 2) }}</td>
                                        </tr>

                                        {{-- Transaction Rows --}}
                                        @foreach ($transactions as $row)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($row->created_at)->format('Y-m-d') }}</td>
                                                <td>{{ $row->source_type ?? '-' }}</td>
                                                <td>{{ $row->transaction_type ?? '-' }}</td>
                                                <td>{{ $row->reference_number ?? '-' }}</td>
                                                <td>₹ {{ number_format($row->amount < 0 ? abs($row->amount) : 0, 2) }}</td>
                                                <td>₹ {{ number_format($row->amount > 0 ? $row->amount : 0, 2) }}</td>
                                            </tr>
                                        @endforeach

                                        {{-- Total Row --}}
                                        <tr class="font-semibold">
                                            <td colspan="4" class="text-right">Total</td>
                                            <td>₹ {{ number_format($debitAmount, 2) }}</td>
                                            <td>₹ {{ number_format($creditAmount, 2) }}</td>
                                        </tr>

                                        {{-- Closing Balance Row --}}
                                        <tr class="font-semibold">
                                            <td>{{ $transactions->last()->created_at ?? '-' }}</td>
                                            <td>Closing Balance</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>₹ {{ $closingBalance < 0 ? number_format(abs($closingBalance), 2) : '0.00' }}</td>
                                            <td>₹ {{ $closingBalance > 0 ? number_format($closingBalance, 2) : '0.00' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="px-5 py-10 text-center text-gray-600 text-lg font-semibold">
                            No transactions to show.
                        </div>
                    @endif



                <!-- Table End -->
        </section>
    @endsection

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
</body>
</html>