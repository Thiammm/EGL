<div class="row">
    <div class="col-lg-5 mt-3">
        <div class="card">
            <div class="card-header bg-primary">
                <h1 class="card-title "><i class="fas fa-list fa-2x"></i> Information sur le client {{$client->nom}}</h1>
            </div>
            <div class="card-body">
                <h5>Nom & Prenom:  <span style="color:blue;">{{$client->nom}} {{$client->prenom}}</span></h5>
                <h5>Date de Naissance: <span style="color:blue;">{{$client->dateNaissance}}</span></h5>
                <h5>Lieu de Naissance: <span style="color:blue;">{{$client->lieuNaissance}}</span></h5>
                <h5>Adresse: <span style="color:blue;">{{$client->adresse}}</span></h5>
                <h5>Ville: <span style="color:blue;">{{$client->ville}}</span></h5>
                <h5>Pays: <span style="color:blue;">{{$client->pays}}</span></h5>
                <h5>Nationalite: <span style="color:blue;">{{$client->nationalite}}</span></h5>
                <h5>Telephone 1: <span style="color:blue;">{{$client->telephone1}}</span></h5>
                <h5>Telephone 2: <span style="color:blue;">{{$client->telephone2}}</span></h5>
                <h5>Piece d'Identite: <span style="color:blue;">{{$client->pieceIdentite}}</span></h5>
                <h5>Numero Piece Identite <span style="color:blue;">{{$client->noPieceIdentite}}</span></h5>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" wire:click='goToList'>Retourner à la liste</button>
            </div>
        </div>
    </div>
</div>
