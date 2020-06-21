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
        DB::table('page_types')->truncate();

        App\PageType::create([
            'type' => 'A0',
            'width' => '841',
            'height' => '1189'
        ]);

        App\PageType::create([
            'type' => 'A1',
            'width' => '594',
            'height' => '841'
        ]);

        App\PageType::create([
            'type' => 'A2',
            'width' => '420',
            'height' => '594'
        ]);

        App\PageType::create([
            'type' => 'A3',
            'width' => '297',
            'height' => '420'
        ]);

        App\PageType::create([
            'type' => 'A4',
            'width' => '210',
            'height' => '297'
        ]);

        App\PageType::create([
            'type' => 'A5',
            'width' => '148',
            'height' => '210'
        ]);

        App\PageType::create([
            'type' => 'A6',
            'width' => '105',
            'height' => '148'
        ]);

        App\PageType::create([
            'type' => 'A7',
            'width' => '74',
            'height' => '105'
        ]);

        App\PageType::create([
            'type' => 'A8',
            'width' => '52',
            'height' => '74'
        ]);

        App\PageType::create([
            'type' => 'A9',
            'width' => '37',
            'height' => '52'
        ]);

        App\PageType::create([
            'type' => 'A10',
            'width' => '26',
            'height' => '37'
        ]);

        App\PageType::create([
            'type' => 'B0',
            'width' => '1000',
            'height' => '1414'
        ]);

        App\PageType::create([
            'type' => 'B1',
            'width' => '707',
            'height' => '1000'
        ]);

        App\PageType::create([
            'type' => 'B2',
            'width' => '500',
            'height' => '707'
        ]);

        App\PageType::create([
            'type' => 'B3',
            'width' => '353',
            'height' => '500'
        ]);

        App\PageType::create([
            'type' => 'B4',
            'width' => '250',
            'height' => '353'
        ]);

        App\PageType::create([
            'type' => 'B5',
            'width' => '176',
            'height' => '250'
        ]);

        App\PageType::create([
            'type' => 'B6',
            'width' => '125',
            'height' => '176'
        ]);

        App\PageType::create([
            'type' => 'B7',
            'width' => '88',
            'height' => '125'
        ]);

        App\PageType::create([
            'type' => 'B8',
            'width' => '62',
            'height' => '88'
        ]);

        App\PageType::create([
            'type' => 'B9',
            'width' => '44',
            'height' => '62'
        ]);

        App\PageType::create([
            'type' => 'B10',
            'width' => '31',
            'height' => '44'
        ]);

        App\PageType::create([
            'type' => 'C0',
            'width' => '917',
            'height' => '1297'
        ]);

        App\PageType::create([
            'type' => 'C1',
            'width' => '648',
            'height' => '917'
        ]);

        App\PageType::create([
            'type' => 'C2',
            'width' => '458',
            'height' => '648'
        ]);

        App\PageType::create([
            'type' => 'C3',
            'width' => '324',
            'height' => '458'
        ]);

        App\PageType::create([
            'type' => 'C4',
            'width' => '229',
            'height' => '324'
        ]);

        App\PageType::create([
            'type' => 'C5',
            'width' => '162',
            'height' => '229'
        ]);

        App\PageType::create([
            'type' => 'C6',
            'width' => '114',
            'height' => '162'
        ]);

        App\PageType::create([
            'type' => 'C7',
            'width' => '81',
            'height' => '114'
        ]);

        App\PageType::create([
            'type' => 'C8',
            'width' => '57',
            'height' => '81'
        ]);

        App\PageType::create([
            'type' => 'C9',
            'width' => '40',
            'height' => '57'
        ]);
    }
}
