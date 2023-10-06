<div class="row">
    <div class="col-md-8 mt-4">
        <div class="card">
            <div class="card-header bg-gradient-primary d-flex">
                <div class="flex-grow-1">
                    <p class="card-title text-center"><i class="fas fa-exchange-alt fa-2x "></i> Gestion des Paiments</p>
                </div>
                <div> 
                    
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
                            <th class="text-center" style="width: 15%">Etat</th>
                            <th class="text-center" style="width: 15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $location)
                            <tr>
                                <td>{{$location->id}}</td>
                                <td>{{$location->dateDebut}}</td>
                                <td>{{$location->dateFin}}</td>
                                <td class="text-center">{{$location->statutLocation->nom}}</td>
                                <td class="text-center">{{$location->user->prenom}} {{$location->user->nom}}</td>
                                <td class="text-center">{{$location->client->prenom}} {{$location->client->nom}}</td>
                                <td class="text-center">
                                    @if(estEffectue($location))
                                        <span class="badge bg-success">Effectué</span>
                                    @else  
                                        <span class="badge bg-danger">Non Effectué</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-link" wire:click='createPayment({{$location->id}})'><i class="far fa-credit-card"></i></button>
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


    <script>
        window.addEventListener("showSuccessMessage", function(e){
            Swal.fire(e.detail);
        });

        window.addEventListener("showConfirmMessage", function(e){
            Swal.fire(e.detail);
        });
    </script>

</div>


 