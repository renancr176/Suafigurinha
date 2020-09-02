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
            'image_path' => '/files/images/albuns/frames/default.png',
            'width' => 52,
            'height' => 52,
            'font_size' => 30,
            'x_position' => 21,
            'y_position' => 9,
            'print_page_type_id' => App\PageType::where('type', 'Impressão figurinha')->firstOrFail()->id,
            'quantity_rows_by_page' => 8,
            'quantity_figures_by_row' => 5,
            'space_between_figures' => 1.5,
            'container_border_space' => 3.5
        ]);

        App\AlbumFrameType::create([
            'font_id' => 1,
            'title' => 'Médio',
            'image_path' => '/files/images/albuns/frames/default.png',
            'width' => 47,
            'height' => 67,
            'font_size' => 27,
            'x_position' => 21,
            'y_position' => 10,
            'print_page_type_id' => App\PageType::where('type', 'Impressão figurinha')->firstOrFail()->id,
            'quantity_rows_by_page' => 6,
            'quantity_figures_by_row' => 5,
            'space_between_figures' => 1.5,
            'container_border_space' => 3.5
        ]);

        App\AlbumFrameType::create([
            'font_id' => 1,
            'title' => 'Grande',
            'image_path' => '/files/images/albuns/frames/default.png',
            'width' => 72,
            'height' => 72,
            'font_size' => 45,
            'x_position' => 27,
            'y_position' => 10,
            'print_page_type_id' => App\PageType::where('type', 'Impressão figurinha')->firstOrFail()->id,
            'quantity_rows_by_page' => 6,
            'quantity_figures_by_row' => 4,
            'space_between_figures' => 1.5,
            'container_border_space' => 3.5
        ]);
    }
}
