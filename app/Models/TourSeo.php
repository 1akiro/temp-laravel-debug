<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TourSeo extends Model
{
    protected $fillable = [
        'tour_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public $timestamps = false;

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
