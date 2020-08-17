<?php

use Illuminate\Database\Seeder;

class BookbindingType extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\BookbindingType::create([
            'title' => 'Brochura'
        ]);

        App\BookbindingType::create([
            'title' => 'Capa Dura'
        ]);
    }
}
