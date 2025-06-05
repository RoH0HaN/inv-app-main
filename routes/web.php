<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\AdminForgetPasswordController;

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

// MIDDLEWARE
use App\Http\Middleware\VerifyLogin;

// ADMIN ROUTE
Route::controller(AdminLoginController::class)->group(function () {
    Route::get("/", "index")->name('login');
    Route::post("/admin/login", "login")->name("admin.login");
    Route::get("/admin/logout", "logout")->name("admin.logout");
});
Route::get("/admin/forget-password", [AdminForgetPasswordController::class, "forgetPassword"])->name("admin.forgetPassword");

// DASHBOARD ROUTE
Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");

Route::prefix("contacts")->name("contacts.")->middleware(VerifyLogin::class)->group(function () {
    // CONTACTS => CUSTOMERS ROUTE
    Route::controller(CustomerController::class)->group(function () {
        Route::get("/customers", "index")->name("customers");
        Route::get("/create-customer", "createCustomer")->name("createCustomer");
    });

    // CONTACTS => SUPPLIERS ROUTE
    Route::controller(SupplierController::class)->group(function () {
        Route::get("/suppliers", "index")->name("suppliers");
        Route::get("/create-supplier", "createSupplier")->name("createSupplier");
        Route::get("/supplier-payment", "supplierPayment")->name("supplierPayment");
        Route::get("/payment-out", "paymentOut")->name("paymentOut");
        Route::get("/supplier-payment-history", "supplierPaymentHistory")->name("supplierPaymentHistory");
        Route::get("/credit-note-history", "creditNoteHistory")->name("creditNoteHistory");
        Route::get("/debit-note-history", "debitNoteHistory")->name("debitNoteHistory");
        Route::get("/create-credit-note", "createCreditNote")->name("createCreditNote");
        Route::get("/create-debit-note", "createDebitNote")->name("createDebitNote");
    });
});

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

Route::prefix("warehouse")->name("warehouse.")->middleware(VerifyLogin::class)->group(function () {
    // WAREHOUSE => WAREHOUSE LIST ROUTE
    Route::controller(WarehouseListController::class)->group(function () {
        Route::get("/warehouses-list", "index")->name("warehousesList");
        Route::get("/create-warehouse", "createWarehouse")->name("createWarehouse");
        Route::post("/save-warehouse-to-database", "saveWarehouseToDatabase")->name('saveWarehouseToDatabase');
    });

    // WAREHOUSE => OUTLET LIST ROUTE
    Route::controller(OutletListController::class)->group(function () {
        Route::get("/outlets-list", "index")->name("outletsList");
        Route::get("/create-outlet", "createOutlet")->name("createOutlet");
    });

    // WAREHOUSE => STOCK TRANSFER LIST ROUTE
    Route::controller(StockTransferListController::class)->group(function () {
        Route::get("/stock-transfer-list", "index")->name("stockTransferList");
        Route::get("/new-transfer", "newTransfer")->name("newTransfer");
    });
});

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
Route::prefix('users')->name('users.')->middleware(VerifyLogin::class)->group(function () {
    Route::controller(AllUsersController::class)->group(function () {
        Route::get('/users-list', 'index')->name('usersList');
        Route::get('/create-user', 'createUser')->name('createUser');
        Route::post('/save-user-to-database', 'saveUserToDatabase')->name('saveUserToDatabase');
    });
});

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