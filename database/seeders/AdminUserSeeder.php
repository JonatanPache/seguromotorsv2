<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Coaseguro;
use App\Models\Deducible;
use App\Models\Moneda;
use App\Models\Prima;
use App\Models\Rol;
use App\Models\TipoCombustible;
use App\Models\TipoServicioVehiculo;
use App\Models\TipoUsoVehiculo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Rol::create([
            'name' => 'admin',
            'description' => 'administrador',
        ]);

        Rol::create([
            'name' => 'client',
            'description' => 'cliente',
        ]);

        City::create([
            'name' => 'SCZ',
            'code_postal' => '6554',
        ]);
        User::create([
            'name' => 'Jonatan',
            'email' => 'admin@email.com',
            'password' => bcrypt('123456'),
            'ci' => '12729094',
            'last_name' => 'pacheco',
            'phone' => '72126063',
            'address' => 'che',
            'birthday' => '12/08/22',
            'city_id' => 1,
            'rol_id' => 1,
        ]);

        Moneda::create([
            'name' => 'Bolivianos',
            'slug' => 'Bs',
        ]);
        Moneda::create([
            'name' => 'Dolares',
            'slug' => '$',
        ]);
        TipoServicioVehiculo::create([
            'name' => 'Particular',
            'description' => 'solo uso particular para una persona',
        ]);
        TipoServicioVehiculo::create([
            'name' => 'Publico',
            'description' => 'unicamente para una persona',
        ]);

        TipoUsoVehiculo::create([
            'name' => 'Servicio Taxi',
            'description' => 'solo uso taxi',
        ]);


        TipoUsoVehiculo::create([
            'name' => 'Normal',
            'description' => 'solo uso taxi',
        ]);

        TipoCombustible::create([
            'name' => 'Gasolina',
            'description' => 'gasolina normal',
        ]);
        TipoCombustible::create([
            'name' => 'Diesel',
            'description' => 'diesel',
        ]);
        TipoCombustible::create([
            'name' => 'Gas Natural',
            'description' => 'gas ',
        ]);
        Deducible::create([
            'name' => 'NO APLICA',
            'description' => 'No aplica para tal seguro ',
        ]);
        Deducible::create([
            'name' => 'POR EVENTO',
            'description' => 'Solo se aplica por evento siniestro de acuerdo al limite de la cobertura',
        ]);
        Deducible::create([
            'name' => 'VALUABLE',
            'description' => 'No aplica para tal seguro ',
            'value'=>''
        ]);

        Prima::create([
            'name' => 'Prima Periodica',
            'description' => 'Se aplica desembolso mensualmente al cliente.',
            'plazo_baja'=>'3',
            'tasa_interes'=>'10'
        ]);

        Prima::create([
            'name' => 'Prima Unica',
            'description' => 'Se aplica desembolso solo una vez al cliente.',
            'plazo_baja'=>'31',
            'tasa_interes'=>'15'
        ]);

        Coaseguro::create([
            'name'=>'Coaseguro A',
            'description'=>'Solo para personas que tengan antiguedad de 1 anio',
        ]);


    }
}
