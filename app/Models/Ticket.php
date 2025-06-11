<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\TicketTopic;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'topic_id',
        'message'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function topic() {
        return $this->belongsTo(TicketTopic::class, 'topic_id');
    }
}
