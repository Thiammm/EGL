<div class="card m-4 mt-5">
    <div class="card-header bg-gradient-primary d-flex align-items-center">
        <h3 class="card-title flex-grow-1"><i class="fas fa-users fa-2x"></i> Liste des Utilisateurs</h3>
        <div class="card-tools">
            <div class="input-group input-group-sm d-flex align-items-center">
                <a href="" class="text-white" wire:click.prevent="goToAddUser()"><i class="fas fa-user-plus"></i> Nouvel utilisateur</a>
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
                <th style="width: 25%;">Users</th>
                <th style="width: 20%;">Roles</th>
                <th style="width: 20%;" class="text-center">Ajoutés</th>
                <th style="width: 30%;" class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>
                    @if($user->sexe == "H")
                        <img src="{{asset('images/utilisateur.png')}}" style="width:100%; height: 100%"/>
                    @else
                        <img src="{{asset('images/femelle.png')}}" style="width:100%; height: 100%"/>
                    @endif
                </td>
                <td>{{$user->prenom}} {{$user->nom}}</td>
                
                <td>
                    {{$user->roles->implode('nom', ' | ')}}
                </td>
                
                <td class="text-center">{{$user->created_at->diffForHumans()}}</td>
                <td class="text-center">
                    <button class="btn btn-link" wire:click.prevent='editUser({{$user->id}})'><i class="far fa-edit"></i></button>
                    <button class="btn btn-link" wire:click.prevent='confirmDelete({{$user->id}})'><i class="far fa-trash-alt"></i></button>
                </td> 
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>

    <div class="card-footer float-right">
        <div class="float-right">
            {{$users->links()}}
        </div>
    </div> 

    <script>
        window.addEventListener("showSuccessMessage", function(e){
            Swal.fire(e.detail)
        });

        window.addEventListener("showConfirmMessage", function(e){
            Swal.fire(e.detail).then((result)=>{
                if(result.isConfirmed){
                @this.deleteUser(e.detail.id)
                }
            })
        });

        window.addEventListener("showConfirmMessageReset", function(e){
            Swal.fire(e.detail).then((result)=>{
                if(result.isConfirmed){
                @this.reinitialiser(e.detail.id)
                }
            })
        });
        
    </script>

</div>