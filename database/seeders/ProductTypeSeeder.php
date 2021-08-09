<?php

namespace Database\Seeders;

use App\Models\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::create(
            [
                'name'        => 'Raw Material',
                'description' => 'The basic material from which a product is made.'
            ],
            [
                'name'        => 'Finish Goods',
                'description' => 'Poducts that have passed or completed the manufacturing process'
            ],
            [
                'name'        => 'Semi Materials',
                'description' => 'Production and supply-chain management term describing partially finished goods awaiting completion'
            ]
        );
    }
}
