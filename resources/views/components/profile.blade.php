<aside class="control-sidebar control-sidebar-dark">

    <div class="p-3">
        {{-- <div class="col-md-3"> --}}
           <div class="card card-primary card-outline bg-dark">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{asset('images/user8-128x128.jpg')}}" alt="User profile picture">
                    </div>
                <h3 class="profile-username text-center ellipsis">{{userFullName()}}</h3>
                <p class="text-muted text-center">{{userAllRoles()}}</p>
                <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <a href="#" class="d-flex justify-content-center "><i class="fa fa-lock pr-2"></i><b>Mot de passe</b></a>
                </li>
                <li class="list-group-item">
                    <a href="#" class="d-flex justify-content-center"><i class="fa fa-user pr-2"></i><b>Mon profile</b></a>
                </li>
                </ul>
                {{-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}
                    <a class="btn btn-primary btn-block" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <b>Deconnexion</b>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                {{-- </div> --}}
                {{-- <a href="#" class="btn btn-primary btn-block"><b>Deconnecter</b></a> --}}
                </div>
            </div> 
        {{-- </div> --}}
        
    </div>
</aside>