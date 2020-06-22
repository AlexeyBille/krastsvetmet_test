<?php


namespace App\Repository;

use App\Models\Link;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class LinkRepository
{
    /** @noinspection PhpIncompatibleReturnTypeInspection */
    public function getLinkByUriAndExpireDate(string $uri, \DateTime $time, $select = ['*']): ?Link
    {
        return Link::query()
            ->where('short_uri', $uri)
            ->where(function (Builder $query) use ($time) {
                $query->where('expires_at', '>', $time)
                    ->orWhereNull('expires_at');
            })
            ->first($select);
    }

    public function all($select = ['*']): Collection
    {
        return Link::all($select);
    }

}
