<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gates')->insert([
            [
                'id' => 1,
                'naam' => 'TL',
                'positie' => 1,
                'is_open' => true,
                'omschrijving' => 'Gate 1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'naam' => 'TR',
                'positie' => 2,
                'is_open' => false,
                'omschrijving' => 'Gate 2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'naam' => 'BL',
                'positie' => 3,
                'is_open' => false,
                'omschrijving' => 'Gate 3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'naam' => 'BR',
                'positie' => 4,
                'is_open' => false,
                'omschrijving' => 'Gate 4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}