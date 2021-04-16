<?php

namespace Database\Seeders;

use App\Models\Produit;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(10)->has(Produit::factory(50))->create();
    }
}
