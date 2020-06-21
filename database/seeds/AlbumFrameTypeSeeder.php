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
        DB::table('album_frame_types')->truncate();

        App\AlbumFrameType::create([
            'title' => 'Pequeno',
            'image_path' => '',
            'width' => '',
            'height' => ''
        ]);

        App\AlbumFrameType::create([
            'title' => 'Médio',
            'image_path' => '',
            'width' => '',
            'height' => ''
        ]);

        App\AlbumFrameType::create([
            'title' => 'Grande',
            'image_path' => '',
            'width' => '',
            'height' => ''
        ]);
    }
}
