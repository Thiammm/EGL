<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;
use App\Models\Paiement;
use Livewire\WithPagination;
use App\Models\StatutLocation;
use App\Http\Livewire\PrintCompenent;
use SebastianBergmann\Type\ObjectType;

class PaiementCompenent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $isBtnClick = 'liste';
    public $search = "";
    public $locationId;
    public $location;
    public $filtreStatut= "";

    public function render()
    {
        $locationQuery = Location::query();

        // if($this->filtreStatut != ""){
        //     $locationQuery->where('statut_location_id', $this->filtreStatut);
        // }
        return view('livewire.paiements.index', [
            'locations' => $locationQuery->latest()->paginate(5),
            'statutLocations' => StatutLocation::all(),
            'paiements' => Paiement::all(),
        ])
        ->extends("layouts.master")
        ->section('content');
    }

    public function goToList(){
        $this->isBtnClick = "liste";
    }

    public function createPayment($locationId){
        $this->isBtnClick = "create";
        $this->location = Location::find($locationId);
    }

    public function savePayment($id){
        $location = Location::find($id);
        dd);
    }
}
