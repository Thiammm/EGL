<?php

namespace App\Http\Livewire;

use App\Models\Client;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class ClientCompenent extends Component
{
    use WithPagination, WithFileUploads;
    protected $paginationTheme ='bootstrap';
    public $isPage = "liste";
    public $search = "";
    public $newClient = [];
    public $editClient = [];
    public $clientId;
    public $client;
    public function render()
    {
        $clientQuery = Client::query();
        if($this->search != ""){
            $clientQuery->where('nom', 'LIKE', '%'.$this->search.'%')
            ->orWhere('prenom', 'LIKE', '%'.$this->search.'%')
            ->orWhere('adresse', 'LIKE', '%'.$this->search.'%')
            ->orWhere('telephone1', 'LIKE', '%'.$this->search.'%');
        };
        return view('livewire.clients.index', [
            "clients" => $clientQuery->latest()->paginate(5),
            ])
        ->extends("layouts.master")
        ->section('content');
    }

    public function rules(){
        if($this->isPage == "create"){

            return [
                "newClient.prenom" => "required",
                "newClient.nom" => "required",
                "newClient.sexe" => "required",
                "newClient.adresse" => "required",
                "newClient.ville" => "required",
                "newClient.pays" => "required",
                "newClient.dateNaissance" => "required",
                "newClient.lieuNaissance" => "required",
                "newClient.nationalite" => "required",
                "newClient.telephone1" => "required",
                "newClient.telephone2" => "required",
                "newClient.pieceIdentite" => "required",
                "newClient.noPieceIdentite" => ["required", Rule::unique("clients", "noPieceIdentite")],
            ];

         
        }
            
        return [
            "editClient.prenom" => "required",
            "editClient.nom" => "required",
            "editClient.sexe" => "required",
            "editClient.adresse" => "required",
            "editClient.ville" => "required",
            "editClient.pays" => "required",
            "editClient.dateNaissance" => "required",
            "editClient.lieuNaissance" => "required",
            "editClient.nationalite" => "required",
            "editClient.telephone1" => "required",
            "editClient.telephone2" => "required",
            "editClient.pieceIdentite" => "required",
            "editClient.noPieceIdentite" => ["required", Rule::unique("clients", "noPieceIdentite")->ignore($this->clientId)],
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

    public function createClient(){
        $this->isPage = "create";
    }

    public function goToList(){
        $this->isPage = "liste";
        $this->newClient = [];
    }

    public function addClient(){
        
        $validateMsg = [
            "required" => "Ce champ est obligatoire",
            "email" => "Veuillez entrer un email valide"
        ];
        $donneesValides = $this->validate();
        Client::create($donneesValides["newClient"]);
        $this->showSuccessMessage("le client a été ajouté avec succès");
        $this->newClient = [];
    }

    public function afficheClient($id){
        $this->client = Client::find($id);
        $this->isPage = "afficheClient";
    }

    public function editclient($id){
        $this->editClient = Client::find($id);
        $this->clientId = $id;
        $this->isPage = "editClient";
    }

    public function updateClient($id){

        $validateMsg = [
            "required" => "Ce champ est obligatoire",
            "email" => "Veuillez entrer un email valide"
        ];
        $donneesValides = $this->validate();
        Client::find($id)->update($donneesValides["editClient"]);
        $this->showSuccessMessage("le client a été modifié avec succès");
    }

    public function confirmDelete($id){
        $client = Client::find($id);
        $this->dispatchBrowserEvent('showConfirmMessage', [
            'title' => 'Etes-vous sûr de continuer',
            'text' => 'vous êtes entrain de supprimer '.$client->prenom.' '.$client->nom,
            'icon' => 'warning',
            'id' => $id,
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'continuer',
        ]);
    }

    public function deleteclient($id){
        $client = Client::find($id);
        $client->delete();
        $this->showSuccessMessage("Le Client $client->prenom $client->nom a été supprimer avec succès");
    }
}
