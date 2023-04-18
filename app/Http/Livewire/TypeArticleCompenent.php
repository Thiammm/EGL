<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\TypeArticle;
use Livewire\WithPagination;

class TypeArticleCompenent extends Component
{
    use WithPagination;
    protected $paginationTheme ='bootstrap';
    public $search;
    public $isBtnClick = "liste";
    public $newTypeArticle = "";

    public function render()
    {
        $searchCritary = '%'.$this->search.'%';
        return view('livewire.typearticles.index', ['typearticles' => TypeArticle::
        latest('created_at')->where('nom', 'like', $searchCritary)->paginate(5)])
        ->extends('layouts.master')
        ->section('content');
    }

    public function rules(){
        return [
            'newTypeArticle' => 'required|unique:type_articles,nom',
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

    public function goToAddtype(){
        $this->isBtnClick = "creer";
    }

    public function addType(){
        $donneesValides = $this->validate();
        TypeArticle::create(['nom' => $donneesValides['newTypeArticle']]);
        $this->showSuccessMessage("Type d'article crée avec succès");
        $this->newTypeArticle = "";
    }
}
