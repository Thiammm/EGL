<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header bg-primary">
                <p class="card-title"><i class="far fa-edit fa-2x"></i> Editer le Client</p>
            </div>
            <form wire:submit.prevent = "updateClient({{$clientId}})">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="prenom">Prenom</label>
                                <input type="text" wire:model="editClient.prenom" id="prenom" class="form-control @error("editClient.prenom")is-invalid @enderror" placeholder="Prenom" value="{{old('editClient.prenom')}}"/>
                                @error("editClient.prenom")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nom">Nom</label>
                                <input type="text" wire:model="editClient.nom" id="nom" class="form-control @error("editClient.nom") is-invalid @enderror" placeholder="Nom" value="{{old('editClient.nom')}}"/>
                                @error("editClient.nom")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="sexe">Sexe</label>
                                <select wire:model="editClient.sexe" id="sexe" class="form-control @error("editClient.sexe")is-invalid @enderror">
                                    <option value="">------------</option>
                                    <option value="H">Homme</option>
                                    <option value="F">Femme</option>
                                </select>
                                @error("editClient.sexe")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" id="adresse" wire:model='editClient.adresse' class="form-control">
                                @error("editClient.adresse")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="ville">Ville</label>
                                <input type="text" id="ville" wire:model='editClient.ville' class="form-control">
                                @error("editClient.ville")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="form-group">
                                <label for="pays">pays</label>
                                <input type="text" id="pays" wire:model='editClient.pays' class="form-control">
                                @error("editClient.nationalite")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div>
                        
                    </div>
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="date">Date De Naissance</label>
                                <input type="date" id="date" wire:model='editClient.dateNaissance' class="form-control">
                                @error("editClient.dateNaissance")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="lieu">Lieu De Naissance</label>
                                <input type="text" id="lieu" wire:model='editClient.lieuNaissance' class="form-control">
                                @error("editClient.lieuNaissance")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div>
                        
                    </div>
                    
                    <div class="form-group">
                        <label for="nationalite">Nationalite</label>
                        <input type="text" wire:model="editClient.nationalite" id="nationalite" class="form-control @error("editClient.nationalite")is-invalid @enderror" placeholder="Nationalite"/>

                        @error("editClient.nationalite")
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                   

                    <div class="row">

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="telephone1">Telephone 1</label>
                                <input type="tel" wire:model="editClient.telephone1" id="telephone1" class="form-control @error("editClient.telephone1")is-invalid @enderror" placeholder="Telephone 1" />
                                @error("editClient.telephone1")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="telephone2">Telephone 2</label>
                                <input type="tel" wire:model="editClient.telephone2" id="telephone2" class="form-control @error("editClient.telephone2")is-invalid @enderror" placeholder="Telephone 2" />
                                @error("editClient.telephone2")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                           <div class="form-group">
                                <label for="pieceidentite">Piece d'Identite</label>
                                <select wire:model="editClient.pieceIdentite" id="pieceidentite" class="form-control @error("editClient.pieceIdentite")is-invalid @enderror" value="old('editClient.pieceIdentite')">
                                    <option value="">----------------</option>
                                    <option value="CNI">CNI</option>
                                    <option value="PERMIS DE CONDUIRE">PERMIS DE CONDUIRE</option>
                                    <option value="PASSPORT">PASSPORT</option>
                                </select>
                                @error("editClient.pieceIdentite")
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> 
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="nopieceidentite">Numéro de pièce d'identité</label>
                                <input type="text" wire:model="editClient.noPieceIdentite" id="nopieceidentite" class="form-control @error("editClient.noPieceIdentite")is-invalid @enderror">
                                @error("editClient.noPieceIdentite")
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