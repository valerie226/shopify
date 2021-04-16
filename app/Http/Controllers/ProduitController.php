<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Produit;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProduitFormRequest;
use App\Notifications\ModificationProduit;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produit::orderByDesc("id")->paginate(15);

       /* $produits500 = Produit::where("prix", 500) ->get();
        dd($produits500);
        dd($produits);

        /*dump($produits);
        $produit = new Produit;

        $produit->designation = "Livre";
        $produit->description = "La description de livre";
        $produit->prix = 1000;

        $produit->save(); //permet d'enregistrer nos données dans la BD
        dd($produit);
        */
        //$its500 = Produit::where("prix",">", 500) ->where("designation", "cahier")->get();
        //$produit = Produit::findOrFail (20);
        //$premier = Produit::first ();
        //dd($premier);
        //dd($produit);
        //dd($its500);
        return view("front-office.produits.index", [

            "produits" => $produits ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $produit= new Produit;
        return view("front-office.Produits.create", [
            "categories" =>$categories,
            "produit"=> $produit,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(ProduitFormRequest $request)
    {
        // dd($request->file("image"));
        $imageName = "produit.png";
        if($request->file("image")){
        $imageName = time().$request->file("image")->getClientOriginalName();
        $request->file("image")->storeAs("public/uploads/produits", $imageName);
        }
        $request->session()->put("imageName", $imageName);
    //dd($request->designation);
    // $request->validate([
// "designation" => "required|min:3|max:50|unique:produits,designation",
// "prix" => "required|numeric|between:500,1000000",
// "description" => "required|max:200",
// "category_id" => "required|numeric"
//     ]);
    $produit = Produit::Create([

        "designation"=>$request->designation,
        "prix"=>$request->prix,
        "category_id"=>$request->category_id,
        "description"=>$request->description,
        "image" =>$imageName,
    ]);
//dd($produit);
return redirect()->route('produits.index')->with("statut", "Le produit a bien été ajouté!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show(Produit $produit)
     {
        // dd($produit);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Produit $produit)
    {
    $categories= Category::all();
return view('front-office.Produits.edit',[
"produit"=>$produit,
"categories"=>$categories,

]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
     public function update(ProduitFormRequest $request, $id)
    {
        // $request->validate([
        //     "designation" => "required|min:3|max:50|unique:produits,designation,".$id,
        //     "prix" => "required|numeric|between:500,1000000",
        //     "category_id" => "required|numeric",
        //     "description" => "required|max:200"
        //         ]);
        // //$request
        Produit::where("id", $id)->update([
            "designation"=>$request->designation,
            "prix"=>$request->prix,
            "category_id"=>$request->category_id,
            "description"=>$request->description,
        ]);

        $user=User::first();
        $user->notify(new ModificationProduit);
        return redirect()->route("produits.index")->with("statut", "Le produit a bien été modifié");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Produit::destroy($id);

        return redirect()->route("produits.index")->with("statut", "Le produit a bien été supprimé");
    }


}
