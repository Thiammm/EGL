@if($isBtnClick === "liste")
    @include('livewire.articles.liste')
@elseif($isBtnClick === "ouvrirTarification")
    @include("livewire.tarifications.liste")
@endif

