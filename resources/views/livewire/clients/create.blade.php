<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header bg-primary">
                <p class="card-title"><i class="fas fa-user-plus fa-2x"></i> Nouvel Client</p>
            </div>
            <form wire:submit.prevent = "addClient()">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="prenom">Prenom</label>
                                <input type="text" wire:model="newClient.prenom" id="prenom" class="form-control @error("newClient.prenom")is-invalid @enderror" placeholder="Prenom" value="{{old('newClient.prenom')}}"/>
                                @error("newClient.prenom")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" wire:model="newClient.nom" id="nom" class="form-control @error("newClient.nom") is-invalid @enderror" placeholder="Nom" value="{{old('newClient.nom')}}"/>
                                @error("newClient.nom")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="sexe">Sexe</label>
                                <select wire:model="newClient.sexe" id="sexe" class="form-control @error("newClient.sexe")is-invalid @enderror">
                                    <option value="">------------</option>
                                    <option value="H">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                                @error("newClient.sexe")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" id="adresse" wire:model='newClient.adresse' class="form-control">
                                @error("newClient.adresse")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <input type="text" id="ville" wire:model='newClient.ville' class="form-control">
                                @error("newClient.ville")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="form-group">
                                <label for="pays">pays</label>
                                <input type="text" id="pays" wire:model='newClient.pays' class="form-control">
                                @error("newClient.nationalite")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div>
                        
                    </div>
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="date">Date De Naissance</label>
                                <input type="date" id="date" wire:model='newClient.dateNaissance' class="form-control">
                                @error("newClient.dateNaissance")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lieu">Lieu De Naissance</label>
                                <input type="text" id="lieu" wire:model='newClient.lieuNaissance' class="form-control">
                                @error("newClient.lieuNaissance")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div>
                        
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="nationalite">Nationalite</label>
                        <input type="text" wire:model="newClient.nationalite" id="nationalite" class="form-control @error("newClient.nationalite")is-invalid @enderror" placeholder="Nationalite"/>

                        @error("newClient.nationalite")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                       

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="telephone1">Telephone 1</label>
                                <input type="tel" wire:model="newClient.telephone1" id="telephone1" class="form-control @error("newClient.telephone1")is-invalid @enderror" placeholder="Telephone 1" />
                                @error("newClient.telephone1")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="telephone2">Telephone 2</label>
                                <input type="tel" wire:model="newClient.telephone2" id="telephone2" class="form-control @error("newClient.telephone2")is-invalid @enderror" placeholder="Telephone 2" />
                                @error("newClient.telephone2")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group">
                                <label for="pieceidentite">Piece d'Identite</label>
                                <select wire:model="newClient.pieceIdentite" id="pieceidentite" class="form-control @error("newClient.pieceIdentite")is-invalid @enderror" value="old('newClient.pieceIdentite')">
                                    <option value="">----------------</option>
                                    <option value="CNI">CNI</option>
                                    <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
                                    <option value="PASSPORT">PASSPORT</option>
                                </select>
                                @error("newClient.pieceIdentite")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nopieceidentite">Numéro de pièce d'identité</label>
                                <input type="text" wire:model="newClient.noPieceIdentite" id="nopieceidentite" class="form-control @error("newClient.noPieceIdentite")is-invalid @enderror">
                                @error("newClient.noPieceIdentite")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" class="btn btn-danger" wire:click.prevent="goToList()">Retourner à la liste des clients</button>
                </div>
                
            </form>
        </div>
    </div>

    
    
</div>