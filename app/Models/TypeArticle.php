<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
    ];

    public function articles(){
        return $this->hasMany(Article::class);
    }

    public function ProprieteArticle(){
        return $this->hasMany(ProprieteArticle::class);
    }
}
