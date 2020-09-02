<?php

use Illuminate\Database\Seeder;

class Album3Seeder extends Seeder
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
            'title' => '10 motivos para amar você',
            'description' => '',
            'have_bookbinding_options' => false,
            'presentation_page_type_id' => App\PageType::where('type', 'Apresentação retangular')->firstOrFail()->id,
            'print_page_type_id' => App\PageType::where('type', 'Impressão retangular')->firstOrFail()->id,
            'print_back_front_page_type_id' => App\PageType::where('type', 'Impressão quadrada combinada')->firstOrFail()->id,
            'album_frame_type_id' => App\AlbumFrameType::where('title', 'Retangular 50x70')->firstOrFail()->id,
            'print_cut_space' => 0,
            'background_color_firgure_grid' => '#9CDBF8',
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
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        #endregion

        #region Page 2

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $backgroundSequece++;
        App\AlbumPageBackground::create([
            'album_page_id' => $page->id,
            'sequence' => $backgroundSequece,
            'width' => 101,
            'height' => 101,
            'x_position' => 26,
            'y_position' => 24.5,
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
            'x_position' => 19.5,
            'y_position' => 20.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 86,
            'y_position' => 20.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 19.5,
            'y_position' => 126.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 86,
            'y_position' => 126.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        #endregion

        #region Page 4

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $backgroundSequece++;
        App\AlbumPageBackground::create([
            'album_page_id' => $page->id,
            'sequence' => $backgroundSequece,
            'width' => 101,
            'height' => 101,
            'x_position' => 25.8,
            'y_position' => 24.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        #endregion

        #region Page 5

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
            'x_position' => 19.5,
            'y_position' => 20.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 86,
            'y_position' => 20.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 19.5,
            'y_position' => 126.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 86,
            'y_position' => 126.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        #endregion

        #region Page 6

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $backgroundSequece++;
        App\AlbumPageBackground::create([
            'album_page_id' => $page->id,
            'sequence' => $backgroundSequece,
            'width' => 101,
            'height' => 101,
            'x_position' => 26,
            'y_position' => 28,
            'rotation' => 0,
            'controls_position' => 'top'
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
            'x_position' => 19.5,
            'y_position' => 20.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 86,
            'y_position' => 20.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 19.5,
            'y_position' => 126.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 86,
            'y_position' => 126.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        #endregion

        #region Page 8

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $backgroundSequece++;
        App\AlbumPageBackground::create([
            'album_page_id' => $page->id,
            'sequence' => $backgroundSequece,
            'width' => 101,
            'height' => 101,
            'x_position' => 25.8,
            'y_position' => 24.3,
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
            'x_position' => 19.5,
            'y_position' => 20.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 86,
            'y_position' => 20.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 19.5,
            'y_position' => 126.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 86,
            'y_position' => 126.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        #endregion

        #region Page 10

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        $backgroundSequece++;
        App\AlbumPageBackground::create([
            'album_page_id' => $page->id,
            'sequence' => $backgroundSequece,
            'width' => 101,
            'height' => 101,
            'x_position' => 25.8,
            'y_position' => 28,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        #endregion

        #region Page 11

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
            'x_position' => 19.5,
            'y_position' => 20.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 86,
            'y_position' => 20.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 19.5,
            'y_position' => 126.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 86,
            'y_position' => 126.5,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        #endregion

        #region Page 12

        $pageSequence++;
        $page = App\AlbumPage::create([
            'album_id' => $album->id,
            'sequence' => $pageSequence,
            'image_path' => "/files/images/albuns/album_$album->id/page_$pageSequence.png"
        ]);

        #endregion
    }
}
