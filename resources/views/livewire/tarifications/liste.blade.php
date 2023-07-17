<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card" style="height:500px">
            <div class="card-header bg-gradient-primary d-flex">
                <div class="flex-grow-1">
                    <p class="card-title text-center"><i class="fas fa-money-check fa-2x "></i> Tarification - {{$article->nom}}</p>
                </div>
                <div>
                    <a href="{{route('admin.gestionarticles.articles.index')}}" class="mr-2 btn btn-light">retourner à la liste des articles</a>
                    <button class="btn btn-light" wire:click='ajouterTarification' ><i class="fas fa-plus"></i> Nouveau tarif</button>
                </div>
            </div>
            
            <div class="card-body card-body table-responsive p-0 h-auto" style="height:150px">

                
                <table class="table table-head-fixed table-striped text-nowrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="width: 50%">Durée de Location</th>
                            <th class="text-center" style="width: 25%">Prix</th>
                            <th class="text-center" style="width: 15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($fonction == "ajout")
                        <div class="p-4">
                            <select class="form-control @error("newTarif.duree_location_id") is-invalid @enderror " wire:model='newTarif.duree_location_id'>
                                <option value="">Choisissez une durée horaire</option>
                                @foreach ($dureeLocation as $duree)
                                    <option value="{{$duree->id}}">{{$duree->libelle}}</option>
                                @endforeach
                            </select>
                            @error("newTarif.duree_location_id")
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
    
                            <input type="number" wire:model='newTarif.prix' class="form-control mt-3" placeholder="prix du tarif">
                            <button class="btn btn-link text-success mt-3" wire:click.prevent='addTarification({{$articleId}})'><i class="fa fa-check"></i> Valider</button>
                            <button class="btn btn-link text-warning mt-3" wire:click.prevent='annulerAjout' ><i class="far fa-trash-alt"></i> Annuler</button>
                        </div>
                        @elseif($fonction == "edit")
                            <div class="p-4">
                                <select class="form-control @error("editTarif.duree_location_id") is-invalid @enderror " wire:model='editTarif.duree_location_id'>
                                    <option value="">Choisissez une durée horaire</option>
                                    @foreach ($dureeLocation as $duree)
                                        <option value="{{$duree->id}}">{{$duree->libelle}}</option>
                                    @endforeach
                                </select>
                                @error("editTarif.duree_location_id")
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
        
                                <input type="number" wire:model='editTarif.prix' class="form-control mt-3 @error("editTarif.prix") is-invalid @enderror" placeholder="prix du tarif">
                                @error("editTarif.prix")
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                <button class="btn btn-link text-success mt-3" wire:click.prevent='updateTarification({{$tarificationId}})'><i class="fa fa-check"></i> Editer</button>
                                <button class="btn btn-link text-warning mt-3" wire:click.prevent='annulerAjout' ><i class="far fa-trash-alt"></i> Annuler</button>
                            </div>
                        @endif
                        @forelse($lesTarifs as $tarif)
                            <tr>
                                <td>{{$tarif->id}}</td>
                                <td>{{$tarif->dureeLocation->libelle}}</td>
                                <td class="text-center">{{$tarif->prix}},00 XAF</td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click='editerTarif({{$tarif->id}})'><i class="far fa-edit"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-success m-2">
                                        <h5><i class="icon fas fa-ban"></i> Information !</h5>
                                        Cet article n'a pas encore de tarif defini
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("showSuccessMessage", function(e){
            Swal.fire(e.detail);
        });
    </script>

</div>