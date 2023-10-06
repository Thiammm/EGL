<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'dateDebut',
        'dateFin',
        'statut_location_id',
        'user_id',
        'client_id',
    ];

    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    public function statutLocation(){
        return $this->belongsTo(StatutLocation::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function paiements(){
        return $this->hasMany(Paiement::class);
    }
}
