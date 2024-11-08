<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function bulk_unit(){
        return $this->belongsTo(Unit::class, 'bulk_unit_id');
    }

    public function retail_unit(){
        return $this->belongsTo(Unit::class, 'retail_unit_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function material_category(){
        return $this->belongsTo(MaterialCategory::class);
    }

    protected static function booted()
    {
        static::created(function ($material) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Material '{$material->name}' was created.",
            ]);
        });

        static::updated(function ($material) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Material '{$material->name}' was updated.",
            ]);
        });

        static::deleted(function ($material) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Material '{$material->name}' was deleted.",
            ]);
        });
    }
}
