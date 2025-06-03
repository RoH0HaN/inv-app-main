<div id="add-batch-details" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hs-scale-animation-modal-label">
  <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-6xl sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
    <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 dark:text-white text-lg">
          BATCH DETAILS
        </h3>
        <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#add-batch-details">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button>
      </div>

      <div class="p-4 overflow-y-scroll">
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-50 dark:bg-neutral-700">
              <tr>
                <th scope="col" class="px-6 py-3 text-center text-sm font-semibold text-[#000] uppercase border-2 border-gray-200">Batch</th>
                <th scope="col" class="px-6 py-3 text-center text-sm font-semibold text-[#000] uppercase border-2 border-gray-200">Model</th>
                <th scope="col" class="px-6 py-3 text-center text-sm font-semibold text-[#000] uppercase border-2 border-gray-200">MRP</th>
                <th scope="col" class="px-6 py-3 text-center text-sm font-semibold text-[#000] uppercase border-2 border-gray-200">Color</th>
                <th scope="col" class="px-6 py-3 text-center text-sm font-semibold text-[#000] uppercase border-2 border-gray-200">Size</th>
                <th scope="col" class="px-6 py-3 text-center text-sm font-semibold text-[#000] uppercase border-2 border-gray-200">Opening Quantity</th>
                <th scope="col" class="px-6 py-3 text-center text-sm font-semibold text-[#000] uppercase border-2 border-gray-200">Action</th>
              </tr>
            </thead>
            <tbody id="batch-rows" class="divide-y divide-gray-200 dark:divide-neutral-700">
              <!-- Batch rows will be added here dynamically -->
            </tbody>
          </table>
        </div>
        
        <div class="mt-4 flex justify-between items-center">
          <button id="add-batch-row" type="button" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
            Add Row
          </button>
          
          <div class="flex gap-2">
            <button type="button" data-hs-overlay="#add-batch-details" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
              Close
            </button>
            <button id="save-batch-details" type="button" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
              Save
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize batch details functionality
    const batchModal = document.getElementById('add-batch-details');
    const batchRowsContainer = document.getElementById('batch-rows');
    const addRowButton = document.getElementById('add-batch-row');
    const saveButton = document.getElementById('save-batch-details');
    const closeButton = batchModal.querySelector('[data-hs-overlay="#add-batch-details"]');
    
    // Sample data for dropdowns (you can replace with your actual data)
    const matchOptions = ['Batch 1', 'Batch 2', 'Batch 3'];
    const modelOptions = ['Model A', 'Model B', 'Model C'];
    const colorOptions = ['Red', 'Blue', 'Green', 'Black', 'White'];
    const sizeOptions = ['S', 'M', 'L', 'XL', 'XXL'];
    
    // Add a new batch row
    function addBatchRow(data = {}) {
      const rowId = Date.now(); // Unique ID for each row
      const row = document.createElement('tr');
      row.id = `batch-row-${rowId}`;
      row.className = 'hover:bg-gray-50 dark:hover:bg-neutral-700';
      
      row.innerHTML = `
        <td class="py-1 whitespace-nowrap border-2 border-gray-200 px-3">
          <select class="batch-match block w-full border border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 py-3 px-2">
            ${matchOptions.map(option => 
              `<option value="${option}" ${data.match === option ? 'selected' : ''}>${option}</option>`
            ).join('')}
          </select>
        </td>
        <td class="py-1 whitespace-nowrap border-2 border-gray-200 px-3">
          <select class="batch-model block w-full border border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 py-3 px-2">
            ${modelOptions.map(option => 
              `<option value="${option}" ${data.model === option ? 'selected' : ''}>${option}</option>`
            ).join('')}
          </select>
        </td>
        <td class="py-1 whitespace-nowrap border-2 border-gray-200 px-3">
          <input type="number" class="batch-mrp block w-full border border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 py-3 px-2" value="${data.mrp || ''}">
        </td>
        <td class="py-1 whitespace-nowrap border-2 border-gray-200 px-3">
          <select class="batch-color block w-full border border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 py-3 px-2">
            ${colorOptions.map(option => 
              `<option value="${option}" ${data.color === option ? 'selected' : ''}>${option}</option>`
            ).join('')}
          </select>
        </td>
        <td class="py-1 whitespace-nowrap border-2 border-gray-200 px-3">
          <select class="batch-size block w-full border border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 py-3 px-2">
            ${sizeOptions.map(option => 
              `<option value="${option}" ${data.size === option ? 'selected' : ''}>${option}</option>`
            ).join('')}
          </select>
        </td>
        <td class="py-1 whitespace-nowrap border-2 border-gray-200 px-3">
          <input type="number" class="batch-quantity block w-full border border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 py-3 px-2" value="${data.quantity || ''}">
        </td>
        <td class="py-4 whitespace-nowrap border-2 border-gray-200 text-center">
          <button type="button" class="delete-batch-row text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 py-3 px-2" data-row-id="${rowId}">
            <img src="/assets/table/trash.svg" alt="" class="w-6 h-6">
          </button>
        </td>
      `;
      
      batchRowsContainer.appendChild(row);
    
      // Add event listener for the delete button
      row.querySelector('.delete-batch-row').addEventListener('click', function() {
        deleteBatchRow(rowId);
      });
    }
    
    // Delete a batch row
    function deleteBatchRow(rowId) {
      const row = document.getElementById(`batch-row-${rowId}`);
      if (row) {
        row.remove();
      }
    }
    
    // Validate batch data
    function validateBatchData() {
      const rows = batchRowsContainer.querySelectorAll('tr');
      let isValid = true;
      
      rows.forEach(row => {
        const match = row.querySelector('.batch-match').value;
        const model = row.querySelector('.batch-model').value;
        const mrp = row.querySelector('.batch-mrp').value;
        const color = row.querySelector('.batch-color').value;
        const size = row.querySelector('.batch-size').value;
        const quantity = row.querySelector('.batch-quantity').value;
        
        if (!match || !model || !mrp || !color || !size || !quantity) {
          isValid = false;
          // Highlight empty fields
          if (!match) row.querySelector('.batch-match').classList.add('border-red-500');
          if (!model) row.querySelector('.batch-model').classList.add('border-red-500');
          if (!mrp) row.querySelector('.batch-mrp').classList.add('border-red-500');
          if (!color) row.querySelector('.batch-color').classList.add('border-red-500');
          if (!size) row.querySelector('.batch-size').classList.add('border-red-500');
          if (!quantity) row.querySelector('.batch-quantity').classList.add('border-red-500');
        }
      });
      
      return isValid;
    }
    
    // Get all batch data
    function getBatchData() {
      const rows = batchRowsContainer.querySelectorAll('tr');
      const batchData = [];
      
      rows.forEach(row => {
        batchData.push({
          match: row.querySelector('.batch-match').value,
          model: row.querySelector('.batch-model').value,
          mrp: row.querySelector('.batch-mrp').value,
          color: row.querySelector('.batch-color').value,
          size: row.querySelector('.batch-size').value,
          quantity: row.querySelector('.batch-quantity').value
        });
      });
      
      return batchData;
    }
    
    // Add row button click handler
    addRowButton.addEventListener('click', function() {
      addBatchRow();
    });
    
    // Save button click handler
    saveButton.addEventListener('click', function() {
      // Remove any previous error highlights
      document.querySelectorAll('.border-red-500').forEach(el => {
        el.classList.remove('border-red-500');
      });
      
      if (!validateBatchData()) {
        alert('Please fill in all fields for each batch row');
        return;
      }
      
      const batchData = getBatchData();
      console.log('Batch data to save:', batchData);
      
      // Update the batch number field in the main form
      const batchNumberField = document.getElementById('batch-number');
      if (batchNumberField) {
        batchNumberField.value = `BATCH-${Date.now().toString().slice(-6)}`;
      }
      
      // Close the modal using HSOverlay
      if (window.HSOverlay) {
        const modal = HSOverlay.getInstance(batchModal);
        if (modal) {
          modal.hide();
        } else {
          batchModal.classList.add('hidden');
        }
      } else {
        batchModal.classList.add('hidden');
      }
      
      // Show success message (you might want to use a better notification system)
      alert('Batch details saved successfully!');
    });
    
    // Close button click handler
    closeButton.addEventListener('click', function() {
      if (window.HSOverlay) {
        const modal = HSOverlay.getInstance(batchModal);
        if (modal) {
          modal.hide();
        } else {
          batchModal.classList.add('hidden');
        }
      } else {
        batchModal.classList.add('hidden');
      }
    });
    
    // Initialize with one empty row
    addBatchRow();
    
    // Make the modal accessible globally if needed
    window.batchDetails = {
      addBatchRow,
      deleteBatchRow,
      getBatchData
    };
  });
</script>