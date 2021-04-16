<?php

namespace App\Exports;

use App\Models\Produit;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProduitsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
//return Produit::all();
return Produit::where("prix",">", 5000)->get();
    }

//     public function view():view
//     {
// return view('partials.list-produits',[
// // 'produits'=> Produit::all()
// 'produits'=> Produit::where("prix",">", 5000)->get()
// ]);
//     }
}
