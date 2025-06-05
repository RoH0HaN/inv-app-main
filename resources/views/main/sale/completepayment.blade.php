<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

    <title>Complete Payment | Fast Forward</title>

    <style>
        .payment-option {
            margin-bottom: 15px;
            padding: 15px;
        }
        .hidden-section {
            display: none;
        }
        .payment-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }
        .remove-payment {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
        }
        .add-payment-btn {
            background-color: #dbeafe;
            color: #1d4ed8;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
    </style>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Sale'],
                ['url' => '/main/sale/invoices', 'text' => 'Invoices'],
                ['url' => '/main/sale/completepayment', 'text' => 'Complete Payment']
            ]" />
        </section>

        <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
            <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                <h3 class="font-semibold text-2xl">INVOICE DETAILS</h3>
            </div>
            <div class="py-5">
                <form id="paymentForm" action="#" class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-5 px-5">
                        <!-- Invoice Fields -->
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Invoice Number</label>
                            <input type="text" name="invoice_number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" readonly>
                        </div>
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Sale Code</label>
                            <input type="text" name="sale_code" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" readonly>
                        </div>
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Date</label>
                            <input type="date" name="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        </div>
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Customer</label>
                            <select name="customer" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                <option value="" selected disabled>Select Customer</option>
                                <option value="John Doe">John Doe</option>
                                <option value="Jane Smith">Jane Smith</option>
                                <option value="Michael Johnson">Michael Johnson</option>
                                <option value="Sarah Williams">Sarah Williams</option>
                            </select>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="pt-4">
                        <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                            <h3 class="font-semibold text-2xl">PAYMENTS</h3>
                        </div>
                        <div id="payment-options-container" class="space-y-4">
                            <!-- Payment Option 1 -->
                            <div class="payment-option">
                                <div class="payment-header">
                                    <h4 class="font-semibold text-lg">Payment Option 1</h4>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Note</label>
                                    <textarea name="payments[0][note]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="2">Good sale from Tim Watson</textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Amount</label>
                                        <input type="number" name="payments[0][amount]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-amount" step="0.01" min="0" value="20.00" required>
                                    </div>
                                    <div>
                                        <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Type</label>
                                        <select name="payments[0][type]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-type" required>
                                            <option value="CASH" selected>Cash</option>
                                            <option value="UPI">UPI</option>
                                            <option value="CREDIT_CARD">Credit Card</option>
                                            <option value="DEBIT_CARD">Debit Card</option>
                                            <option value="BANK_TRANSFER">Bank Transfer</option>
                                            <option value="EXCHANGE">Exchange</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- Credit Card Details (hidden by default) -->
                                <div class="hidden-section" data-payment-type="CREDIT_CARD">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Card Number</label>
                                            <input type="text" name="payments[0][card_number]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        </div>
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Expiry Date</label>
                                            <input type="month" name="payments[0][expiry_date]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Exchange Details (hidden by default) -->
                                <div class="hidden-section" data-payment-type="EXCHANGE">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Product Name</label>
                                            <input type="text" name="payments[0][exchange_product]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        </div>
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">IMEI/Serial Number</label>
                                            <input type="text" name="payments[0][exchange_imei]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Payment Option 2 -->
                            <div class="payment-option">
                                <div class="payment-header">
                                    <h4 class="font-semibold text-lg">Payment Option 2</h4>
                                    <button type="button" class="remove-payment">Remove</button>
                                </div>
                                <div class="mb-3">
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Note</label>
                                    <textarea name="payments[1][note]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="2"></textarea>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Amount</label>
                                        <input type="number" name="payments[1][amount]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-amount" step="0.01" min="0" value="20.00" required>
                                    </div>
                                    <div>
                                        <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Type</label>
                                        <select name="payments[1][type]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-type" required>
                                            <option value="UPI" selected>UPI</option>
                                            <option value="CASH">Cash</option>
                                            <option value="CREDIT_CARD">Credit Card</option>
                                            <option value="DEBIT_CARD">Debit Card</option>
                                            <option value="BANK_TRANSFER">Bank Transfer</option>
                                            <option value="EXCHANGE">Exchange</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- UPI Details (hidden by default) -->
                                <div class="hidden-section" data-payment-type="UPI">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">UPI ID</label>
                                            <input type="text" name="payments[1][upi_id]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Exchange Details (hidden by default) -->
                                <div class="hidden-section" data-payment-type="EXCHANGE">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Product Name</label>
                                            <input type="text" name="payments[1][exchange_product]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        </div>
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">IMEI/Serial Number</label>
                                            <input type="text" name="payments[1][exchange_imei]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="px-5">
                            <button type="button" id="add-payment" class="add-payment-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                                Add Payment Option
                            </button>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-10 px-5 flex gap-5">
                        <button type="submit" class="w-fit bg-indigo-600 text-white py-2 px-12 rounded-md hover:bg-indigo-700 transition cursor-pointer">
                            Submit
                        </button>
                        <button type="button" class="py-2 px-12 w-fit inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-2xs hover:bg-gray-50 focus:outline-hidden focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 cursor-pointer">
                            <a href="{{ route('contacts.customers') }}">Close</a>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let paymentCounter = 1;
                
                // Handle payment type changes
                document.addEventListener('change', function(e) {
                    if (e.target.classList.contains('payment-type')) {
                        const paymentOption = e.target.closest('.payment-option');
                        
                        // Hide all payment details sections
                        paymentOption.querySelectorAll('[data-payment-type]').forEach(section => {
                            section.classList.add('hidden-section');
                        });
                        
                        // Show the selected payment details section
                        const selectedType = e.target.value;
                        const detailsSection = paymentOption.querySelector(`[data-payment-type="${selectedType}"]`);
                        if (detailsSection) {
                            detailsSection.classList.remove('hidden-section');
                        }
                    }
                });
                
                // Add new payment option
                document.getElementById('add-payment').addEventListener('click', function() {
                    paymentCounter++;
                    const container = document.getElementById('payment-options-container');
                    
                    const paymentOption = document.createElement('div');
                    paymentOption.className = 'payment-option';
                    paymentOption.innerHTML = `
                        <div class="payment-header">
                            <h4 class="font-semibold text-lg">Payment Option ${paymentCounter}</h4>
                            <button type="button" class="remove-payment">Remove</button>
                        </div>
                        <div class="mb-3">
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Note</label>
                            <textarea name="payments[${paymentCounter-1}][note]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="2"></textarea>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Amount</label>
                                <input type="number" name="payments[${paymentCounter-1}][amount]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-amount" step="0.01" min="0" value="0.00" required>
                            </div>
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Type</label>
                                <select name="payments[${paymentCounter-1}][type]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-type" required>
                                    <option value="">Select payment type</option>
                                    <option value="CASH">Cash</option>
                                    <option value="UPI">UPI</option>
                                    <option value="CREDIT_CARD">Credit Card</option>
                                    <option value="DEBIT_CARD">Debit Card</option>
                                    <option value="BANK_TRANSFER">Bank Transfer</option>
                                    <option value="EXCHANGE">Exchange</option>
                                </select>
                            </div>
                        </div>
                        
                        <!-- Credit Card Details (hidden by default) -->
                        <div class="hidden-section" data-payment-type="CREDIT_CARD">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Card Number</label>
                                    <input type="text" name="payments[${paymentCounter-1}][card_number]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                </div>
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Expiry Date</label>
                                    <input type="month" name="payments[${paymentCounter-1}][expiry_date]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                </div>
                            </div>
                        </div>
                        
                        <!-- UPI Details (hidden by default) -->
                        <div class="hidden-section" data-payment-type="UPI">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">UPI ID</label>
                                    <input type="text" name="payments[${paymentCounter-1}][upi_id]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Bank Transfer Details (hidden by default) -->
                        <div class="hidden-section" data-payment-type="BANK_TRANSFER">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Account Number</label>
                                    <input type="text" name="payments[${paymentCounter-1}][account_number]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                </div>
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">IFSC Code</label>
                                    <input type="text" name="payments[${paymentCounter-1}][ifsc_code]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                </div>
                            </div>
                        </div>
                        
                        <!-- Exchange Details (hidden by default) -->
                        <div class="hidden-section" data-payment-type="EXCHANGE">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Product Name</label>
                                    <input type="text" name="payments[${paymentCounter-1}][exchange_product]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                </div>
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">IMEI/Serial Number</label>
                                    <input type="text" name="payments[${paymentCounter-1}][exchange_imei]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                </div>
                            </div>
                        </div>
                    `;
                    
                    container.appendChild(paymentOption);
                    
                    // Add event listener to the remove button
                    paymentOption.querySelector('.remove-payment').addEventListener('click', function() {
                        if (confirm('Are you sure you want to remove this payment option?')) {
                            paymentOption.remove();
                            renumberPaymentOptions();
                        }
                    });
                });
                
                // Remove payment option
                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-payment')) {
                        if (confirm('Are you sure you want to remove this payment option?')) {
                            e.target.closest('.payment-option').remove();
                            renumberPaymentOptions();
                        }
                    }
                });
                
                // Renumber payment options when one is removed
                function renumberPaymentOptions() {
                    const paymentOptions = document.querySelectorAll('.payment-option');
                    paymentOptions.forEach((option, index) => {
                        option.querySelector('h4').textContent = `Payment Option ${index + 1}`;
                        
                        // Update all input names to maintain proper indexing
                        const inputs = option.querySelectorAll('[name^="payments["]');
                        inputs.forEach(input => {
                            const name = input.name.replace(/payments\[\d+\]/, `payments[${index}]`);
                            input.name = name;
                        });
                    });
                }
                
                // Form submission
                document.getElementById('paymentForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    // Collect form data
                    const formData = new FormData(this);
                    const data = {
                        invoice_number: formData.get('invoice_number'),
                        sale_code: formData.get('sale_code'),
                        date: formData.get('date'),
                        customer: formData.get('customer'),
                        payments: []
                    };
                    
                    // Collect payment data
                    document.querySelectorAll('.payment-option').forEach((option, index) => {
                        const payment = {
                            note: option.querySelector('[name$="[note]"]').value,
                            amount: option.querySelector('[name$="[amount]"]').value,
                            type: option.querySelector('[name$="[type]"]').value
                        };
                        
                        // Add payment-specific details
                        const paymentType = payment.type;
                        const detailsSection = option.querySelector(`[data-payment-type="${paymentType}"]`);
                        
                        if (detailsSection && !detailsSection.classList.contains('hidden-section')) {
                            if (paymentType === 'CREDIT_CARD') {
                                payment.card_number = detailsSection.querySelector('[name$="[card_number]"]').value;
                                payment.expiry_date = detailsSection.querySelector('[name$="[expiry_date]"]').value;
                            } else if (paymentType === 'UPI') {
                                payment.upi_id = detailsSection.querySelector('[name$="[upi_id]"]').value;
                            } else if (paymentType === 'BANK_TRANSFER') {
                                payment.account_number = detailsSection.querySelector('[name$="[account_number]"]').value;
                                payment.ifsc_code = detailsSection.querySelector('[name$="[ifsc_code]"]').value;
                            } else if (paymentType === 'EXCHANGE') {
                                payment.exchange_product = detailsSection.querySelector('[name$="[exchange_product]"]').value;
                                payment.exchange_imei = detailsSection.querySelector('[name$="[exchange_imei]"]').value;
                            }
                        }
                        
                        data.payments.push(payment);
                    });
                    
                    console.log('Form submission data:', data);
                    alert('Form submitted! Check console for complete data.');
                });
            });
        </script>
    @endsection
</body>
</html>