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
    public function render()
    {
        $searchCritary = '%'.$this->search.'%';
        return view('livewire.type-article-compenent', ['typearticles' => TypeArticle::
        latest('created_at')->where('nom', 'like', $searchCritary)->paginate(5)])
        ->extends('layouts.master')
        ->section('content');
    }
}
