<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TypeArticle;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class TypeArticleCompenent extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    public $isBtnClick = "liste";
    public $newTypeArticle = "";
    public $editTypeArticle = "";
    public $type_id;

    public function render()
    {
        $searchCritary = '%'.$this->search.'%';
        return view('livewire.typearticles.index', ['typearticles' => TypeArticle::
        latest('created_at')->where('nom', 'like', $searchCritary)->paginate(5)])
        ->extends('layouts.master')
        ->section('content');
    }

    public function rules(){
        if($this->isBtnClick === 'creer'){
            return [
                'newTypeArticle' => 'required|unique:type_articles,nom',
            ];
        }
        return [
            'editTypeArticle' => ['required', Rule::unique('type_articles', 'nom')->ignore($this->type_id)],
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
    }

    public function updateType($id){
        $type = TypeArticle::find($id);
        $donneesValides = $this->validate();
        $this->isBtnClick = 'liste';
        $type->update(['nom' => $donneesValides['editTypeArticle']]);
        $this->showSuccessMessage('User Updated Successfuly');
        $this->type_id = 0;
    }
}
