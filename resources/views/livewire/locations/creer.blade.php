<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header bg-primary">
                <p class="card-title text-center"><i class="fa fa-cart-plus fa-2x"></i> Nouvelle Location</p>
            </div>
            <form wire:submit.prevent = "addLocation()">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="dateDebut">dateDebut</label>
                                <input type="date" wire:model="newLocation.dateDebut" id="dateDebut" class="form-control @error("newLocation.dateDebut")is-invalid @enderror" placeholder="dateDebut" value="{{old('newLocation.dateDebut')}}"/>
                                @error("newLocation.dateDebut")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="dateFin">dateFin</label>
                                <input type="date" wire:model="newLocation.dateFin" id="dateFin" class="form-control @error("newLocation.dateFin") is-invalid @enderror" placeholder="dateFin" value="{{old('newLocation.dateFin')}}"/>
                                @error("newLocation.dateFin")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label for="statut_location_id">statut_location_id</label>
                        <select wire:model="newLocation.statut_location_id" id="statut_location_id" class="form-control @error("newLocation.statut_location_id")is-invalid @enderror">
                            <option value="">------------</option>
                            @foreach ($statuts as $statut)
                                <option value="{{$statut->id}}">{{$statut->nom}}</option>
                            @endforeach
                        </select>
                        @error("newLocation.statut_location_id")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="form-group">
                        <label for="user_id">user_id</label>
                        <select wire:model="newLocation.user_id" id="user_id" class="form-control @error("newLocation.user_id")is-invalid @enderror">
                            <option value="">------------</option>
                            @foreach ($users as $user)
                                <option value="{{$user->id}}">{{$user->prenom}} {{$user->nom}}</option>
                            @endforeach
                        </select>
                        @error("newLocation.user_id")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> --}}

                    <div class="form-group">
                        <label for="client_id">Client</label>
                        <select wire:model="newLocation.client_id" id="client_id" class="form-control @error("newLocation.client_id")is-invalid @enderror">
                            <option value="">------------</option>
                            @foreach ($clients as $client)
                                <option value="{{$client->id}}">{{$client->prenom}} {{$client->nom}}</option>
                            @endforeach
                        </select>
                        @error("newLocation.client_id")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-link"  data-bs-toggle="modal" data-bs-target="#myModal"><i class="fas fa-list"></i>
                            Articles
                        </button>
                    </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="goToList()">Retourner à la liste des locaions</button>
                </div>
            </form>  
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-scrollable"">
            <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Veuillez Selectionnez Vos Articles</h4>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> --}}
                </div>

                <div class="d-flex justify-content-end p-5 bg-indigo">
                    <div class="form-group mr-2">
                        <label for="filtreType">Filtrer par Type</label>
                        <select id="filtreType" wire:model='filtreType' class="form-control">
                            <option value=""></option>
                            @foreach ($typeArticles as $type)
                               <option value="{{$type->id}}">{{$type->nom}}</option> 
                            @endforeach   
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="filtreEtat">Filtrer par Etat</label>
                        <select name="" id="filtreEtat" class="form-control" wire:model='filtreEtat'>
                            <option value=""></option>
                            <option value="0">Indisponible</option>
                            <option value="1">Disponible</option>
                        </select>
                    </div>
                </div>
            <!-- Modal body -->
                <div class="modal-body">
                    <table class="table table-head table-striped text-nowrap">
                        <thead>
                            <tr>
                                <th style="width: 10%;"></th>
                                <th style="width: 10%;"></th>
                                <th style="width: 20%;">Articles</th>
                                <th style="width: 20%;" class="text-center">Type</th>
                                <th style="width: 10%;" class="text-center">Etat</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @forelse($articles as $article)
                                <tr>
                                    <td class="text-center">
                                        @if($article->estDisponible)
                                            <input class="form-check-input" wire:model='lesArticles.{{$article->id}}' type="checkbox" id="{{$article->id}}" name="{{$article->nom}}" value="{{$article->id}}">
                                        @else
                                            
                                        @endif
                                    </td>
                                    <td>
                                        @if ($article->imgUrl != "")
                                            <img src="{{asset("storage/".$article->imgUrl)}}" alt="placeholder" style="width:60px; height:60px">
                                        @else 
                                            <img src="{{asset("images/placeholder.png")}}" alt="placeholder" style="width:60px; height:60px">
                                        @endif
                                    </td>
                                    <td>{{$article->nom}} - {{$article->noSerie}}</td>
                                    <td class="text-center">{{typeArticleNom($article->type_article_id)}}</td>
                                    <td class="text-center">
                                        @if($article->estDisponible)
                                            <span class="badge bg-success">Disponible</span>
                                        @else
                                            <span class="badge bg-danger">Indisponible</span>
                                        @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-danger">
                                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                                            aucune données trouvées par rapport aux éléments de recherches entrés.
                                          </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="float-right">
                        {{$articles->links()}}
                    </div>

                </div>

                
            <!-- Modal footer -->
                <div class="modal-footer">
                    {{-- <button class="btn btn-success" wire:click='saveArticles()'><i class="fa fa-check"></i> Ajouter</button> --}}
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Terminer</button>
                </div>
            </div>
        </div>
    </div>
    
</div>



