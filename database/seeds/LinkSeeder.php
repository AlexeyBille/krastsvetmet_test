<?php

use App\Models\Link;
use App\Models\LinkStatistic;
use App\Utils\CommercialImageService;
use Illuminate\Database\Seeder;

class LinkSeeder extends Seeder
{
    /**
     * @var CommercialImageService
     */
    private $commercialImageService;

    public function __construct(CommercialImageService $commercialImageService)
    {
        $this->commercialImageService = $commercialImageService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Link::class, 100)->create()->each(function (Link $link) {
            factory(LinkStatistic::class, 50)->create([
                'link_id' => $link->id,
                'commercial_image' => $link->is_commercial ? $this->commercialImageService->getRandomCommercialImage() : null
            ]);
        });
    }
}
