<div id="imei-details" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="imei-details-label">
  <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
    <div class="w-full flex flex-col bg-white border border-gray-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70">
      <div class="flex justify-between items-center py-3 px-4 border-b border-gray-200 dark:border-neutral-700">
        <h3 id="imei-details-label" class="font-bold text-gray-800 dark:text-white text-lg">
          IMEI DETAILS
        </h3>
        <!-- <button type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#imei-details">
          <span class="sr-only">Close</span>
          <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6 6 18"></path>
            <path d="m6 6 12 12"></path>
          </svg>
        </button> -->
      </div>

      <div class="p-4 overflow-y-auto">
        <div class="mb-4">
          <label for="imei-input" class="block text-sm font-medium text-gray-700 dark:text-neutral-300 mb-1">IMEI Number</label>
          <div class="flex gap-2">
            <input type="text" id="imei-input" class="py-2 px-3 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-300" placeholder="Enter IMEI number">
            <button id="add-imei" type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
              Add
            </button>
          </div>
        </div>

        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
            <thead class="bg-gray-50 dark:bg-neutral-700">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-neutral-400">IMEI Number</th>
                <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider dark:text-neutral-400">Action</th>
              </tr>
            </thead>
            <tbody id="imei-table-body" class="bg-white divide-y divide-gray-200 dark:bg-neutral-800 dark:divide-neutral-700">
              <!-- IMEI rows will be added here dynamically -->
            </tbody>
          </table>
        </div>

        <div class="mt-4 flex justify-end gap-2">
          <!-- <button type="button" data-hs-overlay="#imei-details" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700">
            Close
          </button> -->
          <button id="save-imei" type="button" class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">
            Save
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const imeiModal = document.getElementById('imei-details');
    const imeiInput = document.getElementById('imei-input');
    const addImeiButton = document.getElementById('add-imei');
    const imeiTableBody = document.getElementById('imei-table-body');
    const saveImeiButton = document.getElementById('save-imei');
    const closeButton = imeiModal.querySelector('[data-hs-overlay="#imei-details"]');

    // 1. MODAL CONTROL FUNCTIONS
    function openModal() {
        imeiModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        imeiModal.style.pointerEvents = 'auto';
        
        setTimeout(() => {
        imeiInput.focus();
        }, 100);
    }

    function closeModal() {
        imeiModal.classList.add('hidden');
        document.body.style.overflow = '';
        imeiModal.style.pointerEvents = 'none';
    }

    // 2. IMEI FUNCTIONALITY
    function isValidIMEI(imei) {
        return /^\d{15}$/.test(imei);
    }

    function addImeiToTable(imei) {
        imei = imei.trim();
        if (!isValidIMEI(imei)) {
        alert('Please enter a valid 15-digit IMEI number');
        imeiInput.classList.add('border-red-500');
        return false;
        }

        const existingImeis = Array.from(imeiTableBody.querySelectorAll('.imei-value')).map(el => el.textContent.trim());
        if (existingImeis.includes(imei)) {
        alert('This IMEI number has already been added');
        imeiInput.classList.add('border-red-500');
        return false;
        }

        imeiInput.classList.remove('border-red-500');

        const row = document.createElement('tr');
        row.className = 'hover:bg-gray-50 dark:hover:bg-neutral-700';
        row.innerHTML = `
        <td class="px-6 py-4 whitespace-nowrap imei-value">${imei}</td>
        <td class="px-6 py-4 whitespace-nowrap text-right">
            <button type="button" class="delete-imei text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            </button>
        </td>
        `;

        imeiTableBody.appendChild(row);
        imeiInput.value = '';

        row.querySelector('.delete-imei').addEventListener('click', function() {
        row.remove();
        });

        return true;
    }

    // 3. EVENT LISTENERS
    addImeiButton.addEventListener('click', function() {
        addImeiToTable(imeiInput.value);
    });

    imeiInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
        addImeiToTable(imeiInput.value);
        }
    });

    saveImeiButton.addEventListener('click', function(e) {
        e.preventDefault(); // Prevent any default form submission behavior
        
        const imeiNumbers = Array.from(imeiTableBody.querySelectorAll('.imei-value')).map(el => el.textContent.trim());
        
        if (imeiNumbers.length === 0) {
        alert('Please add at least one IMEI number');
        return;
        }

        // 1. Print to console
        console.log('Saved IMEI numbers:', imeiNumbers);
        
        // 2. Save to hidden field (if exists)
        const imeiNumberField = document.getElementById('imei-number');
        if (imeiNumberField) {
        imeiNumberField.value = imeiNumbers.join(', ');
        }

        // 3. Close the modal
        closeModal();
    });

    closeButton.addEventListener('click', function(e) {
        e.preventDefault();
        closeModal();
    });

    // Close modal when clicking on the backdrop
    imeiModal.addEventListener('click', function(e) {
        if (e.target === imeiModal) {
        closeModal();
        }
    });

    // 4. GLOBAL ACCESS
    window.imeiDetails = {
        addImei: addImeiToTable,
        show: openModal,
        hide: closeModal,
        isValidIMEI
    };
    });
</script>