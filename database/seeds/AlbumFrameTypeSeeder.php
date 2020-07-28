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
            'font_size' => 24,
            'image_path' => '/files/images/albuns/frames/default.png',
            'width' => 60,
            'height' => 60,
            'x_position' => 22,
            'y_position' => 10,
            'sequence_font_size' => 45
        ]);

        App\AlbumFrameType::create([
            'font_id' => 1,
            'title' => 'Médio',
            'font_size' => '45',
            'image_path' => '/files/images/albuns/frames/default.png',
            'width' => '72',
            'height' => '72',
            'x_position' => 27,
            'y_position' => 16,
            'sequence_font_size' => 45
        ]);

        App\AlbumFrameType::create([
            'font_id' => 1,
            'title' => 'Grande',
            'font_size' => '72',
            'image_path' => '/files/images/albuns/frames/default.png',
            'width' => '86',
            'height' => '86',
            'x_position' => 32,
            'y_position' => 20,
            'sequence_font_size' => 45
        ]);
    }
}
