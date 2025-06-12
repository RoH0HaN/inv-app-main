<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Create User | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Users'],
                ['url' => route('users.usersList'), 'text' => 'Users List'],
                ['url' => route('users.createUser'), 'text' => 'Create User']
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
            
            <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">USER DETAILS</h3>
                </div>
                <div class="py-5 px-5">
                    <form id="" action="{{ route('users.saveUserToDatabase') }}" enctype="multipart/form-data" method="POST" class="space-y-6">
                        @csrf
                        <!-- Logo Section Start -->
                        <p class="block text-base font-semibold mb-3 text-[#8d8d8d] dark:text-white">User Picture</p>
                        <div class="flex gap-10">
                            <!-- Profile Preview -->
                            <img id="previewImage" src="/assets/users/demo_profile.png" 
                                alt="Profile Preview"
                                class="rounded w-32 h-32 aspect-square object-cover object-center border border-gray-300" />

                            <div>
                                <div class="flex gap-5 items-center">
                                    <!-- File Input -->
                                    <input type="file" name="profile_image" id="imageInput"
                                        accept="image/*"
                                        class="block w-[110px] overflow-hidden h-10 cursor-pointer text-sm text-gray-500
                                            file:me-4 file:py-2.5 file:px-4
                                            file:rounded-lg file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-[#0084ff] file:text-white
                                            hover:file:bg-[#0066ff]
                                            dark:file:bg-blue-500 dark:hover:file:bg-blue-400">
                                    
                                    <!-- Reset Button -->
                                    <button type="button" onclick="resetImage()"
                                        class="py-2 px-5 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg bg-[#dfdfdf] text-[#8a8a8a] hover:bg-[#d1d1d1]">
                                        Reset
                                    </button>
                                </div>
                                <p class="text-sm mt-3 text-gray-500">Allowed JPG, JPEG, GIF or PNG. Max 1MB.</p>
                            </div>
                        </div>


                        <!-- Logo Section End -->

                        <section class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
                            <div>
                                <label for="first-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">First Name</label>
                                <input type="text" id="first-name" name="first_name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="last-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Last Name</label>
                                <input type="text" id="last-name" name="last_name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="user-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">User Name</label>
                                <input type="text" id="user-name" name="username" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="email" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Email</label>
                                <input type="text" id="email" name="email" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="mobile" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Mobile</label>
                                <input type="number" id="mobile" name="mobile" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Role</label>
                                <select id="role" name="role" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    <option selected disabled>Select Role</option>
                                    <option value="user">USER</option>
                                    <option value="admin">ADMIN</option>
                                    <option value="viewer">VIEWER</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Status</label>
                                <select id="status" name="status" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    <option selected disabled>Select Status</option>
                                    <option value="active">ACTIVE</option>
                                    <option value="inactive">INACTIVE</option>
                                </select>
                            </div>
                        </section>


                            <div id="location-section" class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
    
                                <!-- Warehouses Section -->
                                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl shadow-sm">
                                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <span class="inline-block px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 text-xs rounded-md">Warehouses</span>
                                    </p>
                                    <div class="space-y-3">
                                        @forelse($warehouses as $warehouse)
                                            <label for="warehouse_{{ $warehouse->id }}" class="flex items-center space-x-2 cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900 p-2 rounded-md transition">
                                                <input type="radio" name="location_id" class="location-radio warehouse-radio text-blue-600 focus:ring-blue-500" 
                                                    value="warehouse_{{ $warehouse->id }}" id="warehouse_{{ $warehouse->id }}">
                                                <span class="text-gray-800 dark:text-gray-100">{{ $warehouse->organization_name }}</span>
                                            </label>
                                        @empty
                                            <p class="text-sm text-gray-500">No warehouses available.</p>
                                        @endforelse
                                    </div>
                                </div>

                                <!-- Outlets Section -->
                                <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl shadow-sm">
                                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                                        <span class="inline-block px-2 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 text-xs rounded-md">Outlets</span>
                                    </p>
                                    <div class="space-y-3">
                                        @forelse($outlets as $outlet)
                                            <label for="outlet_{{ $outlet->id }}" class="flex items-center space-x-2 cursor-pointer hover:bg-green-50 dark:hover:bg-green-900 p-2 rounded-md transition">
                                                <input type="radio" name="location_id" class="location-radio outlet-radio text-green-600 focus:ring-green-500" 
                                                    value="outlet_{{ $outlet->id }}" id="outlet_{{ $outlet->id }}">
                                                <span class="text-gray-800 dark:text-gray-100">{{ $outlet->organization_name }}</span>
                                            </label>
                                        @empty
                                            <p class="text-sm text-gray-500">No outlets available.</p>
                                        @endforelse
                                    </div>
                                </div>

                            </div>
                            
                        <!-- Submit Button Start -->
                        <div class="pt-10 flex gap-5">
                            <button type="submit" class="w-fit bg-[#0084ff] hover:bg-[#0066ff] text-white py-2 px-12 rounded-md transition cursor-pointer">
                                Submit
                            </button>
                            <button type="button" class="py-2 px-12 w-fit inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                                Close
                            </button>
                        </div>
                        <!-- Submit Button End -->
                    </form>
                </div>
                
            </div>
        </section>
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const roleSelect = document.getElementById('role');
            const locationRadios = document.querySelectorAll('.location-radio');
            const warehouseRadios = document.querySelectorAll('.warehouse-radio');
            const outletRadios = document.querySelectorAll('.outlet-radio');

            function updateLocationAccess() {
                const role = roleSelect.value;

                if (role === 'user') {
                    // Enable only one selection (radio group ensures that)
                    warehouseRadios.forEach(radio => radio.disabled = false);
                    outletRadios.forEach(radio => radio.disabled = false);
                } else {
                    // Disable all location selections for admin or viewer
                    locationRadios.forEach(radio => {
                        radio.checked = false;
                        radio.disabled = true;
                    });
                }
            }

            // Run once on page load in case of old value
            updateLocationAccess();

            // Watch for role change
            roleSelect.addEventListener('change', updateLocationAccess);
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('imageInput');
            const previewImage = document.getElementById('previewImage');
            const defaultImage = "/assets/users/demo_profile.png";

            imageInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });

            window.resetImage = function () {
                imageInput.value = '';
                previewImage.src = defaultImage;
            };
        });
    </script>



    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>