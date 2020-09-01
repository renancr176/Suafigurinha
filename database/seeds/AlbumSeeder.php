<?php

use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $album = App\Album::create([
            'ref_code' => 'A015',
            'title' => 'AMOR DO OIAPOQUE AO CHUI',
            'description' => '',
            'have_bookbinding_options' => false,
            'presentation_page_type_id' => 1,
            'print_page_type_id' => 3,
            'print_back_front_page_type_id' => 4,
            'print_figure_grid_page_type_id' => 5,
            'album_frame_type_id' => 2,
            'print_cut_space' => 0,
            'active' => true
        ]);

        $pageSequence = 0;
        $photoSequece = 0;
        $backgroundSequece = 0;

        #region Page 1

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => '/files/images/albuns/album_1/img_1.png'
        ]);

        $backgroundSequece++;
        App\AlbumPageBackground::create([
            'album_page_id' => $page->id,
            'sequence' => $backgroundSequece,
            'width' => 142,
            'height' => 113,
            'x_position' => 33.5,
            'y_position' => 48.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        App\AlbumPageText::create([
            'album_page_id' => $page->id,
            'font_id' => 2,
            'text' => 'Eu e Ele(a)',
            'alignment' => 'center',
            'color' => '#F26955',
            'font_size' => 46,
            'bold' => false,
            'italic' => false,
            'underlined' => false,
            'width' => 210,
            'x_position' => 0,
            'y_position' => 170,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 2

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => '/files/images/albuns/album_1/img_2.png'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 23,
            'y_position' => 23,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 114.3,
            'y_position' => 23,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 23,
            'y_position' => 114.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 114.3,
            'y_position' => 114.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 3

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => '/files/images/albuns/album_1/img_3.png'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 14.3,
            'y_position' => 23,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 14.3,
            'y_position' => 114.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $backgroundSequece++;
        App\AlbumPageBackground::create([
            'album_page_id' => $page->id,
            'sequence' => $backgroundSequece,
            'width' => 125,
            'height' => 210,
            'x_position' => 85,
            'y_position' => 0,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        #endregion

        #region Page 4

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => '/files/images/albuns/album_1/img_4.png'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 23,
            'y_position' => 11.8,
            'rotation' => 0,
            'controls_position' => 'left'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 114.3,
            'y_position' => 11.8,
            'rotation' => 0,
            'controls_position' => 'right'
        ]);

        $backgroundSequece++;
        App\AlbumPageBackground::create([
            'album_page_id' => $page->id,
            'sequence' => $backgroundSequece,
            'width' => 168,
            'height' => 117,
            'x_position' => 21,
            'y_position' => 93,
            'rotation' => 0,
            'controls_position' => 'left'
        ]);

        #endregion

        #region Page 5

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => '/files/images/albuns/album_1/img_5.png'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 23,
            'y_position' => 23,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 114.3,
            'y_position' => 23,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 23,
            'y_position' => 114.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 114.3,
            'y_position' => 114.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 6

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => '/files/images/albuns/album_1/img_6.png'
        ]);

        $backgroundSequece++;
        App\AlbumPageBackground::create([
            'album_page_id' => $page->id,
            'sequence' => $backgroundSequece,
            'width' => 175.5,
            'height' => 161,
            'x_position' => 18,
            'y_position' => 25,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 7

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => '/files/images/albuns/album_1/img_7.png'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 23,
            'y_position' => 23,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 23,
            'y_position' => 114.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $backgroundSequece++;
        App\AlbumPageBackground::create([
            'album_page_id' => $page->id,
            'sequence' => $backgroundSequece,
            'width' => 110,
            'height' => 210,
            'x_position' => 100,
            'y_position' => 0,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        #endregion

        #region Page 8

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => '/files/images/albuns/album_1/img_8.png'
        ]);

        $backgroundSequece++;
        App\AlbumPageBackground::create([
            'album_page_id' => $page->id,
            'sequence' => $backgroundSequece,
            'width' => 143,
            'height' => 210,
            'x_position' => 32,
            'y_position' => 0,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        #endregion

        #region Page 9

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => '/files/images/albuns/album_1/img_9.png'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 23,
            'y_position' => 23,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 114.3,
            'y_position' => 23,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 23,
            'y_position' => 114.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 114.3,
            'y_position' => 114.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 10

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => '/files/images/albuns/album_1/img_10.png'
        ]);

        $backgroundSequece++;
        App\AlbumPageBackground::create([
            'album_page_id' => $page->id,
            'sequence' => $backgroundSequece,
            'width' => 210,
            'height' => 154,
            'x_position' => 0,
            'y_position' => 0,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 11

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => '/files/images/albuns/album_1/img_11.png'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 23,
            'y_position' => 55.8,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 114.3,
            'y_position' => 55.8,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        #endregion

        #region Page 12

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => '/files/images/albuns/album_1/img_12.png'
        ]);

        #endregion
    }
}
