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
                        @forelse($locations as $loc)
                            <tr>
                                <td>{{$loc->id}}</td>
                                <td>{{$loc->dateDebut}}</td>
                                <td>{{$loc->dateFin}}</td>
                                <td class="text-center">{{$loc->statutLocation->nom}}</td>
                                <td class="text-center">{{$loc->user->prenom}} {{$loc->user->nom}}</td>
                                <td class="text-center">{{$loc->client->prenom}} {{$loc->client->nom}}</td>
                                <td class="text-center">
                                    @if(estEffectue($loc))
                                        <span class="badge bg-success">Effectué</span>
                                    @else  
                                        <span class="badge bg-danger">Non Effectué</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if(!estEffectue($loc))
                                        <button class="btn btn-link" wire:click='createPayment({{$loc->id}})'><i class="far fa-credit-card"></i></button>
                                    @else
                                    <button class="btn btn-link" data-bs-toggle="modal" data-bs-target="#myModal" wire:click='affichePayment({{$loc->id}})'><i class="far fa-file-alt mr-1"></i></button>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="alert alert-info m-2 text-center">
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
    <div wire:ignore.self class="modal fade" id="myModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
            <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Le Payment est déja Efféctué!</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
            <!-- Modal body -->
              <div class="modal-body">
                <div class="row">
                  <div class="col-12 table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th>Qty</th>
                        <th>Article</th>
                        <th>Serial #</th>
                        <th>Durée Location</th>
                        <th>Subtotal</th>
                      </tr>
                      </thead>
                      <tbody>
                        @forelse ($location->articles as $article)
                         <tr>
                         <td>{{$article->id}}</td>
                         <td>{{$article->nom}}</td>
                         <td>{{$article->noSerie}}</td>
                         <td>
                            @if(intervalJour($location) >= 7)
                              @if(modulo($location))
                              {{intervalSemaine($location)}} semaine(s) et {{modulo($location)}} jours
                              @else
                              {{intervalSemaine($location)}} semaine(s)
                              @endif
                            @else
                              {{intervalJour($location)}} jour(s)
                            @endif
                        </td>
                        <td>
                          @if(dateDiff($location->dateDebut, $location->dateFin)->d >= 7)
                            @if(modulo($location))
                            {{intervalSemaine($location) * prix($article, 3) + modulo($location) * prix($article, 1)}} XAF
                            @else
                              {{intervalSemaine($location) * prix($article, 3)}} XAF
                            @endif
                          @else
                            {{intervalJour($location) * prix($article, 1)}} XAF
                          @endif
                        </td>
                         </tr>
                        @empty
                            <td colspan="4" class="text-center">Aucun articles selectionné</td> 
                        @endforelse
                         <tr>
                          <td colspan="4" class="text-center"><h2>Total</h2></td>
                          <td><h2>{{total($location, $total)}} XAF</h2></td>
                         </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- /.col -->
                </div>
              </div>
  
            <!-- Modal footer -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
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


 





