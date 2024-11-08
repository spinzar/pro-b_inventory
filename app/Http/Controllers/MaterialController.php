<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Brand;
use App\Models\Setting;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\MaterialCategory;
use Yajra\DataTables\DataTables;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $setting = Setting::init();
        if ($request->ajax()) {
            $data = Material::with(['bulk_unit', 'retail_unit', 'brand', 'material_category'])->latest()->get();
            return Datatables::of($data)
                ->editColumn('bulk_unit_id', function($row) {
                    return $row->bulk_unit ? $row->bulk_unit->symbol : '-';
                })
                ->editColumn('retail_unit_id', function($row) {
                    return $row->retail_unit ? $row->retail_unit->symbol : '-';
                })
                ->editColumn('brand_id', function($row) {
                    return $row->brand ? $row->brand->name : '-';
                })
                ->editColumn('material_category_id', function($row) {
                    return $row->material_category ? $row->material_category->name : '-';
                })
                ->make(true);
        }
        return view('material.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::init();
        $units = Unit::all();
        $brands = Brand::all();
        $material_categories = MaterialCategory::all();
        return view('material.create', compact('units', 'setting', 'brands', 'material_categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $setting = Setting::init();
        $buyPrice = floatval(str_replace($setting->decimal_separator, '.', str_replace($setting->thousand_separator, '', $request->buy_price)));
        $sellPrice = floatval(str_replace($setting->decimal_separator, '.', str_replace($setting->thousand_separator, '', $request->sell_price)));
        $request->request->add(['buy_price' => $buyPrice, 'sell_price' => $sellPrice]);

        $validated = $request->validate([
            'bulk_unit_id' => 'required|exists:units,id',
            'retail_unit_id' => 'required|exists:units,id|different:bulk_unit_id',
            'brand_id' => 'required|exists:brands,id',
            'material_category_id' => 'required|exists:material_categories,id',
            'name' => 'required|string|max:255|unique:materials,name',
            'bulk_barcode' => 'nullable|string|max:255|unique:materials,bulk_barcode',
            'retail_barcode' => 'nullable|string|max:255|unique:materials,retail_barcode',
            'buy_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0|gte:buy_price',
        ]);

        Material::create($validated);
        return redirect()->route('material.index')->with('success', 'Material has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        $setting = Setting::init();
        $units = Unit::all();
        $brands = Brand::all();
        $material_categories = MaterialCategory::all();
        return view('material.edit', compact('material', 'units', 'setting', 'brands', 'material_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Material $material)
    {
        $setting = Setting::init();
        $buyPrice = floatval(str_replace($setting->decimal_separator, '.', str_replace($setting->thousand_separator, '', $request->buy_price)));
        $sellPrice = floatval(str_replace($setting->decimal_separator, '.', str_replace($setting->thousand_separator, '', $request->sell_price)));
        $request->request->add(['buy_price' => $buyPrice, 'sell_price' => $sellPrice]);

        $validated = $request->validate([
            'bulk_unit_id' => 'required|exists:units,id',
            'retail_unit_id' => 'required|exists:units,id|different:bulk_unit_id',
            'brand_id' => 'required|exists:brands,id',
            'material_category_id' => 'required|exists:material_categories,id',
            'name' => 'required|string|max:255|unique:materials,name,' . $material->id,
            'bulk_barcode' => 'nullable|string|max:255|unique:materials,bulk_barcode,' . $material->id,
            'retail_barcode' => 'nullable|string|max:255|unique:materials,retail_barcode,' . $material->id,
            'buy_price' => 'required|numeric|min:0',
            'sell_price' => 'required|numeric|min:0|gte:buy_price',
        ]);

        $material->update($validated);
        return redirect()->route('material.index')->with('success', 'Material has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return redirect()->back()->with("success", "Material has been deleted.");
    }
}
