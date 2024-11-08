<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\InventoryMovementConfiguration;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InventoryMovementConfigurationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $setting = Setting::init();
        if ($request->ajax()) {
            $data = InventoryMovementConfiguration::latest()->get();
            return Datatables::of($data)
                ->make(true);
        }
        return view('inventory_movement_configuration.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::init();
        return view('inventory_movement_configuration.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:inventory_movement_configurations,name',
            'code' => 'required|string|max:255|unique:inventory_movement_configurations,name',
            'stock' => 'required',
        ]);

        InventoryMovementConfiguration::create($request->all());
        return redirect()->route('inventory_movement_configuration.index')->with('success', 'InventoryMovementConfiguration has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryMovementConfiguration $inventory_movement_configuration)
    {
        $setting = Setting::init();
        return view('inventory_movement_configuration.edit', compact('inventory_movement_configuration', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InventoryMovementConfiguration $inventory_movement_configuration)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:inventory_movement_configurations,name,' . $inventory_movement_configuration->id,
            'code' => 'required|string|max:255|unique:inventory_movement_configurations,code,' . $inventory_movement_configuration->id,
            'stock' => 'required',
        ]);

        $inventory_movement_configuration->update($request->all());
        return redirect()->route('inventory_movement_configuration.index')->with('success', 'InventoryMovementConfiguration has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $inventory_movement_configuration = InventoryMovementConfiguration::findOrFail($id);
        $inventory_movement_configuration->delete();
        return redirect()->back()->with("success", "InventoryMovementConfiguration has been deleted.");
    }
}
