<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusMachineSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('status_machine')->truncate();

        DB::table('status_machine')->insert([
            [
                'id' => 1,
                'naam' => 'actief',
                'omschrijving' => 'Machine werkt!',
            ],
            [
                'id' => 2,
                'naam' => 'inactief',
                'omschrijving' => 'Machine staat op standby.',
            ],
            [
                'id' => 3,
                'naam' => 'onderhoud',
                'omschrijving' => 'Deze machine kan nu niet worden gebruikt i.v.m onderhoud.',
            ],
            [
                'id' => 4,
                'naam' => 'error',
                'omschrijving' => 'Kijk naar dashboard voor meer informatie.',
            ],
        ]);
    }
}