<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function proprieteArticles(){
        return $this->hasMany(ProprieteArticle::class);
    }
}
