<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($warehouse) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Warehouse '{$warehouse->name}' was created.",
            ]);
        });

        static::updated(function ($warehouse) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Warehouse '{$warehouse->name}' was updated.",
            ]);
        });

        static::deleted(function ($warehouse) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Warehouse '{$warehouse->name}' was deleted.",
            ]);
        });
    }
}
