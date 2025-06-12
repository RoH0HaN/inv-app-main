<!-- Bank Cash Adjustment Dialog -->
<div id="bank-adjust-dialog" class="hs-overlay hidden fixed inset-0 z-[100] bg-black/40 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white dark:bg-gray-900 p-6 rounded-lg max-w-md w-full shadow-xl">
        <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-100">Adjust Bank Cash</h2>
        
        <form method="POST" id="adjust-bank-form" action="{{ route('cash-bank.adjustBankAccount') }}">
            @csrf
            <!-- Hidden Input for Bank ID -->
            <input type="hidden" id="data-id" name="id">
            <div class="space-y-4">
                <!-- Amount -->
                <div>
                    <label for="adjust-amount" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Amount</label>
                    <input type="number" name="amount" id="adjust-amount" step="0.01" required
                        class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                </div>

                <!-- Action Type -->
                <div>
                    <label for="adjust-type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Type</label>
                    <select name="type" id="adjust-type" required
                        class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                        <option value="" disabled selected>Select action</option>
                        <option value="deposit">Deposit</option>
                        <option value="withdraw">Withdraw</option>
                    </select>
                </div>

                <!-- Note -->
                <div>
                    <label for="adjust-note" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Note</label>
                    <textarea name="note" id="adjust-note" rows="3"
                        class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        placeholder="Adjustment note..."></textarea>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <button type="button" class="bg-gray-300 dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-2 rounded-lg"
                        data-hs-overlay="#bank-adjust-dialog">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
