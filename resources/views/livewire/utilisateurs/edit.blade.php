<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header bg-primary">
                <p class="card-title text-center"><i class="fas fa-user-plus fa-2x"></i> Modifier utilisateur</p>
            </div>
            <form wire:submit.prevent = "updateUser()">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="prenom">Prenom</label>
                                <input type="text" wire:model="editUser.prenom" id="prenom" class="form-control @error("editUser.prenom")is-invalid @enderror" placeholder="Prenom" } value="{{old("editUser.prenom")}}" />
                                @error("editUser.prenom")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" wire:model="editUser.nom" id="nom" class="form-control @error("editUser.nom") is-invalid @enderror" placeholder="Nom" value="{{old("editUser.nom")}}" />
                                @error("editUser.nom")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label for="sexe">Sexe</label>
                        <select wire:model="editUser.sexe" id="sexe" class="form-control @error("editUser.sexe")is-invalid @enderror" value="{{old('editUser.sexe')}}">
                            <option value="">------------</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                        @error("editUser.sexe")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" wire:model="editUser.email" id="email" class="form-control @error("editUser.email")is-invalid @enderror" placeholder="Votre Email" value="{{old("editUser.email")}}" />

                        @error("editUser.email")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="telephone1">Telephone 1</label>
                                <input type="tel" wire:model="editUser.telephone1" id="telephone1" class="form-control @error("editUser.telephone1")is-invalid @enderror" placeholder="Telephone 1" value="{{old("editUser.telphone1")}}" />
                                @error("editUser.telephone1")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="telephone2">Telephone 2</label>
                                <input type="tel" wire:model="editUser.telephone2" id="telephone2" class="form-control @error("editUser.telephone2")is-invalid @enderror" placeholder="Telephone 2" value="{{old("editUser.telephone2")}}" />
                                @error("editUser.telephone2")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                    </div>

                    <div class="form-group">
                        <select wire:model="editUser.pieceIdentite" id="pieceidentite" class="form-control @error("editUser.pieceIdentite")is-invalid @enderror" value="old('editUser.pieceIdentite')" value="{{old("editUser.pieceIdentite")}}">
                            <option value="">----------------</option>
                            <option value="CNI">CNI</option>
                            <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
                            <option value="PASSPORT">PASSPORT</option>
                        </select>
                        @error("editUser.pieceIdentite")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nopieceidentite">Numéro de pièce d'identité</label>
                        <input type="text" wire:model="editUser.noPieceIdentite" id="nopieceidentite" class="form-control @error("editUser.noPieceIdentite")is-invalid @enderror" value="{{old("editUser.noPieceIdentite")}}" />
                        @error("editUser.noPieceIdentite")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="form-group">
                        <label for="password">Mot de pass</label>
                        <input type="password" class="form-control"  id="password">
                    </div> --}}
                    
                </div>
                
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary" wire:click.prevent="updateUser({{$editUser['id']}})">Modifier</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="goToList()">Retourner à la liste des utilisateurs</button>
                </div>
                
            </form>
        </div>
    </div>

    <div class="col-md-6 mt-4">

        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title"><i class="fas fa-key fa-2x"></i>   Authentification</div>
            </div>
            <div class="card-body">
                <ul><li><a href="" wire:click.prevent='confirmReinitialisation({{$user_id}})'>réinialiser le mot de passe  </a> (pardefaut: "pasword") </li></ul>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary">
                <div class="card-title"><i class="fas fa-fingerprint fa-2x"></i>    Roles et Permissions</div>
                <button class="btn bg-gradient-success float-right" wire:click='updateRolesPermissions({{$user_id}})'>Mettre à jour les modifications</button>
            </div>
            <div class="card-body">
                <div id="accordion">
                    @foreach($allRoles as $role)
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4 class="card-title text-primary flex-grow-1">
                                    {{-- <a data-parent="#accordion" wire:click.prevent='' href="" aria-expanded="true"> --}}
                                        {{$role->name}}
                                    {{-- </a> --}}
                                </h4>
                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                    <input type="checkbox" wire:model = "rolesUpdated.{{$role->name}}" class="custom-control-input" id="{{$role->name}}">
                                    <label for="{{$role->name}}" class="custom-control-label">@if($rolesUpdated[$role->name])activé@else Desactivé @endif</label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="card">
                        {{-- <div class="card-body"> --}}
                            <table class="table">
                                <thead>
                                    <th><h4>Permissions</h4></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    @foreach ($allPermissions as $permission)
                                        <tr>
                                            <td>{{$permission->name}}</td>
                                            <td>
                                                <div class="custom-control float-right custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input type="checkbox" wire:model='permissionsUpdated.{{$permission->name}}' class="custom-control-input" id="{{$permission->name}}">
                                                    <label for="{{$permission->name}}" class="custom-control-label">@if($permissionsUpdated[$permission->name])Activé @else Desactivé @endif</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach    
                                </tbody>
                            </table>
                        {{-- </div> --}}
                        
                    </div>   

                </div>
                
            </div>
        </div>

    </div>
    
</div>