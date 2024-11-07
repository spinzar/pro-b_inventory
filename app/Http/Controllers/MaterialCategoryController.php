<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\MaterialCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MaterialCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $setting = Setting::init();
        if ($request->ajax()) {
            $data = MaterialCategory::latest()->get();
            return Datatables::of($data)
                ->make(true);
        }
        return view('material_category.index', compact('setting'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $setting = Setting::init();
        return view('material_category.create', compact('setting'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:material_categorys,name',
        ]);

        MaterialCategory::create($request->all());
        return redirect()->route('material_category.index')->with('success', 'MaterialCategory has been created.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MaterialCategory $material_category)
    {
        $setting = Setting::init();
        return view('material_category.edit', compact('material_category', 'setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MaterialCategory $material_category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:material_categorys,name,' . $material_category->id,
        ]);

        $material_category->update($request->all());
        return redirect()->route('material_category.index')->with('success', 'MaterialCategory has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $material_category = MaterialCategory::findOrFail($id);
        $material_category->delete();
        return redirect()->back()->with("success", "MaterialCategory has been deleted.");
    }
}
