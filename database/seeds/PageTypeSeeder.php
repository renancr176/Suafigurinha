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
            'type' => 'Normal apresentação',
            'custom' => true,
            'width' => 210,
            'height' => 210
        ]);

        App\PageType::create([
            'type' => 'Normal impressão',
            'custom' => true,
            'used_on_print' => true,
            'width' => 240.4,
            'height' => 240.4
        ]);

        App\PageType::create([
            'type' => 'Normal impressão capa dura',
            'custom' => true,
            'used_on_print' => true,
            'width' => 510.4,
            'height' => 360.4
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
