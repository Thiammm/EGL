<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Client;
use App\Models\Article;
use Livewire\Component;
use App\Models\Location;
use App\Models\TypeArticle;
use App\Models\StatutLocation;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class LocationCompenent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $isBtnClick = "liste";
    public $newLocation = [];
    public $editLocation = [];
    public $location;
    public $article;
    public $search = "";
    public $articleQuery;
    public $filtreType = "";
    public $filtreEtat = "";
    public $lesArticles = [];
    public $detail = 0;
    public $locationChoisi;

    public function updatingSearch(){
        $this->resetPage();
    }

    public function render()
    {
        $articleQuery = Article::query();
        if($this->search != ""){
            $articleQuery->where('nom', 'LIKE', '%'.$this->search.'%')
            ->orWhere('noSerie', 'LIKE', '%'.$this->search.'%');
        }

        if($this->filtreType != ""){
            $articleQuery->where('type_article_id', $this->filtreType);
        }

        if($this->filtreEtat != ''){
            $articleQuery->where('estDisponible', $this->filtreEtat);
        }

        return view('livewire.locations.index', [
            "locations" => Location::latest()->paginate(5),
            "statuts" => StatutLocation::all(),
            "users" => User::all(),
            "clients" => Client::all(),
            "articles" => $articleQuery->latest()->paginate(5),
            "typeArticles" => TypeArticle::all(),
        ])
        ->extends('layouts.master')
        ->section('content');
    }

    public function rules(){
        if($this->isBtnClick == "creer"){
            return [
                "newLocation.dateDebut" => "required|date",
                "newLocation.dateFin" => "required|date",
                "newLocation.statut_location_id" => "required",
                "newLocation.client_id" => "required",
            ];
        }
        return[
            "editLocation.dateDebut" => "required|date",
            "editLocation.dateFin" => "required|date",
            "editLocation.statut_location_id" => "required",
            "editLocation.client_id" => "required",
        ];

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

    public function ajouterLocation(){
        $this->isBtnClick = "creer";
        $this->filtreEtat = "";
    }

    public function addLocation(){
        if($this->lesArticles != []){
            
            $donneesValides = $this->validate();
            $donneesValides["newLocation"]["user_id"] = auth()->user()->id;
            $location = Location::create($donneesValides["newLocation"]);
            foreach($this->lesArticles as $larticle){
                DB::insert('insert into article_location (article_id, location_id) values (?, ?)', [$larticle, $location->id]);
            }
            $this->showSuccessMessage("La location a été bien enregistrer");
            $this->newLocation = [];
            $this->lesArticles = [];
        }
        else {
            $this->dispatchBrowserEvent('showConfirmMessage', [
                'title' => "Pas d'articles Choisis",
                'text' => "Veuillez choisir au moins un article pour faire une location",
                'icon' => 'warning',
                'confirmButtonColor' => '#3085d6',
                'confirmButtonText' => 'Compris',
            ]);
        }
    }

    public function goToList(){
        $this->isBtnClick = "liste";
        $this->detail = 0;
        $this->newLocation = [];
        $this->editLocation = [];
    }

    public function details($id){
        $this->locationChoisi = Location::find($id);
        $this->detail = 1;
    }

    public function editerLocation($id){
        $this->filtreEtat = "";
        $this->location = Location::find($id);
        $this->lesArticles = [];
        $articles = $this->location->articles;
        $this->editLocation = $this->location;
        foreach($articles as $larticle){
            $this->lesArticles[$larticle->id] = $larticle->id;
        }
        $this->isBtnClick = "edit";
    }

    public function updateLocation($id){
        if(estPasVide($this->lesArticles)){
            $donneesValides = $this->validate();
            $donneesValides["editLocation"]["updated_by"] = auth()->user()->id;
            Location::find($id)->update($donneesValides["editLocation"]);
            DB::delete('delete from article_location where location_id = ?', [$id]);
            // dd($this->lesArticles);
            foreach($this->lesArticles?:[] as $larticle){
                if($larticle){
                    DB::insert('insert into article_location (article_id, location_id) values (?, ?)', [$larticle, $id]);
                }
            }
            $this->showSuccessMessage("La location a été bien modifiée");
            $this->editLocation = [];
            $this->lesArticles = [];
        }
        else {
            $this->dispatchBrowserEvent('showConfirmMessage', [
                'title' => "Pas d'articles Choisis",
                'text' => "Veuillez choisir au moins un article pour faire une location",
                'icon' => 'warning',
                'confirmButtonColor' => '#3085d6',
                'confirmButtonText' => 'Compris',
            ]);
        }
    }
}
