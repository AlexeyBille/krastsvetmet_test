<?php


namespace App\Service;


use App\Models\Link;
use App\Repository\LinkRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class LinkService
{
    /**
     * @var LinkRepository
     */
    private $linkRepository;

    public function __construct(LinkRepository $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    public function getValidLinkByUri(string $uri)
    {
        return $this->linkRepository->getLinkByUriAndExpireDate($uri, Carbon::now());
    }

    public function getAll(): Collection
    {
        return $this->linkRepository->all();
    }

    public function store(Link $link)
    {
        $link->save();
    }

}
