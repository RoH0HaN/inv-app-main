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

    <title>Employee List | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Users'],
                ['url' => '/users/employee-list', 'text' => 'Employee List']
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
                    <h3 class="font-semibold text-2xl">EMPLOYEE LIST</h3>
                    <button type="button" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <a href="/users/create-employee" class="text-[#fff] font-semibold text-sm uppercase py-2 px-5">Create Employee</a>
                    </button>
                </div>
                <div class="px-5 py-5">
                    <div class="table-container">
                        <table id="myTable" class="custom-data-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Total Sale Amount</th>
                                    <th>Bill Count</th>
                                    <th>Outlet</th>
                                    <th>Last Sale</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                <tr>
                                    <td>{{$employee->first_name}} {{ $employee->last_name }}</td>
                                    <td>{{ $employee->mobile }}</td>
                                    <td>{{ $employee->email }}</td>
                                    <td>98,000,000</td>
                                    <td>12</td>
                                    <td>{{ $employee->organization_name }}</td>
                                    <td>12-02-2025</td>
                                    <td>{{ $employee->created_at }}</td>
                                    <td>
                                        <div class="hs-dropdown relative inline-flex">
                                            <button type="button" class="py-1 px-6 inline-flex items-center gap-x-2 text-xs rounded-full bg-[#abd7ff] text-[#0084ff] hover:bg-[#9bc3ff] focus:outline-hidden focus:bg-[#9bc3ff] disabled:opacity-50 disabled:pointer-events-none cursor-pointer font-bold uppercase" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                See
                                            </button>
                                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 shadow-2xl" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-icons">
                                                <div class="p-1">
                                                    <button class="flex items-center w-full cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" aria-haspopup="dialog" aria-expanded="false" aria-controls="edit-employee-dialog" data-hs-overlay="#edit-employee-dialog"
                                                    data-id="{{ $employee->id }}"
                                                    data-first_name="{{ $employee->first_name }}"
                                                    data-last_name="{{ $employee->last_name }}"
                                                    data-email="{{ $employee->email }}"
                                                    data-mobile="{{ $employee->mobile }}"
                                                    data-whatsapp_number="{{ $employee->whatsapp_number }}"
                                                    data-address="{{ $employee->address }}"
                                                    data-outlet_id="{{ $employee->outlet_id }}"
                                                    >
                                                        <img src="/assets/table/edit.svg" alt="" class="w-4 h-4">
                                                        Edit
                                                    </button>
                                                    <button class="flex items-center gap-x-3.5 py-2 px-3 min-w-full cursor-pointer rounded-lg text-sm text-red-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                        aria-haspopup="dialog" aria-expanded="false" 
                                                        aria-controls="common-delete-dialog"
                                                        data-hs-overlay="#common-delete-dialog"
                                                        data-name="{{ $employee->first_name }} {{ $employee->last_name }}"
                                                        data-id="{{ $employee->id }}"
                                                        data-action="{{ route('users.deleteEmployeeToDatabase') }}"
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
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <x-edit-dialogs.employee-edit-component :outlets="$outlets" />
            <x-delete-dialog />
        </section>
    @endsection

    <!-- Main js For Table Start -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('[data-hs-overlay="#edit-employee-dialog"]');

            editButtons.forEach(button => {
            button.addEventListener('click', () => {
                console.log("Edit button clicked");
                console.log( "ID: ",button.dataset.id);
                document.getElementById('edit-id').value = button.dataset.id || '';
                document.getElementById('edit-first-name').value = button.dataset.first_name || '';
                document.getElementById('edit-last-name').value = button.dataset.last_name || '';
                document.getElementById('edit-address').value = button.dataset.address || '';
                document.getElementById('edit-email').value = button.dataset.email || '';
                document.getElementById('edit-mobile').value = button.dataset.mobile || '';
                document.getElementById('edit-whatsapp-number').value = button.dataset.whatsapp_number || '';
                document.getElementById('edit-outlet-id').value = button.dataset.outlet_id || '';
                });
            });
        });

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
    <!-- Main js For Table End -->
</body>
</html>