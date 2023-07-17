<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link {{setMenuActive("home")}}">
                <i class="nav-icon fas fa-home"></i>
                <p>
                    Accueil
                </p>
            </a>
        </li>
    
        @can('isManager')
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Tableau de bord
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chart-line nav-icon"></i>
                        <p>Vue globale</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="fas fa-swatchbook nav-icon"></i>
                        <p>Locations</p>
                    </a>
                </li>
            </ul>
        </li>
        @endcan

        @can('isAdmin')
        <li class="nav-item {{setMenuClass("admin.habilitations.", "menu-open")}}">
            <a href="{{route("admin.habilitations.")}}" class="nav-link {{setMenuClass("admin.habilitations.","active")}}">
                <i class="nav-icon fas fa-user-shield"></i>
                <p>
                    habilitations
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.habilitations.users.index')}}" class="nav-link {{setMenuActive("admin.habilitations.users.index")}}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>utilisateurs</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{route('admin.habilitations.roles.index')}}" class="nav-link {{setMenuActive("admin.habilitations.roles.index")}}">
                        <i class="nav-icon fas fa-fingerprint"></i>
                        <p>Roles et permissions</p>
                    </a>
                </li> --}}
            </ul>
        </li>

        <li class="nav-item {{setMenuClass("admin.gestionarticles.", "menu-open")}}">
            <a href="{{route('admin.gestionarticles.typearticles.index')}}" class="nav-link {{setMenuClass("admin.gestionarticles.", "active")}}">
                <i class="nav-icon fas fa-cogs"></i>
                <p>
                    Gestion articles
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('admin.gestionarticles.typearticles.index')}}" class="nav-link {{setMenuActive("admin.gestionarticles.typearticles.index")}}">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Type d'article</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.gestionarticles.articles.index')}}" class="nav-link {{setMenuClass("admin.gestionarticles.articles", "active")}}">
                        <i class="nav-icon fas fa-list-ul"></i>
                        <p>Articles</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-sliders-h"></i>
                        <p>Tarifications</p>
                    </a>
                </li> --}}
            </ul>
        </li>
        @endcan
        @can('isEmploye')
            
        <li class="nav-header">LOCATION</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                    Gestion des clients
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-exchange-alt"></i>
                <p>
                    Gestion des locations
                </p>
            </a>
        </li>
        <li class="nav-header">CAISSE</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-coins"></i>
                <p>
                    Gestion des paiements
                </p>
            </a>
        </li>
        @endcan
    </ul>
</nav>