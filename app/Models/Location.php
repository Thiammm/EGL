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

    public function clien(){
        return $this->belongsTo(Client::class);
    }

    public function paiements(){
        return $this->hasMany(Paiement::class);
    }
}
