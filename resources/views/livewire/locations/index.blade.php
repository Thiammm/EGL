@if($isBtnClick == "liste")
    @include("livewire.locations.liste")
@endif

@if($isBtnClick == "creer")
    @include("livewire.locations.creer")
@endif

{{-- @if($isBtnClick == "detail")
    @include("livewire.locations.detail")
@endif --}}

@if($isBtnClick == "edit")
    @include("livewire.locations.edit")
@endif