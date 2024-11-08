<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Material;
use App\Models\InventoryMovementConfiguration;
use App\Models\InventoryMovement;
use App\Models\Setting;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class InventoryMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $setting = Setting::init();
        if ($request->ajax()) {
            $data = InventoryMovement::with(['inventory_movement_configuration', 'user'])->latest()->get();
            return Datatables::of($data)
                ->editColumn('user_id', function($inventory_movement) {
                    return $inventory_movement->user ? $inventory_movement->user->name : '';
                })
                ->editColumn('inventory_movement_configuration_id', function($inventory_movement) {
                    return $inventory_movement->inventory_movement_configuration_id ? $inventory_movement->inventory_movement_configuration_id->name : '';
                })
                ->editColumn('date', function ($inventory_movement) {
                    return $inventory_movement->date ? Carbon::parse($inventory_movement->date)->format('d-m-Y') : '';
                })
                ->editColumn('created_at', function ($inventory_movement) {
                    return $inventory_movement->created_at ? $inventory_movement->created_at->format('d-m-Y H:i') : '';
                })
                ->make(true);
        }
        return view('inventory_movement.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::init();
        $inventory_movement_configurations = InventoryMovementConfiguration::all();
        $materials = Material::all();
        return view('inventory_movement.create', compact('inventory_movement_configurations', 'setting', 'materials'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $setting = Setting::get()->first();
        $request->merge([
            'debit' => floatval(str_replace($setting->decimal_separator, '.', str_replace($setting->thousand_separator, '', $request->debit))),
            'credit' => floatval(str_replace($setting->decimal_separator, '.', str_replace($setting->thousand_separator, '', $request->credit))),
            'details' => array_map(function ($detail) use ($setting) {
                $detail['debit'] = floatval(str_replace($setting->decimal_separator, '.', str_replace($setting->thousand_separator, '', $detail['debit'])));
                $detail['credit'] = floatval(str_replace($setting->decimal_separator, '.', str_replace($setting->thousand_separator, '', $detail['credit'])));
                return $detail;
            }, $request->details)
        ]);

        $request->request->add(["user_id" => Auth()->user()->id]);
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'code' => 'required|string|max:255|unique:inventory_movements,code',
            'date' => 'required',
            'debit' => 'required',
            'credit' => 'required',
            'details' => 'required|array',
            'details.*.inventory_movement_configuration_id' => 'required|exists:inventory_movement_configurations,id',
            'details.*.description' => 'nullable|string|max:255',
            'details.*.debit' => 'required|numeric',
            'details.*.credit' => 'required|numeric',
        ]);
        DB::beginTransaction();
        try {
            $inventory_movement = InventoryMovement::create([
                'user_id' => $request->user_id,
                'code' => $request->code,
                'date' => $request->date,
                'debit' => $request->debit,
                'credit' => $request->credit,
            ]);
            foreach ($request->details as $detail) {
                $inventory_movement->inventory_movement_entry()->create([
                    'inventory_movement_configuration_id' => $detail['inventory_movement_configuration_id'],
                    'description' => $detail['description'],
                    'debit' => $detail['debit'],
                    'credit' => $detail['credit'],
                ]);
            }
            DB::commit();
            return redirect()->route('inventory_movement.index')->with('success', 'InventoryMovement has been created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['fail' => 'Failed to create inventory_movement: ' . $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InventoryMovement $inventory_movement)
    {
        $setting = Setting::init();
        $inventory_movement_configurations = InventoryMovementConfiguration::all();
        return view('inventory_movement.edit', compact('inventory_movement', 'inventory_movement_configurations', 'setting'));
    }

    public function show(InventoryMovement $inventory_movement)
    {
        $setting = Setting::init();
        return view('inventory_movement.show', compact('inventory_movement', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $setting = Setting::init();
        $request->merge([
            'debit' => floatval(str_replace($setting->decimal_separator, '.', str_replace($setting->thousand_separator, '', $request->debit))),
            'credit' => floatval(str_replace($setting->decimal_separator, '.', str_replace($setting->thousand_separator, '', $request->credit))),
            'details' => array_map(function ($detail) use ($setting) {
                $detail['debit'] = floatval(str_replace($setting->decimal_separator, '.', str_replace($setting->thousand_separator, '', $detail['debit'])));
                $detail['credit'] = floatval(str_replace($setting->decimal_separator, '.', str_replace($setting->thousand_separator, '', $detail['credit'])));
                return $detail;
            }, $request->details)
        ]);

        $request->validate([
            'date' => 'required|date',
            'debit' => 'required|numeric',
            'credit' => 'required|numeric',
            'details' => 'required|array',
            'details.*.inventory_movement_configuration_id' => 'required|exists:inventory_movement_configurations,id',
            'details.*.description' => 'required|string',
            'details.*.debit' => 'required|numeric',
            'details.*.credit' => 'required|numeric',
        ]);

        DB::beginTransaction();
        try {
            $inventory_movement = InventoryMovement::findOrFail($id);
            $inventory_movement->date = $request->date;
            $inventory_movement->debit = $request->debit;
            $inventory_movement->credit = $request->credit;
            $inventory_movement->save();
            $inventory_movement->inventory_movement_entry()->delete();
            foreach ($request->details as $detail) {
                $inventory_movement->inventory_movement_entry()->create([
                    'inventory_movement_configuration_id' => $detail['inventory_movement_configuration_id'],
                    'description' => $detail['description'],
                    'debit' => $detail['debit'],
                    'credit' => $detail['credit'],
                ]);
            }
            DB::commit();
            return redirect()->route('inventory_movement.index')->with('success', 'InventoryMovement updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['fail' => 'Failed to update inventory_movement: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $inventory_movement = InventoryMovement::findOrFail($id);
        foreach($inventory_movement->inventory_movement_entry as $inventory_movement_entry){
            $inventory_movement_entry->delete();
        }
        $inventory_movement->delete();
        return redirect()->back()->with("success", "InventoryMovement has been deleted.");
    }
}
