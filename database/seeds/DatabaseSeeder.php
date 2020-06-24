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
        $this->call(PageTypeSeeder::class);
        $this->call(FontSeeder::class);
        $this->call(AlbumFrameTypeSeeder::class);
        $this->call(AlbumSeeder::class);
    }
}
