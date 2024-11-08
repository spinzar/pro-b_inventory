<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovementConfiguration extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($inventory_movement_configuration) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "InventoryMovementConfiguration '{$inventory_movement_configuration->name}' was created.",
            ]);
        });

        static::updated(function ($inventory_movement_configuration) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "InventoryMovementConfiguration '{$inventory_movement_configuration->name}' was updated.",
            ]);
        });

        static::deleted(function ($inventory_movement_configuration) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "InventoryMovementConfiguration '{$inventory_movement_configuration->name}' was deleted.",
            ]);
        });
    }
}
