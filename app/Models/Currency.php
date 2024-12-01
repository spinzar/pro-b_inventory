<?php

namespace App\Models;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::created(function ($currency) {
            static::logActivity($currency, "Currency '{$currency->name}' was created.");
        });

        static::updated(function ($currency) {
            static::logActivity($currency, "Currency '{$currency->name}' was updated.");
        });

        static::deleted(function ($currency) {
            static::logActivity($currency, "Currency '{$currency->name}' was deleted.");
        });
    }

    /**
     * Log an activity for the currency model.
     *
     * @param  \App\Models\Currency  $currency
     * @param  string  $description
     * @return void
     */
    protected static function logActivity($currency, $description)
    {
        ActivityLog::create([
            'user_id' => Auth::check() ? Auth::id() : null, // Fallback to null if unauthenticated
            'description' => $description,
        ]);
    }
}
