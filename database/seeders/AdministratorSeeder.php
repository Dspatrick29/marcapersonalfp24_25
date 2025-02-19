<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Administrador;
use App\Models\User;


class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Añado el email del administrador, en mi caso
        //voy a poner un solo administrador que este previamente definido
        // en vez de declararlo en el .env, lo pongo aqui
        $adminEmail = [
            '1481463@alu.murciaeduca.es',
        ];

        //Recorro el array de correos
        foreach ($adminEmail as $email) {
            //Busco el usuario con ese correo
            $user = User::where('email', $email)->first();
            //Si existe el usuario
            if ($user) {
                //Creo un nuevo administrador
                Administrador::create([
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}