@props(['warehouses' => [], 'outlets' => []])

<div id="edit-user-dialog" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="edit-user-dialog-label">
  <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 w-full">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="edit-user-dialog-label" class="font-bold text-gray-800 dark:text-white">
          Edit User
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#edit-user-dialog">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>

      <form class="p-4 space-y-3" method="POST" enctype="multipart/form-data" action="{{ route('users.updateUser') }}">
        @csrf
        <!-- Profile Image -->
        <div class="flex flex-col items-center">
          <div class="relative size-24 rounded-full bg-gray-100 mb-3 overflow-hidden dark:bg-neutral-700">
            <img id="profile-image-preview" src="" alt="Profile preview" class="size-full object-cover hidden">
            <div id="profile-image-placeholder" class="size-full flex items-center justify-center text-gray-400 dark:text-neutral-400">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-10">
                <path d="M18 20a6 6 0 0 0-12 0"></path>
                <circle cx="12" cy="10" r="4"></circle>
              </svg>
            </div>
          </div>
          <label class="cursor-pointer">
            <span class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-[#0084FF] text-white hover:bg-[#0059ff] disabled:opacity-50 disabled:pointer-events-none">
              Upload Image
              <input type="file" id="profile-image" name="profile_image" accept="image/*" class="hidden">
            </span>
          </label>
        </div>

        <input type="hidden" id="edit-id" name="id">
        <!-- First Name & Last Name -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">First Name</label>
            <input type="text" name="first_name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
          </div>
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Last Name</label>
            <input type="text" name="last_name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
          </div>
        </div>

        <!-- Username & Email -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Username</label>
            <input type="text" name="username" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
          </div>
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Email</label>
            <input type="email" name="email" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
          </div>
        </div>

        <!-- Mobile -->
        <div>
          <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Mobile Number</label>
          <input type="tel" name="mobile" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
        </div>

        <!-- Role & Status -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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
        </div>

        <!-- Location Radio Buttons -->
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

        

        <!-- Form Actions -->
        <div class="flex justify-end gap-x-2 pt-4">
          <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#edit-user-dialog">
            Cancel
          </button>
          <button type="submit" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-[#0084FF] text-white hover:bg-[#0059ff] disabled:opacity-50 disabled:pointer-events-none cursor-pointer transition-all duration-200">
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const profileImageInput = document.getElementById('profile-image');
    const profileImagePreview = document.getElementById('profile-image-preview');
    const profileImagePlaceholder = document.getElementById('profile-image-placeholder');

    profileImageInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          profileImagePreview.src = event.target.result;
          profileImagePreview.classList.remove('hidden');
          profileImagePlaceholder.classList.add('hidden');
        }
        reader.readAsDataURL(file);
      }
    });
  });
</script>