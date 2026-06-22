<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class GebruikerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gebruikers')->insert([
            [
                'naam' => 'Admin',
                'role' => 'admin',
                'email' => 'admin@bhs.local',
                'wachtwoord' => Hash::make('Admin123!'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'naam' => 'Test Medewerker',
                'role' => 'medewerker',
                'email' => 'test@gmail.com',
                'wachtwoord' => Hash::make('Test1234!'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
