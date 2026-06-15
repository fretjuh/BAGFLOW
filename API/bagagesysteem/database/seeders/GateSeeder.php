<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GateSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('gates')->truncate();

        DB::table('gates')->insert([
            [
                'id' => 1,
                'naam' => 'TL',
                'positie' => '1',
                'is_open' => 1,
                'omschrijving' => 'Gate 1', 
                'created_at' => '2026-06-12 12:43:11',
                'updated_at' => '2026-06-12 12:43:11',
            ],
            [
                'id' => 2,
                'naam' => 'TR',
                'positie' => '2',
                'is_open' => 0,
                'omschrijving' => 'Gate 2',
                'created_at' => '2026-06-12 12:43:11',
                'updated_at' => '2026-06-12 12:43:11',
            ],
            [
                'id' => 3,
                'naam' => 'BL',
                'positie' => '3',
                'is_open' => 0,
                'omschrijving' => 'Gate 3',
                'created_at' => '2026-06-12 12:43:11',
                'updated_at' => '2026-06-12 12:43:11',
            ],
            [
                'id' => 4,
                'naam' => 'BR',
                'positie' => '4',
                'is_open' => 0,
                'omschrijving' => 'Gate 4',
                'created_at' => '2026-06-12 12:43:11',
                'updated_at' => '2026-06-12 12:43:11',
            ],
        ]);
    }
}
