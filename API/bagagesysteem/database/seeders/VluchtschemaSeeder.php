<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vluchtschema;

class VluchtschemaSeeder extends Seeder
{
    public function run(): void
    {
        $schemas = [
            [
                'gate_id'          => 1,
                'vliegtuig_id'     => 1,
                'status_bagage_id' => 1,
                'vertrektijd'      => '2026-06-20 08:00:00',
                'vertraging'       => 0,
            ],
            [
                'gate_id'          => 2,
                'vliegtuig_id'     => 2,
                'status_bagage_id' => 1,
                'vertrektijd'      => '2026-06-20 10:30:00',
                'vertraging'       => 15,
            ],
            [
                'gate_id'          => 3,
                'vliegtuig_id'     => 3,
                'status_bagage_id' => 2,
                'vertrektijd'      => '2026-06-20 13:45:00',
                'vertraging'       => 0,
            ],
        ];

        foreach ($schemas as $schema) {
            Vluchtschema::create($schema);
        }
    }
}