<div class="row">
    <div class="col-lg-5 mt-3">
        <div class="card">
            <div class="card-header bg-primary">
                <h1 class="card-title "><i class="fas fa-list fa-2x"></i> Information sur la Location</h1>
            </div>
            <div class="card-body">
                <h5>Date de Debut:  <span style="color:blue;">{{$location->dateDebut}}</span></h5>
                <h5>Date de Fin:  <span style="color:blue;">{{$location->dateFin}}</span></h5>
                <h5>Statut Location:  <span style="color:blue;">{{$location->statutLocation->nom}}</span></h5>
                <h5>User:  <span style="color:blue;">{{$location->user->prenom}} {{$location->user->nom}}</span></h5>
                <h5>Client:  <span style="color:blue;">{{$location->client->prenom}} {{$location->client->nom}}</span></h5>
                @foreach ($location->articles as $article)
                    <h5>article {{++$loop->index}}:  <span style="color:blue;">{{$article->nom}}</span></h5>
                @endforeach
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" wire:click='goToList'>Retourner à la liste</button>
            </div>
        </div>
    </div>
</div>