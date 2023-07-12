<div class="card m-4 mt-5">
    <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fas fa-list fa-2x"></i> Liste des Articles</h3>
        <div class="card-tools">
            <div class="input-group input-group-sm d-flex align-items-center">
                <button data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-sm btn-light"><i class="fas fa-plus"></i> Nouvel Article</button>
                <input type="text" class="form-control ml-3" wire:model='search' placeholder="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>   
            </div>
        </div>
    </div>

    
    <!-- The Modal -->
    
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
    
    <div class="card-body table-responsive 
    p-0 h-auto">
    <table class="table table-head-fixed table-striped text-nowrap">
        <thead>
            <tr>
                <th style="width: 10%;"></th>
                <th style="width: 20%;">Articles</th>
                <th style="width: 20%;" class="text-center">Type</th>
                <th style="width: 20%;" class="text-center">Etat</th>
                <th style="width: 10%;" class="text-center">Ajoutés</th>
                <th style="width: 20%;" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            
            @forelse($articles as $article)
                <tr>
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
                    </td>
                    {{-- {{route('admin.gestionarticles.tarifications.index')}} --}}
                    <td class="text-center">{{$article->created_at->diffForHumans()}}</td>
                    <td class="text-center">
                        <a href="" wire:click.prevent='ouvrirTarification({{$article->id}})' class="btn btn-link"><i class="fas fa-money-check"></i></a>
                        <button class="btn btn-link" wire:click='editArticle({{$article->id}})' data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="far fa-edit"></i></button>
                        <button class="btn btn-link" wire:click='confirmDelete({{$article->id}})' ><i class="fas fa-trash-alt"></i></button>
                    </td>
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
    </div>
    <div class="card-footer">
        <div class="float-right">
            {{$articles->links()}}
        </div>    
    </div>

    {{-- Modallllllllllllllllllllllllllll --}}

    <div wire:ignore.self class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Creation d'un nouvel Article</h4>
                </div>
            <!-- Modal body -->
                <div class="modal-body">
                    <div class="d-flex justify-content-between p-2" style="position:relative">
                        <div class="bg-gray-light" style="width:70%">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <h5><i class="icon fas fa-ban"></i> Erreurs !</h5>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="nom">Nom de l'Article</label>
                                <input type="text" class="form-control" id="nom" wire:model='newArticle.nom'>
                            </div>
                            <div class="form-group">
                                <label for="noSerie">Numero de Serie</label>
                                <input type="text" class="form-control" id="noSerie" wire:model='newArticle.noSerie'>
                            </div> 
                            <div class="form-group">
                                <label for="type">Type d'Article</label>
                                <select name="" id="type" class="form-control" wire:model='newArticle.type_article_id'>
                                    <option value=""></option>
                                    @foreach ($typeArticles as $type)
                                        <option value="{{$type->id}}">{{$type->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($proprieteSelections != null)
                                @foreach ($proprieteSelections as $proprietes)
                                    <div class="form-group">
                                        <label for="{{$proprietes->id}}">{{$proprietes->nom}}@if ($proprietes->estObligatoire == 0)
                                            (optionnelle)
                                        @endif</label>
                                        <input type="text" id="{{$proprietes->id}}" class="form-control" wire:model='proprietesType.{{$proprietes->nom}}'>
                                    </div>
                                @endforeach
                            @endif
                             
                        </div>
                        <div style="position:relative; width:30%" class="d-flex flex-column justify-content-center align-items-center">
                            <div class="mb-2 d-flex ml-2" style="width: 100%"> 
                                <input type="file" wire:model='image' id="image{{$iteration}}">
                            </div>
                            <div class="d-flex text-center justify-content-center" style="height: 200px; width:200px; border: 1px solid black; border-radius:20px; max-height:200px">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" style="height: 200px; width:200px; border-radius:20px;">
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    
                </div>

                
            <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success" wire:click.prevent='addArticle'>Valider</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div wire:ignore.self class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edition de l'Article</h4>
                </div>
            <!-- Modal body -->
                <div class="modal-body">
                    <div class="d-flex justify-content-between p-2" style="position:relative">
                        <div class="bg-gray-light" style="width:70%">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <h5><i class="icon fas fa-ban"></i> Erreurs !</h5>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="nom">Nom de l'Article</label>
                                <input type="text" class="form-control" id="nom" wire:model='editArticle.nom'>
                            </div>
                            <div class="form-group">
                                <label for="noSerie">Numero de Serie</label>
                                <input type="text" class="form-control" id="noSerie" wire:model='editArticle.noSerie'>
                            </div> 
                            <div class="form-group">
                                <label for="type">Type d'Article</label>
                                <select name="" id="type" class="form-control" wire:model='editArticle.type_article_id'>
                                    <option value=""></option>
                                    @foreach ($typeArticles as $type)
                                        <option value="{{$type->id}}">{{$type->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($proprieteSelectionEdit != null)
                                @foreach ($proprieteSelectionEdit as $proprietes)
                                    <div class="form-group">
                                        <label for="{{$proprietes->id}}">{{$proprietes->nom}}@if ($proprietes->estObligatoire == 0)
                                            (optionnelle)
                                        @endif</label>
                                        <input type="text" id="{{$proprietes->id}}" class="form-control" wire:model="proprietesEdit.{{$proprietes->nom}}">
                                    </div>
                                @endforeach
                            @endif
                             
                        </div>
                        <div style="position:relative; width:30%" class="d-flex flex-column  align-items-center">
                            <div class="mb-2 d-flex ml-2" style="width: 100%"> 
                                <input type="file" wire:model='image' value=none>
                            </div>
                            <div class="d-flex text-center justify-content-center" style="height: 200px; width:200px; border: 1px solid black; border-radius:20px; max-height:200px">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" style="height: 200px; width:200px;border-radius:20px;">
                                @elseif($imgUrl == "")
                                    <img src="{{asset("images/placeholder.png")}}" style="height: 200px; width:200px;border-radius:20px;">
                                @elseif ($imgUrl != "0")
                                    <img src="{{asset("storage/".$imgUrl)}}" style="height: 200px; width:200px;border-radius:20px;">
                                @endif
                            </div>
                        </div>
                        
                    </div>
                    
                </div>

                
            <!-- Modal footer -->
                <div class="modal-footer">
                    <button class="btn btn-success" wire:click.prevent='updateArticle({{$article_id}})'>Valider</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        window.addEventListener("showSuccessMessage", function(e){
            Swal.fire(e.detail);
        });

        window.addEventListener('showConfirmMessage', function(e){
            Swal.fire(e.detail).then((result)=>{
                if(result.isConfirmed){
                @this.deleteArticle(e.detail.id)
                }
            })
        });

        var myDiv = document.getElementById('avatar');
        window.addEventListener('addImage', function(e){
            // var mydiv = document.getElementById('avatar');
            myDiv.style.border = "none";
        });
    </script>

</div>
