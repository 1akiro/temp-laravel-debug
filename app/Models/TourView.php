<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourView extends Model
{
    protected $fillable = [
        'tour_id',
        'user_id',
        'ip_address',
        'user_agent',
        'viewed_at',
    ];

    public $timestamps = false;

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
