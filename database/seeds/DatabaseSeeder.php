<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(StateSeeder::class);
        $this->call(PageTypeSeeder::class);
        $this->call(FontSeeder::class);
        $this->call(AlbumFrameTypeSeeder::class);
        $this->call(AlbumOrderFileTypeSeeder::class);
        $this->call(BookbindingTypeSeeder::class);
        $this->call(StaffEmailSeeder::class);
        $this->call(AlbumConverTypeSeeder::class);

        #region Albuns
        $this->call(AlbumSeeder::class);
        $this->call(Album2Seeder::class);
        $this->call(Album3Seeder::class);
        #endregion
    }
}
