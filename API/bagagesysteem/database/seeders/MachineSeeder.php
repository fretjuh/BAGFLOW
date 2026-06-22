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
                'id' => 1,
                'naam' => 'Pick & place 1',
                'positie' => 'Z0_TL',
                'status_id' => 1,
            ],
            [
                'id' => 2,
                'naam' => 'Pick & place 2',
                'positie' => 'Z0_TR',
                'status_id' => 1,
            ],
            [
                'id' => 3,
                'naam' => 'Pick & place 3',
                'positie' => 'Z0_BL',
                'status_id' => 1,
            ],
            [
                'id' => 4,
                'naam' => 'Pick & place 4',
                'positie' => 'Z0_BR',
                'status_id' => 1,
            ],
        ]);
    }
}