<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($brand) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Brand '{$brand->name}' was created.",
            ]);
        });

        static::updated(function ($brand) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Brand '{$brand->name}' was updated.",
            ]);
        });

        static::deleted(function ($brand) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Brand '{$brand->name}' was deleted.",
            ]);
        });
    }
}
