<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Create TDS/TCS | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>

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
                    <h3 class="font-semibold text-2xl">TAX DETAILS</h3>
                </div>
                <div class="py-5">
                    <form id="" action="{{ route('settings.saveTcsTdsToDatabase') }}" method="post" class="space-y-6">
                        @csrf
                        <div class="grid gap-y-5 px-5">
                            <div>
                                <label for="name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Name</label>
                                <input type="text" id="name" name="name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="rate" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Rate</label>
                                <input type="text" id="rate" name="rate" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                        </div>

                        <div class="flex gap-x-20 items-center col-span-3 px-5 mt-3">
                            <div class="flex items-center">
                                <input type="radio" name="type" value="tcs" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-group-1" checked="">
                                <label for="hs-radio-group-1" class="text-base font-bold text-black ms-2 dark:text-neutral-400">TCS</label>
                            </div>
                            
                            <div class="flex items-center">
                                <input type="radio" name="type"  value="tds" class="shrink-0 mt-0.5 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-radio-group-2">
                                <label for="hs-radio-group-2" class="text-base font-bold text-black ms-2 dark:text-neutral-400">TDS</label>
                            </div>
                        </div>
                            
                        <!-- Submit Button -->
                        <div class="pt-10 px-5 flex gap-5">
                            <button type="submit" class="w-fit bg-[#0084ff] text-white py-2 px-12 rounded-md hover:bg-[#0066ff] transition cursor-pointer">
                                Submit
                            </button>
                            <button type="button" class="py-2 px-12 w-fit inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                                Close
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @endsection

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>