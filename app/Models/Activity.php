<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'user_id',
        'tour_id',
        'action',
        'description',
        'created_at',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function activity()
    {
        return $this->belongsTo(ActivityType::class);
    }
}
