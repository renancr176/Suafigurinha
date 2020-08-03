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
            'name' => 'Admin',
            'email' => 'admin@suafigurinha.com.br',
            'email_verified_at' => gmdate("M d Y H:i:s", time()),
            'password' => Hash::make(env('ADMIN_PWD'))
        ]);

        App\User::create([
            'name' => 'Usuário de integração WIX',
            'email' => 'wixintegration@suafigurinha.com.br',
            'email_verified_at' => gmdate("M d Y H:i:s", time()),
            'password' => Hash::make(env('WIX_PWD'))
        ]);
    }
}
