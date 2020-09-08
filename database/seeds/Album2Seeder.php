<?php

use Illuminate\Database\Seeder;
use App\Enums\AlbumConverTypeEnum;

class Album2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $album = App\Album::create([
            'ref_code' => substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 4),
            'title' => '1 Ano de Namoro - Edição Especial',
            'description' => '',
            'have_bookbinding_options' => true,
            'presentation_page_type_id' => App\PageType::where('type', 'Apresentação quadrada com sangria')->firstOrFail()->id,
            'print_page_type_id' => App\PageType::where('type', 'Impressão quadrada')->firstOrFail()->id,
            'print_back_front_page_type_id' => App\PageType::where('type', 'Impressão quadrada combinada')->firstOrFail()->id,
            'album_frame_type_id' => App\AlbumFrameType::where('title', 'Quadrado 55x55')->firstOrFail()->id,
            'print_cut_space' => 5,
            'background_color_firgure_grid' => '#9CDBF8',
            'active' => true
        ]);

        $pageSequence = 0;
        $photoSequece = 0;

        App\AlbumHardCover::create([
            'album_id' => $album->id,
            'album_cover_type_id' => AlbumConverTypeEnum::Front,
            'image_path' => "/files/images/albuns/album_$album->id/front_hard_cover.png"
        ]);

        App\AlbumHardCover::create([
            'album_id' => $album->id,
            'album_cover_type_id' => AlbumConverTypeEnum::Back,
            'image_path' => "/files/images/albuns/album_$album->id/back_hard_cover.png"
        ]);

        #region Page 1

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $font = App\Font::updateOrCreate([
            'title' => 'Jushley Shine',
            'path' => '/files/fonts/Jushley-Shine.otf'
        ]);

        App\AlbumPageText::create([
            'album_page_id' => $page->id,
            'font_id' => $font->id,
            'text' => 'Eu e Ele(a)',
            'alignment' => 'center',
            'color' => '#FFFFFF',
            'font_size' => 34.31,
            'bold' => false,
            'italic' => false,
            'underlined' => false,
            'width' => 91.5,
            'x_position' => 64,
            'y_position' => 163.5,
            'rotation' => -5,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 2

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 15.2,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 15.2,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 15.2,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 147.2,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 147.2,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 147.2,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        #endregion

        #region Page 3

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 36.1,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 36.1,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 36.1,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 124,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 124,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 124,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 4

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 18.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 18.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 18.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 82,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 82,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 82,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 5

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        #endregion

        #region Page 6

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        #endregion

        #region Page 7

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 82.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 82.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 82.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 146,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 146,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 146,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 8

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 15.2,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 15.2,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 15.2,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 147.2,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 147.2,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 147.2,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        #endregion

        #region Page 9

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 17.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 17.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 17.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 81,
            'rotation' => 0,
            'controls_position' => 'left'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 81,
            'rotation' => 0,
            'controls_position' => 'right'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 144.8,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 144.8,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 144.8,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 10

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        #endregion

        #region Page 11

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        #endregion

        #region Page 12

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 35.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 35.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 35.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 126.2,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 126.2,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 126.2,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 13

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 17.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 17.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 17.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 81,
            'rotation' => 0,
            'controls_position' => 'left'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 81,
            'rotation' => 0,
            'controls_position' => 'right'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 144.8,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 144.8,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 144.8,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 14

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 16.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 16.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 16.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 80.5,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 80.5,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 80.5,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 15

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 16.2,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 16.2,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 16.2,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 80.2,
            'rotation' => 0,
            'controls_position' => 'right'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 16.4,
            'y_position' => 146.1,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 81.2,
            'y_position' => 146.1,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 146,
            'y_position' => 146.1,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 16

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        #endregion
    }
}
