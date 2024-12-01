<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'description',
    ];

    /**
     * Relationship: The user associated with the activity log.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Create a new activity log entry.
     *
     * @param  string  $description
     * @param  int|null  $userId
     * @return \App\Models\ActivityLog
     */
    public static function log($description, $userId = null)
    {
        return self::create([
            'user_id' => $userId ?? (Auth::check() ? Auth::id() : null),
            'description' => $description,
        ]);
    }
}
