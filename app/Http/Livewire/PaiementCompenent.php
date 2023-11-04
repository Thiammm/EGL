<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Location;
use App\Models\Paiement;
use Livewire\WithPagination;
use App\Models\StatutLocation;

class PaiementCompenent extends Component
{
    use WithPagination;
    protected $paginationTheme = "bootstrap";
    public $isBtnClick = 'liste';
    public $search = "";
    public $locationId;
    public $location;
    public $filtreStatut= "";
    public $total = 0;
    public $sommeRecue;
    public $difference;
    public $detail = 0;

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

    public function showSuccessMessage($message){
        $this->dispatchBrowserEvent('showSuccessMessage', [
            'title' => $message,
            'timer' => 3000,
            'icon' => 'success',
            'toast' => true,
            'showConfirmButton' => false,
            'position' => 'top-right',
        ]);
    }

    public function goToList(){
        $this->isBtnClick = "liste";
        $this->detail = 0;
    }

    public function createPayment($locationId){
        $this->isBtnClick = "create";
        $this->location = Location::find($locationId);
        $this->sommeRecue = total($this->location, $this->total);
    }

    public function terminerPayment($id){
        $location = Location::find($id);
    }

    public function savePayment($id){
        Paiement::create([
            "montantPaye" => total($this->location, $this->total),
            "datePaiement" => now(),
            "user_id" => auth()->user()->id,
            "location_id" => $id,
        ])->save();

        $this->location = [];
        $this->showSuccessMessage('Le paiement a été ajouté avec succès');
        $this->isBtnClick = "liste";
    }

    public function affichePayment($id){
        $this->location = Location::find($id);
        $this->detail = 1;
    }

    // public function fermerModal(){
    //     $this->location = [];
    // }

}