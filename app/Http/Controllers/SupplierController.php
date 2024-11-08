<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Setting;
use App\Models\Business;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $setting = Setting::init();
        if ($request->ajax()) {
            $data = Supplier::with(['business'])->latest()->get();
            return Datatables::of($data)
                ->editColumn('business_id', function($row) {
                    return $row->business ? $row->business->name : '-';
                })
                ->make(true);
        }
        return view('supplier.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::init();
        $businesss = Business::all();
        return view('supplier.create', compact('businesss', 'setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'name' => 'required|string|max:255|unique:suppliers,name',
            'address' => 'required|string',
            'phone' => 'required|string|max:20|regex:/^\+?[0-9]+$/',
            'email' => 'nullable|email|max:255|unique:suppliers,email',
        ]);
        Supplier::create($validated);
        return redirect()->route('supplier.index')->with('success', 'Supplier has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        $setting = Setting::init();
        $businesss = Business::all();
        return view('supplier.edit', compact('supplier', 'businesss', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'business_id' => 'required|exists:businesses,id',
            'name' => 'required|string|max:255|unique:suppliers,name,' . $supplier->id,
            'address' => 'required|string',
            'phone' => 'required|string|max:20|regex:/^\+?[0-9]+$/',
            'email' => 'nullable|email|max:255|unique:suppliers,email',
        ]);
        $supplier->update($validated);
        return redirect()->route('supplier.index')->with('success', 'Supplier has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->back()->with("success", "Supplier has been deleted.");
    }
}
