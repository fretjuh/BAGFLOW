<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // disable foreign key checks to allow truncation order
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // seed in specific order
        $this->call([
            GateSeeder::class,
            StatusBagageSeeder::class,
            StatusMachineSeeder::class,
            MachineSeeder::class,
            BagageSeeder::class,
            VliegtuigSeeder::class,
            VluchtschemaSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
