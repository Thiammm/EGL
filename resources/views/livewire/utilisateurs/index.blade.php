
    @if($isBtnClick === "creer")

        @include("livewire.utilisateurs.create")

    @elseif($isBtnClick === "liste")

        @include("livewire.utilisateurs.liste")

    @elseif ($isBtnClick === "delete")

        @include("livewire.utilisateurs.liste")

    @elseif ($isBtnClick === "edit")

        @include("livewire.utilisateurs.edit")
        
    @endif

