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
        'type_article_id',
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

    public function proprieteArticles(){
        return $this->belongsToMany(PropieteArticle::class, 'article_proprietes', 'article_id', 'propriete_article_id');
    }

}
