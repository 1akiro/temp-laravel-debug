<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
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

}
