@if($isPage == "liste")
    @include('livewire.clients.liste')
@endif

@if($isPage == "create")
    @include('livewire.clients.create')
@endif

@if($isPage == "afficheClient")
    @include('livewire.clients.afficheClient')
@endif

@if($isPage == "editClient")
    @include('livewire.clients.editClient')
@endif