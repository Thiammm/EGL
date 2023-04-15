<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;

class Utilisateurs extends Component
{
    use WithPagination;
    
    protected $paginationTheme = "bootstrap";
    public $isBtnClick = "liste";
    public  $userRoles = [];
    public  $userPermissions = [];
    public $rolesUpdated = [];
    public $permissionsUpdated = [];
    public $newUser = [];
    public $user_id;
    public $allRoles = [];
    public $allPermissions = [];

    protected $rules = [
        "newUser.prenom" => "required",
        "newUser.nom" => "required",
        "newUser.sexe" => "required",
        "newUser.email" => "required|email|unique:users,email",
        "newUser.telephone1" => "required|numeric",
        "newUser.telephone2" => "numeric",
        "newUser.pieceIdentite" => "required",
        "newUser.noPieceIdentite" => "required",
    ];

    protected $messages = [
        'required' => 'le champ est obligatoire',
        'unique' => 'le champ doit être unique',
        'email' => 'veuillez saisir un email valide',
        'numeric' => 'ce champ doit contenir un nombre',
    ];

    // protected $validationAttributes = [
    //     "newUser.prenom" => "Prenom",
    //     "newUser.nom" => "Nom",
    //     "newUser.sexe" => "Sexe",
    //     "newUser.email" => "Email",
    //     "newUser.telephone1" => "Telephone 1",
    //     "newUser.pieceIdentite" => "Piece d'Identite",
    //     "newUser.noPieceIdentite" => "Numero Piece d'Identite",
    // ];



    public function render()
    {
        return view('livewire.utilisateurs.index',[
            'users' => User::latest('created_at')->paginate(5)
        ])
        ->extends('layouts.master')
        ->section('content');

    }

    public function goToAddUser(){
        $this->isBtnClick = "creer";
    }

    public function goToList(){
        $this->isBtnClick = "liste";
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


    public function addUser(){
        $donneesValides = $this->validate();
        $donneesValides["newUser"]["password"] = "password";
        $donneesValides["newUser"]["imgUrl"] = "sdfdsfsfsdfdfdsfsdfs";
        User::create($donneesValides["newUser"]); 
        $this->newUser = [];
        $this->showSuccessMessage('user created successfuly');
    }

    public function confirmDelete($id){
        $user = User::find($id);
        $this->dispatchBrowserEvent('showConfirmMessage', [
            'title' => 'Etes-vous sûr de continuer',
            'text' => 'vous êtes entrainer de supprimer '.$user->prenom.' '.$user->nom,
            'icon' => 'warning',
            'id' => $id,
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'continuer',
        ]);

    }

    public function deleteUser($id){
    
        $this->isBtnClick = "delete";
        $user = User::find($id);
        $user->delete();
        $this->showSuccessMessage('vous avez supprimer '.$user->prenom." ".$user->nom);
    }

    public function editUser($id){
        $this->isBtnClick = "edit";
        $this->user_id = $id;
        $user = User::find($id);
        $this->newUser = $user;
        $this->allRoles = Role::all();
        $this->allPermissions = Permission::all();
        $this->userRoles = $user->roles;
        $this->userPermissions = $user->permissions;
        foreach($this->allRoles as $role){
            $nom = $role->nom;
            $this->rolesUpdated[$nom] = null;
        }
        foreach($this->userRoles as $userRole){
            $nom = $userRole->nom;
            $this->rolesUpdated[$nom] = true;
        }

        foreach($this->allPermissions as $permission){
            $nom = $permission->nom;
           $this->permissionsUpdated[$nom] = null; 
        }

        foreach($this->userPermissions as $userPermission){
            $nom = $userPermission->nom;
            $this->permissionsUpdated[$nom] = true;
        }
    }

    public function updateUser($id){
        $user = User::find($id);
        $donneeValides = $this->validate();
        $user->update($donneeValides["newUser"]);
        $this->showSuccessMessage('user updated');
    }

    public function updateRoles($id, $nom){
        $user = User::find($id);
        $role = Role::all()->where('nom', $nom)->first();
            if($this->rolesUpdated[$nom] === true){
                $user->roles()->attach($role->id);
            }
            else{
                $user->roles()->detach($role->id);
            }

            $user->save();
    }

    public function updatePermissions($user_id, $permission_id){
        $user = User::find($user_id);
        $permission = Permission::find($permission_id);
        dd($permission->nom);
    }

    public function reinitialiser($id){
        $user = User::find($id);
        $user->password = "password";
        $user->save();
        $this->showSuccessMessage('password reseted');
    }

}
