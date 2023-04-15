<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header bg-primary">
                <p class="card-title text-center"><i class="fas fa-user-plus fa-2x"></i> Nouvel utilisateur</p>
            </div>
            <form wire:submit.prevent = "addUser()">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="prenom">Prenom</label>
                                <input type="text" wire:model="newUser.prenom" id="prenom" class="form-control @error("newUser.prenom")is-invalid @enderror" placeholder="Prenom" value="{{old('newUser.prenom')}}"/>
                                @error("newUser.prenom")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" wire:model="newUser.nom" id="nom" class="form-control @error("newUser.nom") is-invalid @enderror" placeholder="Nom" value="{{old('newUser.nom')}}"/>
                                @error("newUser.nom")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="form-group">
                        <label for="sexe">Sexe</label>
                        <select wire:model="newUser.sexe" id="sexe" class="form-control @error("newUser.sexe")is-invalid @enderror">
                            <option value="">------------</option>
                            <option value="H">Homme</option>
                            <option value="F">Femme</option>
                        </select>
                        @error("newUser.sexe")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" wire:model="newUser.email" id="email" class="form-control @error("newUser.email")is-invalid @enderror" placeholder="Votre Email" />

                        @error("newUser.email")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="telephone1">Telephone 1</label>
                                <input type="tel" wire:model="newUser.telephone1" id="telephone1" class="form-control @error("newUser.telephone1")is-invalid @enderror" placeholder="Telephone 1" />
                                @error("newUser.telephone1")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="telephone2">Telephone 2</label>
                                <input type="tel" wire:model="newUser.telephone2" id="telephone2" class="form-control @error("newUser.telephone2")is-invalid @enderror" placeholder="Telephone 2" />
                                @error("newUser.telephone2")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                    </div>

                    <div class="form-group">
                        <select wire:model="newUser.pieceIdentite" id="pieceidentite" class="form-control @error("newUser.pieceIdentite")is-invalid @enderror" value="old('newUser.pieceIdentite')">
                            <option value="">----------------</option>
                            <option value="CNI">CNI</option>
                            <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
                            <option value="PASSPORT">PASSPORT</option>
                        </select>
                        @error("newUser.pieceIdentite")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="nopieceidentite">Numéro de pièce d'identité</label>
                        <input type="text" wire:model="newUser.noPieceIdentite" id="nopieceidentite" class="form-control @error("newUser.noPieceIdentite")is-invalid @enderror">
                        @error("newUser.noPieceIdentite")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- <div class="form-group">
                        <label for="password">Mot de pass</label>
                        <input type="password" class="form-control"  id="password">
                    </div> --}}
                    
                </div>
                
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="goToList()">Retourner à la liste des utilisateurs</button>
                </div>
                
            </form>
        </div>
    </div>

    
    
</div>




