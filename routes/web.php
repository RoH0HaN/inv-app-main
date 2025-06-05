<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminForgotPasswordController;

use App\Http\Controllers\main\DashboardController;
use App\Http\Controllers\main\CustomerController;
use App\Http\Controllers\main\SupplierController;
use App\Http\Controllers\main\InvoicesController;
use App\Http\Controllers\main\PaymentInController;
use App\Http\Controllers\main\PurchaseBillsController;
use App\Http\Controllers\main\PaymentOutController;
use App\Http\Controllers\main\CustomerReportByItemController;
use App\Http\Controllers\main\CustomerStatementController;
use App\Http\Controllers\main\CustomerOutstandingsController;
use App\Http\Controllers\main\PrepaidAmountHistoryController;
use App\Http\Controllers\main\ReturnAmountHistoryController;

use App\Http\Controllers\main\SupplierReportByItemController;
use App\Http\Controllers\main\SupplierStatementController;
use App\Http\Controllers\main\SupplierOutstandingsController;

use App\Http\Controllers\main\ItemListController;
use App\Http\Controllers\main\CategoryListController;
use App\Http\Controllers\main\BrandListController;

use App\Http\Controllers\main\warehouse\WarehouseListController;
use App\Http\Controllers\main\warehouse\OutletListController;
use App\Http\Controllers\main\warehouse\StockTransferListController;

use App\Http\Controllers\main\BillWiseProfitController;
use App\Http\Controllers\main\SalesSummeryController;
use App\Http\Controllers\main\PurchaseSummeryController;
use App\Http\Controllers\main\DayBookController;
use App\Http\Controllers\main\StockReportController;
use App\Http\Controllers\main\PartyReportController;
use App\Http\Controllers\main\GstReportController;
use App\Http\Controllers\main\ExpenseReportController;

use App\Http\Controllers\main\expenses\ExpenseListController;
use App\Http\Controllers\main\expenses\ExpenseTypeController;

use App\Http\Controllers\main\cashandbank\CashInHandController;
use App\Http\Controllers\main\cashandbank\BanksController;

use App\Http\Controllers\main\users\ProfileController;
use App\Http\Controllers\main\users\AllUsersController;
use App\Http\Controllers\main\users\EmployeeController;

use App\Http\Controllers\main\target\OrganizationController;
use App\Http\Controllers\main\target\OutletController;

use App\Http\Controllers\main\settings\SettingsOrganizationController;
use App\Http\Controllers\main\settings\TaxRatesController;
use App\Http\Controllers\main\settings\UnitListController;
use App\Http\Controllers\main\settings\TcsTdsRatesController;
use App\Http\Controllers\main\settings\PaymentOptionController;
use App\Http\Controllers\main\settings\FinanceController;

// ADMIN ROUTE
Route::get("/", [AdminLoginController::class, "index"]);
Route::get("/admin/forgotpassword", [AdminForgotPasswordController::class, "forgotPassword"])->name("admin/forgotpassword");
Route::post("/admin/login", [AdminLoginController::class, "login"])->name("admin.login");

// DASHBOARD ROUTE
Route::get("/main/dashboard/dashboard", [DashboardController::class, "index"])->name("main/dashboard/dashboard");

// CONTACTS => CUSTOMERS ROUTE
Route::get("/main/contacts/customers", [CustomerController::class, "index"])->name("main/contacts/customers");
Route::get("/main/contacts/createcustomer", [CustomerController::class, "createCustomer"])->name("main/contacts/createcustomer");

// CONTACTS => SUPPLIERS ROUTE
Route::get("/main/contacts/suppliers", [SupplierController::class, "index"])->name("main/contacts/suppliers");
Route::get("/main/contacts/createsupplier", [SupplierController::class, "createSupplier"])->name("main/contacts/createsupplier");
Route::get("/main/contacts/supplierpayment", [SupplierController::class, "supplierPayment"])->name("main/contacts/supplierpayment");
Route::get("/main/contacts/paymentout", [SupplierController::class, "paymentOut"])->name("main/contacts/paymentout");
Route::get("/main/contacts/supplierpaymenthistory", [SupplierController::class, "supplierPaymentHistory"])->name("main/contacts/supplierpaymenthistory");
Route::get("/main/contacts/creditnotehistory", [SupplierController::class, "creditNoteHistory"])->name("main/contacts/creditnotehistory");
Route::get("/main/contacts/debitnotehistory", [SupplierController::class, "debitNoteHistory"])->name("main/contacts/debitnotehistory");
Route::get("/main/contacts/createcreditnote", [SupplierController::class, "createCreditNote"])->name("main/contacts/createcreditnote");
Route::get("/main/contacts/createdebitnote", [SupplierController::class, "createDebitNote"])->name("main/contacts/createdebitnote");

// SALE => INVOICES ROUTE
Route::get("/main/sale/invoices", [InvoicesController::class, "index"])->name("main/sale/invoices");
Route::get("/main/sale/createsale", [InvoicesController::class, "createSale"])->name("main/sale/createsale");
Route::get("/main/sale/completepayment", [InvoicesController::class, "completePayment"])->name("main/sale/completepayment");

// SALE => PAYMENT IN ROUTE
Route::get("/main/sale/paymentin", [PaymentInController::class, "index"])->name("main/sale/paymentin");

// PURCHASE => PURCHASE BILLS ROUTE & SUPPLIER => UNPAID PURCHASE BILLS
Route::get("/main/purchase/purchasebills", [PurchaseBillsController::class, "index"])->name("main/purchase/purchasebills");
Route::get("/main/purchase/createpurchase", [PurchaseBillsController::class, "createPurchase"])->name("main/purchase/createpurchase");

// PURCHASE => PAYMENT OUT ROUTE
Route::get("/main/purchase/paymentout", [PaymentOutController::class, "index"])->name("main/purchase/paymentout");

// CUSTOMER => REPORT BY ITEM ROUTE
Route::get("/main/customer/reportbyitem", [CustomerReportByItemController::class, "index"])->name("main/customer/reportbyitem");

// CUSTOMER => CUSTOMER STATEMENT ROUTE
Route::get("/main/customer/customerstatement", [CustomerStatementController::class, "index"])->name("main/customer/customerstatement");

// CUSTOMER => CUSTOMER OUTSTANDINGS ROUTE
Route::get("/main/customer/customeroutstandings", [CustomerOutstandingsController::class, "index"])->name("main/customer/customeroutstandings");

// CUSTOMER => PREPAID AMOUNT HISTORY & ENTRY ROUTE
Route::get("/main/customer/prepaidamounthistory", [PrepaidAmountHistoryController::class, "index"])->name("main/customer/prepaidamounthistory");
Route::get("/main/customer/prepaidamountentryfrom", [PrepaidAmountHistoryController::class, "prepaidAmountEntry"])->name("main/customer/prepaidamountentryfrom");

// CUSTOMER => PREPAID AMOUNT HISTORY & ENTRY ROUTE
Route::get("/main/customer/returnamounthistory", [ReturnAmountHistoryController::class, "index"])->name("main/customer/returnamounthistory");
Route::get("/main/customer/returnamountentryfrom", [ReturnAmountHistoryController::class, "returnAmountEntry"])->name("main/customer/returnamountentryfrom");

// SUPPLIER => REPORT BY ITEM ROUTE
Route::get("/main/supplier/reportbyitem", [SupplierReportByItemController::class, "index"])->name("main/supplier/reportbyitem");

// SUPPLIER => SUPPLIER STATEMENT ROUTE
Route::get("/main/supplier/supplierstatement", [SupplierStatementController::class, "index"])->name("main/supplier/supplierstatement");

// SUPPLIER => SUPPLIER OUTSTANDINGS ROUTE
Route::get("/main/supplier/supplieroutstandings", [SupplierOutstandingsController::class, "index"])->name("main/supplier/supplieroutstandings");

// ITEMS => ITEM LIST ROUTE
Route::get("/main/items/itemlist", [ItemListController::class, "index"])->name("main/items/itemlist");
Route::get("/main/items/createitem", [ItemListController::class, "createItem"])->name("main/items/createitem");

// ITEMS => CATEGORY LIST ROUTE
Route::get("/main/items/categorylist", [CategoryListController::class, "index"])->name("main/items/categorylist");
Route::get("/main/items/createcategory", [CategoryListController::class, "createCategory"])->name("main/items/createcategory");
Route::post("/main/items/save-category-to-database", [CategoryListController::class, "saveCategoryToDatabase"])->name('main.items.saveCategoryToDatabase');

// ITEMS => BRAND LIST ROUTE
Route::get("/main/items/brandlist", [BrandListController::class, "index"])->name("main/items/brandlist");
Route::get("/main/items/createbrand", [BrandListController::class, "createBrand"])->name("main/items/createbrand");

// WAREHOUSE => WAREHOUSE LIST ROUTE
Route::get("/main/warehouse/warehouseslist", [WarehouseListController::class, "index"])->name("main/warehouse/warehouseslist");
Route::get("/main/warehouse/createwarehouse", [WarehouseListController::class, "createWarehouse"])->name("main/warehouse/createwarehouse");
Route::post("/main/warehouse/save-warehouse-to-database", [WarehouseListController::class, "saveWarehouseToDatabase"])->name('main.warehouse.saveWarehouseToDatabase');

// WAREHOUSE => OUTLET LIST ROUTE
Route::get("/main/warehouse/outletslist", [OutletListController::class, "index"])->name("main/warehouse/outletslist");
Route::get("/main/warehouse/createoutlet", [OutletListController::class, "createOutlet"])->name("main/warehouse/createoutlet");

// WAREHOUSE => STOCK TRANSFER LIST ROUTE
Route::get("/main/warehouse/stocktransferlist", [StockTransferListController::class, "index"])->name("main/warehouse/stocktransferlist");
Route::get("/main/warehouse/newtransfer", [StockTransferListController::class, "newTransfer"])->name("main/warehouse/newtransfer");

// REPORTS => BILL WISE PROFIT ROUTE
Route::get("/main/reports/billwiseprofit", [BillWiseProfitController::class, "index"])->name("main/reports/billwiseprofit");

// REPORTS => SALES SUMMERY ROUTE
Route::get("/main/reports/salessummery", [SalesSummeryController::class, "index"])->name("main/reports/salessummery");

// REPORTS => PURCHASE SUMMERY ROUTE
Route::get("/main/reports/purchasesummery", [PurchaseSummeryController::class, "index"])->name("main/reports/purchasesummery");

// REPORTS => DAYBOOK ROUTE
Route::get("/main/reports/daybook", [DayBookController::class, "index"])->name("main/reports/daybook");

// REPORTS => STOCK REPORT ROUTE
Route::get("/main/reports/stockreport", [StockReportController::class, "index"])->name("main/reports/stockreport");

// REPORTS => PARTY REPORT ROUTE
Route::get("/main/reports/partyreport", [PartyReportController::class, "index"])->name("main/reports/partyreport");
Route::get("/main/reports/viewstatement", [PartyReportController::class, "viewStatement"])->name("main/reports/viewstatement");

// REPORTS => GST REPORT ROUTE
Route::get("/main/reports/gstreport", [GstReportController::class, "index"])->name("main/reports/gstreport");

// REPORTS => EXPENSE REPORT ROUTE
Route::get("/main/reports/expensereport", [ExpenseReportController::class, "index"])->name("main/reports/expensereport");

// EXPENSES => EXPENSE LIST ROUTE
Route::get("/main/expenses/expenselist", [ExpenseListController::class, "index"])->name("main/expenses/expenselist");
Route::get("/main/expenses/createexpense", [ExpenseListController::class, "createExpense"])->name("main/expenses/createexpense");

// EXPENSES => EXPENSE TYPE ROUTE
Route::get("/main/expenses/expensetype", [ExpenseTypeController::class, "index"])->name("main/expenses/expensetype");
Route::get("/main/expenses/createexpensetype", [ExpenseTypeController::class, "createExpenseType"])->name("main/expenses/createexpensetype");

// CASH IN HAND => CASH IN HAND ROUTE
Route::get("/main/cashandbank/cashinhand", [CashInHandController::class, "index"])->name("main/cashandbank/cashinhand");

// CASH IN HAND => BANKS ROUTE
Route::get("/main/cashandbank/banks", [BanksController::class, "index"])->name("main/cashandbank/banks");
Route::get("/main/cashandbank/add-bank-account", [BanksController::class, "addBankAccount"])->name("main/cashandbank/add-bank-account");
Route::get("/main/cashandbank/account-details", [BanksController::class, "viewAccountDetails"])->name("main/cashandbank/account-details");

// USERS => PROFILE ROUTE
Route::get("/main/users/profile", [ProfileController::class, "index"])->name("main/users/profile");

// USERS => ALL USERS ROUTE
Route::get("/main/users/userslist", [AllUsersController::class, "index"])->name("main/users/userslist");
Route::get("/main/users/createuser", [AllUsersController::class, "createUser"])->name("main/users/createuser");
Route::post("/main/users/save-user-to-database", [AllUsersController::class, "saveUserToDatabase"])->name('main.users.saveUserToDatabase');

// USERS => EMPLOYEE ROUTE
Route::get("/main/users/employeelist", [EmployeeController::class, "index"])->name("main/users/employeelist");
Route::get("/main/users/createemployee", [EmployeeController::class, "createEmployee"])->name("main/users/createemployee");

// TARGET => ORGANIZATION TARGET ROUTE
Route::get("/main/target/organizationtarget", [OrganizationController::class, "index"])->name("main/target/organizationtarget");
Route::get("/main/target/createorganizationtarget", [OrganizationController::class, "createOrganizationTarget"])->name("main/target/createorganizationtarget");

// TARGET => OUTLET TARGET ROUTE
Route::get("/main/target/outlettarget", [OutletController::class, "index"])->name("main/target/outlettarget");
Route::get("/main/target/createoutlettarget", [OutletController::class, "createOutletTarget"])->name("main/target/createoutlettarget");

// SETTINGS => ORGANIZATION ROUTE
Route::get("/main/settings/organization", [SettingsOrganizationController::class, "index"])->name("main/settings/organization");

// SETTINGS => TAX RATES ROUTE
Route::get("/main/settings/taxrates", [TaxRatesController::class, "index"])->name("main/settings/taxrates");
Route::get("/main/settings/createtax", [TaxRatesController::class, "createTax"])->name("main/settings/createtax");

// SETTINGS => UNIT LIST ROUTE
Route::get("/main/settings/unitlist", [UnitListController::class, "index"])->name("main/settings/unitlist");
Route::get("/main/settings/createunit", [UnitListController::class, "createUnit"])->name("main/settings/createunit");

// SETTINGS => TCS TDS RATES ROUTE
Route::get("/main/settings/tcs-tds-rates", [TcsTdsRatesController::class, "index"])->name("main/settings/tcs-tds-rates");
Route::get("/main/settings/create-tcs-tds", [TcsTdsRatesController::class, "createTcsTds"])->name("main/settings/create-tcs-tds");

// SETTINGS => PAYMENT OPTIONS ROUTE
Route::get("/main/settings/payment-options", [PaymentOptionController::class, "index"])->name("main/settings/payment-options");
Route::get("/main/settings/create-payment-option", [PaymentOptionController::class, "createPaymentOption"])->name("main/settings/create-payment-option");

// SETTINGS => FINANCES LIST ROUTE
Route::get("/main/settings/finances-list", [FinanceController::class, "index"])->name("main/settings/finances-list");
Route::get("/main/settings/create-finance", [FinanceController::class, "createFinance"])->name("main/settings/create-finance");
Route::get("/main/settings/finance-details-page", [FinanceController::class, "viewFinanceDetails"])->name("main/settings/finance-details-page");