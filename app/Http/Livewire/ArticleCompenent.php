<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Models\TypeArticle;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Tarification;
use Livewire\WithPagination;
use App\Models\DureeLocation;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Models\ArticlePropriete;
use App\Models\ProprieteArticle;

class ArticleCompenent extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme ='bootstrap';
    public $isBtnClick = 'liste';
    public $search = "";
    public $articleQuery;
    public $filtreType = "";
    public $filtreEtat = "";
    public $newArticle = [];
    public $editArticle = [];
    public $proprietesType = [];
    public $proprietesEdit = [];
    public $proprieteSelections = null;
    public $nomPropriete = [];
    public $proprieteChoisi;
    public $image = null;
    public $iteration = 0;
    public $article_id = 0;
    public $imgUrl;
    public $proprieteSelectionEdit;
    public $dureeLocation;
    public $ajoutTarification;
    public $lesTarifs;
    public $newTarif = [];

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
        // $searchCritary = "%".$this->search."%";
        return view('livewire.articles.index', ["articles" => $articleQuery->latest()->paginate(5),
        'typeArticles' => TypeArticle::orderBy('nom', 'ASC')->get()])
        ->extends('layouts.master')
        ->section('content');
    }

    public function updated($name){
        if($name == "newArticle.type_article_id"){
            $this->proprieteSelections = typeArticle::find($this->newArticle['type_article_id'])->proprieteArticles;
        }

        elseif($name == "editArticle.type_article_id"){
            $this->proprieteSelectionEdit = typeArticle::find($this->editArticle['type_article_id'])->proprieteArticles;
        }

        elseif($name == "image"){
            $this->dispatchBrowserEvent('addImage', ['avatar' => $this->image]);
        }
        
    }

    // public function rules(){
    //     return [
    //         "newArticle.nom" => "required",
    //         "newArticle.noSerie" => "required",
    //         "newArticle.type_article_id" => "required",
    //     ];
    // }

    
    // protected $rules = [

    // ];

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



    public function confirmDelete($id){
        $article = Article::find($id);
        $this->dispatchBrowserEvent('showConfirmMessage', [
            'title' => 'Etes-vous sûr de continuer',
            'text' => 'vous êtes entrain de supprimer '.$article->nom,
            'icon' => 'warning',
            'id' => $id,
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'continuer',
        ]);
    }

    public function deleteArticle($id){
        $article = Article::find($id);
        $article->delete();
        $this->showSuccessMessage('l\'article '.$article->nom.' a été supprimer');
    }

    public function addArticle(){

        $this->iteration++;

        $validateArr = [
            "newArticle.nom" => "required",
            "newArticle.noSerie" => "required",
            "newArticle.type_article_id" => "required",
            "image" => 'image|max:10240'
        ];

        $messages = [];

        $validationAttribus = [
            "newArticle.nom" => "nom de l'article",
            "newArticle.noSerie" => "numero de serie",
            "newArticle.type_article_id" => "type d'article",
        ];

        foreach($this->proprieteSelections?:[] as $propriete){
            if($propriete->estObligatoire){
                $validateArr["proprietesType.".$propriete->nom] = "required";
                $messages["proprietesType.$propriete->id"] = "le champ $propriete->nom est obligatoire";
            }
            else{
                $validateArr["proprietesType.".$propriete->nom] = "nullable";
            }
        }

        $donneesValides = $this->validate($validateArr, $messages, $validationAttribus);
        $imageUrl = $this->image->store('upload', 'public');
        $donneesValides['newArticle']['imgUrl'] = $imageUrl;
        $idArticle = Article::create($donneesValides['newArticle'])->id;
        foreach ($this->proprieteSelections?:[] as $propriete) {
            ArticlePropriete::create([
                "article_id" => $idArticle,
                "propriete_article_id" => $propriete->id,
                "valeur" => $donneesValides["proprietesType"][$propriete->nom],
            ]);
        }
        $this->showSuccessMessage("l'article a été crée avec succès");
        $this->newArticle = [];
        $this->proprieteSelections = null;
        $this->proprietesType = []; 
        $this->image = null;
    }


    public function editArticle($id){
        $this->iteration++;
        $this->article_id = $id;
        $article = Article::find($id);
        $this->editArticle['nom'] = $article->nom;
        $this->editArticle['noSerie'] = $article->noSerie;
        $this->editArticle['type_article_id'] = $article->type_article_id;
        $this->imgUrl = $article->imgUrl;
        $this->proprieteSelectionEdit = typeArticle::find($this->editArticle['type_article_id'])->proprieteArticles;
        foreach($this->proprieteSelectionEdit?:[] as $propriete){
            if($propriete->nom){
                $temporaire = Arr::pluck(ArticlePropriete::where("article_id", $id)->where("propriete_article_id", $propriete->id)->get(), "valeur");
                $proprieteDeArticle = Arr::pull($temporaire, "0");
                    $this->proprietesEdit[$propriete->nom] = $proprieteDeArticle;
            }
        }
    } 

    public function updateArticle($id){
        $this->iteration++;
        $article = Article::find($id);
        $validateArr = [
            "editArticle.nom" => ["required", Rule::unique("articles", "nom")->ignore($this->article_id)],
            "editArticle.noSerie" => "required",
            "editArticle.type_article_id" => "required",
            "image" => 'nullable'
        ];

        $messages = [];

        $validationAttribus = [
            "editArticle.nom" => "nom de l'article",
            "editArticle.noSerie" => "numero de serie",
            "editArticle.type_article_id" => "type d'article",
        ];

        foreach($this->proprieteSelectionEdit?:[] as $propriete){
            if($propriete->estObligatoire){
                $validateArr["proprietesEdit.$propriete->nom"] = "required";
                $messages["proprietesEdit.$propriete->id"] = "le champ $propriete->nom est obligatoire";
            }
            else{
                $validateArr["proprietesEdit.".$propriete->nom] = "nullable";
            }
        }

        $donneesValides = $this->validate($validateArr, $messages, $validationAttribus);
        $imageUrl = "";
        if($this->image){
            $imageUrl = $this->image->store('upload', 'public');
            $this->imgUrl = $imageUrl;
        }
        else{
            $imageUrl = $this->imgUrl;
        }
        
        $donneesValides['editArticle']['imgUrl'] = $imageUrl;
        $article->update($donneesValides['editArticle']);
        foreach ($this->proprieteSelectionEdit?:[] as $propriete) {
            $proprieteDeArticle = Arr::pluck(ArticlePropriete::where("article_id", $id)->where("propriete_article_id", $propriete->id)->get(), "id");
            $idPropriete = Arr::pull($proprieteDeArticle, "0");
            if($articlePropriete = ArticlePropriete::find($idPropriete)){
                $articlePropriete->update([
                    'article_id' => $id,
                    'propriete_article_id' => $propriete->id,
                    'valeur' => $donneesValides["proprietesEdit"]["$propriete->nom"],
                ]);
            }
            else{
                ArticlePropriete::create([
                    "article_id" => $id,
                    "propriete_article_id" => $propriete->id,
                    "valeur" => $donneesValides["proprietesEdit"]["$propriete->nom"],
                ]);
            }
        }
        $this->showSuccessMessage("l'article a été modifié avec succès");
        $this->editArticle = null;
        $this->proprietesEdit = null;
        $this->article_id = 0;
        $this->image = null;
        $this->proprieteSelectionEdit = null;
        $this->imgUrl = "0";
    }   

    // les fonctions ci-dessous sont pour l'instant jugées temporaires elles peuvent être utilisée dans un autre o

    public function ouvrirTarification($id){
        $this->isBtnClick = "ouvrirTarification";
        $this->lesTarifs = Article::find($id)->tarifications;
        $this->article_id = $id;
    }

    public function retournerArticles(){
        $this->isBtnClick = "liste";
    }

    public function ajouterTarification(){
        $this->ajoutTarification = true;
        $this->dureeLocation = DureeLocation::all();
    }

    public function annulerAjout(){
        $this->ajoutTarification = false;
    }

    public function addTarification($id){
        $validateTarif = [
            "newTarif.duree_location_id" => "required",
            "newTarif.prix" => "required",
        ];

        $messages = [];

        $AttribusTarif = [
            "newTarif.duree" => "duree",
            "newTarif.prix" => "prix",
        ];

        $donneesValides = $this->validate($validateTarif, $messages, $AttribusTarif);

        $donneesValides["newTarif"]["article_id"] = $id;

        Tarification::create($donneesValides["newTarif"]);

        $this->showSuccessMessage("la tarification a été enregistrer avec succès");


        $this->newTarif = [];

        // dd($donneesValides);
    }
}
