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

        <style>
            .hidden-section {
                display: none;
            }
            .toggle-container {
                display: flex;
                align-items: center;
                gap: 8px;
            }
            .toggle-text {
                font-size: 14px;
                color: #666;
                font-weight: 500;
            }
            .active-text {
                color: #0084ff;
                font-weight: 600;
            }
            .metric-boxes {
                transition: all 0.3s ease;
            }
            .hs-dropdown-menu {
                z-index: 1000;
            }
        </style>
        
        <title>Dashboard | Fast Forward</title>
    </head>
    <body>
        @extends("main.layout")
        
        @section("content")
            <section>
                <!-- Payment Metrics (shown by default) -->
                <div id="paymentMetrics" class="metric-boxes grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
                    <!-- Box 01 -->
                    <div class="flex items-center justify-between border-l-4 border-[#0084ff] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Daily Sales Report</p>
                            <h1 class="text-[#0084ff] font-bold text-lg">43,0000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#0084ff] p-5 rounded-full">
                            <img src="/assets/main/dashboard/money-recive.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 02 -->
                    <div class="flex items-center justify-between border-l-4 border-[#7500cf] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Weekly Sales Report</p>
                            <h1 class="text-[#7500cf] font-bold text-lg">1,23,0000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#7500cf] p-5 rounded-full">
                            <img src="/assets/main/dashboard/money-recive.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 03 -->
                    <div class="flex items-center justify-between border-l-4 border-[#ff6600] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Monthly Sales Report</p>
                            <h1 class="text-[#ff6600] font-bold text-lg">43,0000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#ff6600] p-5 rounded-full">
                            <img src="/assets/main/dashboard/money-recive.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 04 -->
                    <div class="flex items-center justify-between border-l-4 border-[#0162ff] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Yearly Sales Report</p>
                            <h1 class="text-[#0162ff] font-bold text-lg">43,0000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#0162ff] p-5 rounded-full">
                            <img src="/assets/main/dashboard/money-recive.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 05 -->
                    <div class="flex items-center justify-between border-l-4 border-[#d70400] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Payment Payable</p>
                            <h1 class="text-[#d70400] font-bold text-lg">12,45,0000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#d70400] p-5 rounded-full">
                            <img src="/assets/main/dashboard/money-recive.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 06 -->
                    <div class="flex items-center justify-between border-l-4 border-[#00a800] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Warehouse Stock Value</p>
                            <h1 class="text-[#00a800] font-bold text-lg">45,67,000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#00a800] p-5 rounded-full">
                            <img src="/assets/main/dashboard/box.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 07 -->
                    <div class="flex items-center justify-between border-l-4 border-[#00bdcf] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Outlet Available Stocks</p>
                            <h1 class="text-[#00bdcf] font-bold text-lg">43,0000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#00bdcf] p-5 rounded-full">
                            <img src="/assets/main/dashboard/shop.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 08 -->
                    <div class="flex items-center justify-between border-l-4 border-[#0300cf] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Total Unchecked Bills</p>
                            <h1 class="text-[#0300cf] font-bold text-lg">43,0000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#0300cf] p-5 rounded-full">
                            <img src="/assets/main/dashboard/receipt-text.svg" alt="">
                        </div>
                    </div>
                </div>

                <!-- Target Metrics (hidden by default) -->
                <div id="targetMetrics" class="metric-boxes hidden-section grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-5">
                    <!-- Box 01 -->
                    <div class="flex items-center justify-between border-l-4 border-[#0084ff] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Daily Sales Report</p>
                            <h1 class="text-[#0084ff] font-bold text-lg">43,0000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#0084ff] p-5 rounded-full">
                            <img src="/assets/main/dashboard/money-recive.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 02 -->
                    <div class="flex items-center justify-between border-l-4 border-[#7500cf] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Weekly Sales Report</p>
                            <h1 class="text-[#7500cf] font-bold text-lg">1,23,0000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#7500cf] p-5 rounded-full">
                            <img src="/assets/main/dashboard/money-recive.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 03 -->
                    <div class="flex items-center justify-between border-l-4 border-[#ff6600] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Monthly Sales Report</p>
                            <h1 class="text-[#ff6600] font-bold text-lg">43,0000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#ff6600] p-5 rounded-full">
                            <img src="/assets/main/dashboard/money-recive.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 04 -->
                    <div class="flex items-center justify-between border-l-4 border-[#0162ff] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Yearly Sales Report</p>
                            <h1 class="text-[#0162ff] font-bold text-lg">43,0000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#0162ff] p-5 rounded-full">
                            <img src="/assets/main/dashboard/money-recive.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 09 -->
                    <div class="flex items-center justify-between border-l-4 border-[#00bdcf] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Outlet Available Stocks</p>
                            <h1 class="text-[#00bdcf] font-bold text-lg">43,0000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#cbe6ff] to-[#00bdcf] p-5 rounded-full">
                            <img src="/assets/main/dashboard/shop.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 10 -->
                    <div class="flex items-center justify-between border-l-4 border-[#29CF00] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Cash In Hand</p>
                            <h1 class="text-[#29CF00] font-bold text-lg">45,67,000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#8BE8E8] to-[#29CF00] p-5 rounded-full">
                            <img src="/assets/main/dashboard/coin.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 11 -->
                    <div class="flex items-center justify-between border-l-4 border-[#CF00CB] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Cash (Inclusive)</p>
                            <h1 class="text-[#CF00CB] font-bold text-lg">45,67,000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#FFEA00] to-[#CF00CB] p-5 rounded-full">
                            <img src="/assets/main/dashboard/coin.svg" alt="">
                        </div>
                    </div>
                    <!-- Box 12 -->
                    <div class="flex items-center justify-between border-l-4 border-[#CF0000] px-5 py-4 rounded-xl shadow bg-[#fff]">
                        <div class="grid gap-2">
                            <p class="text-sm font-semibold tracking-wide text-[#949494]">Cash (Emempt)</p>
                            <h1 class="text-[#CF0000] font-bold text-lg">45,67,000.00</h1>
                        </div>
                        <div class="bg-gradient-to-br from-[#FFCC00] to-[#CF0000] p-5 rounded-full">
                            <img src="/assets/main/dashboard/coin.svg" alt="">
                        </div>
                    </div>
                </div>

                <!-- Payment In Out With Chart -->
                <div class="mt-8 shadow-md rounded-lg bg-[#fff]">
                    <div class="flex justify-between border-b-[1.5px] border-[#dddddd] px-5 py-3">
                        <h3 id="sectionTitle" class="font-semibold text-2xl">PAYMENT IN-OUT</h3>
                        <div class="toggle-container">
                            <label class="relative inline-flex items-center cursor-pointer rounded-full">
                                <input type="checkbox" id="periodToggle" class="sr-only peer">
                                <div class="group peer rounded-full duration-300 w-12 h-6 bg-[#03ad0049] after:duration-300 after:bg-[#03AD00] peer-checked:after:bg-green-500 peer-checked:ring-green-500 after:rounded-full after:absolute after:h-4 after:w-4 after:top-[4px] after:left-1 after:flex after:justify-center after:items-center peer-checked:after:translate-x-6 peer-hover:after:scale-95" style="box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.1);"></div>
                            </label>
                        </div>
                    </div>

                    <!-- Monthly Section -->
                    <div id="monthlySection">
                        <div class="px-5 py-5 grid grid-cols-3 place-items-center">
                            <div class="grid gap-2">
                                <p class="text-2xl font-bold tracking-wide text-[#8a8a8a]">Purchase In</p>
                                <h1 class="text-[#a0cc4d] font-bold text-xl">4582851</h1>
                            </div>
                            <div class="grid gap-2">
                                <p class="text-2xl font-bold tracking-wide text-[#8a8a8a]">Sale Out</p>
                                <h1 class="text-[#23bcb8] font-bold text-xl">59865</h1>
                            </div>
                            <div class="w-44 h-44 relative">
                                <canvas id="monthlyChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Yearly Section (hidden by default) -->
                    <div id="yearlySection" class="hidden-section">
                        <div class="px-5 py-5 grid grid-cols-3 place-items-center">
                            <div class="grid gap-2">
                                <p class="text-2xl font-bold tracking-wide text-[#8a8a8a]">Target Amount</p>
                                <h1 class="text-[#a0cc4d] font-bold text-xl">98978</h1>
                            </div>
                            <div class="grid gap-2">
                                <p class="text-2xl font-bold tracking-wide text-[#8a8a8a]">Achieved Amount</p>
                                <h1 class="text-[#23bcb8] font-bold text-xl">23522</h1>
                            </div>
                            <div class="w-44 h-44 relative">
                                <canvas id="yearlyChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table Start -->
                 <div class="mt-8 shadow-md rounded-lg bg-[#fff]">
                    <h3 class="border-b-[1.5px] border-[#dddddd] px-5 py-3 font-semibold text-2xl">RECENT SALES</h3>
                    <div class="px-5 py-5">
                        <div class="table-container">
                            <table id="myTable" class="custom-data-table">
                                <thead>
                                    <tr>
                                        <th>Invoice No</th>
                                        <th>Date</th>
                                        <th>Customer</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Created By</th>
                                        <th>Payment Type</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>INV-00123</td>
                                        <td>2025-04-16</td>
                                        <td>John Doe</td>
                                        <td>$250.00</td>
                                        <td>Paid</td>
                                        <td>Admin</td>
                                        <td>Credit Card</td>
                                        <td>2025-04-16 10:23 AM</td>
                                        <td>
                                        <div class="hs-dropdown relative inline-flex">
                                            <button type="button" class="py-1 px-6 inline-flex items-center gap-x-2 text-xs rounded-full bg-[#abd7ff] text-[#0084ff] hover:bg-[#9bc3ff] focus:outline-hidden focus:bg-[#9bc3ff] disabled:opacity-50 disabled:pointer-events-none cursor-pointer font-bold uppercase" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                                See
                                            </button>
                                            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white rounded-lg mt-2 divide-y divide-gray-200 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 shadow-2xl" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-with-icons">
                                                <div class="p-1">
                                                    <!-- <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                        <img src="/assets/table/edit.svg" alt="" class="w-4 h-4">
                                                        Edit
                                                    </a> -->
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                        <img src="/assets/table/wallet-money.svg" alt="" class="w-4 h-4">
                                                        Purchase
                                                    </a>
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                        <img src="/assets/table/wallet-money.svg" alt="" class="w-4 h-4">
                                                        Prepaid Amount Entry
                                                    </a>
                                                    <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                                                        <img src="/assets/table/wallet-money.svg" alt="" class="w-4 h-4">
                                                        Return Amount Entry
                                                    </a>
                                                    <button class="flex items-center gap-x-3.5 py-2 px-3 min-w-full cursor-pointer rounded-lg text-sm text-red-500 hover:bg-gray-100 focus:outline-hidden focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700">
                                                        <img src="/assets/table/trash.svg" alt="" class="w-4 h-4">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                 </div>
                <!-- Table End -->
            </section>
        @endsection

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            $(document).ready(function() {
                const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
                const monthlyChart = new Chart(monthlyCtx, {
                    type: 'pie',
                    data: {
                        labels: ['Purchase In', 'Sale Out'],
                        datasets: [{
                            data: [4582851, 59865],
                            backgroundColor: ['#a0cc4d', '#23bcb8'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } }
                    }
                });

                const yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
                const yearlyChart = new Chart(yearlyCtx, {
                    type: 'pie',
                    data: {
                        labels: ['Target Amount', 'Achieved Amount'],
                        datasets: [{
                            data: [98978, 23522],
                            backgroundColor: ['#a0cc4d', '#23bcb8'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } }
                    }
                });

                // Toggle functionality
                $('#periodToggle').change(function() {
                    const sectionTitle = $('#sectionTitle');
                    const monthlyText = $('#monthlyText');
                    const yearlyText = $('#yearlyText');
                    
                    if ($(this).is(':checked')) {
                        // Switch to Yearly/Target view
                        $('#monthlySection').addClass('hidden-section');
                        $('#yearlySection').removeClass('hidden-section');
                        $('#paymentMetrics').addClass('hidden-section');
                        $('#targetMetrics').removeClass('hidden-section');
                        
                        sectionTitle.text('TARGET INFORMATION');
                        monthlyText.removeClass('active-text');
                        yearlyText.addClass('active-text');
                        
                        // Update chart data if needed
                        // yearlyChart.data.datasets[0].data = [newValue1, newValue2];
                        // yearlyChart.update();
                    } else {
                        // Switch to Monthly/Payment view
                        $('#monthlySection').removeClass('hidden-section');
                        $('#yearlySection').addClass('hidden-section');
                        $('#paymentMetrics').removeClass('hidden-section');
                        $('#targetMetrics').addClass('hidden-section');
                        
                        sectionTitle.text('PAYMENT IN-OUT');
                        monthlyText.addClass('active-text');
                        yearlyText.removeClass('active-text');
                        
                        // Update chart data if needed
                        // monthlyChart.data.datasets[0].data = [newValue1, newValue2];
                        // monthlyChart.update();
                    }
                });
            });
        </script>
    </body>
</html>