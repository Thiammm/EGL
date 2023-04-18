<div class="card m-4 mt-5">
    <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fas fa-types fa-2x"></i> Liste des Utilisateurs</h3>
        <div class="card-tools">
            <div class="input-group input-group-sm d-flex align-items-center">
                <a href="" class="text-white" wire:click.prevent="goToAddtype()"><i class="fas fa-type-plus"></i> Nouvel utilisateur</a>
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
        @foreach($typearticles as $type)
            <tr>
                
                <td>{{$type->nom}}</td>
                
                <td class="text-center">{{$type->created_at->diffForHumans()}}</td>
                <td class="text-center">
                    <button class="btn btn-link" wire:click.prevent='edittype({{$type->id}})'><i class="far fa-edit"></i></button>
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
    
</div>
