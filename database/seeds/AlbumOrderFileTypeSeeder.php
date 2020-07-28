<?php

use Illuminate\Database\Seeder;

class AlbumOrderFileTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\AlbumOrderFileType::create([
            'title' => 'Figurinha'
        ]);

        App\AlbumOrderFileType::create([
            'title' => 'Fundo'
        ]);

        App\AlbumOrderFileType::create([
            'title' => 'Album'
        ]);

        App\AlbumOrderFileType::create([
            'title' => 'Gabarito'
        ]);
    }
}
