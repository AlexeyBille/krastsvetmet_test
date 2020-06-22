<?php


namespace App\Service;


use App\Models\Link;
use App\Models\LinkStatistic;
use App\Repository\LinkStatisticRepository;
use App\Utils\CommercialImageService;
use Carbon\Carbon;

class LinkStatisticService
{
    /**
     * @var CommercialImageService
     */
    private $commercialImageService;
    /**
     * @var LinkStatisticRepository
     */
    private $linkStatisticRepository;

    /**
     * LinkStatisticService constructor.
     * @param CommercialImageService $commercialImageService
     * @param LinkStatisticRepository $linkStatisticRepository
     */
    public function __construct(
        CommercialImageService $commercialImageService,
        LinkStatisticRepository $linkStatisticRepository
    )
    {
        $this->commercialImageService  = $commercialImageService;
        $this->linkStatisticRepository = $linkStatisticRepository;
    }

    public function reach(Link $link, string $ip): LinkStatistic
    {
        $commercialImage = $link->is_commercial ? $this->commercialImageService->getRandomCommercialImage() : null;

        $linkStatistic             = new LinkStatistic();
        $linkStatistic->link_id    = $link->id;
        $linkStatistic->visitor_ip = $ip;
        $linkStatistic->visit_at            = Carbon::now();
        $linkStatistic->commercial_image    = $commercialImage;

        $linkStatistic->save();

        return $linkStatistic;
    }

}
