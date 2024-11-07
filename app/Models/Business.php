<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($business) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Business '{$business->name}' was created.",
            ]);
        });

        static::updated(function ($business) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Business '{$business->name}' was updated.",
            ]);
        });

        static::deleted(function ($business) {
            ActivityLog::create([
                'user_id' => Auth()->user()->id,
                'description' => "Business '{$business->name}' was deleted.",
            ]);
        });
    }
}
