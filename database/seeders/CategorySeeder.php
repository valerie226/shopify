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
        Category::create([

            'description'=>'iphone',
            'Libelle' => 'vente',
        ]);

        Category::create([

            'description'=>'nokia',
            'Libelle' => 'vendu',
        ]);

        Category::create([

            'description'=>'hp',
            'Libelle' => 'loue',
        ]);
    }
}
