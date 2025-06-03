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
                ['url' => '/main/dashboard/dashboard', 'text' => 'Home'],
                ['url' => '#', 'text' => 'Warehouse'],
                ['url' => '/main/warehouse/warehouseslist', 'text' => 'Warehouse List'],
                ['url' => '/main/warehouse/createwarehouse', 'text' => 'Create Warehouse']
            ]" />

            <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">WAREHOUSE DETAILS</h3>
                </div>
                <div class="py-5 px-5">
                    <form id="" action="#" class="space-y-6">
                        <!-- Logo Section Start -->
                        <p class="block text-base font-semibold mb-3 text-[#8d8d8d] dark:text-white">Organization Logo</p>
                        <div class="flex gap-10">
                            <img src="/assets/warehouse/empty_cart_image.png" alt="" class="border border-gray-400 rounded w-32 h-32 aspect-square object-cover object-center" />
                            <div>
                                <div class="flex gap-5">
                                    <div>
                                        <label class="block">
                                        <input type="file" accept=".jpg,.jpeg,.gif,.png" class="block w-[90px] overflow-hidden h-10 cursor-pointer text-sm text-gray-500
                                            file:me-4 file:py-2.5 file:px-4
                                            file:rounded-lg file:border-0
                                            file:text-sm file:font-semibold
                                            file:bg-blue-600 file:text-white
                                            hover:file:bg-blue-700
                                            file:disabled:opacity-50 file:disabled:pointer-events-none
                                            dark:text-neutral-500
                                            dark:file:bg-blue-500
                                            dark:hover:file:bg-blue-400">
                                        </label>
                                    </div>

                                    <button type="button" class="py-2 px-5 inline-flex items-center gap-x-2 text-sm font-semibold cursor-pointer rounded-lg border border-transparent bg-[#dfdfdf] text-[#8a8a8a] hover:bg-[#d1d1d1] focus:outline-hidden focus:bg-[#d1d1d1] disabled:opacity-50 disabled:pointer-events-none">
                                        Reset
                                    </button>
                                </div>
                                <p class="font-semibold text-sm mt-3 text-[#8d8d8d] dark:text-white">Allowed JPG, JPEG, GIF or PNG. Max size of 1MB.</p>
                            </div>
                        </div>
                        <!-- Logo Section End -->

                        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                            <div>
                                <label for="organization-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Organization Name</label>
                                <input type="text" id="organization-name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="mobile" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Mobile</label>
                                <input type="number" id="mobile" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="alternative-mobile" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Alternative Mobile</label>
                                <input type="number" id="alternative-mobile" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            </div>
                        </section>

                        <section class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
                            <div>
                                <label for="email" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Email</label>
                                <input type="email" id="email" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="tax-number" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Tax Number</label>
                                <input type="text" id="tax-number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                        </section>

                        <div>
                            <label for="address" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Address</label>
                            <textarea 
                                id="address" 
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

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>