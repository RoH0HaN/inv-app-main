<?php

namespace App\Http\Controllers\main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index() {
        return view('main.contacts.suppliers');
    }

    public function createSupplier() {
        return view('main.contacts.createsupplier');
    }

    public function paymentOut() {
        return view('main.contacts.paymentout');
    }

    public function supplierPayment() {
        return view('main.contacts.supplierpayment');
    }

    public function supplierPaymentHistory() {
        return view('main.contacts.supplierpaymenthistory');
    }

    public function creditNoteHistory() {
        return view('main.contacts.creditnotehistory');
    }

    public function debitNoteHistory() {
        return view('main.contacts.debitnotehistory');
    }

    public function createCreditNote() {
        return view('main.contacts.createcreditnote');
    }

    public function createDebitNote() {
        return view('main.contacts.createdebitnote');
    }
}
