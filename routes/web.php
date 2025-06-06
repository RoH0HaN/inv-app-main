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
use Illuminate\Routing\Router;

// ADMIN ROUTE
Route::controller(AdminLoginController::class)->group(function () {
    Route::get("/", "index")->name('login');
    Route::post("/admin/login", "login")->name("admin.login");
    Route::get("/admin/logout", "logout")->name("admin.logout");
});
Route::get("/admin/forget-password", [AdminForgetPasswordController::class, "forgetPassword"])->name("admin.forgetPassword");

// DASHBOARD ROUTE
Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard")->middleware(VerifyLogin::class);

Route::prefix("contacts")->name("contacts.")->middleware(VerifyLogin::class)->group(function () {
    // CONTACTS => CUSTOMERS ROUTE
    Route::controller(CustomerController::class)->group(function () {
        Route::get("/customers", "index")->name("customers");
        Route::get("/create-customer", "createCustomer")->name("createCustomer");
        Route::post("/save-customer-to-database", "saveCustomerToDatabase")->name("saveCustomerToDatabase");  
        Route::post("/update-customer", "updateCustomer")->name("updateCustomer");  
        Route::delete("/delete-customer", "deleteCustomer")->name("deleteCustomer");  
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
// Route::get("/sale/invoices", [InvoicesController::class, "index"])->name("main/sale/invoices");
// Route::get("/sale/create-sale", [InvoicesController::class, "createSale"])->name("main/sale/createsale");
// Route::get("/sale/complete-payment", [InvoicesController::class, "completePayment"])->name("main/sale/completepayment");

Route::prefix("sale")->name("sale.")->middleware(VerifyLogin::class)->group(function () {
    // SALE => SALE BILLS ROUTE & CUSTOMER => UNPAID SALE BILLS
    Route::controller(InvoicesController::class)->group(function () {
        Route::get("/invoices", "index")->name("invoices");
        Route::get("/create-sale", "createSale")->name("createSale");
        Route::get("/complete-payment", "completePayment")->name("completePayment");
    });

    // SALE => PAYMENT IN ROUTE
    Route::get("/payment-in", [PaymentInController::class, "index"])->name("paymentIn");
});

// SALE => PAYMENT IN ROUTE
// Route::get("/sale/payment-in", [PaymentInController::class, "index"])->name("main/sale/paymentin");

Route::prefix("purchase")->name("purchase.")->middleware(VerifyLogin::class)->group(function () {
    // PURCHASE => PURCHASE BILLS ROUTE & SUPPLIER => UNPAID PURCHASE BILLS
    Route::controller(PurchaseBillsController::class)->group(function () {
        Route::get("/purchase-bills", "index")->name("purchaseBills");
        Route::get("/create-purchase", "createPurchase")->name("createPurchase");
    });

    // PURCHASE => PAYMENT OUT ROUTE
    Route::get("/payment-out", [PaymentOutController::class, "index"])->name("paymentOut");
});

// PURCHASE => PURCHASE BILLS ROUTE & SUPPLIER => UNPAID PURCHASE BILLS
// Route::get("/purchase/purchase-bills", [PurchaseBillsController::class, "index"])->name("main/purchase/purchasebills");
// Route::get("/purchase/create-purchase", [PurchaseBillsController::class, "createPurchase"])->name("main/purchase/createpurchase");

// PURCHASE => PAYMENT OUT ROUTE
// Route::get("/purchase/payment-out", [PaymentOutController::class, "index"])->name("main/purchase/paymentout");


Route::prefix("customer")->name("customer.")->middleware(VerifyLogin::class)->group(function () {
   
    // CUSTOMER 
    ROute::controller(CustomerController::class)->group(function () {
       Route::get('/report-by-item', 'reportByItem')->name('reportByItem');
       Route::get('/customer-statement', 'customerStatement')->name('customerStatement');
       Route::get('/customer-outstanding', 'customerOutstanding')->name('customerOutstanding'); 
    });

    // CUSTOMER => CUSTOMER PREPAID ROUTE
    Route::controller(PrepaidAmountHistoryController::class)->group(function () {
        Route::get("/customer-prepaid", "index")->name("customerPrepaid");
        Route::get("/create-customer-prepaid", "createCustomerPrepaid")->name("createCustomerPrepaid");
    });

    // CUSTOMER => CUSTOMER RETURN AMOUNT ROUTE
    Route::controller(ReturnAmountHistoryController::class)->group(function () {
        Route::get("/customer-return", "index")->name("customerReturn");
        Route::get("/create-customer-return", "createCustomerReturn")->name("createCustomerReturn");
    });
});

// // CUSTOMER => REPORT BY ITEM ROUTE
// Route::get("/customer/report-by-item", [CustomerReportByItemController::class, "index"])->name("main/customer/reportbyitem");

// // CUSTOMER => CUSTOMER STATEMENT ROUTE
// Route::get("/customer/customer-statement", [CustomerStatementController::class, "index"])->name("main/customer/customerstatement");

// // CUSTOMER => CUSTOMER OUTSTANDINGS ROUTE
// Route::get("/customer/customer-outstanding", [CustomerOutstandingsController::class, "index"])->name("main/customer/customeroutstandings");

Route::prefix('customer')->name('customer.')->middleware(VerifyLogin::class)->group(function () {
    // CUSTOMER => PREPAID AMOUNT HISTORY & ENTRY ROUTE
    Route::controller(PrepaidAmountHistoryController::class)->group(function () {
        Route::get("/prepaid-amount-history/{id?}", "index")->name("prepaidAmountHistory");
        Route::get("/prepaid-amount-entry-from/{id?}", "prepaidAmountEntry")->name("prepaidAmountEntry");
        Route::post("/save-prepaid-amount-entry-to-database", "savePrepaidAmountEntryToDatabase")->name("savePrepaidAmountEntryToDatabase");
    });

    // CUSTOMER => RETURN AMOUNT HISTORY & ENTRY ROUTE
    Route::controller(ReturnAmountHistoryController::class)->group(function () {
        Route::get("/return-amount-history", "index")->name("returnAmountHistory");
        Route::get("/return-amount-entry-from", "returnAmountEntry")->name("returnAmountEntry");
    });
});

Route::prefix("supplier")->name("supplier.")->middleware(VerifyLogin::class)->group(function () {
   
    // SUPPLIER 
    ROute::controller(SupplierController::class)->group(function () {
       Route::get('/report-by-item', 'reportByItem')->name('reportByItem');
       Route::get('/supplier-statement', 'supplierStatement')->name('supplierStatement');
       Route::get('/supplier-outstanding', 'supplierOutstanding')->name('supplierOutstanding'); 
    });
});

// // SUPPLIER => REPORT BY ITEM ROUTE
// Route::get("/supplier/report-by-item", [SupplierReportByItemController::class, "index"])->name("main/supplier/reportbyitem");

// // SUPPLIER => SUPPLIER STATEMENT ROUTE
// Route::get("/supplier/supplier-statement", [SupplierStatementController::class, "index"])->name("main/supplier/supplierstatement");

// // SUPPLIER => SUPPLIER OUTSTANDINGS ROUTE
// Route::get("/supplier/supplier-outstanding", [SupplierOutstandingsController::class, "index"])->name("main/supplier/supplieroutstandings");

Route::prefix("items")->name("items.")->middleware(VerifyLogin::class)->group(function () {
   
    // ITEMS => ITEMS LIST ROUTE
    Route::controller(ItemListController::class)->group(function () {
        Route::get("/items-list", 'index')->name("itemsList");
    });

    // ITEMS => CATEGORY LIST ROUTE
    Route::controller(CategoryListController::class)->group(function () {
        Route::get("/category-list", 'index')->name("categoryList");
        Route::get("/create-category", 'createCategory')->name("createCategory");
        Route::post("/save-category-to-database", 'saveCategoryToDatabase')->name('items.saveCategoryToDatabase');
    });
    
    // ITEMS => BRAND LIST ROUTE
    Route::controller(BrandListController::class)->group(function () {
        Route::get("/brand-list", 'index')->name("brandList");
        Route::get("/create-brand", 'createBrand')->name("createBrand");
    });

});

// // ITEMS => ITEM LIST ROUTE
// Route::get("/items/item-list", [ItemListController::class, "index"])->name("main/items/itemlist");
// Route::get("/items/create-item", [ItemListController::class, "createItem"])->name("main/items/createitem");

// // ITEMS => CATEGORY LIST ROUTE
// Route::get("/items/category-list", [CategoryListController::class, "index"])->name("main/items/categorylist");
// Route::get("/items/create-category", [CategoryListController::class, "createCategory"])->name("main/items/createcategory");
// Route::post("/main/items/save-category-to-database", [CategoryListController::class, "saveCategoryToDatabase"])->name('main.items.saveCategoryToDatabase');

// // ITEMS => BRAND LIST ROUTE
// Route::get("/items/brand-list", [BrandListController::class, "index"])->name("main/items/brandlist");
// Route::get("/items/create-brand", [BrandListController::class, "createBrand"])->name("main/items/createbrand");

Route::prefix("warehouse")->name("warehouse.")->middleware(VerifyLogin::class)->group(function () {
    // WAREHOUSE => WAREHOUSE LIST ROUTE
    Route::controller(WarehouseListController::class)->group(function () {
        Route::get("/warehouses-list", "index")->name("warehousesList");
        Route::get("/create-warehouse", "createWarehouse")->name("createWarehouse");
        Route::post("/save-warehouse-to-database", "saveWarehouseToDatabase")->name('saveWarehouseToDatabase');
        Route::post("/update-warehouse", "updateWarehouse")->name('updateWarehouse');
        Route::delete("/delete-warehouse", "deleteWarehouse")->name('deleteWarehouse');
    });
    
    // WAREHOUSE => OUTLET LIST ROUTE
    Route::controller(OutletListController::class)->group(function () {
        Route::get("/outlets-list", "index")->name("outletsList");
        Route::get("/create-outlet", "createOutlet")->name("createOutlet");
        Route::post("/save-outlet-to-database", "saveOutletToDatabase")->name('saveOutletToDatabase');
        Route::post("/update-outlet", "updateOutlet")->name('updateOutlet');
        Route::delete("/delete-outlet", "deleteOutlet")->name('deleteOutlet');
    });

    // WAREHOUSE => STOCK TRANSFER LIST ROUTE
    Route::controller(StockTransferListController::class)->group(function () {
        Route::get("/stock-transfer-list", "index")->name("stockTransferList");
        Route::get("/new-transfer", "newTransfer")->name("newTransfer");
    });
});

Route::prefix("reports")->name("reports.")->middleware(VerifyLogin::class)->group(function () {
   // REPORTS => BILL WISE PROFIT ROUTE
   Route::get("/bill-wise-profit", [BillWiseProfitController::class, "index"])->name("billWiseProfit"); 

   // REPORTS => SALES SUMMERY ROUTE
   Route::get("/sales-summery", [SalesSummeryController::class, "index"])->name("salesSummery");

   // REPORTS => PURCHASE SUMMERY ROUTE
   Route::get("/purchase-summery", [PurchaseSummeryController::class, "index"])->name("purchaseSummery");

   // REPORTS => DAYBOOK ROUTE
   Route::get("/daybook", [DayBookController::class, "index"])->name("daybook");

   // REPORTS => STOCK REPORT ROUTE
   Route::get("/stock-report", [StockReportController::class, "index"])->name("stockReport");

   // REPORTS => PARTY REPORT ROUTE
   Route::get("/party-report", [PartyReportController::class, "index"])->name("partyReport");
   Route::get("/view-statement", [PartyReportController::class, "viewStatement"])->name("viewStatement");

   // REPORTS => GST REPORT ROUTE
   Route::get("/gst-report", [GstReportController::class, "index"])->name("gstReport");

   // REPORTS => EXPENSE REPORT ROUTE
   Route::get("/expense-report", [ExpenseReportController::class, "index"])->name("expenseReport");

});



// REPORTS => BILL WISE PROFIT ROUTE
// Route::get("/reports/bill-wise-profit", [BillWiseProfitController::class, "index"])->name("main/reports/billwiseprofit");

// // REPORTS => SALES SUMMERY ROUTE
// Route::get("/reports/sales-summery", [SalesSummeryController::class, "index"])->name("main/reports/salessummery");

// // REPORTS => PURCHASE SUMMERY ROUTE
// Route::get("/reports/purchase-summery", [PurchaseSummeryController::class, "index"])->name("main/reports/purchasesummery");

// // REPORTS => DAYBOOK ROUTE
// Route::get("/reports/daybook", [DayBookController::class, "index"])->name("main/reports/daybook");

// // REPORTS => STOCK REPORT ROUTE
// Route::get("/reports/stock-report", [StockReportController::class, "index"])->name("main/reports/stockreport");

// // REPORTS => PARTY REPORT ROUTE
// Route::get("/reports/party-report", [PartyReportController::class, "index"])->name("main/reports/partyreport");
// Route::get("/reports/view-statement", [PartyReportController::class, "viewStatement"])->name("main/reports/viewstatement");

// // REPORTS => GST REPORT ROUTE
// Route::get("/reports/gst-report", [GstReportController::class, "index"])->name("main/reports/gstreport");

// // REPORTS => EXPENSE REPORT ROUTE
// Route::get("/reports/expense-report", [ExpenseReportController::class, "index"])->name("main/reports/expensereport");

Route::prefix("expenses")->name("expenses.")->middleware(VerifyLogin::class)->group(function () {

    // EXPENSES => EXPENSE LIST ROUTE
    Route::controller(ExpenseListController::class)->group(function () {
        Route::get("/expense-list", "index")->name("expenseList");
        Route::get("/create-expense", "createExpense")->name("createExpense");
    });

    // EXPENSES => EXPENSE TYPE ROUTE
    Route::controller(ExpenseTypeController::class)->group(function () {
        Route::get("/expense-type", "index")->name("expenseType");
        Route::get("/create-expense-type", "createExpenseType")->name("createExpenseType");
    });
});

// // EXPENSES => EXPENSE LIST ROUTE
// Route::get("/expenses/expense-list", [ExpenseListController::class, "index"])->name("main/expenses/expenselist");
// Route::get("/expenses/create-expense", [ExpenseListController::class, "createExpense"])->name("main/expenses/createexpense");

// // EXPENSES => EXPENSE TYPE ROUTE
// Route::get("/expenses/expense-type", [ExpenseTypeController::class, "index"])->name("main/expenses/expensetype");
// Route::get("/expenses/create-expense-type", [ExpenseTypeController::class, "createExpenseType"])->name("main/expenses/createexpensetype");

// CASH IN HAND => CASH IN HAND ROUTE
// Route::get("/cash-bank/cash-in-hand", [CashInHandController::class, "index"])->name("main/cashandbank/cashinhand");

// CASH IN HAND => BANKS ROUTE
// Route::get("/cash-bank/banks", [BanksController::class, "index"])->name("main/cashandbank/banks");
// Route::get("/cash-bank/add-bank-account", [BanksController::class, "addBankAccount"])->name("main/cashandbank/add-bank-account");
// Route::get("/cash-bank/account-details", [BanksController::class, "viewAccountDetails"])->name("main/cashandbank/account-details");

Route::prefix("cash-bank")->name("cash-bank.")->middleware(VerifyLogin::class)->group(function () {

   // CASH IN HAND => CASH IN HAND ROUTE
   Route::controller(CashInHandController::class)->group(function () {
       Route::get("/cash-in-hand", "index")->name("cashInHand");
   });
   // CASH IN HAND => BANKS ROUTE
   Route::controller(BanksController::class)->group(function () {
       Route::get("/banks", "index")->name("banks");
       Route::get("/add-bank-account", "addBankAccount")->name("addBankAccount");
       Route::get("/account-details", "viewAccountDetails")->name("accountDetails");
   });
});

// USERS => PROFILE ROUTE
// Route::get("/users/profile", [ProfileController::class, "index"])->name("main/users/profile");

// USERS => ALL USERS ROUTE
Route::prefix('users')->name('users.')->middleware(VerifyLogin::class)->group(function () {

    // USERS => PROFILE ROUTE
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
    });

    // USERS => ALL USERS ROUTE
    Route::controller(AllUsersController::class)->group(function () {
        Route::get('/users-list', 'index')->name('usersList');
        Route::get('/create-user', 'createUser')->name('createUser');
        Route::post('/save-user-to-database', 'saveUserToDatabase')->name('saveUserToDatabase');
    });

    // USERS => EMPLOYEE ROUTE
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employee-list', 'index')->name('employeeList');
        Route::get('/create-employee', 'createEmployee')->name('createEmployee');
        Route::post('/save-employee-to-database', 'saveEmployeeToDatabase')->name('saveEmployeeToDatabase');
    });

});

// USERS => EMPLOYEE ROUTE
// Route::get("/users/employee-list", [EmployeeController::class, "index"])->name("main/users/employeelist");
// Route::get("/users/create-employee", [EmployeeController::class, "createEmployee"])->name("main/users/createemployee");

// // TARGET => ORGANIZATION TARGET ROUTE
// Route::get("/target/organization-target", [OrganizationController::class, "index"])->name("main/target/organizationtarget");
// Route::get("/target/create-organization-target", [OrganizationController::class, "createOrganizationTarget"])->name("main/target/createorganizationtarget");

// // TARGET => OUTLET TARGET ROUTE
// Route::get("/target/outlet-target", [OutletController::class, "index"])->name("main/target/outlettarget");
// Route::get("/target/create-outlet-target", [OutletController::class, "createOutletTarget"])->name("main/target/createoutlettarget");


Route::prefix("target")->name("target.")->middleware(VerifyLogin::class)->group(function () {
    // ORGANIZATION TARGET ROUTE
   Route::controller(OrganizationController::class)->group(function () {
      Route::get("/organization-target", 'index')->name("organizationTarget");
      Route::get("/create-organization-target", 'createOrganizationTarget')->name("createOrganizationTarget"); 
   });

   // OUTLET TARGET ROUTE
   Route::controller(OutletController::class)->group(function () {
      Route::get("/outlet-target", 'index')->name("outletTarget");
      Route::get("/create-outlet-target", 'createOutletTarget')->name("createOutletTarget"); 
   });
});

// SETTINGS => ORGANIZATION ROUTE
// Route::get("/settings/organization", [SettingsOrganizationController::class, "index"])->name("main/settings/organization");


Route::prefix("settings")->name("settings.")->middleware(VerifyLogin::class)->group(function () {

    // ORGANIZATION ROUTE
    Route::controller(SettingsOrganizationController::class)->group(function () {
        Route::get("/organization", 'index')->name("organization");
    });

    // TAX RATES ROUTE
    Route::controller(TaxRatesController::class)->group(function () {
        Route::get("/tax-rates", 'index')->name("taxRates");
        Route::get("/create-tax", 'createTax')->name("createTax");
        Route::post("/save-tax-to-database", 'saveTaxToDatabase')->name("saveTaxToDatabase");
        Route::post("/update-tax-to-database", 'updateTaxToDatabase')->name("updateTaxToDatabase");
    });

    // UNIT LIST ROUTE
    Route::controller(UnitListController::class)->group(function () {
        Route::get("/unit-list", 'index')->name("unitList");
        Route::get("/create-unit", 'createUnit')->name("createUnit");
    });

    // TCS/TDS RATES ROUTE
    Route::controller(TcsTdsRatesController::class)->group(function () {
        Route::get("/tcs-tds-rates", 'index')->name("tcsTdsRates");
        Route::get("/create-tcs-tds", 'createTcsTds')->name("createTcsTds");
    });

    // PAYMENT OPTIONS ROUTE
    Route::controller(PaymentOptionController::class)->group(function () {
        Route::get("/payment-options", 'index')->name("paymentOptions");
        Route::get("/create-payment-option", 'createPaymentOption')->name("createPaymentOption");
    });

    // FINANCES LIST ROUTE
    Route::controller(FinanceController::class)->group(function () {
        Route::get("/finances-list", 'index')->name("financesList");
        Route::get("/create-finance", 'createFinance')->name("createFinance");
        Route::get("/finance-details-page", 'viewFinanceDetails')->name("financeDetailsPage");
    });

});


// SETTINGS => UNIT LIST ROUTE
// Route::get("/settings/unit-list", [UnitListController::class, "index"])->name("main/settings/unitlist");
// Route::get("/settings/create-unit", [UnitListController::class, "createUnit"])->name("main/settings/createunit");

// // SETTINGS => TCS TDS RATES ROUTE
// Route::get("/settings/tcs-tds-rates", [TcsTdsRatesController::class, "index"])->name("main/settings/tcs-tds-rates");
// Route::get("/settings/create-tcs-tds", [TcsTdsRatesController::class, "createTcsTds"])->name("main/settings/create-tcs-tds");

// // SETTINGS => PAYMENT OPTIONS ROUTE
// Route::get("/settings/payment-options", [PaymentOptionController::class, "index"])->name("main/settings/payment-options");
// Route::get("/settings/create-payment-option", [PaymentOptionController::class, "createPaymentOption"])->name("main/settings/create-payment-option");

// // SETTINGS => FINANCES LIST ROUTE
// Route::get("/settings/finances-list", [FinanceController::class, "index"])->name("main/settings/finances-list");
// Route::get("/settings/create-finance", [FinanceController::class, "createFinance"])->name("main/settings/create-finance");
// Route::get("/settings/finance-details-page", [FinanceController::class, "viewFinanceDetails"])->name("main/settings/finance-details-page");