<?php

namespace Database\Seeders;

use App\Models\JobCost;
use App\Models\JobCostReferance;
use Illuminate\Database\Seeder;

class JobCostreferenceseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobCostReferance::insert([
            ['name' => 'PRODUCTION'],
            ['name' => 'DEVELOPMENT'],
            ['name' => 'OTHER']
        ]);

        JobCost::where('for', 'PRODUCTION')->update(['for' => 1]);
        JobCost::where('for', 'DEVELOPMENT')->update(['for' => 2]);
    }
}
