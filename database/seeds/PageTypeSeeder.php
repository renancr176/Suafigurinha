<?php

use Illuminate\Database\Seeder;

class PageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\PageType::create([
            'type' => 'Apresentação quadrada',
            'custom' => true,
            'width' => 210,
            'height' => 210
        ]);

        App\PageType::create([
            'type' => 'Apresentação quadrada com sangria',
            'custom' => true,
            'width' => 215,
            'height' => 215
        ]);

        App\PageType::create([
            'type' => 'Apresentação retangular',
            'custom' => true,
            'used_on_print' => false,
            'width' => 153,
            'height' => 215
        ]);

        App\PageType::create([
            'type' => 'Impressão quadrada',
            'custom' => true,
            'used_on_print' => true,
            'width' => 240.4,
            'height' => 240.4
        ]);

        App\PageType::create([
            'type' => 'Impressão quadrada combinada',
            'custom' => true,
            'used_on_print' => true,
            'width' => 510.4,
            'height' => 360.4
        ]);

        App\PageType::create([
            'type' => 'Impressão retangular',
            'custom' => true,
            'used_on_print' => true,
            'width' => 178.4,
            'height' => 240.4
        ]);

        App\PageType::create([
            'type' => 'Impressão figurinha',
            'custom' => true,
            'used_on_print' => true,
            'width' => 330,
            'height' => 480
        ]);


    }
}
