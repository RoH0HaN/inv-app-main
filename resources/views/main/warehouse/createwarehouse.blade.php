<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Create Warehouse | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Warehouse'],
                ['url' => route('warehouse.warehousesList'), 'text' => 'Warehouse List'],
                ['url' => route('warehouse.createWarehouse'), 'text' => 'Create Warehouse']
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

            <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">WAREHOUSE DETAILS</h3>
                </div>
                <div class="py-5 px-5">
                    <form id="" action="{{ route('warehouse.saveWarehouseToDatabase') }}" enctype="multipart/form-data" method="POST" class="space-y-6">
                        @csrf
                        <!-- Logo Section Start -->
                        <p class="block text-base font-semibold mb-3 text-[#8d8d8d] dark:text-white">Organization Logo</p>
                        <div class="flex gap-10">
                            <!-- Organization Image Preview -->
                            <img id="previewImage" src="/assets/warehouse/empty_cart_image.png" 
                                alt="Profile Preview"
                                class="rounded w-32 h-32 aspect-square object-cover object-center border border-gray-300" />

                            <div>
                                <div class="flex gap-5 items-center">
                                    <!-- File Input -->
                                    <input type="file" name="organization_logo" id="imageInput"
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

                        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                            <div>
                                <label for="organization-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Organization Name</label>
                                <input type="text" id="organization-name" name="organization_name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="mobile" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Mobile</label>
                                <input type="number" id="mobile" name="mobile" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="alternative-mobile" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Alternative Mobile</label>
                                <input type="number" id="alternative-mobile" name="alternative_mobile" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            </div>
                        </section>

                        <section class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
                            <div>
                                <label for="email" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Email</label>
                                <input type="email" id="email" name="email" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="tax-number" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Tax Number</label>
                                <input type="text" id="tax-number" name="tax_number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                        </section>

                        <div>
                            <label for="address" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Address</label>
                            <textarea 
                                id="address" 
                                name="address"
                                rows="3" 
                                class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                                required
                            ></textarea>
                        </div>
                            
                        <!-- Submit Button Start -->
                        <div class="pt-10 flex gap-5">
                            <button type="submit" class="w-fit bg-indigo-600 text-white py-2 px-12 rounded-md hover:bg-indigo-700 transition cursor-pointer">
                                Submit
                            </button>
                            <a href="{{ url()->previous() }}"><button type="button" class="py-2 px-12 w-fit inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                                Close
                            </button></a>
                        </div>
                        <!-- Submit Button End -->
                    </form>
                </div>
            </div>
        </section>
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const imageInput = document.getElementById('imageInput');
            const previewImage = document.getElementById('previewImage');
            const defaultImage = "/assets/warehouse/empty_cart_image.png";

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