<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\pagination\paginator;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

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
    public $editUser = [];
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

    public function updatingSearch(){
        $this->resetPage();
    }


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
        if($this->isBtnClick === "edit")
        {
            return [
                "editUser.prenom" => "required",
                "editUser.nom" => "required",
                "editUser.sexe" => "required",
                "editUser.email" => ["required", "email", Rule::unique("users", "email")->ignore($this->user_id)],
                "editUser.telephone1" => "required|numeric",
                "editUser.telephone2" => "numeric",
                "editUser.pieceIdentite" => "required",
                "editUser.noPieceIdentite" => "required",
            ];
        }

        return [
            "newUser.prenom" => "required",
            "newUser.nom" => "required",
            "newUser.sexe" => "required",
            "newUser.email" => ["required", "email", Rule::unique("users", "email")],
            "newUser.password" => ["required"],
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
        $donneesValides["newUser"]["password"] = Hash::make($donneesValides["newUser"]["password"]);
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
        // $user = User::find($id);
        // dd($user->roles);
        $this->isBtnClick = "edit";
        $this->user_id = $id;
        $user = User::find($id);
        $this->editUser = $user;
        $this->allRoles = Role::all();
        $this->allPermissions = Permission::all();
        $this->userRoles = $user->roles;
        $this->userPermissions = $user->permissions;
        foreach($this->allRoles as $role){
            $nom1 = $role->name;
            $this->rolesUpdated[$nom1] = null;
        }
        foreach($this->userRoles as $userRole){
            $nom2 = $userRole->name;
            $this->rolesUpdated[$nom2] = true;
        }

        foreach($this->allPermissions as $permission){
            $nom3 = $permission->name;
           $this->permissionsUpdated[$nom3] = null; 
        }

        foreach($this->userPermissions as $userPermission){
            $nom4 = $userPermission->name;
            $this->permissionsUpdated[$nom4] = true;
        }
    }

    public function updateUser($id){
        $user = User::find($id);
        $donneeValides = $this->validate();
        $user->update($donneeValides["editUser"]);
        $this->showSuccessMessage('user updated');
        $this->editUser = [];
    }

    public function updateRolesPermissions($id){
        $user = User::find($id);
        $roles = Role::all();
        $permissions = Permission::all();
        DB::table('role_user')->where("user_id", $id)->delete();
        DB::table('permission_user')->where("user_id", $id)->delete();
        foreach($roles as $role){
            if($this->rolesUpdated[$role->name]){
                // $user->roles()->attach($role->id);
                $user->assignRole($role->name);
            }
            else{
                $user->removeRole($role->name);
                // $user->roles()->detach($role->id);
            }
        };

        foreach($permissions as $permission){
            if($this->permissionsUpdated[$permission->name]){
                // $user->permissions()->attach($permission->id);
                $user->givePermissionTo($permission->name);
            }
            else{
                $user->revokePermissionTo($permission->name);
                // $user->permissions()->detach($permission->id);
            }
        }
        $this->showSuccessMessage('les mises à jour ont été enrégistrer avec succès');
    }

    public function updateRoles($id, $nom){
        $user = User::find($id);
        $role = Role::all()->where('name', $nom)->first();
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
        if($this->permissionsUpdated[$permission->name] === true){
            $user->givePermissionTo($permission->name);
            // $user->permissions()->attach($permission->id);
        }
        else{
            $user->revokePermissionTo($permission->name);
            // $user->permissions()->detach($permission->id);
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


}
