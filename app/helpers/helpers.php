<?php

use Illuminate\Support\Str;

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
            $nameRoles .= $role->nom;
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


    