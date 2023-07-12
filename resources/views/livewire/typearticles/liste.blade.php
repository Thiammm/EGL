<div class="card m-4 mt-5">
    <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fas fa-list fa-2x"></i> Liste des Type d'Articles</h3>
        <div class="card-tools">
            <div class="input-group input-group-sm d-flex align-items-center">
                <a href="" class="btn btn-sm btn-light" wire:click.prevent="goToAddType()"><i class="fas fa-plus"></i> Nouvel Type d'Article</a>
                <input type="text" wire:model.debounce='search' class="form-control ml-3" placeholder="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>   
            </div>
        </div>
    </div>

    
    <!-- The Modal -->
    
    
    <div class="card-body table-responsive p-0 h-auto">
    <table class="table table-head-fixed table-striped text-nowrap">
        <thead>
            <tr>
                <th style="width: 50%;">Articles</th>
                <th style="width: 20%;" class="text-center">Ajoutés</th>
                <th style="width: 30%;" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @if($isBtnClick === "creer")
                <tr>
                    <td class="d-flex justify-items-center" style="width: 150%;"><input type="text" wire:keydown.enter='addType()' wire:model="newTypeArticle" class="form-control" placeholder="Entrer Le Nom Du Type d'Article"></td>
                    <td></td>
                    <td class="text-center">
                        <button class="btn btn-link text-success" wire:click.prevent='addType()'><i class="fa fa-check"></i> Valider</button>
                        <button class="btn btn-link text-warning" wire:click.prevent='goToList()'><i class="far fa-trash-alt"></i> Annuler</button>
                    </td>
                    
                </tr>
            @endif

            {{-- @if($isBtnClick === "edit")
                <tr>
                    <td class="d-flex justify-items-center">Nouveau Nom: <input type="text" wire:model="editTypeArticle" class="form-control ml-1"></td>
                    <td class="text-center">
                        <button class="btn btn-link text-success" wire:click.prevent='updateType({{$type_id}})'><i class="fa fa-check"></i> Modifier</button>
                        <button class="btn btn-link text-warning" wire:click.prevent='goToList()'><i class="far fa-trash-alt"></i> Annuler</button>
                    </td>
                    <td></td>
                </tr>
            @endif --}} 
            @foreach($typearticles as $type)
            {{-- verification de l'existance d'un propriete article --}}

            {{-- les bouttons de manipulation --}}
                <tr>
                    <td>{{$type->nom}}</td>
                    <td class="text-center">{{$type->created_at->diffForHumans()}}</td>
                    <td class="text-center">
                        <button class="btn btn-link" wire:click.prevent='editType({{$type->id}})'><i class="far fa-edit"></i> Editer</button>
                        <button type="button" class="btn btn-link"  data-bs-toggle="modal" data-bs-target="#myModal" wire:click.prevent='modalOpen({{$type->id}})'><i class="fas fa-list"></i>
                            Proprietes
                        </button>
                        <div wire:ignore.self class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" style="z-index: 1222;" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Edition de la propriete: <strong>{{$nomProprieteChoisi}}</strong></h4>
                                    </div>
                    
                                <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="bg-gray-light d-flex justify-content-between p-2">
                                            <div class="form-group mr-2 d-flex flex-column" style="width:60%">
                                                <input type="text" class="form-control @error('editPropriete.nom')
                                                    is-invalid
                                                @enderror" wire:model="editPropriete.nom" placeholder="Nom de La Propriete" value="{{old('editPropriete.nom')}}"/>
                                                @error('editPropriete.nom')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                                
                                            </div>
                                            <div class="form-group mr-2 d-flex flex-column" style="width:60%">
                                                <select class="form-control @error('editPropriete.estObligatoire')
                                                    is-invalid
                                                @enderror" wire:model="editPropriete.estObligatoire" value="old('editPropriete.estObligatoire')">
                                                    <option value="">---Champ Obligatoire---</option>
                                                    <option value=1 >Oui</option>
                                                    <option value=0 >Non</option>
                                                </select>
                                                @error('editPropriete.estObligatoire')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group" style="width:20%">
                                                <button class="btn btn-success" wire:click='updateProprieteArticle({{$proprieteArticleChoisi}})'><i class="fa fa-check"></i>Modifier</button>
                                            </div>
                                        </div>  
                                    </div>
                    
                                <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div wire:ignore.self class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h4 class="modal-title">Gestion des proprietes de: <strong>{{$nomDuType}}</strong></h4>
                                        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> --}}
                                    </div>
                                <!-- Modal body -->
                                    <div class="modal-body">
                                        <div class="bg-gray-light d-flex justify-content-between p-2">
                                            <div class="form-group mr-2 d-flex align-items-center flex-column" style="width:50%">
                                                <input type="text" class="form-control @error('newPropriete.nom')
                                                    is-invalid
                                                @enderror" wire:model="newPropriete.nom" placeholder="Nom de La Propriete"/>
                                                @error('newPropriete.nom')
                                                <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                                
                                            </div>
                                            <div class="form-group mr-2 d-flex flex-column" style="width:50%">
                                                <select class="form-control @error('newPropriete.estObligatoire')
                                                    is-invalid
                                                @enderror" wire:model="newPropriete.estObligatoire">
                                                    <option value="">---Champ Obligatoire---</option>
                                                    <option value=1 >Oui</option>
                                                    <option value=0 >Non</option>
                                                </select>
                                                @error('newPropriete.estObligatoire')
                                                    <div class="invalid-feedback">{{$message}}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-success" wire:click='saveProprietes({{$typeArticleChoisi}})'><i class="fa fa-check"></i> Ajouter</button>
                                            </div>
                                        </div>
                                        
                                        <div class="mt-3">
                                            <table class="table table-bordered">
                                                {{-- <thead> --}}
                                                    <tr class="bg-primary">
                                                        <th>Proprietes</th>
                                                        <th>Champ Obligatoire</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                    
                                                {{-- </thead> --}}
                                                <tbody>
                                                    @forelse($proprietesTypeArticles as $propriete)
                                                        <tr>
                                                            <td>{{$propriete->nom}}</td>
                                                            <td>{{$propriete->estObligatoire == 0 ? "NON" : "OUI"}}</td>
                                                            <td class="text-center">
                                                                <button data-bs-toggle="modal" data-bs-target="#editModal" wire:click='editProprieteArticles({{$propriete}})' class="btn btn-link"><i class="far fa-edit"></i></button>
                                                                <button wire:click='confirmDeletePropriete({{$propriete->id}})' class="btn btn-link"><i class="far fa-trash-alt"></i></button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="3" class="text-green">Ce Type d'article n'a aucunes propreietes</td>
                                                        </tr>
                                                    @endforelse
                                                    
                                                </tbody>
                                            </table>
                                        </div>  
                                        
                                        <div class="float-right">
                                            {{$proprietesTypeArticles->links()}}
                                        </div>
                                    </div>

                                    
                                <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--permisssion de suppression seulement pour les type d'articles qui ne sont liée à aucun article--}}
                            @if(!existeArticle($type))
                                <button class="btn btn-link" wire:click.prevent='confirmDelete({{$type->id}})'><i class="fas fa-trash-alt"></i> Delete</button>
                            @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    <div class="card-footer">
        <div class="float-right">
            {{$typearticles->links()}}
        </div>    
    </div>
    
    {{-- modal pour l'edition des proprietes des types d'articles --}}


 

    <script>
        window.addEventListener("showSuccessMessage", function(e){
            Swal.fire(e.detail);
        });

        window.addEventListener('showConfirmMessage', function(e){
            Swal.fire(e.detail).then((result)=>{
                if(result.isConfirmed){
                @this.deleteType(e.detail.id)
                }
            })
        })

        window.addEventListener('showConfirmMessagePropriete', function(e){
            Swal.fire(e.detail).then((result)=>{
                if(result.isConfirmed){
                @this.deletePropriete(e.detail.id)
                }
            })
        })

        window.addEventListener("showEditForm", function(e){
            Swal.fire({
                title: e.detail.title,
                input: e.detail.input,
                inputLabel: e.detail.inputLabel,
                inputValue: e.detail.inputValue,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Modifier',
                cancelButtonText: 'Annuler',
                inputValidator: (value) => {
                    if (!value) {
                        return 'Le Champ est obligatoire';
                    }

                    @this.updateType(e.detail.id, value);
                }
                
            });
        });

    </script>
</div>
