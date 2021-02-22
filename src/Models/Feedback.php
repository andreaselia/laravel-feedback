<?php

namespace AndreasElia\Feedback\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /** @var array */
    protected $fillable = [
        'type',
        'text',
        'screenshot',
    ];

    public function scopeFilter($query, $period = 'today')
    {
        if ($period !== 'today') {
            [$interval, $unit] = explode('_', $period);

            return $query->where('created_at', '>=', now()->sub($unit, $interval));
        }

        return $query->whereDate('created_at', today());
    }
}
