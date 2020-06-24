<?php

use Illuminate\Database\Seeder;

class FontSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Font::create([
            'title' => 'Rage Italic',
            'path' => 'files/fonts/rage-italic.ttf'
        ]);

        App\Font::create([
            'title' => 'Stefont',
            'path' => 'files/fonts/Stefont.ttf'
        ]);
    }
}
