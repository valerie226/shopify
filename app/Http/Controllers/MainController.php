<?php

namespace App\Http\Controllers;

use App\Exports\ProduitsExport;
use App\Models\User;
use App\Models\Produit;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MainController extends Controller
{
public function accueil (){
    $produits =Produit::orderByDesc("id")->get();
    return view ("welcome", [
        "produits" => $produits,
    ]);
}

    public function ajouterProduit()
    {
//dd("hello");
$produit = Produit::create([
    "designation"=> "Cahier",
    "description"=> "La description de cahier",
    "prix"=> 500
]);
dd($produit);
    }

    public function updateProduit(Produit $produit){
        //echo "Hello";
        dd ($produit);
        $produit = Produit::findOrFail($produit);
       // dump($produit);
        $produit->designation = "Chemise";
        $produit->description = "La description de chemise";
        $produit->prix = 6000;
        $produit->save();
        dd($produit);
    }

    public function updateProduit2($id){
        //echo "Hello";
        $produit = Produit::FindOrFail($id);
        /*dump($produit);
        $produit->designation = "Chemise";
        $produit->description = "La description de chemise";
        $produit->prix = 6000;
        $produit->save();
        */
        //dd($produit);
        $result = Produit::where("id", 2)->update([
            "designation" => "Tricot",
            "description" => "La description de tricot",
            "prix" => 3500
        ]);
    dd($result);
    }

    public function supprimerProduit($id)
    {
//dd("hello");
$result = Produit::destroy($id);
dd($result);

}
public function createCategory()
{
    //Category::create([
        $category= Category::create([
        "Libelle" => "Vetements",
        ]);

    $produit = Produit::create([
        "category_id"=> $category->id,
        "designation"=> "Pantalon",
        "description"=> "La description de pantalon",
        "prix"=> 5000
    ]);
    dd($produit);
}

public function getProduit(Produit $produit)
{
    $category = Category::first();
    dd($category, $category->produits);
//dd($produit->category);
}

public function commande()
{
    //$user = User::create([
    //"name" =>"Issa OUEDRAOGO",
    //"email" =>"issa@gmail.com",
   // "password" => Hash::make("admin123"),
     // ]);

    //dd($category, $category->produits);
//dd($produit->category]);


$user = User::first();
$produit1 = Produit::first();
$produit2 = Produit::findOrFail(2);

//$user->produits()->attach($produit1);
$user->produits()->attach($produit2);
dd($user->produits);
}


// public function afficherProduit(Produit $produit){
//     //echo "Hello";
//     dd ($produit);
//     $produit = Produit::findOrFail($produit);
//    // dump($produit);
//     $produit->designation = "Chemise";
//     $produit->description = "La description de chemise";
//     $produit->prix = 6000;
//     $produit->save();
//     dd($produit);
// }




public function collection(){
    $collection1=collect([
        [
            "titre"=>"Mon super livre 1",
            "Prix"=>5000,
            "Description"=>"La description du livre 1"
        ],
        [
            "titre"=>"Mon super livre 2",
            "Prix"=>700,
            "Description"=>"La description du livre 2"
        ],

        [
            "titre"=>"Mon super livre 3",
            "Prix"=>10000,
            "Description"=>"La description du livre"
        ],
    ]);

$collection1->push([
        "titre"=>"Mon super livre 4",
        "Prix"=>10000,
        "Description"=>"La description du livre 4"
    ]);
    //dd($collection1->sortBy("prix"));
    $nouvelleCollection = $collection1->filter(function($livre, $key){
        return $livre ["prix"] >= 10000;
    });
    dd($nouvelleCollection);
}



public function exportProduits(){

return Excel::download(new ProduitsExport, "produits.xlsx");
}

}
