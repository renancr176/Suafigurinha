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
            'title' => 'Página de album gerada'
        ]);
    }
}
