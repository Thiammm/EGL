
@if($isBtnClick == 'liste')
    @include('livewire.paiements.liste')
@endif
@if($isBtnClick == "create")
    @include('livewire.paiements.create')
@endif
@if($isBtnClick == "print")
    @include('livewire.paiements.invoice')
@endif

