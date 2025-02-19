<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Administrator;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('administrators')->truncate();
        //Añado el email del administrador, en mi caso
        //voy a poner un solo administrador que este previamente definido
        // en vez de declararlo en el .env, lo pongo aqui
    /* Creo unn array con correos de admiin y hago un insertar manuall
    en este caso de un solo admin ell elemento 0 pero poddria adaptarlo a  varioos  coon un f */
        $adminEmail = [
            'test@example.com',
        ];
        DB::table('administrators')->insert([
            'email' => $adminEmail[0],
            'user_id' => User::where('email', $adminEmail[0])->first()->id,
        ]);

    }
}
