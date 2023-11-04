<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Client;
use App\Models\Article;
use Livewire\Component;
use App\Models\Location;
use App\Models\Paiement;
use App\Models\TypeArticle;
use Illuminate\Support\Facades\DB;

class DashboardCompenent extends Component
{
    public $periode = 0;
    public $nombreLocations = 0;
    public $nombreArticles = 0;
    public $nombreClients = 0;
    public $nombreUsers = 0;
    public $typeArticles = [];
    public $immobiliers = 0;
    public $transports = 0;
    public $electroniques = 0;
    public $evenementiels = 0;
    public $agricoles = 0;
    public $typeSomme = [];
    public $paiementsTypes;

    public function render()
    {
        foreach(TypeArticle::all() as $type){
            $this->typeSomme[$type->nom] = 0;
        }
        // dd(dateDiff(Location::find(5)->dateDebut, Location::find(5)->dateFin)->days);
        $this->nombreArticles = Article::count();
        $this->nombreClients = Client::count();
        $this->nombreUsers = User::count();
        $this->nombreLocations = Location::count();
        $this->typeArticles['Immobilier'] = DB::table("articles")->join('type_articles', 'type_article_id', '=', 'type_articles.id')->select('type_articles.nom as typeNom')->where('type_articles.nom', '=',  'immobilier')->count();
        $this->typeArticles['Materiels Electronique'] = DB::table("articles")->join('type_articles', 'type_article_id', '=', 'type_articles.id')->select('type_articles.nom as typeNom')->where('type_articles.nom', '=',  'Materiels Electronique')->count();
        $this->typeArticles['Transports'] = DB::table("articles")->join('type_articles', 'type_article_id', '=', 'type_articles.id')->select('type_articles.nom as typeNom')->where('type_articles.nom', '=',  'Transports')->count();
        $this->typeArticles['Equipements évènementiels'] = DB::table("articles")->join('type_articles', 'type_article_id', '=', 'type_articles.id')->select('type_articles.nom as typeNom')->where('type_articles.nom', '=',  'Equipements évènementiels')->count();
        $this->typeArticles['Equipements Agricoles'] = DB::table("articles")->join('type_articles', 'type_article_id', '=', 'type_articles.id')->select('type_articles.nom as typeNom')->where('type_articles.nom', '=',  'Equipements Agricoles')->count();
        $this->paiementsTypes = Paiement::all();
        foreach($this->paiementsTypes as $paiementsType){
            if(estEffectue($paiementsType->location)){
                foreach($paiementsType->location->articles as $article){
                    // dd($article->typeArticle->nom);
                    // $this->typeSomme[$article->typeArticle->nom] += $location->
                    if(dateDiff($paiementsType->location->dateDebut, $paiementsType->location->dateFin)->d >= 7){
                        if(modulo($paiementsType->location)){
                            $this->typeSomme[$article->typeArticle->nom] += (intervalSemaine($paiementsType->location) * prix($article, 3) + modulo($paiementsType->location) * prix($article, 1));
                        }
                        else{
                        $this->typeSomme[$article->typeArticle->nom] += (intervalSemaine($paiementsType->location) * prix($article, 3));
                        }
                    }          
                    else{
                        $this->typeSomme[$article->typeArticle->nom] += (intervalJour($paiementsType->location) * prix($article, 1));
                    }
                }
            }
        }
        
        return view('livewire.dashboard.index', [
            'locations' => Location::latest()->get(),
            'latestUsers' => DB::table("users")->latest()->where('deleted_at', '=', null)->limit(8)->get(),
            'latestArticles' => DB::table("articles")->join('type_articles', 'type_article_id', '=', 'type_articles.id')->select('type_articles.nom as typeNom', 'articles.*')->latest('articles.created_at')->limit(5)->get(),
        ])
        ->extends("layouts.master")
        ->section("content");
    }

    public function changePeriode(){
    }
}
