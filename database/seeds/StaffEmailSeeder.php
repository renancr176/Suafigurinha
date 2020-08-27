<?php

use Illuminate\Database\Seeder;

class StaffEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\StaffEmail::create([
            'name' => 'Renan de Carvalho Ribeiro',
            'email' => 'renancr176@gmail.com'
        ]);
    }
}
