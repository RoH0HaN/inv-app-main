<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

     <!-- Custom Css For Table Start -->
     <link rel="stylesheet" href="/assets/table/css/style.css">
    <!-- Custom Css For Table End -->

    <title>Create Purchase | Fast Forward</title>

    <style>
        .discount-tax-container {
            display: flex;
            gap: 5px;
        }
        .discount-tax-container input, .discount-tax-container select {
            flex: 1;
        }
        .finance-details, .card-details, .exchange-details {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            border: 1px solid #e9ecef;
        }
        .hidden-page {
            display: none;
        }
    </style>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Purchase'],
                ['url' => '/main/purchase/createpurchase', 'text' => 'Create Purchase']
            ]" />

            <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">PURCHASE DETAILS</h3>
                </div>
                
                <form id="purchaseForm" class="space-y-6 py-5">
                    <!-- Purchase Details Section -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5 px-5">
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Date</label>
                            <input type="date" name="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        </div>
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Supplier</label>
                            <select name="supplier" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                <option value="" selected disabled>Select Supplier</option>
                                <option value="John Smith">John Smith</option>
                                <option value="Sarah Johnson">Sarah Johnson</option>
                                <option value="Michael Brown">Michael Brown</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Seller Invoice Number</label>
                            <input type="text" name="seller_invoice_number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        </div>
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Purchase Code</label>
                            <input type="text" name="purchase_code" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        </div>
                        <div></div>
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">TCS</label>
                            <select name="tcs" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                <option value="0">No TCS</option>
                                <option value="0.1">TCS @0.1%</option>
                                <option value="1">TCS @1%</option>
                                <option value="5">TCS @5%</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Purchase Items Section -->
                    <div class="mb-6">
                        <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                            <h3 class="font-semibold text-2xl">ITEMS</h3>
                        </div>
                        
                        <div class="flex flex-col md:flex-row gap-6 my-5 px-5 max-w-7xl">
                            <div class="flex-grow">
                                <input type="text" id="item-search" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm" 
                                    placeholder="Search items...">
                            </div>
                            <div class="w-full md:w-auto">
                                <button type="button" id="search-item" 
                                        class="w-full md:w-auto transition-all duration-300 px-6 py-2 bg-[#CBE6FF] text-[#0084FF] hover:text-white cursor-pointer font-semibold rounded-md hover:bg-[#006eff]">
                                    Search
                                </button>
                            </div>
                        </div>
                        
                        <div class="overflow-x-auto px-5 table-container">
                            <table id="myTable" class="w-full">
                                <thead>
                                    <tr>
                                        <th class="w-24">ACTION</th>
                                        <th class="min-w-44">ITEM</th>
                                        <th>IMEI</th>
                                        <th>BATCH NO.</th>
                                        <th>COLOR</th>
                                        <th>MODEL</th>
                                        <th class="">QTY</th>
                                        <th class="w-28">UNIT</th>
                                        <th class="min-w-[120px]">PRICE/UNIT</th>
                                        <th class="">DISCOUNT</th>
                                        <th class="min-w-44">TAX</th>
                                        <th class="">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody id="purchase-items-body">
                                    <!-- Items will be added here -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="px-6 py-3 font-semibold text-right" style="text-align: right;">Total Quantity</td>
                                        <td id="total-quantity" class="px-6 py-3 text-right">0</td>
                                        <td colspan="4"></td>
                                        <td id="items-subtotal" class="px-6 py-3 text-right">0.00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4 px-5">
                            <div class="col-span-2">
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Purchase Note</label>
                                <textarea name="purchase-note" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="2"></textarea>
                            </div>

                            <div class="border border-gray-400 grid items-center gap-y-1.5 -translate-y-7 h-fit rounded-lg">
                                <div class="grid grid-cols-2 items-center px-2.5 py-1" style="background-color: rgba(0, 0, 0, 0.05);">
                                    <label>Round Off</label>
                                    <span id="round-off-display" class="w-full px-3 py-1 border border-gray-300 rounded-md bg-white">0.00</span>
                                </div>
                                <div class="grid grid-cols-2 items-center px-2.5 py-1">
                                    <label class="">Grand Total</label>
                                    <input name="grand_total" id="grand-total" class="w-full px-3 py-1 border border-gray-300 rounded-md bg-white" 
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
                            <!-- Initial Payment Option (cannot be removed) -->
                            <div class="payment-option bg-white p-4 rounded-lg">
                                <h5 class="text-md font-bold text-gray-800 mb-3">Payment Option 1</h5>
                                
                                <div class="mb-3">
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Note</label>
                                    <textarea name="payments[0][note]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="2"></textarea>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Amount</label>
                                        <input type="number" name="payments[0][amount]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-amount" step="0.01" min="0" value="0.00" required>
                                    </div>
                                    <div>
                                        <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Type</label>
                                        <select name="payments[0][type]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-type" required>
                                            <option value="" disabled selected>Select payment type</option>
                                            <option value="UPI">UPI</option>
                                            <option value="CASH">Cash</option>
                                            <option value="EMI">EMI</option>
                                            <option value="DEBIT_CARD">Debit Card</option>
                                            <option value="CREDIT_CARD">Credit Card</option>
                                            <option value="EXCHANGE">Exchange</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- EMI Details (hidden-page by default) -->
                                <div class="finance-details hidden-page" data-payment-type="EMI">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Finance</label>
                                            <select name="payments[0][finance]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                <option value="" disabled selected>Select Finance</option>
                                                <option value="TVS Finance">TVS Finance</option>
                                                <option value="HBD Finance">HBD Finance</option>
                                                <option value="Bajaj Finance">Bajaj Finance</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Loan ID</label>
                                            <input type="text" name="payments[0][loan_id]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        </div>
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Tenor</label>
                                            <input type="text" name="payments[0][tenor]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        </div>
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Down Payment</label>
                                            <input type="number" name="payments[0][down_payment]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" step="0.01" min="0" value="0.00">
                                        </div>
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">EMI</label>
                                            <input type="number" name="payments[0][emi]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" step="0.01" min="0" value="0.00">
                                        </div>
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Autopay Status</label>
                                            <select name="payments[0][autopay_status]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Debit Card Details (hidden-page by default) -->
                                <div class="card-details hidden-page" data-payment-type="DEBIT_CARD">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Transaction Charge (%)</label>
                                            <input type="number" name="payments[0][transaction_charge]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" step="0.01" min="0" value="0.00">
                                        </div>
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Disbursed Amount</label>
                                            <input type="number" name="payments[0][disbursed_amount]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" step="0.01" min="0" value="0.00">
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Credit Card Details (hidden-page by default) -->
                                <div class="card-details hidden-page" data-payment-type="CREDIT_CARD">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                        <div>
                                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Date</label>
                                            <input type="date" name="payments[0][card_date]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                        </div>
                                    </div>
                                </div>

                                <!-- Exchange Details (hidden-page by default) -->
                                <div class="exchange-details hidden-page" data-payment-type="EXCHANGE">
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
                        </div>
                        
                        <div class="px-4 mt-4">
                            <button type="button" id="add-payment-option" 
                                    class="transition-all duration-300 px-6 py-2 bg-[#CBE6FF] text-[#0084FF] hover:text-white cursor-pointer font-semibold rounded-md hover:bg-[#006eff]">
                                Add Payment Option
                            </button>
                        </div>
                    </div>
                    
                    <div class="space-x-5 mt-6 mx-4">
                        <button type="submit" class="px-8 cursor-pointer py-1.5 bg-[#0084FF] text-white rounded-md hover:bg-[#006aff]">Submit</button>
                        <button type="button" class="close-btn px-8 cursor-pointer py-1.5 bg-[#DFDFDF] text-[#8a8a8a] rounded-md hover:bg-gray-300">Close</button>
                    </div>
                </form>
            </div>
        </section>
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Demo items data
            const demoItems = [
                { id: 1, name: "Sony WG500", price: 78.00, unit: "Ben" },
                { id: 2, name: "Samsung 512", price: 78.00, unit: "Rever" },
                { id: 3, name: "iPhone 13", price: 899.00, unit: "Piece" },
                { id: 4, name: "OnePlus 9 Pro", price: 699.00, unit: "Piece" },
                { id: 5, name: "LG OLED TV", price: 1299.00, unit: "Box" }
            ];
            
            let itemCounter = 0;
            let paymentCounter = 1;
            
            // Search item functionality
            document.getElementById('search-item').addEventListener('click', function() {
                const searchTerm = document.getElementById('item-search').value.trim().toLowerCase();
                if (!searchTerm) {
                    alert('Please enter an item name to search');
                    return;
                }
                
                const foundItem = demoItems.find(item => 
                    item.name.toLowerCase().includes(searchTerm)
                );
                
                if (foundItem) {
                    addItemToTable(foundItem);
                    document.getElementById('item-search').value = '';
                } else {
                    alert('Item not found in inventory');
                }
            });
            
            // Add item to table
            function addItemToTable(item) {
                const tbody = document.getElementById('purchase-items-body');
                const rowId = `item-${itemCounter}`;
                
                const newRow = document.createElement('tr');
                newRow.id = rowId;
                newRow.className = 'bg-white';
                newRow.innerHTML = `
                    <td class="px-2 py-2 text-center">
                        <button type="button" class="remove-item" data-row="${rowId}">
                            <img src="/assets/table/trash.svg" alt="Remove" class="w-6 h-6">
                        </button>
                    </td>
                    <td class="px-2 py-2">
                        <input type="text" name="items[${itemCounter}][name]" class="w-full border-none bg-transparent" value="${item.name}" readonly>
                    </td>
                    <td class="px-2 py-2">
                        <div class="space-y-1">  <!-- Added wrapper div -->
                            <input type="text" name="items[${itemCounter}][imei1]" class="w-full border border-gray-300 bg-white rounded px-2 py-1" placeholder="IMEI 1" required>
                            <input type="text" name="items[${itemCounter}][imei2]" class="w-full border border-gray-300 bg-white rounded px-2 py-1" placeholder="IMEI 2">
                        </div>
                    </td>
                    <td class="px-2 py-2">
                        <input type="text" name="items[${itemCounter}][batch_no]" class="w-full border border-gray-300 bg-white rounded px-2 py-1">
                    </td>
                    <td class="px-2 py-2">
                        <input type="text" name="items[${itemCounter}][color]" class="w-full border border-gray-300 bg-white rounded px-2 py-1">
                    </td>
                    <td class="px-2 py-2">
                        <input type="text" name="items[${itemCounter}][model]" class="w-full border border-gray-300 bg-white rounded px-2 py-1">
                    </td>
                    <td class="px-2 py-2">
                        <input type="number" name="items[${itemCounter}][quantity]" class="w-full border border-gray-300 bg-white rounded px-2 py-1 item-qty" value="1" min="1">
                    </td>
                    <td class="px-2 py-2">
                        <select name="items[${itemCounter}][unit]" class="w-full border border-gray-300 bg-white rounded px-2 py-1">
                            <option value="${item.unit}">${item.unit}</option>
                            <option value="Piece">Piece</option>
                            <option value="Box">Box</option>
                        </select>
                    </td>
                    <td class="px-2 py-2">
                        <input type="number" name="items[${itemCounter}][price]" class="w-full border border-gray-300 bg-white rounded px-2 py-1 item-price" value="${item.price}" step="0.01" min="0">
                    </td>
                    <td class="px-2 py-2">
                        <div class="discount-tax-container flex">
                            <div class="flex items-center">
                                <input type="text" name="items[${itemCounter}][discount]" class="max-w-16 border border-gray-300 bg-white rounded-l px-2 py-1 item-discount" value="0" step="0.01" min="0">
                                <span class="px-2 h-full flex items-center bg-[#858585] text-white font-bold rounded-r">%</span>
                            </div>
                            <input type="text" disabled class="w-full text-center rounded px-2 py-1 border-none bg-transparent item-discount-amount" value="0.00" readonly>
                        </div>
                    </td>
                    <td class="px-2 py-2">
                        <div class="discount-tax-container">
                            <select name="items[${itemCounter}][tax_rate]" class="w-24 border border-gray-300 bg-white rounded px-2 py-1 item-tax-rate">
                                <option value="0">GST@0%</option>
                                <option value="0.1">GST@0.1%</option>
                                <option value="5">GST@5%</option>
                                <option value="12">GST@12%</option>
                                <option value="18">GST@18%</option>
                                <option value="28">GST@28%</option>
                            </select>
                            <input type="text" disabled class="w-full text-center rounded px-2 py-1 border-none bg-transparent item-tax-amount" value="0.00" readonly>
                        </div>
                    </td>
                    <td class="px-2 py-2">
                        <input type="text" disabled name="items[${itemCounter}][total]" class="w-full border-none bg-transparent text-center item-total" value="${item.price}" readonly>
                    </td>
                `;
                
                tbody.appendChild(newRow);
                itemCounter++;
                
                // Add event listeners to the new row
                const qtyInput = newRow.querySelector('.item-qty');
                const priceInput = newRow.querySelector('.item-price');
                const discountInput = newRow.querySelector('.item-discount');
                const taxRateSelect = newRow.querySelector('.item-tax-rate');
                
                const calculateRowTotal = () => {
                    const qty = parseFloat(qtyInput.value) || 0;
                    const price = parseFloat(priceInput.value) || 0;
                    const discountRate = parseFloat(discountInput.value) || 0;
                    const taxRate = parseFloat(taxRateSelect.value) || 0;
                    
                    const subtotal = qty * price;
                    const discountAmount = subtotal * (discountRate / 100);
                    const taxableAmount = subtotal - discountAmount;
                    const taxAmount = taxableAmount * (taxRate / 100);
                    const total = taxableAmount + taxAmount;
                    
                    // Update calculated fields
                    newRow.querySelector('.item-discount-amount').value = discountAmount.toFixed(2);
                    newRow.querySelector('.item-tax-amount').value = taxAmount.toFixed(2);
                    newRow.querySelector('.item-total').value = total.toFixed(2);
                    
                    // Update totals
                    calculateTotals();
                };
                
                qtyInput.addEventListener('input', calculateRowTotal);
                priceInput.addEventListener('input', calculateRowTotal);
                discountInput.addEventListener('input', calculateRowTotal);
                taxRateSelect.addEventListener('change', calculateRowTotal);
                
                // Remove row button
                newRow.querySelector('.remove-item').addEventListener('click', function() {
                    if (confirm('Remove this item?')) {
                        document.getElementById(this.dataset.row).remove();
                        calculateTotals();
                    }
                });
                
                // Initial calculation
                calculateRowTotal();
            }
            
            // Calculate all totals
            function calculateTotals() {
                let subtotal = 0;
                let totalDiscount = 0;
                let totalTax = 0;
                let totalQuantity = 0;
                
                document.querySelectorAll('#purchase-items-body tr').forEach(row => {
                    subtotal += parseFloat(row.querySelector('.item-total').value) || 0;
                    totalDiscount += parseFloat(row.querySelector('.item-discount-amount').value) || 0;
                    totalTax += parseFloat(row.querySelector('.item-tax-amount').value) || 0;
                    totalQuantity += parseInt(row.querySelector('.item-qty').value) || 0;
                });
                
                // Calculate round off and grand total
                const roundedTotal = Math.round(subtotal);
                const roundOff = roundedTotal - subtotal;
                
                // Update totals
                document.getElementById('total-quantity').textContent = totalQuantity;
                document.getElementById('items-subtotal').textContent = subtotal.toFixed(2);
                
                // Update round off and grand total in the display div
                document.getElementById('round-off-display').textContent = roundOff.toFixed(2);
                document.getElementById('grand-total').value = roundedTotal.toFixed(2);
                
                // Update first payment amount to match grand total if it's the only payment
                const paymentAmounts = document.querySelectorAll('.payment-amount');
                if (paymentAmounts.length === 1) {
                    paymentAmounts[0].value = roundedTotal.toFixed(2);
                }
            }
            
            // Add payment option
            document.getElementById('add-payment-option').addEventListener('click', function() {
                const container = document.getElementById('payment-options-container');
                
                const paymentOption = document.createElement('div');
                paymentOption.className = 'payment-option bg-white p-4 rounded-lg';
                paymentOption.innerHTML = `
                    <h5 class="text-md font-bold text-gray-800 mb-3">Payment Option ${paymentCounter + 1}</h5>
                    
                    <div class="mb-3">
                        <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Note</label>
                        <textarea name="payments[${paymentCounter}][note]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="2"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Amount</label>
                            <input type="number" name="payments[${paymentCounter}][amount]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-amount" step="0.01" min="0" value="0.00" required>
                        </div>
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Payment Type</label>
                            <select name="payments[${paymentCounter}][type]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 payment-type" required>
                                <option value="">Select payment type</option>
                                <option value="UPI">UPI</option>
                                <option value="CASH">Cash</option>
                                <option value="EMI">EMI</option>
                                <option value="DEBIT_CARD">Debit Card</option>
                                <option value="CREDIT_CARD">Credit Card</option>
                                <option value="EXCHANGE">Exchange</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- EMI Details (hidden-page by default) -->
                    <div class="finance-details hidden-page" data-payment-type="EMI">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Finance</label>
                                <select name="payments[${paymentCounter}][finance]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    <option value="">Select Finance</option>
                                    <option value="TVS Finance">TVS Finance</option>
                                    <option value="HBD Finance">HBD Finance</option>
                                    <option value="Bajaj Finance">Bajaj Finance</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Loan ID</label>
                                <input type="text" name="payments[${paymentCounter}][loan_id]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            </div>
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Tenor</label>
                                <input type="text" name="payments[${paymentCounter}][tenor]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            </div>
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Down Payment</label>
                                <input type="number" name="payments[${paymentCounter}][down_payment]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" step="0.01" min="0" value="0.00">
                            </div>
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">EMI</label>
                                <input type="number" name="payments[${paymentCounter}][emi]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" step="0.01" min="0" value="0.00">
                            </div>
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Autopay Status</label>
                                <select name="payments[${paymentCounter}][autopay_status]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Debit Card Details (hidden-page by default) -->
                    <div class="card-details hidden-page" data-payment-type="DEBIT_CARD">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Transaction Charge (%)</label>
                                <input type="number" name="payments[${paymentCounter}][transaction_charge]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" step="0.01" min="0" value="0.00">
                            </div>
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Disbursed Amount</label>
                                <input type="number" name="payments[${paymentCounter}][disbursed_amount]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" step="0.01" min="0" value="0.00">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Credit Card Details (hidden-page by default) -->
                    <div class="card-details hidden-page" data-payment-type="CREDIT_CARD">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Date</label>
                                <input type="date" name="payments[${paymentCounter}][card_date]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            </div>
                        </div>
                    </div>

                    <!-- Exchange Details (hidden-page by default) -->
                    <div class="exchange-details hidden-page" data-payment-type="EXCHANGE">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Product Name</label>
                                <input type="text" name="payments[${paymentCounter}][exchange_product]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            </div>
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">IMEI/Serial Number</label>
                                <input type="text" name="payments[${paymentCounter}][exchange_imei]" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                            </div>
                        </div>
                    </div>
                    
                    <button type="button" class="mt-3 px-4 py-2 bg-red-100 text-red-600 rounded hover:bg-red-200 remove-payment">
                        Remove Option
                    </button>
                `;
                
                container.appendChild(paymentOption);
                
                // Add event listeners to the new payment option
                const typeSelect = paymentOption.querySelector('.payment-type');
                const removeBtn = paymentOption.querySelector('.remove-payment');
                
                typeSelect.addEventListener('change', function() {
                    // Hide all details sections first
                    paymentOption.querySelectorAll('.finance-details, .card-details, .exchange-details').forEach(el => {
                        el.classList.add('hidden-page');
                    });
                    
                    // Show the selected one
                    const selectedType = this.value;
                    if (selectedType) {
                        const detailsSection = paymentOption.querySelector(`[data-payment-type="${selectedType}"]`);
                        if (detailsSection) {
                            detailsSection.classList.remove('hidden-page');
                        }
                    }
                });
                
                removeBtn.addEventListener('click', function() {
                    if (confirm('Remove this payment option?')) {
                        paymentOption.remove();
                        renumberPaymentOptions();
                    }
                });
                
                paymentCounter++;
            });
            
            // Renumber payment options when one is removed
            function renumberPaymentOptions() {
                const paymentOptions = document.querySelectorAll('.payment-option');
                paymentCounter = 0;
                
                paymentOptions.forEach((option, index) => {
                    paymentCounter++;
                    option.querySelector('h5').textContent = `Payment Option ${paymentCounter}`;
                    
                    // Update all input names to maintain proper indexing
                    const inputs = option.querySelectorAll('[name^="payments["]');
                    inputs.forEach(input => {
                        const name = input.name.replace(/payments\[\d+\]/, `payments[${index}]`);
                        input.name = name;
                    });
                });
            }
            
            // Handle payment type changes for existing payment options
            document.addEventListener('change', function(e) {
                if (e.target.classList.contains('payment-type')) {
                    const paymentOption = e.target.closest('.payment-option');
                    
                    // Hide all details sections first
                    paymentOption.querySelectorAll('.finance-details, .card-details, .exchange-details').forEach(el => {
                        el.classList.add('hidden-page');
                    });
                    
                    // Show the selected one
                    const selectedType = e.target.value;
                    if (selectedType) {
                        const detailsSection = paymentOption.querySelector(`[data-payment-type="${selectedType}"]`);
                        if (detailsSection) {
                            detailsSection.classList.remove('hidden-page');
                        }
                    }
                }
            });
            
            // Close button
            document.querySelector('.close-btn').addEventListener('click', function() {
                if (confirm('Close without saving?')) {
                    alert('Form closed (demo)');
                }
            });
            
            // Form submission
            document.getElementById('purchaseForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Collect form data
                const formData = new FormData(this);
                const data = {
                    date: formData.get('date'),
                    supplier: formData.get('supplier'),
                    seller_invoice_number: formData.get('seller_invoice_number'),
                    purchase_code: formData.get('purchase_code'),
                    tcs: formData.get('tcs'),
                    purchase_note: formData.get('purchase-note'),
                    round_off: document.getElementById('round-off-display').textContent,
                    grand_total: document.getElementById('grand-total').value,
                    items: [],
                    payments: []
                };
                
                // Collect items
                document.querySelectorAll('#purchase-items-body tr').forEach((row, index) => {
                    data.items.push({
                        name: row.querySelector('[name$="[name]"]').value,
                        imei1: row.querySelector('[name$="[imei1]"]').value,
                        imei2: row.querySelector('[name$="[imei2]"]').value,
                        batch_no: row.querySelector('[name$="[batch_no]"]').value,
                        color: row.querySelector('[name$="[color]"]').value,
                        model: row.querySelector('[name$="[model]"]').value,
                        quantity: row.querySelector('[name$="[quantity]"]').value,
                        unit: row.querySelector('[name$="[unit]"]').value,
                        price: row.querySelector('[name$="[price]"]').value,
                        discount: row.querySelector('[name$="[discount]"]').value,
                        discount_amount: row.querySelector('.item-discount-amount').value,
                        tax_rate: row.querySelector('[name$="[tax_rate]"]').value,
                        tax_amount: row.querySelector('.item-tax-amount').value,
                        total: row.querySelector('[name$="[total]"]').value
                    });
                });
                
                // Collect payments
                document.querySelectorAll('.payment-option').forEach((option, index) => {
                    const payment = {
                        note: option.querySelector('[name$="[note]"]').value,
                        amount: option.querySelector('[name$="[amount]"]').value,
                        type: option.querySelector('[name$="[type]"]').value
                    };
                    
                    // Add EMI details if present
                    const emiDetails = option.querySelector('[data-payment-type="EMI"]');
                    if (emiDetails && !emiDetails.classList.contains('hidden-page')) {
                        payment.finance = emiDetails.querySelector('[name$="[finance]"]').value;
                        payment.loan_id = emiDetails.querySelector('[name$="[loan_id]"]').value;
                        payment.tenor = emiDetails.querySelector('[name$="[tenor]"]').value;
                        payment.down_payment = emiDetails.querySelector('[name$="[down_payment]"]').value;
                        payment.emi = emiDetails.querySelector('[name$="[emi]"]').value;
                        payment.autopay_status = emiDetails.querySelector('[name$="[autopay_status]"]').value;
                    }
                    
                    // Add Debit Card details if present
                    const debitDetails = option.querySelector('[data-payment-type="DEBIT_CARD"]');
                    if (debitDetails && !debitDetails.classList.contains('hidden-page')) {
                        payment.transaction_charge = debitDetails.querySelector('[name$="[transaction_charge]"]').value;
                        payment.disbursed_amount = debitDetails.querySelector('[name$="[disbursed_amount]"]').value;
                    }
                    
                    // Add Credit Card details if present
                    const creditDetails = option.querySelector('[data-payment-type="CREDIT_CARD"]');
                    if (creditDetails && !creditDetails.classList.contains('hidden-page')) {
                        payment.card_date = creditDetails.querySelector('[name$="[card_date]"]').value;
                    }

                    // Add Exchange details if present
                    const exchangeDetails = option.querySelector('[data-payment-type="EXCHANGE"]');
                    if (exchangeDetails && !exchangeDetails.classList.contains('hidden-page')) {
                        payment.exchange_product = exchangeDetails.querySelector('[name$="[exchange_product]"]').value;
                        payment.exchange_imei = exchangeDetails.querySelector('[name$="[exchange_imei]"]').value;
                    }
                    
                    data.payments.push(payment);
                });
                
                console.log('Complete Form Data:', data);
                alert('Form submitted! Check console for complete data.');
            });
        });
    </script>
</body>
</html>