<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialCategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($material_category) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "MaterialCategory '{$material_category->name}' was created.",
            ]);
        });

        static::updated(function ($material_category) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "MaterialCategory '{$material_category->name}' was updated.",
            ]);
        });

        static::deleted(function ($material_category) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "MaterialCategory '{$material_category->name}' was deleted.",
            ]);
        });
    }
}
