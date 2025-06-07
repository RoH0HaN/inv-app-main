<?php

namespace App\Http\Controllers\main\settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsOrganizationController extends Controller
{
    public function index() {
        $warehouses = DB::table('warehouses')->select(['id', 'organization_name'])->get();
        $outlets = DB::table('outlets')->get();
        $essentials = DB::table('essentials')->get();

        $signature = null;
        $t_and_c = null;

        foreach ($essentials as $essential) {
            if ($essential->key == "signature") {
                $signature = $essential->value;
            }

            if ($essential->key == "t_and_c") {
                $t_and_c = $essential->value;
            }
        }

        return view('main.settings.organization', ['warehouses' => $warehouses, 'outlets' => $outlets, 'signature' => $signature, 't_and_c' => $t_and_c]);
    }

    public function updateEssentials(Request $request){
        $essentials = DB::table('essentials')->pluck('value', 'key');

        // Handle Signature Image Upload
        if ($request->hasFile('signature')) {
            $file = $request->file('signature');

            // Delete old signature if exists
            if ($essentials->has('signature') && file_exists(public_path('uploads/essentials/' . $essentials['signature']))) {
                unlink(public_path('uploads/essentials/' . $essentials['signature']));
            }

            // Save new signature
            $filename = 'signature_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/essentials/'), $filename);
            $imagePath = 'uploads/essentials/' . $filename;

            // Update or insert in DB
            if ($essentials->has('signature')) {
                DB::table('essentials')->where('key', 'signature')->update([
                    'value' => $imagePath,
                ]);
            } else {
                DB::table('essentials')->insert([
                    'key' => 'signature',
                    'value' => $imagePath,
                ]);
            }
        }

        // Handle T&C Text
        if ($request->filled('t_and_c')) {
            $t_and_c = $request->input('t_and_c');
            if ($essentials->has('t_and_c')) {
                DB::table('essentials')->where('key', 't_and_c')->update([
                    'value' => $t_and_c,
                ]);
            } else {
                DB::table('essentials')->insert([
                    'key' => 't_and_c',
                    'value' => $t_and_c,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Essentials updated successfully!');
    }


}