<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $casts    = [
        'expires_at' => 'datetime'
    ];
    protected $fillable = [
        'url',
        'short_uri',
        'expires_at',
        'is_commercial',
        'visitor_ip',
    ];

    public function statistic()
    {
        return $this->hasMany(
            LinkStatistic::class,
            'link_id',
            'id'
        );
    }

    public function getUniqueUsersLast14DaysAttribute()
    {
        return $this->statistic()
            ->select(['visitor_ip'])
            ->where('visit_at', '>', Carbon::now()->subDays(14))
            ->distinct('visitor_ip')
            ->count();
    }
}
