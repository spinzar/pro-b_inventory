<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($unit) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Unit '{$unit->name}' was created.",
            ]);
        });

        static::updated(function ($unit) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Unit '{$unit->name}' was updated.",
            ]);
        });

        static::deleted(function ($unit) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Unit '{$unit->name}' was deleted.",
            ]);
        });
    }
}
