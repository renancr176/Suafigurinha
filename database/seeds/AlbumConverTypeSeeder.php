<?php

use Illuminate\Database\Seeder;

class AlbumConverTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\AlbumCoverType::create([
            'title' => 'Capa'
        ]);

        App\AlbumCoverType::create([
            'title' => 'Contra capa'
        ]);
    }
}
