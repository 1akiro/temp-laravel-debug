<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $fillable = [
        'role'
    ];
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
