<?php

use App\Models\Article;
use App\Models\TypeArticle;
use Illuminate\Support\Str;
use App\Models\ProprieteArticle;

    function setMenuClass($root, $class){
        $rootActuel = request()->route()->getName();
        if(contient($rootActuel, $root)){
            return $class;
        }
        return "";
    }
    
    function setMenuActive($root){
        if(request()->route()->getName()==$root){
            return "active";
        }
        return "";
    }

    function userFullName(){
        return auth()->user()->prenom ." ". auth()->user()->nom;
    }


    function userAllRoles(){
        $nameRoles = ""; $i=1;
        foreach(auth()->user()->roles as $role){
            $nameRoles .= $role->name;
            if($i < sizeof(auth()->user()->roles)){
                $nameRoles .= ", ";
            }
            $i++;
        }
        return $nameRoles;
    }

    function contient($conteneur, $contenu){
        return Str::contains($conteneur, $contenu);
    }

    function existeArticle($type){
        $existe = 0;
        $articles = Article::all();
        foreach($articles as $article){
            if($article->type_article_id === $type->id){
                $existe++;
            }
        }
        return($existe);
    }

    function typeArticleNom($id){
        $type = TypeArticle::find($id);
        // dd($type->nom);
        return $type->nom;
    }


    