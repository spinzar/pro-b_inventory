<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Unit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $setting = Setting::init();
        if ($request->ajax()) {
            $data = Unit::latest()->get();
            return Datatables::of($data)
                ->make(true);
        }
        return view('unit.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::init();
        return view('unit.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:units,name',
            'symbol' => 'required|string|max:255|unique:units,symbol',
        ]);

        Unit::create($request->all());
        return redirect()->route('unit.index')->with('success', 'Unit has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
        $setting = Setting::init();
        return view('unit.edit', compact('unit', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:units,name,' . $unit->id,
            'symbol' => 'required|string|max:255|unique:units,symbol,' . $unit->id,
        ]);

        $unit->update($request->all());
        return redirect()->route('unit.index')->with('success', 'Unit has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        return redirect()->back()->with("success", "Unit has been deleted.");
    }
}
