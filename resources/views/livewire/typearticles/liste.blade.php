<div class="card m-4 mt-5">
    <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fas fa-types fa-2x"></i> Liste des Type d'Articles</h3>
        <div class="card-tools">
            <div class="input-group input-group-sm d-flex align-items-center">
                <a href="" class="btn btn-sm btn-light" wire:click.prevent="goToAddType()"><i class="fas fa-type-plus"></i> Nouvel Type d'Article</a>
                <input type="text" wire:model.debounce='search' class="form-control ml-3" placeholder="Search">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                    </button>
                </div>   
            </div>
        </div>
    </div>
    
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
                    <td class="d-flex justify-items-center">Nom du Type d'Article: <input type="text" wire:model="newTypeArticle" class="form-control ml-1"></td>
                    <td class="text-center">
                        <button class="btn btn-link text-success" wire:click.prevent='addType()'><i class="fa fa-check"></i> Valider</button>
                        <button class="btn btn-link text-warning" wire:click.prevent='goToList()'><i class="far fa-trash-alt"></i> Annuler</button>
                    </td>
                    <td></td>
                </tr>
            @endif

            @if($isBtnClick === "edit")
                <tr>
                    <td class="d-flex justify-items-center">Nouveau Nom: <input type="text" wire:model="editTypeArticle" class="form-control ml-1"></td>
                    <td class="text-center">
                        <button class="btn btn-link text-success" wire:click.prevent='updateType({{$type_id}})'><i class="fa fa-check"></i> Modifier</button>
                        <button class="btn btn-link text-warning" wire:click.prevent='goToList()'><i class="far fa-trash-alt"></i> Annuler</button>
                    </td>
                    <td></td>
                </tr>
            @endif
            @foreach($typearticles as $type)
                <tr>
                    
                    <td>{{$type->nom}}</td>
                    
                    <td class="text-center">{{$type->created_at->diffForHumans()}}</td>
                    <td class="text-center">
                        <button class="btn btn-link" wire:click.prevent='editType({{$type->id}})'><i class="far fa-edit"></i></button>
                        <button class="btn btn-link" wire:click.prevent='confirmDelete({{$type->id}})'><i class="far fa-trash-alt"></i></button>
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

    </script>

</div>
