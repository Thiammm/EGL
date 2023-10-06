<div class="row">
    <div class="col-md-8 mt-4">
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex">
                <div class="flex-grow-1">
                    <p class="card-title text-center"><i class="fas fa-exchange-alt fa-2x "></i> Liste des Locations</p>
                </div>
                <div> 
                    <button class="btn btn-light" wire:click='ajouterLocation' ><i class="fas fa-plus"></i> Nouvelle Location</button>
                </div>
            </div>
            
            <div class="card-body card-body table-responsive p-0 h-auto" style="height:150px">

                
                <table class="table table-head-fixed table-striped text-nowrap">
                    <thead>
                        <tr>
                            <th></th>
                            <th style="width: 20%">Date Debut</th>
                            <th style="width: 20%">Date Fin</th>
                            <th class="text-center" style="width: 15%">Statut Location</th>
                            <th class="text-center" style="width: 15%">User</th>
                            <th class="text-center" style="width: 15%">Client</th>
                            <th class="text-center" style="width: 15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- ++$loop->index --}}
                        @forelse($locations as $location)
                            <tr>
                                <td>{{$location->id}}</td>
                                <td>{{$location->dateDebut}}</td>
                                <td>{{$location->dateFin}}</td>
                                <td class="text-center">{{$location->statutLocation->nom}}</td>
                                <td class="text-center">{{$location->user->prenom}} {{$location->user->nom}}</td>
                                <td class="text-center">{{$location->client->prenom}} {{$location->client->nom}}</td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click='editerLocation({{$location->id}})'><i class="far fa-edit"></i></button>
                                    <button class="btn btn-link" wire:click='details({{$location->id}})'><i class="fa fa-list"></i></button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">
                                    <div class="alert alert-info m-2">
                                        <h5><i class="icon fas fa-ban"></i> Information !</h5>
                                        Aucune Location à afficher
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <div class="float-right">
                    {{$locations->links()}}
                </div>
            </div>
        </div>
    </div>

    @if($detail)
        {{-- <div class="row"> --}}
            <div class="col-lg-4 mt-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h1 class="card-title "><i class="fas fa-list fa-2x"></i> Information sur la Location {{$locationChoisi->id}}</h1>
                    </div>
                    <div class="card-body">
                        <h5>Date de Debut:  <span style="color:blue;">{{$locationChoisi->dateDebut}}</span></h5>
                        <h5>Date de Fin:  <span style="color:blue;">{{$locationChoisi->dateFin}}</span></h5>
                        <h5>Statut Location:  <span style="color:blue;">{{$locationChoisi->statutLocation->nom}}</span></h5>
                        <h5>User:  <span style="color:blue;">{{$locationChoisi->user->prenom}} {{$locationChoisi->user->nom}}</span></h5>
                        <h5>Client:  <span style="color:blue;">{{$location->client->prenom}} {{$locationChoisi->client->nom}}</span></h5>
                        @foreach ($locationChoisi->articles as $article)
                            <h5>article {{++$loop->index}}:  <span style="color:blue;">{{$article->nom}}</span></h5>
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-danger" wire:click='goToList'>Fermer</button>
                    </div>
                </div>
            </div>
        {{-- </div> --}}
    @endif

    






    <script>
        window.addEventListener("showSuccessMessage", function(e){
            Swal.fire(e.detail);
        });

        window.addEventListener("showConfirmMessage", function(e){
            Swal.fire(e.detail);
        });
    </script>

</div>