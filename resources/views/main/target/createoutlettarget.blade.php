<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

    <!-- Custom Css For Table Start -->
    <link rel="stylesheet" href="/assets/table/css/style.css">
    <!-- Custom Css For Table End -->

    <title>Create Outlet Target | Fast Forward</title>
</head>
<body>
    @extends("main.layout")

    @section("content")
        <section>
            <x-breadcrumb :links="[
                ['url' => route('dashboard'), 'text' => 'Home'],
                ['url' => '#', 'text' => 'Target'],
                ['url' => '/main/target/outlettarget', 'text' => 'Outlet Target List'],
                ['url' => '/main/target/createoutlettarget', 'text' => 'Create Target']
            ]" />

            <div class="shadow-md rounded-lg bg-[#fff] dark:bg-gray-800">
                <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                    <h3 class="font-semibold text-2xl">TARGET DETAILS</h3>
                </div>
                    
                <form id="targetForm" class="space-y-6 py-5">
                    <!-- Brand and Outlet Dropdowns -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5 px-5">
                        <div>
                            <label for="brand" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Brand</label>
                            <select id="brand" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                <option disabled selected="">Select Brand</option>
                                <option value="Samsung">Samsung</option>
                                <option value="Apple">Apple</option>
                            </select>
                        </div>
                        <div>
                            <label for="outlet" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Outlet</label>
                            <select id="outlet" class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                <option selected="" disabled>Select Outlet</option>
                                <option vlaue="Shop One">Shop One</option>
                                <option value="Shop Two">Shop Two</option>
                            </select>
                        </div>
                        <!-- Year Input -->
                        <div>
                            <label for="year" class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Year</label>
                            <input type="number" id="year" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" value="{{ date('Y') }}" required>
                        </div>
                    </div>
                    
                    <!-- Initial Target Option (Main) -->
                    <div class="mb-6">
                        <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                            <h3 class="font-semibold text-2xl">TARGET AMOUNTS</h3>
                        </div>

                        <div id="initialTargetOption" class="bg-white p-4 rounded-lg space-y-4">
                            <h5 class="text-md font-bold text-gray-800 mb-3">Target Option (Main) 1</h5>
                            
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Target Note</label>
                                <textarea class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="2"></textarea>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Amount</label>
                                    <input type="number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" step="0.01" required>
                                </div>

                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">From Date</label>
                                    <input type="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                </div>
                                
                                <div>
                                    <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">To Date</label>
                                    <input type="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                </div>
                            </div>
                            
                            <button type="button" id="addBonusTargetBtn" class="text-center w-60 py-3 bg-[#CCFCCB] border border-transparent rounded-md text-sm font-bold text-[#03AD00] cursor-pointer tracking-widest hover:bg-[#d5fccb] disabled:opacity-25 transition-all duration-300">
                                Add Bonus Target
                            </button>
                        </div>
                    </div>
                    
                    <!-- Container for additional target options -->
                    <div id="additionalTargetOptions" class="space-y-6"></div>
                    
                    <button type="button" id="addTargetOptionBtn" class="inline-flex items-center w-full mt-5 mx-5 md:w-auto transition-all duration-300 px-6 py-2 bg-[#CBE6FF] text-[#0084FF] hover:text-white cursor-pointer font-semibold rounded-md hover:bg-[#006eff]">
                        Add Target (Main)
                    </button>
                    
                    <div class="space-x-5 mt-6 mx-5">
                        <button type="button" id="submitBtn" class="px-8 cursor-pointer py-1.5 bg-[#0084FF] text-white rounded-md hover:bg-[#006aff]">Submit</button>
                        <button type="button" id="closeBtn" class="px-8 cursor-pointer py-1.5 bg-[#DFDFDF] text-[#8a8a8a] rounded-md hover:bg-gray-300">Close</button>
                    </div>
                </form>
            </div>
        </section>
    @endsection

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set default dates to today
            const today = new Date().toISOString().split('T')[0];
            document.querySelectorAll('input[type="date"]').forEach(dateInput => {
                dateInput.value = today;
            });
            
            // Target Options counter
            let targetOptionCount = 1;
            let bonusTargetCount = 0;
            
            // Sample product data
            const products = [
                { id: 1, name: 'Samsung Galaxy S23' },
                { id: 2, name: 'Samsung Galaxy S24' },
                { id: 3, name: 'iPhone 15' },
                { id: 4, name: 'iPhone 16' }
            ];
            
            // Add Bonus Target button click handler
            document.getElementById('addBonusTargetBtn').addEventListener('click', addBonusTarget);
            
            // Add Target Option button click handler
            document.getElementById('addTargetOptionBtn').addEventListener('click', addTargetOption);
            
            // Submit button click handler
            document.getElementById('submitBtn').addEventListener('click', submitForm);
            
            // Close button click handler
            document.getElementById('closeBtn').addEventListener('click', resetForm);
            
            // Function to add a bonus target to the initial target option
            function addBonusTarget() {
                bonusTargetCount++;
                const container = document.getElementById('initialTargetOption');
                
                const bonusTargetDiv = document.createElement('div');
                bonusTargetDiv.className = 'bg-gray-50 p-4 rounded-lg border border-gray-200 mt-4';
                bonusTargetDiv.innerHTML = `
                    <h4 class="text-md font-bold text-gray-800 mb-3">Bonus Target Option ${bonusTargetCount}</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Bonus Target Name</label>
                            <input type="text" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" placeholder="Samsung Premiere League">
                        </div>
                        
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Product</label>
                            <select class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600">
                                <option value="">Select Product</option>
                                ${products.map(product => `<option value="${product.id}">${product.name}</option>`).join('')}
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Target Quantity</label>
                            <input type="number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        </div>
                        
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Target Bonus Amount</label>
                            <input type="number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" step="0.01" required>
                        </div>
                        
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">From Date</label>
                            <input type="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        </div>
                        
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">To Date</label>
                            <input type="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <button type="button" class="remove-bonus-target-btn text-center px-5 py-2 -translate-y-0.5 h-fit bg-[#FCCBCC] text-red-500 text-sm font-bold rounded transition-all duration-300 cursor-pointer hover:bg-red-300 hover:text-white">
                            Remove Bonus Target
                        </button>
                    </div>
                `;
                
                container.appendChild(bonusTargetDiv);
                
                // Add event listener for the remove button
                bonusTargetDiv.querySelector('.remove-bonus-target-btn').addEventListener('click', function() {
                    container.removeChild(bonusTargetDiv);
                    bonusTargetCount--;
                });
            }
            
            // Function to add a new target option
            function addTargetOption() {
                targetOptionCount++;
                const container = document.getElementById('additionalTargetOptions');
                
                const targetOptionDiv = document.createElement('div');
                targetOptionDiv.className = 'bg-white p-4 rounded-lg space-y-4';
                targetOptionDiv.innerHTML = `
                    <h3 class="text-md font-bold text-gray-800 mb-3">Target Option (Main) ${targetOptionCount}</h3>
                    
                    <div class="mb-4">
                        <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Target Note</label>
                        <textarea class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" rows="2"></textarea>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5 mb-4">
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Amount</label>
                            <input type="number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" step="0.01" required>
                        </div>

                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">From Date</label>
                            <input type="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        </div>
                        
                        <div>
                            <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">To Date</label>
                            <input type="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <button type="button" class="add-bonus-target-btn text-center w-60 py-3 bg-[#CCFCCB] border border-transparent rounded-md text-sm font-bold text-[#03AD00] cursor-pointer tracking-widest hover:bg-[#d5fccb] disabled:opacity-25 transition-all duration-300">
                            Add Bonus Target
                        </button>
                        
                        <button type="button" class="remove-target-option-btn text-center w-60 py-3 bg-[#FCCBCC] text-red-500 text-sm font-bold rounded transition-all duration-300 cursor-pointer hover:bg-red-300 hover:text-white">
                            Remove Target Option
                        </button>
                    </div>
                    
                    <div class="bonus-targets-container mt-4 space-y-4"></div>
                `;
                
                container.appendChild(targetOptionDiv);
                
                // Add event listener for the "Add Bonus Target" button
                targetOptionDiv.querySelector('.add-bonus-target-btn').addEventListener('click', function() {
                    const bonusContainer = targetOptionDiv.querySelector('.bonus-targets-container');
                    const bonusCount = bonusContainer.querySelectorAll('.bonus-target').length + 1;
                    
                    const bonusTargetDiv = document.createElement('div');
                    bonusTargetDiv.className = 'bg-gray-50 p-4 rounded-lg border border-gray-200 mt-4';
                    bonusTargetDiv.innerHTML = `
                        <h4 class="text-md font-medium text-gray-700 mb-3">Bonus Target Option ${bonusCount}</h4>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-5">
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Bonus Target Name</label>
                                <input type="text" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Product</label>
                                <select class="py-2.5 sm:py-3 px-4 pe-9 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                                    <option value="">Select Product</option>
                                    ${products.map(product => `<option value="${product.id}">${product.name}</option>`).join('')}
                                </select>
                            </div>
                            
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Target Quantity</label>
                                <input type="number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">Target Bonus Amount</label>
                                <input type="number" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" step="0.01" required>
                            </div>
                            
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">From Date</label>
                                <input type="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                            
                            <div>
                                <label class="block text-base font-semibold mb-2 text-[#8d8d8d] dark:text-white">To Date</label>
                                <input type="date" class="py-2.5 sm:py-3 px-4 block w-full border border-gray-400 rounded-lg sm:text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" required>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <button type="button" class="remove-bonus-target-btn text-center px-5 py-2 -translate-y-0.5 h-fit bg-[#FCCBCC] text-red-500 text-sm font-bold rounded transition-all duration-300 cursor-pointer hover:bg-red-300 hover:text-white">
                                Remove Bonus Target
                            </button>
                        </div>
                    `;
                    
                    bonusContainer.appendChild(bonusTargetDiv);
                    
                    // Add event listener for the remove button
                    bonusTargetDiv.querySelector('.remove-bonus-target-btn').addEventListener('click', function() {
                        bonusContainer.removeChild(bonusTargetDiv);
                    });
                });
                
                // Add event listener for the "Remove Target Option" button
                targetOptionDiv.querySelector('.remove-target-option-btn').addEventListener('click', function() {
                    container.removeChild(targetOptionDiv);
                    targetOptionCount--;
                });
            }
            
            // Function to submit the form
            function submitForm(e) {
                e.preventDefault(); 

                const formData = {
                    brand: document.getElementById('brand').value,
                    outlet: document.getElementById('outlet').value,
                    year: document.getElementById('year').value,
                    targetOptions: []
                };
                
                // Get initial target option data
                const initialOption = {
                    note: document.querySelector('#initialTargetOption textarea').value,
                    amount: document.querySelector('#initialTargetOption input[type="number"]').value,
                    fromDate: document.querySelector('#initialTargetOption input[type="date"]:first-of-type').value,
                    toDate: document.querySelector('#initialTargetOption input[type="date"]:last-of-type').value,
                    bonusTargets: []
                };
                
                // Get bonus targets from initial option
                document.querySelectorAll('#initialTargetOption > div').forEach(bonusTarget => {
                    if (bonusTarget.classList.contains('bg-gray-50')) {
                        initialOption.bonusTargets.push({
                            name: bonusTarget.querySelector('input[type="text"]').value,
                            product: bonusTarget.querySelector('select').value,
                            quantity: bonusTarget.querySelectorAll('input[type="number"]')[0].value,
                            bonusAmount: bonusTarget.querySelectorAll('input[type="number"]')[1].value,
                            fromDate: bonusTarget.querySelectorAll('input[type="date"]')[0].value,
                            toDate: bonusTarget.querySelectorAll('input[type="date"]')[1].value
                        });
                    }
                });
                
                formData.targetOptions.push(initialOption);
                
                // Get additional target options
                document.querySelectorAll('#additionalTargetOptions > div').forEach(targetOption => {
                    const option = {
                        note: targetOption.querySelector('textarea').value,
                        amount: targetOption.querySelector('input[type="number"]').value,
                        fromDate: targetOption.querySelector('input[type="date"]:first-of-type').value,
                        toDate: targetOption.querySelector('input[type="date"]:last-of-type').value,
                        bonusTargets: []
                    };
                    
                    targetOption.querySelectorAll('.bonus-targets-container > div').forEach(bonusTarget => {
                        option.bonusTargets.push({
                            name: bonusTarget.querySelector('input[type="text"]').value,
                            product: bonusTarget.querySelector('select').value,
                            quantity: bonusTarget.querySelectorAll('input[type="number"]')[0].value,
                            bonusAmount: bonusTarget.querySelectorAll('input[type="number"]')[1].value,
                            fromDate: bonusTarget.querySelectorAll('input[type="date"]')[0].value,
                            toDate: bonusTarget.querySelectorAll('input[type="date"]')[1].value
                        });
                    });
                    
                    formData.targetOptions.push(option);
                });
                
                console.log('Form submitted:', formData);
                alert('Form data logged to console! Check your browser console for details.');
            }
            
            // Function to reset the form
            function resetForm() {
                document.getElementById('targetForm').reset();
                document.getElementById('year').value = new Date().getFullYear();
                document.getElementById('additionalTargetOptions').innerHTML = '';
                
                // Reset dates to today
                const today = new Date().toISOString().split('T')[0];
                document.querySelectorAll('input[type="date"]').forEach(dateInput => {
                    dateInput.value = today;
                });
                
                // Remove all bonus targets except the first one
                const initialOption = document.getElementById('initialTargetOption');
                const bonusTargets = initialOption.querySelectorAll('div.bg-gray-50');
                bonusTargets.forEach(target => initialOption.removeChild(target));
                
                targetOptionCount = 1;
                bonusTargetCount = 0;
            }
        });
    </script>
</body>
</html>