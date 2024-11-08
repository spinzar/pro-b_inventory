<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $setting = Setting::init();
        if ($request->ajax()) {
            $data = Warehouse::latest()->get();
            return Datatables::of($data)
                ->make(true);
        }
        return view('warehouse.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::init();
        return view('warehouse.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:warehouses,name',
        ]);

        Warehouse::create($request->all());
        return redirect()->route('warehouse.index')->with('success', 'Warehouse has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse)
    {
        $setting = Setting::init();
        return view('warehouse.edit', compact('warehouse', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:warehouses,name,' . $warehouse->id,
        ]);
        self::updateColumn($warehouse, $request);
        $warehouse->update($request->all());
        return redirect()->route('warehouse.index')->with('success', 'Warehouse has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();
        return redirect()->back()->with("success", "Warehouse has been deleted.");
    }

    public static function updateColumn($warehouse, $request)
    {
        $old_column_name = str_replace(' ', '_', $warehouse->name);
        $new_column_name = str_replace(' ', '_', $request->name);
        $queries = [
            "ALTER TABLE materials CHANGE COLUMN `{$old_column_name}` `{$new_column_name}` FLOAT NULL",
        ];
        foreach ($queries as $query) {
            DB::statement($query);
        }
    }
}
