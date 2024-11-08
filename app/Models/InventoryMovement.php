<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovement extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inventory_movement(){
        return $this->belongsTo(InventoryMovement::class);
    }

    public function inventory_movement_entry(){
        return $this->hasMany(InventoryMovementEntry::class);
    }

    protected static function booted()
    {
        static::created(function ($inventory_movement) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "InventoryMovement '{$inventory_movement->code}' was created.",
            ]);
        });

        static::updated(function ($inventory_movement) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "InventoryMovement '{$inventory_movement->code}' was updated.",
            ]);
        });

        static::deleted(function ($inventory_movement) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "InventoryMovement '{$inventory_movement->code}' was deleted.",
            ]);
        });
    }
}
