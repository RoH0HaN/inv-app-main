<div id="edit-outlet-dialog" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="edit-outlet-dialog-label">
  <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-2xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 w-full">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="edit-outlet-dialog-label" class="font-bold text-gray-800 dark:text-white">
          Edit Outlet
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#edit-outlet-dialog">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>

      <form class="p-4 space-y-3">
        <!-- Outlet Image -->
        <div class="flex flex-col items-center">
          <div class="relative size-24 rounded-lg bg-gray-100 mb-3 overflow-hidden dark:bg-neutral-700">
            <img id="outlet-image-preview" src="" alt="Outlet preview" class="size-full object-cover hidden">
            <div id="outlet-image-placeholder" class="size-full flex items-center justify-center text-gray-400 dark:text-neutral-400">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="size-10">
                <rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect>
                <circle cx="9" cy="9" r="2"></circle>
                <path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path>
              </svg>
            </div>
          </div>
          <label class="cursor-pointer">
            <span class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-[#0084FF] text-white hover:bg-[#0059ff] disabled:opacity-50 disabled:pointer-events-none">
              Upload Image
              <input type="file" id="outlet-image" name="outlet_image" accept="image/*" class="hidden">
            </span>
          </label>
        </div>

        <!-- Organization Name -->
        <div>
          <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Organization Name</label>
          <input type="text" name="organization_name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
        </div>

        <!-- Mobile & Alternative Mobile -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Mobile Number</label>
            <input type="tel" name="mobile" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
          </div>
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Alternative Mobile</label>
            <input type="tel" name="alternative_mobile" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
          </div>
        </div>

        <!-- Email & Tax Number -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Email</label>
            <input type="email" name="email" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
          </div>
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Tax Number</label>
            <input type="text" name="tax_number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
          </div>
        </div>

        <!-- Address -->
        <div>
          <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Address</label>
          <textarea name="address" rows="3" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"></textarea>
        </div>

        <!-- Warehouse Dropdown -->
        <div>
          <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Warehouse</label>
          <select name="warehouse" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
            <option selected disabled>Select Warehouse</option>
            <option value="warehouse_1">Warehouse 1</option>
            <option value="warehouse_2">Warehouse 2</option>
            <option value="warehouse_3">Warehouse 3</option>
          </select>
        </div>

        <!-- Invoice Settings - GST -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Invoice Prefix (GST)</label>
            <input type="text" name="gst_invoice_prefix" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
          </div>
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Invoice Number (GST)</label>
            <input type="number" name="gst_invoice_number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
          </div>
        </div>

        <!-- Invoice Settings - Non-GST -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Invoice Prefix (Non-GST)</label>
            <input type="text" name="non_gst_invoice_prefix" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
          </div>
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Invoice Number (Non-GST)</label>
            <input type="number" name="non_gst_invoice_number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
          </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end gap-x-2 pt-4">
          <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#edit-outlet-dialog">
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
    const outletImageInput = document.getElementById('outlet-image');
    const outletImagePreview = document.getElementById('outlet-image-preview');
    const outletImagePlaceholder = document.getElementById('outlet-image-placeholder');

    outletImageInput.addEventListener('change', function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
          outletImagePreview.src = event.target.result;
          outletImagePreview.classList.remove('hidden');
          outletImagePlaceholder.classList.add('hidden');
        }
        reader.readAsDataURL(file);
      }
    });
  });
</script>