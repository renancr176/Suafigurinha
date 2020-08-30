<?php

use Illuminate\Database\Seeder;

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
            'presentation_page_type_id' => 1,
            'print_page_type_id' => 2,
            'print_back_front_page_type_id' => 3,
            'print_figure_grid_page_type_id' => 4,
            'album_frame_type_id' => 1,
            'print_cut_space' => 5,
            'active' => true
        ]);

        $pageSequence = 0;
        $photoSequece = 0;

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

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 14.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 14.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 14.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 143.1,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 143.1,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 143.1,
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
            'x_position' => 15.5,
            'y_position' => 34.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 34.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 34.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 120.5,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 120.5,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 120.5,
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
            'x_position' => 15.5,
            'y_position' => 17.4,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 17.4,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 17.4,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 79.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 79.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 79.3,
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
            'x_position' => 15.5,
            'y_position' => 80,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 80,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 80,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 142,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 142,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 142,
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
            'x_position' => 15.5,
            'y_position' => 14.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 14.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 14.3,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 143.1,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 143.1,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 143.1,
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
            'x_position' => 15.5,
            'y_position' => 16.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 16.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 16.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 78.5,
            'rotation' => 0,
            'controls_position' => 'left'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 78.5,
            'rotation' => 0,
            'controls_position' => 'right'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 140.8,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 140.8,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 140.8,
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
            'x_position' => 15.5,
            'y_position' => 34.1,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 34.1,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 34.1,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 122.5,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 122.5,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 122.5,
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
            'x_position' => 15.5,
            'y_position' => 16.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 16.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 16.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 78.5,
            'rotation' => 0,
            'controls_position' => 'left'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 78.5,
            'rotation' => 0,
            'controls_position' => 'right'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 140.8,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 140.8,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 140.8,
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
            'x_position' => 15.5,
            'y_position' => 15.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 15.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 15.6,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 78,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 78,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 78,
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
            'x_position' => 15.5,
            'y_position' => 15.4,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 15.4,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 15.4,
            'rotation' => 0,
            'controls_position' => 'top'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 77.6,
            'rotation' => 0,
            'controls_position' => 'right'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 15.5,
            'y_position' => 142.1,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 78.8,
            'y_position' => 142.1,
            'rotation' => 0,
            'controls_position' => 'bottom'
        ]);

        $photoSequece++;
        App\AlbumPagePhoto::create([
            'album_page_id' => $page->id,
            'sequence' => $photoSequece,
            'x_position' => 142,
            'y_position' => 142.1,
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
