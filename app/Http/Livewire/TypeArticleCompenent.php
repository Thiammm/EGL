<?php

namespace App\Http\Livewire;

use App\Models\Article;
use Livewire\Component;
use App\Models\TypeArticle;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use App\Models\ProprieteArticle;

class TypeArticleCompenent extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    public $isBtnClick = "liste";
    public $newTypeArticle = "";
    public $editTypeArticle = "";
    public $type_id;
    public $typeArticleChoisi;
    public $newPropriete = [];
    public $editPropriete = [];
    public $test;
    public $nomDuType;
    public $proprieteArticleChoisi;
    public $nomProprieteChoisi;
    

    public function updatingSearch(){
        $this->resetPage();
    }

    protected $messages = [
        'required' => 'le champ est obligatoire',
        'unique' => 'le champ doit être unique',
        'email' => 'veuillez saisir un email valide',
        'numeric' => 'ce champ doit contenir un nombre',
    ];

    public function render()
    {
        // dd(TypeArticle::find(10)->proprieteArticles->toArray()[0]);
        
        $searchCritary = '%'.$this->search.'%';
        $data = ['typearticles' => TypeArticle::latest('created_at')->where('nom', 'like', $searchCritary)->paginate(5), 'proprietesTypeArticles' => ProprieteArticle::where('type_article_id', $this->typeArticleChoisi)->paginate(5, ['*'], 'proprietePage')];
        return view('livewire.typearticles.index', $data)
        ->extends('layouts.master')
        ->section('content');
    }

    public function rules(){
        if($this->isBtnClick === 'creer'){
            return [
                'newTypeArticle' => 'required|unique:type_articles,nom',
            ];
        }
        
        if($this->isBtnClick === 'edit'){
            return [
            'editTypeArticle' => ['required', Rule::unique('type_articles', 'nom')->ignore($this->type_id)],
            ];
        }

        // if($this->isBtnClick === 'propriete'){
        //     return [
        //     'newPropriete.nom' => 'required|unique:propriete_articles,nom',
        //     'newPropriete.estObligatoire' => 'required',
        //     ];
        // }
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
        $this->newTypeArticle = "";
        $this->isBtnClick = "liste";
    }

    public function goToAddType(){
        $this->isBtnClick = "creer";
    }

    public function addType(){
        $donneesValides = $this->validate();
        TypeArticle::create(['nom' => $donneesValides['newTypeArticle']]);
        $this->showSuccessMessage("Type d'article crée avec succès");
        $this->newTypeArticle = "";
    }

    public function confirmDelete($id){
        $type = TypeArticle::find($id);
        $this->dispatchBrowserEvent('showConfirmMessage', [
            'title' => 'Etes-vous sûr de continuer',
            'text' => 'vous êtes entrain de supprimer '.$type->nom,
            'icon' => 'warning',
            'id' => $id,
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'continuer',
        ]);

    }

    public function deleteType($id){
        $type = TypeArticle::find($id);
        $type->delete();
        $this->showSuccessMessage('le type '.$type->nom.' a été supprimer');
    }

    public function editType($id){
        $this->isBtnClick = 'edit';
        $this->type_id = $id;
        $type = TypeArticle::find($id);
        $this->editTypeArticle = $type->nom;
        $this->dispatchBrowserEvent("showEditForm", [
            "title" => 'Modifier le Type',
            "input" => 'text',
            "inputValue" => $type->nom,
            "id" => $type->id,
            "showCancelButton" => true,
        ]);
    }

    public function updateType($id, $nom){
        $type = TypeArticle::find($id);
        $this->editTypeArticle = $nom;
        $donneesValides = $this->validate();
        $this->isBtnClick = 'liste';
        $type->update(['nom' => $donneesValides['editTypeArticle']]);
        $this->showSuccessMessage('User Updated Successfuly');
        $this->type_id = 0;
    }

    public function modalOpen($id){
        $this->typeArticleChoisi = $id;
        $type = TypeArticle::find($id);
        $this->nomDuType = $type->nom;
    }

    public function saveProprietes($id){
        $donneesValides = $this->validate([
            'newPropriete.nom' => ['required', Rule::unique('propriete_articles', 'nom')->where('type_article_id', $id)],
            'newPropriete.estObligatoire' => 'required',
        ]);
        $donneesValides['newPropriete']['type_article_id'] = $id;
        // dd($donneesValides);
        ProprieteArticle::create($donneesValides['newPropriete']);
        $this->showSuccessMessage('propriete created Successfuly');
        $this->newPropriete = [];
    }

    public function confirmDeletePropriete($id){
        $propriete = ProprieteArticle::find($id);
        $this->dispatchBrowserEvent('showConfirmMessagePropriete', [
            'title' => 'Etes-vous sûr de continuer',
            'text' => 'vous êtes entrain de supprimer '.$propriete->nom,
            'icon' => 'warning',
            'id' => $id,
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'continuer',
        ]);
    }

    public function deletePropriete($id){
        $propriete = ProprieteArticle::find($id);
        $propriete->delete();
        $this->showSuccessMessage('le type '.$propriete->nom.' a été supprimer');
    }

    public function editProprieteArticles(ProprieteArticle $propriete){
        $this->proprieteArticleChoisi = $propriete->id;
        $this->nomProprieteChoisi = $propriete->nom;
        $this->editPropriete['nom'] = $propriete->nom;
        $this->editPropriete['estObligatoire'] = $propriete->estObligatoire;
    }

    public function updateProprieteArticle(ProprieteArticle $propriete){
        $donneesValides = $this->validate([
            'editPropriete.nom' => ['required', Rule::unique('propriete_articles', 'nom')->where('type_article_id', $propriete->type_article_id)->ignore($propriete->id)],
            'editPropriete.estObligatoire' => 'required',
        ]);

        // dd($donneesValides);
        $propriete->update([
            'nom' => $donneesValides['editPropriete']['nom'], 
            'estObligatoire' => $donneesValides['editPropriete']['estObligatoire'],
        ]);

        $this->showSuccessMessage('le type '.$propriete->nom.' a été Modifier');
    }
}
