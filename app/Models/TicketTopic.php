<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;
class TicketTopic extends Model
{
    protected $fillable = [
        'topic',
    ];

    public function tickets () {
        return $this->hasMany(Ticket::class);
    }
}
