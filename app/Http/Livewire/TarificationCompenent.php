<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Models\Tarification;
use App\Models\DureeLocation;
use Illuminate\Validation\Rule;

class TarificationCompenent extends Component
{
    public $isBtnClick = "liste";
    public $fonction = "liste";
    public $dureeLocation = null;
    public $lesTarifs;
    public $articleId;
    public $newTarif = [];
    public $editTarif = [];
    public $tarificationId;
    public $article;

    public function mount($articleId){
        $this->articleId = $articleId;
        $this->article = Article::find($articleId);
    }

    public function render()
    {
        $this->lesTarifs = Article::find($this->articleId)->tarifications;
        return view('livewire.tarifications.index', [
            "lesTarifs" => $this->lesTarifs,
        ])
        ->extends("layouts.master")
        ->section("content");
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

    public function ajouterTarification(){
        $this->fonction = "ajout";
        $this->dureeLocation = DureeLocation::all();
    }

    public function annulerAjout(){
        $this->fonction = "liste";
    }

    public function addTarification($id){
        $validateTarif = [
            "newTarif.duree_location_id" => ["required", Rule::unique("tarifications", "duree_location_id")->where("article_id", $id)],
            "newTarif.prix" => "required",
        ];

        $messages = [
            "unique" => "cette durée a dèja une tarification pour cet article...",
        ];

        $AttribusTarif = [
            "newTarif.duree" => "duree",
            "newTarif.prix" => "prix",
        ];

        $donneesValides = $this->validate($validateTarif, $messages, $AttribusTarif);

        $donneesValides["newTarif"]["article_id"] = $id;

        Tarification::create($donneesValides["newTarif"]);

        $this->showSuccessMessage("la tarification a été enregistrer avec succès");


        $this->newTarif = [];
    }

    public function editerTarif(Tarification $tarif){
        $this->fonction = "edit";
        $this->articleId = $tarif->article_id;
        $this->tarificationId = $tarif->id;
        $this->editTarif["duree_location_id"] = $tarif->duree_location_id;
        $this->editTarif["prix"] = $tarif->prix;
        $this->dureeLocation = DureeLocation::all();
    }

    public function updateTarification(Tarification $tarif){
        $validateArr = [
            "editTarif.duree_location_id" => ["required", Rule::unique("tarifications", "duree_location_id")->where("article_id", $tarif->article_id)->ignore($tarif->id)],
            "editTarif.prix" => "required",
        ];

        $message = [
            "unique" => "cette durrée a dèja un tarif",
        ];

        $validateAttr = [
            "editTarif.duree_location_id" => "duree",
            "editTarif.prix" => "prix",
        ];

        $donneesValides = $this->validate($validateArr, $message, $validateAttr);
        $tarif->update($donneesValides["editTarif"]);
        $this->showSuccessMessage("la tarification a été modifier avec succès");
    }

}
