<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityType extends Model
{
    protected $fillable = [
        'action',
        'description',
    ];

    public $timestamps = false;

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
