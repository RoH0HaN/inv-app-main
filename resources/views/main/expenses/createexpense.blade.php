<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Css For Table Start -->
    <link rel="stylesheet" href="/assets/table/css/style.css">
    <!-- Custom Css For Table End -->

    <title>Create Expense | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => '/main/dashboard/dashboard', 'text' => 'Home'],
                ['url' => '#', 'text' => 'Contacts'],
                ['url' => '/main/contacts/suppliers', 'text' => 'Suppliers List'],
                ['url' => '/main/contacts/supplierpayment', 'text' => 'Supplier Payment']
            ]" />

            <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">EXPENSE DETAILS</h3>
                </div>
                
                <form id="supplierPaymentForm" class="space-y-6 py-5">
                    <!-- Expense Details Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5 px-5">
                        <div>
                            <label for="date" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Date</label>
                            <input type="date" id="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        </div>
                        <div>
                            <label for="expense-code" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Expense Code</label>
                            <input type="text" id="expense-code" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        </div>
                        <div>
                            <label for="reference-number" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Reference Number</label>
                            <input type="text" id="reference-number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        </div>
                    </div>
                    
                    <!-- Expense Items Section -->
                    <div class="mb-6">
                        <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                            <h3 class="font-semibold text-2xl">EXPENSE ITEMS</h3>
                        </div>
                        
                        <div class="flex flex-col md:flex-row gap-6 my-5 px-5 max-w-7xl">
                            <div class="flex-grow">
                                <input type="text" id="item-search" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm">
                            </div>
                            <div class="w-full md:w-auto">
                                <button type="button" id="add-item-row" 
                                        class="w-full md:w-auto transition-all duration-300 px-6 py-2 bg-[#CBE6FF] text-[#0084FF] hover:text-white cursor-pointer font-semibold rounded-md hover:bg-[#006eff]">
                                    Add Row
                                </button>
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto px-5 table-container">
                            <table id="myTable">
                                <thead>
                                    <tr>
                                        <th class="w-24">ACTION</th>
                                        <th>ITEM</th>
                                        <th class="w-44">QTY</th>
                                        <th class="w-60">PRICE/UNIT</th>
                                        <th style="text-align: right;">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody id="expense-items-body">
                                    <!-- Empty by default -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="px-6 py-3 font-semibold text-right" style="text-align: right;">Total Quantity</td>
                                        <td id="total-qty" class="px-6 py-3">0</td>
                                        <td colspan="2" id="items-grand-total" class="text-right" style="text-align: right;">0.00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 px-5">
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Note</label>
                                <textarea name="note" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="2"></textarea>
                            </div>
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Employee</label>
                                <select name="employee_id" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    <option value="1">John Doe</option>
                                    <option value="2">Emma Watson</option>
                                </select>
                            </div>

                            <div class="border border-gray-400 grid items-center gap-y-1.5 -translate-y-7 h-fit rounded-lg">
                                <div class="grid grid-cols-2 items-center px-2.5 py-1" style="background-color: rgba(0, 0, 0, 0.05);">
                                    <label>Round Off</label>
                                    <input type="number" name="round_off" id="round-off" class="w-full px-3 py-1 border border-gray-300 rounded-md bg-white" 
                                        value="" step="0.01" readonly>
                                </div>
                                <div class="grid grid-cols-2 items-center px-2.5 py-1">
                                    <label class="">Grand Total</label>
                                    <input type="number" name="grand_total" id="grand-total" class="w-full px-3 py-1 border border-gray-300 rounded-md bg-white" 
                                        value="0.00" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Payments Section -->
                    <div class="mb-6">
                        <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                            <h3 class="font-semibold text-2xl">PAYMENTS</h3>
                        </div>
                        
                        <div id="payment-options-container" class="space-y-4">
                            <!-- Single non-removable payment option -->
                            <div class="bg-white p-4 rounded-lg">
                                <h5 class="text-md font-bold text-gray-800 mb-3">Payment Option 1</h5>
                                
                                <div class="mb-3">
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Note</label>
                                    <textarea name="payments[0][note]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-note" rows="2"></textarea>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Amount</label>
                                        <input type="number" name="payments[0][amount]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-amount" 
                                            step="0.01" min="0" value="0.00" required>
                                    </div>
                                    <div>
                                        <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Type</label>
                                        <select name="payments[0][type]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-type" required>
                                            <option value="" selected disabled>Select payment option</option>
                                            <option value="UPI">UPI</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Credit Card">Credit Card</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <button type="button" id="add-payment-option" 
                                class="w-full mt-5 mx-5 md:w-auto transition-all duration-300 px-6 py-2 bg-[#CBE6FF] text-[#0084FF] hover:text-white cursor-pointer font-semibold rounded-md hover:bg-[#006eff]">
                            Add Payment Option
                        </button>
                    </div>
                    
                    <div class="space-x-5 mt-6 mx-5">
                        <button type="submit" class="px-8 cursor-pointer py-1.5 bg-[#0084FF] text-white rounded-md hover:bg-[#006aff]">Submit</button>
                        <button type="button" class="px-8 cursor-pointer py-1.5 bg-[#DFDFDF] text-[#8a8a8a] rounded-md hover:bg-gray-300">Close</button>
                    </div>
                </form>
            </div>
        </section>
    @endsection

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let itemCounter = 0;
            let paymentCounter = 1; // Start from 1 since we have one by default
            
            // Add item row functionality
            document.getElementById('add-item-row').addEventListener('click', function() {
                addExpenseItemRow();
            });
            
            // Add payment option functionality
            document.getElementById('add-payment-option').addEventListener('click', function() {
                addPaymentOption();
            });
            
            // Form submission handler
            document.getElementById('supplierPaymentForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const formData = new FormData(this);
                const data = Object.fromEntries(formData.entries());
                
                console.log('Form submission data:', data);
                alert('Form submitted! Check console for data.');
            });
            
            // Function to add a new expense item row
            function addExpenseItemRow(name = '', qty = 1, price = 0) {
                const tbody = document.getElementById('expense-items-body');
                const searchInput = document.getElementById('item-search');
                
                // If name is empty, use the search input value
                if (!name) {
                    name = searchInput.value.trim();
                    if (!name) {
                        alert('Please enter an item name');
                        return;
                    }
                    searchInput.value = '';
                }
                
                const newRow = document.createElement('tr');
                newRow.className = 'bg-white divide-y divide-gray-200';
                newRow.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <button type="button" class="px-2 py-2 text-xs rounded remove-item cursor-pointer">
                            <img src="/assets/table/trash.svg" alt="" class="w-6 h-6">
                        </button>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input disabled type="text" name="items[${itemCounter}][name]" class="w-full rounded item-name" 
                               value="${name}" readonly>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="number" name="items[${itemCounter}][quantity]" class="w-full px-2 py-2 border border-gray-300 bg-white rounded item-qty" 
                               min="1" value="${qty}" required>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input type="number" name="items[${itemCounter}][price]" class="w-full px-2 py-2 border border-gray-300 bg-white rounded item-price" 
                               step="0.01" min="0" value="${price}" required>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <input disabled type="text" name="items[${itemCounter}][total]" class="w-full text-right rounded item-total" 
                               value="${(qty * price).toFixed(2)}" readonly>
                    </td>
                `;
                
                tbody.appendChild(newRow);
                itemCounter++;
                
                // Add event listeners to the new row
                const qtyInput = newRow.querySelector('.item-qty');
                const priceInput = newRow.querySelector('.item-price');
                const totalInput = newRow.querySelector('.item-total');
                
                const calculateRowTotal = () => {
                    const qty = parseFloat(qtyInput.value) || 0;
                    const price = parseFloat(priceInput.value) || 0;
                    const total = qty * price;
                    totalInput.value = total.toFixed(2);
                    calculateGrandTotal();
                };
                
                qtyInput.addEventListener('input', calculateRowTotal);
                priceInput.addEventListener('input', calculateRowTotal);
                
                // Remove row button
                newRow.querySelector('.remove-item').addEventListener('click', function() {
                    newRow.remove();
                    calculateGrandTotal();
                });
                
                calculateRowTotal();
            }
            
            // Function to add a new payment option
            function addPaymentOption(amount = 0, type = 'UPI', note = '') {
                const container = document.getElementById('payment-options-container');
                
                const paymentOption = document.createElement('div');
                paymentOption.className = 'bg-white p-4';
                paymentOption.innerHTML = `
                    <h5 class="text-md font-bold text-gray-800 mb-3">Payment Option ${paymentCounter + 1}</h5>
                    
                    <div class="mb-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Payment Note</label>
                        <textarea name="payments[${paymentCounter}][note]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 payment-note" 
                                  rows="2">${note}</textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                            <input type="number" name="payments[${paymentCounter}][amount]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 payment-amount" 
                                   step="0.01" min="0" value="${amount}" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Payment Type</label>
                            <select name="payments[${paymentCounter}][type]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 payment-type" required>
                                <option value="UPI" ${type === 'UPI' ? 'selected' : ''}>UPI</option>
                                <option value="Cash" ${type === 'Cash' ? 'selected' : ''}>Cash</option>
                                <option value="Credit Card" ${type === 'Credit Card' ? 'selected' : ''}>Credit Card</option>
                                <option value="Bank Transfer" ${type === 'Bank Transfer' ? 'selected' : ''}>Bank Transfer</option>
                            </select>
                        </div>

                        <button type="button" class="self-end px-10 py-3 -translate-y-0.5 w-fit h-fit bg-[#FCCBCC] text-red-500 text-sm font-bold rounded transition-all duration-300 cursor-pointer hover:bg-red-300 hover:text-white remove-payment-option">
                            Remove Option
                        </button>
                    </div>
                `;
                
                container.appendChild(paymentOption);
                paymentCounter++;
                
                // Add event listener to remove button
                paymentOption.querySelector('.remove-payment-option').addEventListener('click', function() {
                    paymentOption.remove();
                    validatePaymentAmounts();
                    renumberPaymentOptions();
                });
                
                // Add event listener to amount input
                paymentOption.querySelector('.payment-amount').addEventListener('input', validatePaymentAmounts);
                
                validatePaymentAmounts();
            }
            
            // Function to renumber payment options after one is removed
            function renumberPaymentOptions() {
                const paymentOptions = document.querySelectorAll('#payment-options-container > div');
                paymentOptions.forEach((option, index) => {
                    option.querySelector('h5').textContent = `Payment Option ${index + 1}`;
                });
            }
            
            // Calculate grand total
            function calculateGrandTotal() {
                let totalQty = 0;
                let grandTotal = 0;
                
                document.querySelectorAll('#expense-items-body tr').forEach(row => {
                    const qty = parseFloat(row.querySelector('.item-qty').value) || 0;
                    const total = parseFloat(row.querySelector('.item-total').value) || 0;
                    
                    totalQty += qty;
                    grandTotal += total;
                });
                
                document.getElementById('total-qty').textContent = totalQty;
                document.getElementById('items-grand-total').textContent = grandTotal.toFixed(2);
                
                // Update the grand total in the form (with round off)
                const roundOff = parseFloat(document.getElementById('round-off').value) || 0;
                const finalTotal = (grandTotal + roundOff).toFixed(2);
                document.getElementById('grand-total').value = finalTotal;
                
                // Update payment amounts if there's only one payment option
                const paymentAmounts = document.querySelectorAll('.payment-amount');
                if (paymentAmounts.length === 1) {
                    paymentAmounts[0].value = finalTotal;
                }
                
                validatePaymentAmounts();
            }
            
            // Validate that payment amounts match the grand total
            function validatePaymentAmounts() {
                const grandTotal = parseFloat(document.getElementById('grand-total').value) || 0;
                let paymentTotal = 0;
                
                document.querySelectorAll('.payment-amount').forEach(input => {
                    paymentTotal += parseFloat(input.value) || 0;
                });
                
                // You can add visual feedback here if needed
                const difference = Math.abs(paymentTotal - grandTotal);
                if (difference > 0.01) { // Allow for small rounding differences
                    console.warn(`Payment total (${paymentTotal}) doesn't match grand total (${grandTotal})`);
                }
            }
        });
    </script>
</body>
</html>