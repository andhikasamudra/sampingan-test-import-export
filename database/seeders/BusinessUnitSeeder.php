<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = base_path('database/sql/business_unit.sql');
        DB::unprepared(file_get_contents($path));
        $this->command->info('Business Unit data seeded');
    }
}
