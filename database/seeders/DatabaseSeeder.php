<?php

namespace Database\Seeders;

use App\Models\Produit;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
         CategorySeeder::class,
         ]);
        //Produit::factory(50)->create();
        // \App\Models\User::factory(10)->create();

    }
}
