<div class="card m-4 mt-5">
    <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des Clients</h3>
        <div class="card-tools">
            <div class="input-group input-group-sm d-flex align-items-center">
                <a href="" class="text-white" wire:click.prevent="createClient()"><i class="fas fa-user-plus"></i> Nouvel Client</a>
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
                <th style="width: 5%;"></th>
                <th style="width: 25%;">Clients</th>
                <th style="width: 20%;">Adresse</th>
                <th style="width: 15%;">Telephone</th>
                <th style="width: 15%;" class="text-center">Ajoutés</th>
                <th style="width: 20%;" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($clients as $client)
            <tr>
                <td>
                    @if($client->sexe == "H")
                        <img src="{{asset('images/utilisateur.png')}}" style="width:100%; height: 100%"/>
                    @else
                        <img src="{{asset('images/femelle.png')}}" style="width:100%; height: 100%"/>
                    @endif
                </td>
                <td>{{$client->prenom}} {{$client->nom}}</td>
                
                <td>
                    {{$client->adresse}}
                </td>

                <td>{{$client->telephone1}}</td>
                
                <td class="text-center">{{$client->created_at->diffForHumans()}}</td>
                <td class="text-center">
                    <button class="btn btn-link" wire:click.prevent='afficheClient({{$client->id}})'><i class="fas fa-list"></i></button>
                    <button class="btn btn-link" wire:click.prevent='editclient({{$client->id}})'><i class="far fa-edit"></i></button>
                    <button class="btn btn-link" wire:click.prevent='confirmDelete({{$client->id}})'><i class="far fa-trash-alt"></i></button>
                </td> 
            </tr>
        @empty
        <tr>
            <td colspan='6'>
                <div class="alert alert-info m-2 text-center">
                    <h5><i class="icon fas fa-ban"></i> Information !</h5>
                    Aucun Client pour le moment
                </div>
            </td>
        </tr>
        
        @endforelse
        </tbody>
    </table>
    </div>

    <div class="card-footer">
        <div class="float-right">
            {{$clients->links()}}
        </div>
    </div> 

    <script>
        window.addEventListener("showSuccessMessage", function(e){
            Swal.fire(e.detail)
        });

        window.addEventListener("showConfirmMessage", function(e){
            Swal.fire(e.detail).then((result)=>{
                if(result.isConfirmed){
                @this.deleteclient(e.detail.id)
                }
            });
        });

        
    </script>

</div>