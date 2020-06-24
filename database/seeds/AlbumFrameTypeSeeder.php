<?php

use Illuminate\Database\Seeder;

class AlbumFrameTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\AlbumFrameType::create([
            'font_id' => 1,
            'title' => 'Pequeno',
            'font_size' => '24',
            'image_path' => 'files/images/albuns/frames/default.png',
            'width' => '100',
            'height' => '100'
        ]);

        App\AlbumFrameType::create([
            'font_id' => 1,
            'title' => 'Médio',
            'font_size' => '45',
            'image_path' => 'files/images/albuns/frames/default.png',
            'width' => '250',
            'height' => '250'
        ]);

        App\AlbumFrameType::create([
            'font_id' => 1,
            'title' => 'Grande',
            'font_size' => '72',
            'image_path' => 'files/images/albuns/frames/default.png',
            'width' => '400',
            'height' => '400'
        ]);
    }
}
