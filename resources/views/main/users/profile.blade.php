<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <title>Profile | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Users'],
                ['url' => '/users/profile', 'text' => 'Update Profile']
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

            <div class="flex">
                <div class="border w-60 px-5 h-fit py-3 bg-white dark:bg-gray-800 rounded-lg border-gray-200 dark:border-neutral-700 shadow shrink-0">
                    <h1 class="font-semibold text-2xl mb-3">OPTIONS</h1>
                    <nav class="flex flex-col space-y-2" aria-label="Tabs" role="tablist" aria-orientation="horizontal">
                        <button type="button" class="hs-tab-active:border-blue-500 text-black hs-tab-active:bg-blue-600 dark:hs-tab-active:bg-blue-600 py-1 pe-4 inline-flex items-center gap-x-2 border-transparent text-[15px] whitespace-nowrap hover:text-blue-600 focus:outline-hidden hs-tab-active:text-white focus:text-white px-2 rounded-md active" id="vertical-tab-with-border-item-1" aria-selected="true" data-hs-tab="#vertical-tab-with-border-1" aria-controls="vertical-tab-with-border-1" role="tab">
                            <img src="/assets/sidebar/profile-1user.svg" alt="" class="w-4 h-4 aspect-square object-cover">
                            Profile
                        </button>
                        <button type="button" class="hs-tab-active:border-blue-500 text-black hs-tab-active:bg-blue-600 dark:hs-tab-active:bg-blue-600 py-1 pe-4 inline-flex items-center gap-x-2 border-transparent text-[15px] whitespace-nowrap hover:text-blue-600 focus:outline-hidden hs-tab-active:text-white focus:text-white px-2 rounded-md" id="vertical-tab-with-border-item-2" aria-selected="false" data-hs-tab="#vertical-tab-with-border-2" aria-controls="vertical-tab-with-border-2" role="tab">
                            <img src="/assets/sidebar/unlock.svg" alt="" class="w-4 h-4 aspect-square object-cover">
                            Change Password
                        </button>
                    </nav>
                </div>

                <div class="ml-8 w-full">
                    <div id="vertical-tab-with-border-1" role="tabpanel" aria-labelledby="vertical-tab-with-border-item-1">
                        <section class="border bg-white dark:bg-gray-800 rounded-lg border-gray-200 dark:border-neutral-700 shadow shrink-0">
                            <div class="border-b-[1.5px] border-[#dddddd] px-5 py-3">
                                <h3 class="font-semibold text-2xl">PROFILE</h3>
                            </div>
                            <form action="{{ route('users.updateProfile') }}" method="POST" enctype="multipart/form-data" class="space-y-6 px-5 py-3">
                                @csrf
                                <input name="id" type="hidden" value="{{ Auth::id() }}" />
                                <!-- Logo Section Start -->
                                <p class="block text-base font-semibold mb-3 text-[#8d8d8d] dark:text-white">Profile Picture</p>
                                <div class="flex gap-10">
                                    <img src="{{ Auth::check() ? url(Auth::user()->profile_picture) : '/assets/users/demo_profile.png' }}" id="previewImage" alt="" class="border border-gray-400 rounded w-32 h-32 aspect-square object-cover object-center" />
                                    <div>
                                        <div class="flex gap-5">
                                            <div>
                                                <label class="block">
                                                    <input name="profile_image" type="file" id="imageInput" accept=".jpg,.jpeg,.gif,.png" class="block w-[110px] overflow-hidden h-10 cursor-pointer text-sm text-gray-500
                                                        file:me-4 file:py-2.5 file:px-4
                                                        file:rounded-lg file:border-0
                                                        file:text-sm file:font-semibold
                                                        file:bg-[#0084ff] file:text-white
                                                        hover:file:bg-[#0066ff]
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
                                        <label for="user-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">User Name</label>
                                        <input type="text" name="username" value="{{ Auth::user()->username }}" id="user-name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    </div>
                                    <div>
                                        <label for="first-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">First Name</label>
                                        <input type="text" name="first_name" value="{{ Auth::user()->first_name }}" id="first-name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    </div>
                                    <div>
                                        <label for="last-name" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Last Name</label>
                                        <input type="text" name="last_name" value="{{ Auth::user()->last_name }}" id="last-name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    </div>
                                </section>

                                <section class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5">
                                    <div>
                                        <label for="email" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Email</label>
                                        <input type="email" name="email" value="{{ Auth::user()->email }}" id="email" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    </div>
                                    <div>
                                        <label for="mobile" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Mobile</label>
                                        <input type="number" name="mobile" value="{{ Auth::user()->mobile }}" id="mobile" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    </div>
                                </section>
                                    
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
                        </section>
                    </div>


                    <div id="vertical-tab-with-border-2" role="tabpanel" aria-labelledby="vertical-tab-with-border-item-2" class="hidden">
                        <section class="border bg-white dark:bg-gray-800 rounded-lg border-gray-200 dark:border-neutral-700 shadow shrink-0">
                            <div class="border-b-[1.5px] border-[#dddddd] px-5 py-3">
                                <h3 class="font-semibold text-2xl">CHANGE PASSWORD</h3>
                            </div>
                            <form action="{{ route('users.changePassword') }}" method="POST" class="space-y-6 px-5 py-3">
                                @csrf
                                <input name="id" type="hidden" value="{{ Auth::id() }}" />
                                <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                                    <div>
                                        <label for="old-password" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Old Password</label>
                                        <input type="text" name="old_password" id="old-password" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    </div>
                                    <div>
                                        <label for="new-password" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">New Password</label>
                                        <input type="text" name="new_password" id="new-password" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    </div>
                                    <div>
                                        <label for="confirm-password" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Confirm Password</label>
                                        <input type="text" name="confirm_password" id="confirm-password" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    </div>
                                </section>
                                    
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
                        </section>
                    </div>
                </div>
            </div>
        </section>
    @endsection

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
</body>
</html>