<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $fillable = [
        'title',
        'description',
        'company_name',
        'slug',
        'thumbnail',
        'tour_url',
        'user_id',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
