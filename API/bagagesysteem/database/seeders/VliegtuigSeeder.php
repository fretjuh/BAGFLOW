<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vliegtuig;

class VliegtuigSeeder extends Seeder
{
    public function run(): void
    {
        $vliegtuigen = [
            [
                'vluchtschema_id' => 1,
                'gate_id'         => 1,
                'model_id'        => null,
                'vliegmaatschappij' => 'KLM',
            ],
            [
                'vluchtschema_id' => 2,
                'gate_id'         => 2,
                'model_id'        => null,
                'vliegmaatschappij' => 'Transavia',
            ],
            [
                'vluchtschema_id' => 3,
                'gate_id'         => 3,
                'model_id'        => null,
                'vliegmaatschappij' => 'Ryanair',
            ],
        ];

        foreach ($vliegtuigen as $vliegtuig) {
            Vliegtuig::create($vliegtuig);
        }
    }
}