<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Organization Target | Fast Forward</title>

    <style>
        .input-with-dropdown {
            position: relative;
        }
        .input-with-dropdown select {
            position: absolute;
            right: 0;
            top: 0;
            height: 100%;
            width: 100px;
            border-left: 1px solid #ddd;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }
        .input-with-dropdown input {
            padding-right: 105px;
        }
    </style>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Target'],
                ['url' => '/target/organization-target', 'text' => 'Organization Target List'],
                ['url' => '/target/create-organization-target', 'text' => 'Create Target']
            ]" />
        </section>

        <div class="shadow-md rounded-lg bg-white dark:bg-gray-800">
            <div class="flex justify-between border-b border-gray-200 px-5 py-3">
                <h3 class="font-semibold text-2xl">TARGET DETAILS</h3>
            </div>
            <div class="py-5">
                <form id="targetForm" class="space-y-6">
                    <!-- Target Details Section -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 px-5">
                        <div>
                            <label class="block font-semibold mb-2 text-gray-500 dark:text-gray-300">Brand</label>
                            <select name="brand" class="w-full p-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700" required>
                                <option value="" selected disabled>Select Brand</option>
                                <option value="Samsung">Samsung</option>
                                <option value="Apple">Apple</option>
                                <option value="OnePlus">OnePlus</option>
                                <option value="Xiaomi">Xiaomi</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-semibold mb-2 text-gray-500 dark:text-gray-300">Month</label>
                            <input type="number" name="month" min="1" max="12" class="w-full p-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700" required>
                        </div>
                        <div>
                            <label class="block font-semibold mb-2 text-gray-500 dark:text-gray-300">Year</label>
                            <input type="number" name="year" min="2000" max="2100" class="w-full p-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700" required>
                        </div>
                    </div>

                    <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                        <h3 class="font-semibold text-2xl">TARGET AMOUNTS</h3>
                    </div>

                    <!-- Value Wise Target Section -->
                    <div class="px-5">
                        <h5 class="text-md font-bold text-gray-800 mb-3">VALUE WISE TARGET</h5>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div>
                                <label class="block font-semibold mb-2 text-gray-500 dark:text-gray-300">Target Value</label>
                                <input type="number" name="value_target_amount" class="w-full p-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700" step="0.01" min="0" required>
                            </div>
                            <div>
                                <label class="block font-semibold mb-2 text-gray-500 dark:text-gray-300">Payout Percentage</label>
                                <input type="number" name="value_payout_percentage" class="w-full p-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700" step="0.01" min="0" required>
                            </div>
                            <div>
                                <label class="block font-semibold mb-2 text-gray-500 dark:text-gray-300">Total Payout</label>
                                <input type="number" name="value_total_payout" class="w-full p-3 border border-gray-300 rounded-lg focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700" step="0.01" min="0" readonly>
                            </div>
                        </div>
                    </div>

                    <!-- Product Wise Target Container -->
                    <div id="product-target-container"></div>

                    <!-- Add Product Target Button -->
                    <button type="button" id="add-product-target" class="flex items-center mx-5 w-full mt-5 md:w-auto transition-all duration-300 px-6 py-2 bg-[#CBE6FF] text-[#0084FF] hover:text-white cursor-pointer font-semibold rounded-md hover:bg-[#006eff]">
                        Add Row
                    </button>

                    <!-- Additional Payout Options Container -->
                    <div id="additional-payout-container"></div>

                    <!-- Add Additional Payout Button -->
                    <button type="button" id="add-additional-payout" class="text-center w-fit mx-5 px-5 py-3 bg-[#CCFCCB] border border-transparent rounded-md text-sm font-bold text-[#03AD00] cursor-pointer tracking-widest hover:bg-[#d5fccb] disabled:opacity-25 transition-all duration-300">
                        Add Additional Payout Option
                    </button>

                    <!-- Submit Button -->
                    <div class="pt-10 flex gap-5 mx-5">
                        <button type="submit" class="bg-indigo-600 text-white py-2 px-12 rounded-md hover:bg-indigo-700 transition">
                            Submit
                        </button>
                        <button type="button" class="py-2 px-12 border border-gray-200 bg-white text-gray-800 rounded-lg hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700">
                            Close
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let productTargetCounter = 0;
                let productTargetSectionExists = false;
                let additionalPayoutCount = 0; // Tracks total added (not current count)
                
                // Calculate Value Wise Total Payout
                function calculateValuePayout() {
                    const targetValue = parseFloat(document.querySelector('[name="value_target_amount"]').value) || 0;
                    const payoutPercentage = parseFloat(document.querySelector('[name="value_payout_percentage"]').value) || 0;
                    const totalPayout = (targetValue * payoutPercentage) / 100;
                    document.querySelector('[name="value_total_payout"]').value = totalPayout.toFixed(2);
                }
                
                document.querySelector('[name="value_target_amount"]').addEventListener('input', calculateValuePayout);
                document.querySelector('[name="value_payout_percentage"]').addEventListener('input', calculateValuePayout);
                
                // Add Product Wise Target
                document.getElementById('add-product-target').addEventListener('click', function() {
                    productTargetCounter++;
                    const container = document.getElementById('product-target-container');
                    
                    if (!productTargetSectionExists) {
                        const productTargetSection = document.createElement('div');
                        productTargetSection.className = 'px-5';
                        productTargetSection.innerHTML = `
                            <h5 class="text-md font-bold text-gray-800 mb-3">PRODUCT WISE TARGET</h5>
                            <div id="product-target-rows" class="space-y-4"></div>
                        `;
                        container.appendChild(productTargetSection);
                        productTargetSectionExists = true;
                    }
                    
                    const rowsContainer = document.getElementById('product-target-rows');
                    const rowId = `product-target-row-${productTargetCounter}`;
                    
                    const row = document.createElement('div');
                    row.className = 'grid grid-cols-1 md:grid-cols-4 gap-6 items-end';
                    row.id = rowId;
                    row.innerHTML = `
                        <div>
                            <input type="text" name="product_target[${productTargetCounter}][product]" class="w-full p-3 border border-gray-300 rounded-lg" required>
                        </div>
                        <div>
                            <div class="input-with-dropdown">
                                <input type="number" name="product_target[${productTargetCounter}][target_condition_value]" class="w-full p-3 border border-gray-300 rounded-lg" required>
                                <select name="product_target[${productTargetCounter}][target_condition_type]" class="p-3 border border-gray-300 rounded-lg">
                                    <option value="Unit">Unit</option>
                                    <option value="Amount">Amount</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <div class="input-with-dropdown">
                                <input type="number" name="product_target[${productTargetCounter}][target_bonus_value]" class="w-full p-3 border border-gray-300 rounded-lg" required>
                                <select name="product_target[${productTargetCounter}][target_bonus_type]" class="p-3 border border-gray-300 rounded-lg">
                                    <option value="Amount">Amount</option>
                                    <option value="Percentage">Percentage</option>
                                </select>
                            </div>
                        </div>
                        <div class="flex items-end gap-6">
                            <div class="flex-grow">
                                <input type="number" name="product_target[${productTargetCounter}][total_payout]" class="w-full p-3 border border-gray-300 rounded-lg" readonly>
                            </div>
                            <button type="button" class="bg-red-100 text-red-700 px-5 py-3 rounded-lg remove-product-row" data-row="${rowId}">
                                <img src="/assets/target/minus-square.svg" class="w-6 h-6">
                            </button>
                        </div>
                    `;
                    
                    rowsContainer.appendChild(row);
                    
                    row.querySelector('.remove-product-row').addEventListener('click', function() {
                        if (confirm('Are you sure you want to remove this product target?')) {
                            document.getElementById(this.dataset.row).remove();
                            if (rowsContainer.querySelectorAll('div.grid').length === 0) {
                                container.querySelector('.px-5').remove();
                                productTargetSectionExists = false;
                            }
                        }
                    });
                });
                
                // Additional Payout Options - MAIN FIXED PART
                const additionalPayoutContainer = document.getElementById('additional-payout-container');
                
                function updatePayoutNumbers() {
                    const options = additionalPayoutContainer.querySelectorAll('[id^="additional-payout-"]');
                    
                    options.forEach((option, index) => {
                        const newNumber = index + 1;
                        const oldNumber = option.id.split('-')[2];
                        
                        if (newNumber.toString() !== oldNumber) {
                            // Update IDs and displayed numbers
                            option.id = `additional-payout-${newNumber}`;
                            option.querySelector('h3').textContent = `ADDITIONAL PAYOUT OPTION ${newNumber}`;
                            
                            // Update data attributes
                            const removeBtn = option.querySelector('.remove-payout-option');
                            const addRowBtn = option.querySelector('.add-payout-row');
                            removeBtn.dataset.payout = newNumber;
                            addRowBtn.dataset.payout = newNumber;
                            
                            // Update all input names
                            const inputs = option.querySelectorAll('input, select');
                            inputs.forEach(input => {
                                input.name = input.name.replace(
                                    /additional_payout\[\d+\]/g, 
                                    `additional_payout[${newNumber}]`
                                );
                            });
                            
                            // Update rows container ID
                            const rowsContainer = option.querySelector('[id^="additional-payout-rows-"]');
                            if (rowsContainer) {
                                rowsContainer.id = `additional-payout-rows-${newNumber}`;
                            }
                        }
                    });
                }
                
                document.getElementById('add-additional-payout').addEventListener('click', function() {
                    additionalPayoutCount++;
                    const newNumber = additionalPayoutCount;
                    
                    const payoutOption = document.createElement('div');
                    payoutOption.className = 'px-5 mb-4';
                    payoutOption.id = `additional-payout-${newNumber}`;
                    payoutOption.innerHTML = `
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-md font-bold text-gray-800 mb-3">ADDITIONAL PAYOUT OPTION ${newNumber}</h3>
                            <button type="button" class="bg-[#FCCBCC] text-[#CA0306] px-8 py-2 rounded-md text-sm remove-payout-option" data-payout="${newNumber}">Remove Option</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-4">
                            <div>
                                <input type="text" name="additional_payout[${newNumber}][name]" class="w-full p-3 border border-gray-300 rounded-lg" required>
                            </div>
                            <div>
                                <input type="date" name="additional_payout[${newNumber}][from_date]" class="w-full p-3 border border-gray-300 rounded-lg" required>
                            </div>
                            <div>
                                <input type="date" name="additional_payout[${newNumber}][to_date]" class="w-full p-3 border border-gray-300 rounded-lg" required>
                            </div>
                        </div>
                        <div id="additional-payout-rows-${newNumber}" class="space-y-4"></div>
                        <button type="button" class="flex items-center w-fit mt-5 px-6 py-2 bg-[#CBE6FF] text-[#0084FF] font-semibold rounded-md add-payout-row" data-payout="${newNumber}">
                            Add Row
                        </button>
                    `;
                    
                    additionalPayoutContainer.appendChild(payoutOption);
                    
                    payoutOption.querySelector('.remove-payout-option').addEventListener('click', function() {
                        if (confirm('Are you sure you want to remove this additional payout option?')) {
                            this.closest('[id^="additional-payout-"]').remove();
                            updatePayoutNumbers(); // This ensures sequential numbering
                        }
                    });
                    
                    payoutOption.querySelector('.add-payout-row').addEventListener('click', function() {
                        const payoutId = this.dataset.payout;
                        const rowsContainer = document.getElementById(`additional-payout-rows-${payoutId}`);
                        const rowCount = rowsContainer.querySelectorAll('.grid').length + 1;
                        
                        const row = document.createElement('div');
                        row.className = 'grid grid-cols-1 md:grid-cols-4 gap-6 items-end';
                        row.innerHTML = `
                            <div>
                                <input type="text" name="additional_payout[${payoutId}][rows][${rowCount}][product]" class="w-full p-3 border border-gray-300 rounded-lg" required>
                            </div>
                            <div>
                                <div class="input-with-dropdown">
                                    <input type="number" name="additional_payout[${payoutId}][rows][${rowCount}][target_condition_value]" class="w-full p-3 border border-gray-300 rounded-lg" required>
                                    <select name="additional_payout[${payoutId}][rows][${rowCount}][target_condition_type]" class="p-3 border border-gray-300 rounded-lg">
                                        <option value="Unit">Unit</option>
                                        <option value="Amount">Amount</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <div class="input-with-dropdown">
                                    <input type="number" name="additional_payout[${payoutId}][rows][${rowCount}][target_bonus_value]" class="w-full p-3 border border-gray-300 rounded-lg" required>
                                    <select name="additional_payout[${payoutId}][rows][${rowCount}][target_bonus_type]" class="p-3 border border-gray-300 rounded-lg">
                                        <option value="Amount">Amount</option>
                                        <option value="Percentage">Percentage</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex items-end gap-2">
                                <div class="flex-grow">
                                    <input type="number" name="additional_payout[${payoutId}][rows][${rowCount}][total_payout]" class="w-full p-3 border border-gray-300 rounded-lg" readonly>
                                </div>
                                <button type="button" class="bg-red-100 text-red-700 px-5 py-3 rounded-lg remove-payout-row">
                                    <img src="/assets/target/minus-square.svg" class="w-6 h-6">
                                </button>
                            </div>
                        `;
                        
                        rowsContainer.appendChild(row);
                        
                        row.querySelector('.remove-payout-row').addEventListener('click', function() {
                            if (confirm('Are you sure you want to remove this row?')) {
                                row.remove();
                            }
                        });
                    });
                });
                
                // Form submission
                document.getElementById('targetForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const formData = new FormData(this);
                    const data = {
                        brand: formData.get('brand'),
                        month: formData.get('month'),
                        year: formData.get('year'),
                        value_wise_target: {
                            target_value: formData.get('value_target_amount'),
                            payout_percentage: formData.get('value_payout_percentage'),
                            total_payout: formData.get('value_total_payout')
                        },
                        product_wise_targets: [],
                        additional_payouts: []
                    };
                    
                    // Collect product wise targets
                    document.querySelectorAll('[name^="product_target["]').forEach(input => {
                        const match = input.name.match(/product_target\[(\d+)\]\[(\w+)\]/);
                        if (match) {
                            const index = match[1];
                            const field = match[2];
                            if (!data.product_wise_targets[index]) {
                                data.product_wise_targets[index] = {};
                            }
                            data.product_wise_targets[index][field] = input.value;
                        }
                    });
                    
                    // Collect additional payouts
                    document.querySelectorAll('[name^="additional_payout["]').forEach(input => {
                        const match = input.name.match(/additional_payout\[(\d+)\]\[(\w+)\]/);
                        if (match) {
                            const payoutId = match[1];
                            const field = match[2];
                            if (!data.additional_payouts[payoutId]) {
                                data.additional_payouts[payoutId] = { rows: [] };
                            }
                            if (['name', 'from_date', 'to_date'].includes(field)) {
                                data.additional_payouts[payoutId][field] = input.value;
                            }
                        }
                        
                        const rowMatch = input.name.match(/additional_payout\[(\d+)\]\[rows\]\[(\d+)\]\[(\w+)\]/);
                        if (rowMatch) {
                            const payoutId = rowMatch[1];
                            const rowId = rowMatch[2];
                            const field = rowMatch[3];
                            if (!data.additional_payouts[payoutId]) {
                                data.additional_payouts[payoutId] = { rows: [] };
                            }
                            if (!data.additional_payouts[payoutId].rows[rowId]) {
                                data.additional_payouts[payoutId].rows[rowId] = {};
                            }
                            data.additional_payouts[payoutId].rows[rowId][field] = input.value;
                        }
                    });
                    
                    // Clean up arrays
                    data.product_wise_targets = data.product_wise_targets.filter(Boolean);
                    data.additional_payouts = data.additional_payouts.filter(Boolean);
                    
                    console.log('Form data:', data);
                    alert('Form submitted successfully!');
                });
            });
        </script>
    @endsection
</body>
</html>