<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        $user = User::create([
            'name' => 'Job Zea',
            'email' => 'correo@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://restaurant-app-jzea.netlify.app/'
        ]);

        $user2 = User::create([
            'name' => 'Lore Uribe',
            'email' => 'correo2@correo.com',
            'password' => Hash::make('12345678'),
            'url' => 'https://restaurant-app-jzea.netlify.app/',
        ]);
    }
}
