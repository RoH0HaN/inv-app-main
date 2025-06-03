<div id="edit-tcs-tds-dialog" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="edit-tcs-tds-dialog-label">
  <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 w-full">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="edit-tcs-tds-dialog-label" class="font-bold text-gray-800 dark:text-white">
          Edit TCS/TDS
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#edit-tcs-tds-dialog">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>

      <form class="p-4 space-y-3">
        <!-- Name -->
        <div>
          <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Name</label>
          <input type="text" name="name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
        </div>

        <!-- Rate -->
        <div>
          <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Rate</label>
          <input type="number" name="rate" step="0.01" min="0" max="100" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
        </div>

        <!-- TCS/TDS Radio Buttons -->
        <div>
          <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Type</label>
          <div class="grid sm:grid-cols-2 gap-2 h-fit">
            <label class="flex p-3 w-full bg-white border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
              <input type="radio" name="type" value="tcs" class="shrink-0 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
              <span class="text-sm text-gray-800 font-bold ms-3 dark:text-neutral-400">TCS</span>
            </label>

            <label class="flex p-3 w-full bg-white border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
              <input type="radio" name="type" value="tds" class="shrink-0 border-gray-200 rounded-full text-blue-600 focus:ring-blue-500 checked:border-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
              <span class="text-sm text-gray-800 font-bold ms-3 dark:text-neutral-400">TDS</span>
            </label>
          </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-end gap-x-2 pt-4">
          <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#edit-tcs-tds-dialog">
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