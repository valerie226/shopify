<x-master-layout>
    <div class="container">
<div class="col-md-12">
    <h1 class="text-center">La liste des produits</h1>
</div>
        <div class="row">
            <div class="col-md-12">
                @if(session('statut'))



{{-- {{ session("statut")}} --}}
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  {{ session('statut')}}
  {{-- <strong></strong> --}}
</div>
@endif
<script>
  $(".alert").alert();
</script>
<div>
<a class="btn btn-success btn-sm" href="{{route('produits.create')}}">
<i class="fas fa-plus"></i>Ajouter
  </a>

  <a class="btn btn-warning btn-sm" href="{{route('export')}}">
    <i class="fas fa-download"></i>Exporter
      </a>
</div>
Le nom de l'image sélectionnée est: {{session('imageName')}}
                <table class="table">
                    <thead>
                        <tr>
                            <th>Désignation</th>
                            <th>Libéllé</th>
                            <th>Prix</th>
                            <th>Catégorie</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($produits as $produit)
                        <tr>
                            <td scope="row">{{$produit->designation }}</td>
                            <td>{{$produit->category ? $produit->category->Libelle : "Non catégorisé" }}</td>
                            <td>{{formatPrixBf($produit->prix) }}</td>
                            <td>{{$produit->description }}</td>
                            <td>
                                {{-- <a href="{{route("produits.edit", $produit)}}" class="btn btn-primary btn-sm mr-2"><i class="fas fa-show"></i></a> --}}
                                <a href="{{route("produits.edit", $produit)}}" class="btn btn-primary btn-sm mr-2"><i class="fas fa-edit "></i></a>
                                <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash " onclick="suppressionConfirm('{{$produit->id}}')"></i></a>
                                <form  id="{{$produit->id}}" method="post" action="{{route("produits.destroy",$produit->id)}}">
                                    @csrf
                                    @method("Delete")
                                </form>
                            </td>

                        </tr>
                        <tr>
                            <td scope="row"></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
        <div class="mt-5 text-center d-flex justify-content-center">
            {{$produits->links()}}
        </div>

            </div>
        </div>
    </div>
</x-master-layout>
