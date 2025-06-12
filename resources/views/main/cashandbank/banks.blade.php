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

    <title>Banks | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Cash & Bank'],
                ['url' => '/cash-bank/banks', 'text' => 'Bank Accounts']
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
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">BANK ACCOUNTS</h3>
                    <button type="button" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <a href="/cash-bank/add-bank-account" class="text-[#fff] font-semibold text-sm uppercase py-2 px-5">Add Bank</a>
                    </button>
                </div>
                <div class="px-5 py-5">
                    <div class="table-container">

                        <div class="flex justify-end items-center space-x-4 mb-4">
                            <!-- Buttons -->
                            <x-export-controls />

                            <!-- Search -->
                            <div class="flex items-center space-x-2">
                                <form method="GET" action="{{ route('cash-bank.banks') }}">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search banks..." class="px-3 py-2 border rounded-md">
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Search</button>
                                </form>
                            </div>
                        </div>

                        <table id="myTable" class="custom-data-table">
                            <thead>
                                <tr>
                                    <th>Bank Name</th>
                                    <th>Account Number</th>
                                    <th>IFSC Code</th>
                                    <th>Balance</th>
                                    <th>Account Holder Name</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bankAccounts as $bank)
                                <tr>
                                    <td>{{ $bank->bank_name }}</td>
                                    <td>{{ $bank->account_number }}</td>
                                    <td>{{ $bank->ifsc_code }}</td>
                                    <td>₹ {{ number_format($bank->balance, 2) }}</td>
                                    <td>{{ $bank->account_holder_name }}</td>
                                    <td>{{ $bank->created_at }}</td>
                                    <td>
                                        <div class="hs-dropdown relative inline-flex">
                                            <button type="button" class="py-1 px-6 inline-flex items-center gap-x-2 text-xs rounded-full bg-[#abd7ff] text-[#0084ff] hover:bg-[#9bc3ff] focus:outline-hidden focus:bg-[#9bc3ff] disabled:opacity-50 disabled:pointer-events-none cursor-pointer font-bold uppercase" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                See
                                            </button>
                                            <div class="hs-dropdown-menu z-20 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 shadow-2xl" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-icons">
                                                <div class="p-1">
                                                    <button 
                                                        class="flex items-center w-full cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" 
                                                        aria-haspopup="dialog" aria-expanded="false" aria-controls="edit-bank-account-dialog" data-hs-overlay="#edit-bank-account-dialog"
                                                        data-bank='@json($bank)'
                                                        data-access='@json($bank->access)'
                                                    >
                                                        <img src="/assets/table/edit.svg" alt="" class="w-4 h-4">
                                                        Edit
                                                    </button>
                                                    <a 
                                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"  
                                                        href="{{ route('cash-bank.accountDetails', ['bank_id' => $bank->id]) }}"
                                                    >
                                                        <img src="/assets/main/sale/eye.svg" alt="" class="w-4 h-4">
                                                        View
                                                    </a>
                                                    <button 
                                                        class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                        aria-haspopup="dialog" aria-expanded="false" aria-controls="bank-adjust-dialog"
                                                        data-hs-overlay="#bank-adjust-dialog"
                                                        data-id="{{ $bank->id }}"
                                                    >
                                                        <img src="/assets/main/sale/eye.svg" alt="" class="w-4 h-4">
                                                        Adjust
                                                    </button>
                                                    <button 
                                                        class="flex items-center gap-x-3.5 py-2 px-3 min-w-full cursor-pointer rounded-lg text-sm text-red-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                        aria-haspopup="dialog" aria-expanded="false" aria-controls="common-delete-dialog"
                                                        data-hs-overlay="#common-delete-dialog"
                                                        data-id="{{ $bank->id }}"
                                                        data-name="{{ $bank->bank_name }} ({{ $bank->account_number }})"
                                                        data-action="{{ route('cash-bank.deleteBankAccount') }}"
                                                    >
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
                       {{ $bankAccounts->appends(['search' => request('search')])->links() }}
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <x-edit-dialogs.bank-account-details-edit-component :outlets="$outlets" :warehouses="$warehouses" />
            <x-delete-dialog />
            <x-adjust-bank-account-dialog />

        </section>
    @endsection

    <!-- Main js For Table Start -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            document.querySelectorAll('[data-hs-overlay="#edit-bank-account-dialog"]').forEach((button) => {
                button.addEventListener('click', function () {
                    const bank = JSON.parse(this.getAttribute('data-bank'));
                    const access = JSON.parse(this.getAttribute('data-access'));
                    const modal = document.getElementById('edit-bank-account-dialog');

                    console.log('button clicked');
                    

                    // Fill basic fields
                    modal.querySelector('[name="id"]').value = bank.id || '';
                    modal.querySelector('[name="account_holder_name"]').value = bank.account_holder_name || '';
                    modal.querySelector('[name="bank_name"]').value = bank.bank_name || '';
                    modal.querySelector('[name="account_number"]').value = bank.account_number || '';
                    modal.querySelector('[name="ifsc_code"]').value = bank.ifsc_code || '';
                    modal.querySelector('[name="opening_balance"]').value = bank.opening_balance || '';

                    // Reset all checkboxes first
                    modal.querySelectorAll('.location-checkbox').forEach(cb => cb.checked = false);

                    // Check relevant access checkboxes
                    access.forEach(entry => {
                        const checkbox = modal.querySelector(`input[value="${entry.location_type.toLowerCase()}_${entry.location_id}"]`);
                        if (checkbox) checkbox.checked = true;
                    });
                });
            });

            // -- delete Dialog
            const deleteButtons = document.querySelectorAll('[data-hs-overlay="#common-delete-dialog"]');

            deleteButtons.forEach(button => {
                button.addEventListener('click', () => {
                    const form = document.getElementById('delete-form');
                    const nameEl = document.getElementById('delete-item-name');
                    const idInput = document.getElementById('delete-item-id');

                    // Set form action and values
                    form.action = button.dataset.action;
                    idInput.value = button.dataset.id;
                    nameEl.textContent = button.dataset.name || 'this item';
                });
            });

            // -- adjust Dialog
            const adjustButtons = document.querySelectorAll('[data-hs-overlay="#bank-adjust-dialog"]');

            adjustButtons.forEach(button => {
                button.addEventListener('click', () => {
                    console.log(document.getElementById('data-id'), button.dataset.id);
                    
                    document.getElementById('data-id').value = button.dataset.id || '';
                });
            });
        });
    </script>
    <!-- Main js For Table End -->
</body>
</html>