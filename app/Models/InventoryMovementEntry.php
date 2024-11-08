<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryMovementEntry extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function inventory_movement(){
        return $this->belongsTo(InventoryMovement::class);
    }

    public function material(){
        return $this->belongsTo(Material::class);
    }
}
