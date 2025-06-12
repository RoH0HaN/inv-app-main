@props(['outlets'=> [], 'warehouses' => []])
<div id="edit-bank-account-dialog" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="edit-bank-account-dialog-label">
  <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-3.5rem)] flex items-center">
    <div class="flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 w-full">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="edit-bank-account-dialog-label" class="font-bold text-gray-800 dark:text-white">
          Edit Bank Account
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-hidden focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#edit-bank-account-dialog">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>

      <form class="p-4 space-y-3" action="{{ route('cash-bank.updateBankAccount') }}" method="POST">
        @csrf
        <input type="hidden" name="id">
        <!-- Bank Name & Account Number -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Account Holder Name</label>
            <input type="text" name="account_holder_name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
          </div>
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Bank Name</label>
            <input type="text" name="bank_name" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
          </div>
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Account Number</label>
            <input type="text" name="account_number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
          </div>
        </div>

        <!-- IFSC Code & Opening Balance -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">IFSC Code</label>
            <input type="text" name="ifsc_code" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
          </div>
          <div>
            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Opening Balance</label>
            <input type="number" name="opening_balance" step="0.01" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
          </div>
        </div>

        

        <label for="other-details" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Select Operable Warehouse and outlet</label>
        <div id="location-section" class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">

            <!-- Warehouses Section -->
            <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-xl shadow-sm">
                <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                    <span class="inline-block px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 text-xs rounded-md">Warehouses</span>
                </p>
                <div class="space-y-3">
                    @forelse($warehouses as $warehouse)
                        <label for="warehouse_{{ $warehouse->id }}" class="flex items-center space-x-2 cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900 p-2 rounded-md transition">
                            <input type="checkbox" name="location_ids[]" class="location-checkbox warehouse-checkbox text-blue-600 focus:ring-blue-500" 
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
                            <input type="checkbox" name="location_ids[]" class="location-checkbox outlet-checkbox text-green-600 focus:ring-green-500" 
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
          <button type="button" class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700" data-hs-overlay="#edit-bank-account-dialog">
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