<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProprieteArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'estObligatoire',
    ];

    public function articles(){
        return $this->belongsToMany(Article::class);
    }

    public function typeArticle(){
        return $this->belongsTo(TypeArticle::class);
    }
}
