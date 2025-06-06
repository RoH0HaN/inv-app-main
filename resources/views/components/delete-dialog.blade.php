<!-- Common Delete Confirmation Dialog -->
<div id="common-delete-dialog" class="hs-overlay hidden fixed inset-0 z-[100] bg-black/40 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg max-w-md w-full shadow-xl">
        <h2 class="text-xl font-semibold mb-4">Confirm Delete</h2>
        <p>Are you sure you want to delete <span id="delete-item-name" class="font-bold text-red-600">this item</span>?</p>

        <form method="POST" id="delete-form">
            @csrf
            @method('DELETE')
            <input type="hidden" name="id" id="delete-item-id">
            <div class="mt-6 flex justify-end gap-4">
                <button type="button" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg" data-hs-overlay="#common-delete-dialog">
                    Cancel
                </button>
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>
