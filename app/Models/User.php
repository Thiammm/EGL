<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'sexe',
        'email',
        'pieceIdentite',
        'noPieceIdentite',
        'telephone1',
        'telephone2',
        'password',
        'imgUrl',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function locations(){
        return $this->hasMany(Location::class);
    }

    public function paiements(){
        return $this->hasMany(Paiement::class);
    }

    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function permissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function isAdmin(){
        return $this->roles()->where('nom', 'admin')->first();
    }
    public function isManager(){
        return $this->roles()->where('nom', 'manager')->first();
    }
    public function isEmploye(){
        return $this->roles()->where('nom', 'employe')->first();
    }

}
