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

    <title>Category List | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Item'],
                ['url' => '/items/create-category', 'text' => 'Category List']
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
                    <h3 class="font-semibold text-2xl">CATEGORY LIST</h3>
                    <button type="button" class="inline-flex items-center gap-x-2 text-sm font-medium rounded-full border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-hidden focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
                        <a href="/items/create-category" class="text-[#fff] font-semibold text-sm uppercase py-2 px-5">Create Category</a>
                    </button>
                </div>
                <div class="px-5 py-5">
                    <div class="table-container">
                         <div class="flex justify-end items-center space-x-4 mb-4">
                            <!-- Buttons -->
                            <x-export-controls />

                            <!-- Search -->
                            <div class="flex items-center space-x-2">
                                <form method="GET" action="{{ route('items.categoryList') }}">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search category..." class="px-3 py-2 border rounded-md">
                                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Search</button>
                                </form>
                            </div>
                        </div>
                        <table id="myTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Created By</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->first_name }} {{ $category->last_name }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>
                                        <div class="hs-dropdown relative inline-flex">
                                            <button type="button" class="py-1 px-6 inline-flex items-center gap-x-2 text-xs rounded-full bg-[#abd7ff] text-[#0084ff] hover:bg-[#9bc3ff] focus:outline-hidden focus:bg-[#9bc3ff] disabled:opacity-50 disabled:pointer-events-none cursor-pointer font-bold uppercase" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                See
                                            </button>
                                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 shadow-2xl" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-icons">
                                                <div class="p-1">
                                                    <button class="flex items-center w-full cursor-pointer gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" aria-haspopup="dialog" aria-expanded="false" aria-controls="edit-category-dialog" data-hs-overlay="#edit-category-dialog"
                                                    data-id="{{ $category->id }}"
                                                    data-name="{{ $category->name }}"
                                                    data-description="{{ $category->description }}"    
                                                    >
                                                        <img src="/assets/table/edit.svg" alt="" class="w-4 h-4">
                                                        Edit
                                                    </button>
                                                    <button class="flex items-center gap-x-3.5 py-2 px-3 min-w-full cursor-pointer rounded-lg text-sm text-red-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700"
                                                        aria-haspopup="dialog" aria-expanded="false" 
                                                        aria-controls="common-delete-dialog"
                                                        data-hs-overlay="#common-delete-dialog"
                                                        data-name="{{ $category->name }}"
                                                        data-id="{{ $category->id }}"
                                                        data-action="{{ route('items.deleteCategoryToDatabase') }}"
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
                        {{ $categories->appends(['search' => request('search')])->links() }}
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <x-edit-dialogs.category-edit-component />
            <x-delete-dialog />

        </section>
    @endsection

    <!-- Main js For Table Start -->

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const editButtons = document.querySelectorAll('[data-hs-overlay="#edit-category-dialog"]');

            editButtons.forEach(button => {
            button.addEventListener('click', () => {
                console.log("Edit button clicked");
                console.log( "ID: ",button.dataset.id);
                document.getElementById('edit-id').value = button.dataset.id || '';
                document.getElementById('edit-name').value = button.dataset.name || '';
                document.getElementById('edit-description').value = button.dataset.description || '';
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