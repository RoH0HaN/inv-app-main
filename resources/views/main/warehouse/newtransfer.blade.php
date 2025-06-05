<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Css For Table Start -->
    <link rel="stylesheet" href="/assets/table/css/style.css">
    <!-- Custom Css For Table End -->

    <title>New Transfer | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Warehouse'],
                ['url' =>  route('warehouse.stockTransferList'), 'text' => 'Stock Transfer List'],
                ['url' =>  route('warehouse.newTransfer'), 'text' => 'New Transfer']
            ]" />

            <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">NEW TRANSFER</h3>
                </div>
                <div class="py-5 px-5">
                    <form id="transferForm" action="#" class="space-y-6">

                        <section class="grid grid-cols-3 items-center py-3 gap-10">
                            <div>
                                <label for="date" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Date</label>
                                <input type="date" id="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <!-- Select From Warehouse Or Shop Start -->
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">From</label>
                                    <select id="fromWarehouse" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option value="" selected disabled>Select Warehouse or Shop</option>
                                        <option value="Warehouse 01">Warehouse 01</option>
                                        <option value="Warehouse 02">Warehouse 02</option>
                                        <option value="Warehouse 03">Warehouse 03</option>
                                        <option value="Warehouse 04">Warehouse 04</option>
                                        <option value="Warehouse 05">Warehouse 05</option>
                                        <option value="Warehouse 06">Warehouse 06</option>
                                        <option value="Warehouse 07">Warehouse 07</option>
                                        <option value="Warehouse 08">Warehouse 08</option>
                                    </select>
                                </div>
                            <!-- Select From Warehouse Or Shop End -->
                            <!-- Select To Warehouse Or Shop Start -->
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">To</label>
                                    <select id="toWarehouse" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        <option value="" selected disabled>Select Warehouse or Shop</option>
                                        <option value="Warehouse 01">Warehouse 01</option>
                                        <option value="Warehouse 02">Warehouse 02</option>
                                        <option value="Warehouse 03">Warehouse 03</option>
                                        <option value="Warehouse 04">Warehouse 04</option>
                                        <option value="Warehouse 05">Warehouse 05</option>
                                        <option value="Warehouse 06">Warehouse 06</option>
                                        <option value="Warehouse 07">Warehouse 07</option>
                                        <option value="Warehouse 08">Warehouse 08</option>
                                    </select>
                                </div>
                            <!-- Select To Warehouse Or Shop End -->

                            <div>
                                <label for="transfer-code" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Transfer Code</label>
                                <input type="text" id="transfer-code" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            <div>
                                <label for="transfer-request-code" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Transfer Request Code</label>
                                <input type="text" id="transfer-request-code" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>

                            <div class="col-span-3">
                                <label for="transfer-note" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Transfer Note</label>
                                <textarea 
                                    id="transfer-note" 
                                    rows="3" 
                                    class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                                    required
                                ></textarea>
                            </div>
                        </section>

                        <!-- Items Start -->
                        <div>
                            <h3 class="font-semibold text-2xl uppercase border-b mb-5 border-gray-200 py-3">ITEMS</h3>
                            
                            <!-- SearchBox with Button -->
                            <div class="flex gap-3">
                                <div class="relative flex-grow">
                                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-3.5">
                                        <svg class="shrink-0 size-4 text-gray-400 dark:text-white/60" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="11" cy="11" r="8"></circle>
                                            <path d="m21 21-4.3-4.3"></path>
                                        </svg>
                                    </div>
                                    <input id="itemSearch" class="py-2.5 sm:py-3 ps-10 pe-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" type="text" placeholder="Enter item details to search .....">
                                </div>
                                <button type="button" id="searchButton" class="px-4 py-2.5 sm:py-3 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                                    Search
                                </button>
                            </div>
                            
                            <!-- Table -->
                            <div class="overflow-x-auto table-container">
                                <table id="myTable">
                                    <thead>
                                        <tr>
                                            <th>ACTION</th>
                                            <th>ITEM</th>
                                            <th>IMEI</th>
                                            <th>BATCH NO.</th>
                                            <th>COLOR</th>
                                            <th>STOCK</th>
                                            <th class="w-60">UNIT</th>
                                            <th>QUANTITY TO TRANSFER</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemsTableBody" class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                        <!-- Items will be added here dynamically -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" class="px-6 py-3 font-semibold text-right" style="text-align: right;">Total Quantity</td>
                                            <td id="totalQuantity" class="px-6 py-3">0</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <!-- Items End -->
                            
                        <!-- Submit Button Start -->
                        <div class="pt-10 flex gap-5">
                            <button type="submit" class="w-fit bg-indigo-600 text-white py-2 px-12 rounded-md hover:bg-indigo-700 transition cursor-pointer">
                                Submit
                            </button>
                            <button type="button" id="closeBtn" class="py-2 px-12 w-fit inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                                Close
                            </button>
                        </div>
                        <!-- Submit Button End -->
                    </form>
                </div>
            </div>
        </section>
    @endsection

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Demo data for items
            const demoItems = [
                { id: 1, name: 'Samsung Galaxy S23', imei: 'IMEI123456789', batchNo: 'BATCH001', color: 'Black', stock: 50, unit: 'Piece' },
                { id: 2, name: 'Samsung Galaxy S24', imei: 'IMEI987654321', batchNo: 'BATCH002', color: 'White', stock: 30, unit: 'Piece' },
                { id: 3, name: 'iPhone 15', imei: 'IMEI456123789', batchNo: 'BATCH003', color: 'Blue', stock: 25, unit: 'Piece' },
                { id: 4, name: 'iPhone 16', imei: 'IMEI789123456', batchNo: 'BATCH004', color: 'Red', stock: 15, unit: 'Piece' },
                { id: 5, name: 'Sony HX300', imei: 'IMEI321654987', batchNo: 'BATCH005', color: 'Black', stock: 10, unit: 'Box' }
            ];

            // Search functionality
            function performSearch() {
                const searchTerm = $('#itemSearch').val().toLowerCase();
                console.log('Searching for:', searchTerm);
                
                if (searchTerm.length > 0) {
                    const filteredItems = demoItems.filter(item => 
                        item.name.toLowerCase().includes(searchTerm) || 
                        item.imei.toLowerCase().includes(searchTerm)
                    );
                    
                    if (filteredItems.length > 0) {
                        // Add ALL matching items to the table
                        filteredItems.forEach(item => {
                            // Check if item already exists in table
                            if (!$(`#item-row-${item.id}`).length) {
                                addItemToTable(item);
                            }
                        });
                        $('#itemSearch').val(''); // Clear search after adding
                    } else {
                        alert('No matching items found');
                    }
                } else {
                    alert('Please enter a search term');
                }
            }

            // Search on button click
            $('#searchButton').on('click', performSearch);

            // Also search on Enter key press
            $('#itemSearch').on('keypress', function(e) {
                if (e.which === 13) {
                    performSearch();
                }
            });

            // Add item to table (with duplicate check)
            function addItemToTable(item) {
                const rowId = `item-row-${item.id}`;
                
                const row = `
                    <tr id="${rowId}" class="item-row">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <button type="button" class="delete-item-btn px-2 py-2 text-xs rounded remove-item cursor-pointer" data-id="${item.id}">
                                <img src="/assets/table/trash.svg" alt="" class="w-6 h-6">
                            </button>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">${item.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap">${item.imei}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="text" class="batch-no w-full px-2 py-2 border border-gray-300 bg-white rounded">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="text" class="color w-full px-2 py-2 border border-gray-300 bg-white rounded">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="number" min="1" class="stock w-full px-2 py-2 border border-gray-300 bg-white rounded" value="${item.stock}">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <select class="unit-select w-full px-2 py-2 border border-gray-300 bg-white rounded">
                                <option value="Piece" ${item.unit === 'Piece' ? 'selected' : ''}>Piece</option>
                                <option value="Box" ${item.unit === 'Box' ? 'selected' : ''}>Box</option>
                                <option value="Set">Set</option>
                            </select>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <input type="number" min="1" max="${item.stock}" value="1" class="quantity-input w-full px-2 py-2 border border-gray-300 bg-white rounded" data-stock="${item.stock}">
                        </td>
                    </tr>
                `;
                
                $('#itemsTableBody').append(row);
                updateTotalQuantity();
                
                // Add event listeners for the new row
                $(`#${rowId} .delete-item-btn`).on('click', function() {
                    $(this).closest('tr').remove();
                    updateTotalQuantity();
                });
                
                $(`#${rowId} .quantity-input`).on('change', function() {
                    const max = parseInt($(this).data('stock'));
                    const value = parseInt($(this).val());
                    
                    if (value > max) {
                        $(this).val(max);
                        alert(`Cannot transfer more than available stock (${max})`);
                    } else if (value < 1) {
                        $(this).val(1);
                    }
                    
                    updateTotalQuantity();
                });
            }

            // Delete item from table
            $(document).on('click', '.delete-item-btn', function() {
                $(this).closest('tr').remove();
                updateTotalQuantity();
            });

            // Update total quantity
            function updateTotalQuantity() {
                let total = 0;
                $('.quantity-input').each(function() {
                    total += parseInt($(this).val()) || 0;
                });
                $('#totalQuantity').text(total);
            }

            // Form submission
            $('#transferForm').on('submit', function(e) {
                e.preventDefault();
                
                const formData = {
                    date: $('#date').val(),
                    fromWarehouse: $('#fromWarehouse').val(),
                    toWarehouse: $('#toWarehouse').val(),
                    transferCode: $('#transfer-code').val(),
                    transferRequestCode: $('#transfer-request-code').val(),
                    transferNote: $('#transfer-note').val(),
                    items: []
                };
                
                $('.item-row').each(function() {
                    const row = $(this);
                    formData.items.push({
                        item: row.find('td:eq(1)').text(),
                        imei: row.find('td:eq(2)').text(),
                        batchNo: row.find('.batch-no').val(),
                        color: row.find('.color').val(),
                        stock: row.find('.stock').val(),
                        unit: row.find('.unit-select').val(),
                        quantity: row.find('.quantity-input').val()
                    });
                });
                
                console.log('Form data to be submitted:', formData);
                alert('Form data logged to console! Check your browser console for details.');
            });

            // Close button
            $('#closeBtn').on('click', function() {
                if (confirm('Are you sure you want to close without saving?')) {
                    window.location.href = "{{ route('warehouse.stockTransferList') }}";
                }
            });

            // Set today's date as default
            const today = new Date().toISOString().split('T')[0];
            $('#date').val(today);
        });
    </script>
</body>
</html>