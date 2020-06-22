<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkStatistic extends Model
{
    protected $fillable = [
        'link_id',
        'visitor_ip',
        'visit_at',
        'commercial_image'
    ];

    public function link()
    {
        return $this->belongsTo(
            LinkStatistic::class,
            'link_id',
            'id'
        );
    }
}
