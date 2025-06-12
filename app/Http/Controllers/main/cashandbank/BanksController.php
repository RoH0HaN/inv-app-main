<?php

namespace App\Http\Controllers\main\cashandbank;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BanksController extends Controller
{
    public function index(Request $request){
        // Initial query
        $query = DB::table('bank_accounts');

        // Apply search if present
        if ($request->filled('search')) {
            $searchTerm = $request->search;

            $query->where(function ($q) use ($searchTerm) {
                $q->where('account_holder_name', 'like', "%$searchTerm%")
                ->orWhere('bank_name', 'like', "%$searchTerm%")
                ->orWhere('account_number', 'like', "%$searchTerm%")
                ->orWhere('ifsc_code', 'like', "%$searchTerm%");
            });
        }

        // Paginate result
        $bankAccounts = $query->paginate(15);

        // Fetch all access records in one query
        $accessRecords = DB::table('bank_account_access')
            ->whereIn('bank_account_id', $bankAccounts->pluck('id'))
            ->get()
            ->groupBy('bank_account_id');
        
        $balances = DB::table('bank_transactions')
            ->select('bank_account_id', DB::raw('SUM(amount) as total'))
            ->whereIn('bank_account_id', $bankAccounts->pluck('id'))
            ->groupBy('bank_account_id')
            ->pluck('total', 'bank_account_id');


        // Attach access records to each bank account
        foreach ($bankAccounts as $bank) {

            $bank->balance = ($balances[$bank->id] ?? 0) + $bank->opening_balance;


            $bank->access = $accessRecords[$bank->id] ?? collect();
        }

        // Fetch related warehouses and outlets
        $warehouses = DB::table('warehouses')->select('id', 'organization_name')->get();
        $outlets = DB::table('outlets')->select('id', 'organization_name')->get();

        return view('main.cashandbank.banks', [
            'bankAccounts' => $bankAccounts,
            'warehouses'   => $warehouses,
            'outlets'      => $outlets,
        ]);
    }


    public function addBankAccount() {
        $warehouses = DB::table('warehouses')->select(['id', 'organization_name'])->get();
        $outlets = DB::table('outlets')->select(['id', 'organization_name'])->get();
        
        return view('main.cashandbank.add-bank-account', ['warehouses' => $warehouses, 'outlets' => $outlets]);
    }

    public function viewAccountDetails(Request $request){
        $bankId = $request->bank_id;

        if (!$bankId) {
            return redirect()->back()->with('error', 'Bank ID not provided.');
        }

        $bank = DB::table('bank_accounts')->where('id', $bankId)->first();

        if (!$bank) {
            return redirect()->back()->with('error', 'Bank not found.');
        }

        // Always show base opening balance
        $openingBalance = $bank->opening_balance;
        $transactions = collect(); // Use collection for safe methods like ->sum()
        $creditAmount = 0;
        $debitAmount = 0;
        $closingBalance = $openingBalance;

        // Only compute if from and to are set
        if ($request->filled(['from', 'to'])) {
            $fromDate = Carbon::parse($request->from)->startOfDay();
            $toDate = Carbon::parse($request->to)->endOfDay();

            // Transactions before date range for opening balance
            $transactionsBefore = DB::table('bank_transactions')
                ->where('bank_account_id', $bankId)
                ->where('created_at', '<', $fromDate)
                ->sum('amount');

            $openingBalance += $transactionsBefore;

            // Fetch filtered transactions
            $transactions = DB::table('bank_transactions')
                ->where('bank_account_id', $bankId)
                ->whereBetween('created_at', [$fromDate, $toDate])
                ->orderBy('created_at', 'desc')
                ->get();

            $creditAmount = $transactions->where('amount', '>', 0)->sum('amount');
            $debitAmount = $transactions->where('amount', '<', 0)->sum('amount') * -1; // convert to positive

            $closingBalance = $openingBalance + $transactions->sum('amount');
        }

        return view('main.cashandbank.account-details', [
            'bank' => $bank,
            'transactions' => $transactions,
            'creditAmount' => $creditAmount,
            'debitAmount' => $debitAmount,
            'openingBalance' => $openingBalance,
            'closingBalance' => $closingBalance,
        ]);
    }

    public function saveBankAccountToDatabase(Request $request) {
        if(Auth::user()->role !== 'admin'){
            return redirect()->back()->with('error', 'You do not have permission to do that action.');
        }
        $selectedLocations = $request->input('location_ids', []); // array of 'warehouse_1', 'outlet_3', etc.

        // You can split this later to differentiate between warehouses and outlets
        $warehouseIds = collect($selectedLocations)
            ->filter(fn($id) => str_starts_with($id, 'warehouse_'))
            ->map(fn($id) => (int) str_replace('warehouse_', '', $id));

        $outletIds = collect($selectedLocations)
            ->filter(fn($id) => str_starts_with($id, 'outlet_'))
            ->map(fn($id) => (int) str_replace('outlet_', '', $id));

        $request->validate([
            'account_holder_name' => 'required|string|max:100',
            'account_number' => 'required|string|max:50',
            'bank_name' =>'required|string|max:100',
            'ifsc_code' =>'required|string|max:20',
            'opening_balance' =>'required|numeric',
            'location_ids' => 'required|array|min:1',
        ]);

        try {
            DB::beginTransaction();

            $bankAccountId = DB::table('bank_accounts')->insertGetId([
                'account_holder_name' => $request->account_holder_name,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'ifsc_code' => $request->ifsc_code,
                'opening_balance' => $request->opening_balance,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($warehouseIds as $warehouseId) {
                DB::table('bank_account_access')->insert([
                    'bank_account_id' => $bankAccountId,
                    'location_id' => $warehouseId,
                    'location_type' => 'warehouse',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            foreach ($outletIds as $outletId) {
                DB::table('bank_account_access')->insert([
                    'bank_account_id' => $bankAccountId,
                    'location_id' => $outletId,
                    'location_type' => 'outlet',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Bank account saved successfully.');
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while saving the bank account.');
        }

    }

    public function updateBankAccount(Request $req){
        if(Auth::user()->role !== 'admin'){
            return redirect()->back()->with('error', 'You do not have permission to do that action.');
        }
        $bankId = $req->id;
        $req->validate([
            'id' => 'required|exists:bank_accounts,id',
            'account_holder_name' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:50',
            'ifsc_code' => 'nullable|string|max:20',
            'opening_balance' => 'nullable|numeric',
            'location_ids' => 'array',
        ]);

        // Update bank_accounts table
        DB::table('bank_accounts')->where('id', $req->id)->update([
            'account_holder_name' => $req->account_holder_name,
            'bank_name' => $req->bank_name,
            'account_number' => $req->account_number,
            'ifsc_code' => $req->ifsc_code,
            'opening_balance' => $req->opening_balance,
            'updated_at' => now()
        ]);

        DB::table('bank_account_access')->where('bank_account_id', $bankId)->delete();

        // Step 3: Re-insert the new access entries
        $locationIds = $req->location_ids ?? [];

        $accessData = collect($locationIds)->map(function ($value) use ($bankId) {
            [$type, $id] = explode('_', $value);
            return [
                'bank_account_id' => $bankId,
                'location_type' => $type,
                'location_id' => (int)$id,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray();

        if (!empty($accessData)) {
            DB::table('bank_account_access')->insert($accessData);
        }


        return redirect()->back()->with('success', 'Bank account updated successfully.');
    }

    public function adjustBankAccount(Request $req){
        // accessing session to fetch user entity [warehouse, outlet]
        $entity = session('user_entity');

        $bankAccount = DB::table('bank_accounts')->where('id', $req->id)->first();
        if (!$bankAccount) {
            return redirect()->back()->with('error', 'Bank account not found!');
        }

        if($entity){
            $bankAccountAccess = DB::table('bank_account_access')
                ->where('bank_account_id', $bankAccount->id)
                ->where('location_id', $entity['id'])
                ->where('location_type', $entity['type'])
                ->first();

            if (!$bankAccountAccess) {
                return redirect()->back()->with('error', 'You do not have permission to adjust this bank account!');
            }
        }else{
            return redirect()->back()->with('error', 'Admin or Viewer cannot adjust bank account!');
        }


        $amount = 0;
        if($req->type == 'withdraw'){
            $amount -= $req->amount;
        }else{
            $amount += $req->amount;
        }

        DB::table('bank_transactions')->insert([
            'bank_account_id' => $bankAccount->id,
            'amount' => $amount,
            'transaction_type' => 'adjustment',
            'method' => 'cash_'.$req->type,
            'reference_number' => 'REF-ADJ-' . now()->format('YmdHis') . '-' . mt_rand(100, 999),
            'source_type' => '(Adjustment) cash_'.$req->type,
            'note' => $req->note,
            'created_by_id' => Auth::user()->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Bank account adjusted successfully!');
    }

    public function deleteBankAccount(Request $req){
        if(Auth::user()->role !== 'admin'){
            return redirect()->back()->with('error', 'You do not have permission to do that action.');
        }
        // Fetch bank-account record
        $bankAccount = DB::table('bank_accounts')->where('id', $req->id)->first();
        if (!$bankAccount) {
            return redirect()->back()->with('error', 'Bank account not found!');
        }
        DB::table('bank_accounts')->where('id', $req->id)->delete();
        return redirect()->back()->with('success', 'Bank account deleted successfully!');
    }
}