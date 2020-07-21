<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::create([
            'name' => 'Renan de Carvalho Ribeiro',
            'email' => 'renancr176@gmail.com',
            'email_verified_at' => gmdate("M d Y H:i:s", time()),
            'password' => Hash::make('#$horde%23*&')
        ]);

        App\User::create([
            'name' => 'Usuário de integração WIX',
            'email' => 'suafigurinha@gmail.com',
            'email_verified_at' => gmdate("M d Y H:i:s", time()),
            'password' => Hash::make('!5dM&-myCH82?L4E')
        ]);
    }
}
