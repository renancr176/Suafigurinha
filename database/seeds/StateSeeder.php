<?php

use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\State::create([
            'name' => 'Acre',
            'uf' => 'AC'
        ]);

        App\State::create([
            'name' => 'Alagoas',
            'uf' => 'AL'
        ]);

        App\State::create([
            'name' => 'Amapá',
            'uf' => 'AP'
        ]);

        App\State::create([
            'name' => 'Amazonas',
            'uf' => 'AM'
        ]);

        App\State::create([
            'name' => 'Bahia',
            'uf' => 'BA'
        ]);

        App\State::create([
            'name' => 'Ceará',
            'uf' => 'CE'
        ]);

        App\State::create([
            'name' => 'Distrito Federal',
            'uf' => 'DF'
        ]);

        App\State::create([
            'name' => 'Espírito Santol',
            'uf' => 'ES'
        ]);

        App\State::create([
            'name' => 'Goiás',
            'uf' => 'GO'
        ]);

        App\State::create([
            'name' => 'Maranhão',
            'uf' => 'MA'
        ]);

        App\State::create([
            'name' => 'Mato Grosso',
            'uf' => 'MT'
        ]);

        App\State::create([
            'name' => 'Mato Grosso do Sul',
            'uf' => 'MS'
        ]);

        App\State::create([
            'name' => 'Minas Gerais',
            'uf' => 'MG'
        ]);

        App\State::create([
            'name' => 'Pará',
            'uf' => 'PA'
        ]);

        App\State::create([
            'name' => 'Paraíba',
            'uf' => 'PB'
        ]);

        App\State::create([
            'name' => 'Paraná',
            'uf' => 'PR'
        ]);

        App\State::create([
            'name' => 'Pernambuco',
            'uf' => 'PE'
        ]);

        App\State::create([
            'name' => 'Piauí',
            'uf' => 'PI'
        ]);

        App\State::create([
            'name' => 'Rio de Janeiro',
            'uf' => 'RJ'
        ]);

        App\State::create([
            'name' => 'Rio Grande do Norte',
            'uf' => 'RN'
        ]);

        App\State::create([
            'name' => 'Rio Grande do Sul',
            'uf' => 'RS'
        ]);

        App\State::create([
            'name' => 'Rondônia',
            'uf' => 'RO'
        ]);

        App\State::create([
            'name' => 'Roraima',
            'uf' => 'RR'
        ]);

        App\State::create([
            'name' => 'Santa Catarina',
            'uf' => 'SC'
        ]);

        App\State::create([
            'name' => 'São Paulo',
            'uf' => 'SP'
        ]);

        App\State::create([
            'name' => 'Sergipe',
            'uf' => 'SE'
        ]);

        App\State::create([
            'name' => 'Tocantins',
            'uf' => 'TO'
        ]);
    }
}
