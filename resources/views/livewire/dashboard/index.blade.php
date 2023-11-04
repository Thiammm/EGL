<div class="">


  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Dashboard</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group me-2">
        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
      </div>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->
      {{-- <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Articles</span>
              <span class="info-box-number">
                10
                <small>%</small>
              </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Clients</span>
              <span class="info-box-number">41,410</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix hidden-md-up"></div>

        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Locations</span>
              <span class="info-box-number">760</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-12 col-sm-6 col-md-3">
          <div class="info-box mb-3">
            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Users</span>
              <span class="info-box-number">2,000</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div> --}}
      <!-- /.row -->

        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$nombreLocations}}</h3>

                <p>Locations</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$nombreArticles}}</h3>

                <p>Articles</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$nombreClients}}</h3>

                <p>Clients</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$nombreUsers}}</h3>

                <p>Users</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>
          <!-- ./col -->
        </div>

        {{-- <div class="row"> --}}

          {{-- ------------------------CANVAS----------------------- --}}

        <div class="row">
          <div class="col-md-6 col-sm-12">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Bar Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 644px;" width="644" height="250" class="chartjs-render-monitor"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Pie Chart</h3>
  
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
          {{-- <div class="card">
            <div class="card-header">
              <h5 class="card-title">Monthly Recap Report</h5>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-wrench"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <a href="#" class="dropdown-item">Action</a>
                    <a href="#" class="dropdown-item">Another action</a>
                    <a href="#" class="dropdown-item">Something else here</a>
                    <a class="dropdown-divider"></a>
                    <a href="#" class="dropdown-item">Separated link</a>
                  </div>
                </div>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Sales: 1 Jan, 2014 - 30 Jul, 2014</strong>
                  </p>

                  <div class="chart">
                    <!-- Sales Chart Canvas -->
                    <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                  </div>
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Goal Completion</strong>
                  </p>

                  <div class="progress-group">
                    Add Products to Cart
                    <span class="float-right"><b>160</b>/200</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <div class="progress-group">
                    Complete Purchase
                    <span class="float-right"><b>310</b>/400</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-danger" style="width: 75%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Visit Premium Page</span>
                    <span class="float-right"><b>480</b>/800</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    Send Inquiries
                    <span class="float-right"><b>250</b>/500</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-warning" style="width: 50%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
              <div class="row">
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block">
                    <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-footer -->
          </div> --}}
            <!-- /.card -->
          
          <!-- /.col -->
        {{-- </div> --}}
        <!-- /.row -->
    

      {{-- latest order --}}

      {{-- <div class="row"> --}}
        <div class="card">
          <div class="card-header border-transparent">
            <h3 class="card-title">Latest Orders</h3>

            <div class="card-tools">
              <select wire:change='changePeriode()' wire:model='periode' class="btn ml-2 btn-sm btn-outline-secondary">
                <option value="0">All Date</option>
                <option value="1">Yesterday</option>
                <option value="6">This week</option>
                <option value="13">last week</option>
                <option value="30">This Month</option>
                <option value="364">This Year</option>
              </select>
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0">
                <thead>
                <tr>
                  <th>Date Debut</th>
                  <th>Date Fin</th>
                  <th>Status</th>
                  <th>User</th>
                  <th>Client</th>
                  <th>Etat</th>
                </tr>
                </thead>
                <tbody>
              @forelse ($locations as $location)
                @if($periode == 0)
                  <tr>
                    <td>{{$location->dateDebut}}</td>
                    <td>{{$location->dateFin}}</td>
                    <td>{{$location->statutLocation->nom}}</td>
                    <td>{{$location->user->prenom}} {{$location->user->nom}}</td>
                    <td>{{$location->client->prenom}} {{$location->client->nom}}</td>
                    <td>
                    @if(estEffectue($location))
                      <span class="badge bg-success">Effectué</span>
                    @else
                      <span class="badge bg-danger">Non Effectué</span>
                    @endif
                    </td>
                  </tr>
                @elseif ($periode > dansPeriode($location))
                  <tr>
                    <td>{{$location->dateDebut}}</td>
                    <td>{{$location->dateFin}}</td>
                    <td>{{$location->statutLocation->nom}}</td>
                    <td>{{$location->user->prenom}} {{$location->user->nom}}</td>
                    <td>{{$location->client->prenom}} {{$location->client->nom}}</td>
                    <td>
                    @if(estEffectue($location))
                      <span class="badge bg-success">Effectué</span>
                    @else
                      <span class="badge bg-danger">Non Effectué</span>
                    @endif
                    </td>
                  </tr>
                @endif
              @empty
                <tr>
                  <td colspan="6">
                      <div class="alert alert-info m-2">
                          <h5><i class="icon fas fa-ban"></i> Information !</h5>
                          Aucune Location pour le moment
                      </div>
                  </td>
                </tr>
              @endforelse
                </tbody>
              </table>
            </div>
            <!-- /.table-responsive -->
          </div>
          <!-- /.card-body -->
        <!-- /.card-footer -->
        </div>
      {{-- </div> --}}

        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Recently Added Products</h3>

                  <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                  </button>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="products-list product-list-in-card pl-2 pr-2">
                  @forelse ($latestArticles as $article)
                    <li class="item">
                      <div class="product-img mr-3">
                        @if ($article->imgUrl != "")
                            <img src="{{asset("storage/".$article->imgUrl)}}" alt="placeholder" style="width:60px; height:60px;"> 
                        @else 
                            <img src="{{asset("images/placeholder.png")}}" alt="placeholder" style="width:60px; height:60px"> 
                        @endif
                      {{-- <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50"> --}}
                      </div>
                      <div class="product-info">
                      <a href="javascript:void(0)" class="product-title"> {{$article->nom}}
                          @if ($article->estDisponible)
                            <span class="badge badge-success float-right">Disponible</span>
                          @else
                            <span class="badge badge-warning float-right">Indisponible</span>
                          @endif
                      </a>
                      <span class="product-description">
                          {{$article->nom}} de type {{$article->typeNom}}
                      </span>
                      </div>
                    </li>
                  @empty
                    <li>
                        <div class="alert alert-info m-2">
                          <h5><i class="icon fas fa-ban"></i> Information !</h5>
                          Aucun Article pour le moment
                      </div>
                    </li>
                  @endforelse
                  
                  <!-- /.item -->
                  
                  <!-- /.item -->
                  </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                  <a href="javascript:void(0)" class="uppercase">View All Products</a>
              </div>
            <!-- /.card-footer -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                  <h3 class="card-title">Latest Members</h3>

                  <div class="card-tools">
                  <span class="badge badge-danger">8 New Members</span>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                  </button>
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                  <ul class="users-list clearfix">
                    @forelse ($latestUsers as $user)

                      <li>
                        @if($user->sexe == "H")
                            <img src="{{asset('images/utilisateur.png')}}" style="width:50%; height: 50%"/>
                        @else
                            <img src="{{asset('images/femelle.png')}}" style="width:50%; height: 50%"/>
                        @endif
                        {{-- <img src="dist/img/user1-128x128.jpg" alt="User" /> --}}
                          <a class="users-list-name" href="#">{{$user->prenom}} {{$user->nom}}</a>
                          <span class="users-list-date">{{$user->created_at}}</span>
                      </li>
                    @empty
                        <li>
                          <div class="alert alert-info m-2">
                            <h5><i class="icon fas fa-ban"></i> Information !</h5>
                            Aucune Location pour le moment
                          </div>
                        </li>
                    @endforelse
                  </ul>
                  <!-- /.users-list -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer text-center">
                  <a href="javascript:">View All Users</a>
              </div>
            <!-- /.card-footer -->
            </div>
          </div>
        </div>

        

    </div><!--/. container-fluid -->
  </section>

  <script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

  <script>
    var categorieArticle = @json($typeArticles);
    var typeSomme = @json($typeSomme);
  </script>
</div>  