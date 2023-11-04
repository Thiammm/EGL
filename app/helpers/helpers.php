<?php

use App\Models\Article;
use App\Models\Paiement;
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

    function estPasVide($tableaux){
        $result = 0;
        foreach($tableaux as $table){
            if($table)
                $result++;
        }
        return $result;
    }

    function estEffectue($location){
        $test = 0;
        $paiements = Paiement::all();
        foreach($paiements as $paiement){
            if($paiement->location_id == $location->id){
                $test++;
            }
        }
        return $test;
    }

    function dateDiff($date1, $date2){
        $object1 = date_create($date1);
        $object2 = date_create($date2);
        return date_diff($object1, $object2);
    }

    function prix($article, $dureeId){
        return $article->tarifications->where('duree_location_id', $dureeId)->first()->prix;
    }

    function modulo($location){
        return dateDiff($location->dateDebut, $location->dateFin)->days %7;
    }

    function intervalSemaine($location){
        return intval(dateDiff($location->dateDebut, $location->dateFin)->days / 7);
    }

    function intervalJour($location){
        return dateDiff($location->dateDebut, $location->dateFin)->days;
    }

    function total($location, $total){
        foreach($location->articles as $article){
            if(dateDiff($location->dateDebut, $location->dateFin)->d >= 7){
                if(modulo($location)){
                    $total = $total + intervalSemaine($location) * prix($article, 3) + modulo($location) * prix($article, 1);
                }
                else{
                $total = $total + intervalSemaine($location) * prix($article, 3);
                }
            }          
            else{
                $total = $total + intervalJour($location) * prix($article, 1);
            }
        }
        return $total;
    }

    // La fonction dansPeriode permettra de personaliser le dashboard par rapport aux differentes périodes

    function dansPeriode($location){
        return dateDiff($location->updated_at, now())->d;
    }


    