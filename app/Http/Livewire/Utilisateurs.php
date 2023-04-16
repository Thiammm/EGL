<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use App\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

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
    public $search = "";

    // protected $rules = [
    //     "newUser.prenom" => "required",
    //     "newUser.nom" => "required",
    //     "newUser.sexe" => "required",
    //     "newUser.email" => ["required", "email", Role::unique("users", "email")->ignore('$this->user_id')],
    //     "newUser.telephone1" => "required|numeric",
    //     "newUser.telephone2" => "numeric",
    //     "newUser.pieceIdentite" => "required",
    //     "newUser.noPieceIdentite" => "required",
    // ];

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
        $searchCritary = "%".$this->search."%";
        return view('livewire.utilisateurs.index',[
            'users' => User::latest('created_at')->where("prenom", "like", $searchCritary)->paginate(5)
        ])
        ->extends('layouts.master')
        ->section('content');

    }

    public function rules(){
        return [
            "newUser.prenom" => "required",
            "newUser.nom" => "required",
            "newUser.sexe" => "required",
            "newUser.email" => ["required", "email", Rule::unique("users", "email")->ignore($this->user_id)],
            "newUser.telephone1" => "required|numeric",
            "newUser.telephone2" => "numeric",
            "newUser.pieceIdentite" => "required",
            "newUser.noPieceIdentite" => "required",
        ];
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
        $donneesValides["newUser"]["password"] = "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi";
        $donneesValides["newUser"]["imgUrl"] = "sdfdsfsfsdfdfdsfsdfs";
        User::create($donneesValides["newUser"]); 
        $this->newUser = [];
        $this->showSuccessMessage('user created successfuly');
    }

    public function confirmDelete($id){
        $user = User::find($id);
        $this->dispatchBrowserEvent('showConfirmMessage', [
            'title' => 'Etes-vous sûr de continuer',
            'text' => 'vous êtes entrain de supprimer '.$user->prenom.' '.$user->nom,
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

    public function updateRolesPermissions($id){
        $user = User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();
        DB::table('role_user')->where("user_id", $id)->delete();
        DB::table('permission_user')->where("user_id", $id)->delete();
        foreach($roles as $role){
            if($this->rolesUpdated[$role->nom]){
                $user->roles()->attach($role->id);
            }
            else{
                $user->roles()->detach($role->id);
            }
        };

        foreach($permissions as $permission){
            if($this->permissionsUpdated[$permission->nom]){
                $user->permissions()->attach($permission->id);
            }
            else{
                $user->permissions()->detach($permission->id);
            }
        }
        $this->showSuccessMessage('les mises à jour ont été enrégistrer avec succès');
    }

    public function updateRoles($id, $nom){
        $user = User::find($id);
        $role = Role::all()->where('nom', $nom)->first();
            // if($this->rolesUpdated[$nom] === true){
            //     $user->roles()->attach($role->id);
            // }
            // else{
            //     $user->roles()->detach($role->id);
            // }
    }

    public function updatePermissions($user_id, $permission_id){
        $user = User::find($user_id);
        $permission = Permission::find($permission_id);
        if($this->permissionsUpdated[$permission->nom] === true){
            $user->permissions()->attach($permission->id);
        }
        else{
            $user->permissions()->detach($permission->id);
        }
    }

    public function confirmReinitialisation($id){
        $user = User::find($id);
        $this->dispatchBrowserEvent('showConfirmMessageReset', [
            'title' => 'Etes-vous sûr de continuer',
            'text' => 'vous êtes entrain de reinitialiser le mot de pass de '.$user->prenom.' '.$user->nom,
            'icon' => 'warning',
            'id' => $id,
            'showCancelButton' => true,
            'confirmButtonColor' => '#3085d6',
            'cancelButtonColor' => '#d33',
            'confirmButtonText' => 'continuer',
        ]);
        
    }

    public function reinitialiser($id){
        $user = User::find($id);
        $user->password = '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $user->save();
        $this->showSuccessMessage('password reseted for '.$user->prenom." ".$user->nom);
    }


    public function setPage($url){
        $this->currentPage = explode('pag=', $url)[1];
        paginator::currentPageResolver(function(){
            return $this->currentPage;
        });
    }

}
