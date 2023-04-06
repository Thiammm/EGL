<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'dateNaissance',
        'lieuNaissance',  
        'nationalite',
        'ville',
        'pays',
        'adresse',
        'telephone1',
        'telephone2',
        'sexe',
        'pieceIdentite',
        'noPieceIdentite',
    ];

    public function locations(){
        return $this->hasMany(Location::class);
    }
}
