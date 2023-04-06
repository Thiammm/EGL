<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'noSerie',
        'EstDisponible',
        'imgUrl',
    ];

    public function typeArticle(){
        return $this->belongsTo(TypeArticle::class);
    }

    public function tarifications(){
        return $this->hasMany(Tarification::class);
    }

    public function locations(){
        return $this->belongsToMany(Location::class);
    }

    public function typeArticles(){
        return $this->belongsToMany(PropieteArticle::class);
    }

}
