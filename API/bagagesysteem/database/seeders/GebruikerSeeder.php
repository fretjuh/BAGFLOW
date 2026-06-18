<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GebruikerSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'naam'       => 'Jan Jansen',
            'email'      => 'jan.jansen@bagflow.nl',
            'wachtwoord' => Hash::make('wachtwoord123'),
            'role'       => 'medewerker',
        ]);

        User::create([
            'naam'       => 'Sanne Admin',
            'email'      => 'sanne.admin@bagflow.nl',
            'wachtwoord' => Hash::make('wachtwoord123'),
            'role'       => 'admin',
        ]);
    }
}