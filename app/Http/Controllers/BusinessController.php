<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Business;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $setting = Setting::init();
        if ($request->ajax()) {
            $data = Business::latest()->get();
            return Datatables::of($data)
                ->make(true);
        }
        return view('business.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::init();
        return view('business.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:businesss,name',
        ]);

        Business::create($request->all());
        return redirect()->route('business.index')->with('success', 'Business has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        $setting = Setting::init();
        return view('business.edit', compact('business', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:businesss,name,' . $business->id,
        ]);

        $business->update($request->all());
        return redirect()->route('business.index')->with('success', 'Business has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $business = Business::findOrFail($id);
        $business->delete();
        return redirect()->back()->with("success", "Business has been deleted.");
    }
}
