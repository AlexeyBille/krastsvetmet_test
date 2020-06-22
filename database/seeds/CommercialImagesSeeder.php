<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CommercialImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::disk('public')->makeDirectory('commercial_images');

        for ($i = 0; $i < 10; $i++) {
            $this->command->getOutput()->writeln('<comment>Image #' . $i . ':</comment> seeding ');
            Storage::disk('public')
                ->put(
                    config('statistic.commercial_images_dir') . '/image_' . $i . '.jpg',
                    file_get_contents('https://picsum.photos/640/480')
                );
            $this->command->getOutput()->writeln('<info>Image #' . $i . ':</info> seeded');
        }
    }
}
