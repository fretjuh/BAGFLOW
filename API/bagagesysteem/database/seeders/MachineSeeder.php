<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MachineSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('machines')->truncate();

        DB::table('machines')->insert([
            [
                'id' => 5,
                'naam' => 'Pick & place 1',
                'positie' => 'Z0_TL',
                'status_id' => 2,
            ],
            [
                'id' => 6,
                'naam' => 'Pick & place 2',
                'positie' => 'Z0_TR',
                'status_id' => 2,
            ],
            [
                'id' => 7,
                'naam' => 'Pick & place 3',
                'positie' => 'Z0_BL',
                'status_id' => 2,
            ],
            [
                'id' => 8,
                'naam' => 'Pick & place 4',
                'positie' => 'Z0_BR',
                'status_id' => 2,
            ],
        ]);
    }
}