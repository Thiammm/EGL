<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\DureeLocation;

class TarificationCompenent extends Component
{
    public $isBtnClick = "liste";
    public $ajoutTarification = false;
    public $dureeLocation = null;

    public function render()
    {
        return view('livewire.tarifications.index')
        ->extends("layouts.master")
        ->section("content");
    }

    // public function ajouterTarification(){
    //     $this->ajoutTarification = true;
    //     $this->dureeLocation = DureeLocation::all();
    // }

    // public function annulerAjout(){
    //     $this->ajoutTarification = false;
    // }

    public function addTarification($id){

    }
}
