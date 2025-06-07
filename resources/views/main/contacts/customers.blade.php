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

    <title>Customers | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Contacts'],
                ['url' => route('contacts.customers'), 'text' => 'Customer List']
            ]" />

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
                    <h3 class="font-semibold text-2xl">CUSTOMER LIST</h3>
                    <button type="button" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <a href="{{ route('contacts.createCustomer') }}" class="text-[#fff] font-semibold text-sm uppercase py-2 px-5">Create Customer</a>
                    </button>
                </div>
                <div class="px-5 py-5">
                    <div class="table-container">

                        <div class="flex justify-end items-center space-x-4 mb-4">
                            <!-- Buttons -->
                            <x-export-controls />

                            <!-- Search -->
                            <div class="flex items-center space-x-2">
                                <form method="GET" action="{{ route('contacts.customers') }}">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search warehouse..." class="px-3 py-2 border rounded-md">
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Search</button>
                                </form>
                            </div>
                        </div>

                        <table id="myTable" class="custom-data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Due Amount / Date</th>
                                    <th>Advance Amount</th>
                                    <th>Last Purchased</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $customer->first_name }} {{ $customer->last_name }}</td>
                                    <td>{{ $customer->mobile }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td class="flex flex-col gap-1">
                                        <span>₹ {{ $customer->due_amount }}</span>
                                        <span style="color: red; font-weight:bold;">{{ $customer->due_date ?? "NO DUE" }}</span>
                                    </td>
                                    <td><span class="status-paid" style="color: green; font-weight:bold;">₹ {{ $customer->advance_amount }}</span></td>
                                    <td>2025-04-16</td>
                                    <td>{{ $customer->created_by_first_name }} {{ $customer->created_by_last_name }}</td>
                                    <td>{{ $customer->created_at }}</td>
                                    <td>
                                        <div class="hs-dropdown relative inline-flex">
                                            <button type="button" class="py-1 px-6 inline-flex items-center gap-x-2 text-xs rounded-full bg-[#abd7ff] text-[#0084ff] hover:bg-[#9bc3ff] focus:outline-hidden focus:bg-[#9bc3ff] disabled:opacity-50 disabled:pointer-events-none cursor-pointer font-bold uppercase" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                See
                                            </button>
                                            <div class="hs-dropdown-menu z-20 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 shadow-2xl" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-icons">
                                                <div class="p-1">
                                                    <button class="flex items-center w-full cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" 
                                                        aria-haspopup="dialog" aria-expanded="false" aria-controls="edit-customer-dialog" data-hs-overlay="#edit-customer-dialog"
                                                        data-customer='@json($customer)'
                                                    >
                                                        <img src="/assets/table/edit.svg" alt="" class="w-4 h-4">
                                                        Edit
                                                    </button>
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                        <img src="/assets/table/wallet-money.svg" alt="" class="w-4 h-4">
                                                        Purchase
                                                    </a>
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="{{ route('customer.prepaidAmountHistory', $customer->id) }}">
                                                        <img src="/assets/table/wallet-money.svg" alt="" class="w-4 h-4">
                                                        Prepaid Amount Entry
                                                    </a>
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="{{ route('customer.returnAmountHistory', $customer->id) }}">
                                                        <img src="/assets/table/wallet-money.svg" alt="" class="w-4 h-4">
                                                        Return Amount Entry
                                                    </a>
                                                    <button 
                                                        class="flex items-center gap-x-3.5 py-2 px-3 min-w-full cursor-pointer rounded-lg text-sm text-red-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                        aria-haspopup="dialog" aria-expanded="false" aria-controls="common-delete-dialog"
                                                        data-hs-overlay="#common-delete-dialog"
                                                        data-id="{{ $customer->id }}"
                                                        data-name="{{ $customer->first_name }} {{ $customer->last_name }}"
                                                        data-action="{{ route('contacts.deleteCustomer') }}"
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
                        {{ $customers->appends(['search' => request('search')])->links() }}
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <x-edit-dialogs.customer-edit-component />
            <x-delete-dialog />
        </section>
    @endsection
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('[data-hs-overlay="#edit-customer-dialog"]');

            editButtons.forEach((button)=>{
                button.addEventListener('click', function () {
                    const customer = JSON.parse(this.getAttribute('data-customer'));

                    console.log(customer)

                    const modal = document.getElementById('edit-customer-dialog');

                    // Fill fields
                    modal.querySelector('[name="id"]').value = customer.id;
                    modal.querySelector('[name="first_name"]').value = customer.first_name;
                    modal.querySelector('[name="last_name"]').value = customer.last_name;
                    modal.querySelector('[name="mobile"]').value = customer.mobile;
                    modal.querySelector('[name="whatsapp_number"]').value = customer.whatsapp_number;
                    modal.querySelector('[name="email"]').value = customer.email;
                    modal.querySelector('[name="address"]').value = customer.address;
                    
                    modal.querySelector('[name="opening_balance"]').value = customer.due_amount == 0 ? customer.advance_amount : customer.due_amount;
                    // Set radio button based on customer.opening_balance_type
                    const radios = modal.querySelectorAll('[name="opening_balance_type"]');
                    radios.forEach((radio) => {
                        radio.checked = (radio.value === customer.opening_balance_type);
                    });
                    modal.querySelector('[name="credit_limit"]').value = customer.credit_limit;
                    modal.querySelector('[name="credit_period"]').value = customer.credit_period;
                    
                })
            })
        })

        document.addEventListener('DOMContentLoaded', function () {
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
        });
    </script>
    <!-- Main js For Table Start -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    </script>
    <!-- Main js For Table End -->
</body>
</html>