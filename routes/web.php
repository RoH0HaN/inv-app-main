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


Route::prefix("purchase")->name("purchase.")->middleware(VerifyLogin::class)->group(function () {
    // PURCHASE => PURCHASE BILLS ROUTE & SUPPLIER => UNPAID PURCHASE BILLS
    Route::controller(PurchaseBillsController::class)->group(function () {
        Route::get("/purchase-bills", "index")->name("purchaseBills");
        Route::get("/create-purchase", "createPurchase")->name("createPurchase");
    });

    // PURCHASE => PAYMENT OUT ROUTE
    Route::get("/payment-out", [PaymentOutController::class, "index"])->name("paymentOut");
});

Route::prefix('customer')->name('customer.')->middleware(VerifyLogin::class)->group(function () {
    // CUSTOMER => PREPAID AMOUNT HISTORY & ENTRY ROUTE
    Route::controller(PrepaidAmountHistoryController::class)->group(function () {
        Route::get("/prepaid-amount-history/{id?}", "index")->name("prepaidAmountHistory");
        Route::get("/prepaid-amount-entry-from/{id?}", "prepaidAmountEntry")->name("prepaidAmountEntry");
        Route::post("/save-prepaid-amount-entry-to-database", "savePrepaidAmountEntryToDatabase")->name("savePrepaidAmountEntryToDatabase");
    });
    
    // CUSTOMER => RETURN AMOUNT HISTORY & ENTRY ROUTE
    Route::controller(ReturnAmountHistoryController::class)->group(function () {
        Route::get("/return-amount-history/{id?}", "index")->name("returnAmountHistory");
        Route::get("/return-amount-entry-from/{id?}", "returnAmountEntry")->name("returnAmountEntry");
        Route::post("/save-return-amount-entry-to-database", "saveReturnAmountEntryToDatabase")->name("saveReturnAmountEntryToDatabase");
    });

    // CUSTOMER => REPORTS, STATEMENTS & OUTSTANDINGS
    Route::get('/report-by-item', [CustomerReportByItemController::class, "index"])->name('reportByItem');
    Route::get('/customer-statement', [CustomerStatementController::class, "index"])->name('customerStatement');
    Route::get('/customer-outstanding', [CustomerOutstandingsController::class, "index"])->name('customerOutstanding'); 
});

Route::prefix("supplier")->name("supplier.")->middleware(VerifyLogin::class)->group(function () {

    // SUPPLIER => REPORTS, STATEMENTS & OUTSTANDINGS
    Route::get('/report-by-item', [SupplierReportByItemController::class, "index"])->name('reportByItem');
    Route::get('/supplier-statement', [SupplierStatementController::class, "index"])->name('supplierStatement');
    Route::get('/supplier-outstanding', [SupplierOutstandingsController::class, "index"])->name('supplierOutstanding'); 
});


Route::prefix("items")->name("items.")->middleware(VerifyLogin::class)->group(function () {
   
    // ITEMS => ITEMS LIST ROUTE
    Route::controller(ItemListController::class)->group(function () {
        Route::get("/items-list", 'index')->name("itemsList");
        Route::get("/create-item", 'createItem')->name("createItem");
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


// USERS => ALL USERS ROUTE
Route::prefix('users')->name('users.')->middleware(VerifyLogin::class)->group(function () {

    // USERS => PROFILE ROUTE
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile');
        Route::post('/update-profile', 'updateProfile')->name('updateProfile');
        Route::post('/change-password', 'changePassword')->name('changePassword');
    });

    // USERS => ALL USERS ROUTE
    Route::controller(AllUsersController::class)->group(function () {
        Route::get('/users-list', 'index')->name('usersList');
        Route::get('/create-user', 'createUser')->name('createUser');
        Route::post('/save-user-to-database', 'saveUserToDatabase')->name('saveUserToDatabase');
        Route::post('/update-user', 'updateUser')->name('updateUser');
        Route::delete('/delete-user', 'deleteUser')->name('deleteUser');
    });

    // USERS => EMPLOYEE ROUTE
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employee-list', 'index')->name('employeeList');
        Route::get('/create-employee', 'createEmployee')->name('createEmployee');
        Route::post('/save-employee-to-database', 'saveEmployeeToDatabase')->name('saveEmployeeToDatabase');
        Route::post("/update-employee-to-database", 'updateEmployeeToDatabase')->name("updateEmployeeToDatabase");
        Route::delete("/delete-employee-to-database", 'deleteEmployeeToDatabase')->name("deleteEmployeeToDatabase");
    });

});


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



Route::prefix("settings")->name("settings.")->middleware(VerifyLogin::class)->group(function () {

    // ORGANIZATION ROUTE
    Route::controller(SettingsOrganizationController::class)->group(function () {
        Route::get("/organization", 'index')->name("organization");
        Route::post("/update-essentials", 'updateEssentials')->name("updateEssentials");
    });

    // TAX RATES ROUTE
    Route::controller(TaxRatesController::class)->group(function () {
        Route::get("/tax-rates", 'index')->name("taxRates");
        Route::get("/create-tax", 'createTax')->name("createTax");
        Route::post("/save-tax-to-database", 'saveTaxToDatabase')->name("saveTaxToDatabase");
        Route::post("/update-tax-to-database", 'updateTaxToDatabase')->name("updateTaxToDatabase");
        Route::delete("/delete-tax-to-database", 'deleteTaxToDatabase')->name("deleteTaxToDatabase");
    });

    // UNIT LIST ROUTE
    Route::controller(UnitListController::class)->group(function () {
        Route::get("/unit-list", 'index')->name("unitList");
        Route::get("/create-unit", 'createUnit')->name("createUnit");
        Route::post("/save-unit-to-database", 'saveUnitToDatabase')->name("saveUnitToDatabase");
        Route::post("/update-unit-to-database", 'updateUnitToDatabase')->name("updateUnitToDatabase");
        Route::delete("/delete-unit-to-database", 'deleteUnitToDatabase')->name("deleteUnitToDatabase");
    });

    // TCS/TDS RATES ROUTE
    Route::controller(TcsTdsRatesController::class)->group(function () {
        Route::get("/tcs-tds-rates", 'index')->name("tcsTdsRates");
        Route::get("/create-tcs-tds", 'createTcsTds')->name("createTcsTds");
        Route::post("/save-tcs-tds-to-database", 'saveTcsTdsToDatabase')->name("saveTcsTdsToDatabase");
        Route::post("/update-tcs-tds-to-database", 'updateTcsTdsToDatabase')->name("updateTcsTdsToDatabase");
        Route::delete("/delete-tcs-tds-to-database", 'deleteTcsTdsToDatabase')->name("deleteTcsTdsToDatabase");
    });

    // PAYMENT OPTIONS ROUTE
    Route::controller(PaymentOptionController::class)->group(function () {
        Route::get("/payment-options", 'index')->name("paymentOptions");
        Route::get("/create-payment-option", 'createPaymentOption')->name("createPaymentOption");
        Route::post("/save-payment-option-to-database", 'savePaymentOptionToDatabase')->name("savePaymentOptionToDatabase");
        Route::post("/update-payment-option-to-database", 'updatePaymentOptionToDatabase')->name("updatePaymentOptionToDatabase");
        Route::delete("/delete-payment-option-to-database", 'deletePaymentOptionToDatabase')->name("deletePaymentOptionToDatabase");
    });

    // FINANCES LIST ROUTE
    Route::controller(FinanceController::class)->group(function () {
        Route::get("/finances-list", 'index')->name("financesList");
        Route::get("/create-finance", 'createFinance')->name("createFinance");
        Route::get("/finance-details-page", 'viewFinanceDetails')->name("financeDetailsPage");

        // TODO: These routes is not completed. need to be complete

        Route::post("/save-finance-to-database", 'saveFinanceToDatabase')->name("saveFinanceToDatabase");
        Route::post("/update-finance-to-database", 'updateFinanceToDatabase')->name("updateFinanceToDatabase");
        Route::delete("/delete-finance-to-database", 'deleteFinanceToDatabase')->name("deleteFinanceToDatabase");
    });

});
