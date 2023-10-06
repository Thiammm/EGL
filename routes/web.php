<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Utilisateurs;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\PrintCompenent;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ClientCompenent;
use App\Http\Livewire\ArticleCompenent;
use App\Http\Livewire\LocationCompenent;
use App\Http\Livewire\PaiementCompenent;
use App\Http\Livewire\TypeArticleCompenent;
use App\Http\Livewire\TarificationCompenent;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes();


Route::prefix('admin')->name('admin.')->middleware("auth")->group(function(){
    Route::prefix('habilitations')->name('habilitations.')->group(function(){
        Route::get('/', [HomeController::class, 'index']);
        Route::get('/utilisateurs', Utilisateurs::class)->name('users.index');
        Route::get('/roles', [admin\UsersController::class, "index"])->name('roles.index');
    });
});

Route::prefix('admin')->name('admin.')->middleware("auth")->group(function(){
    Route::prefix('gestionarticles')->name('gestionarticles.')->group(function(){
        Route::get('/', [HomeController::class, 'index']);
        Route::get('/typearticles', TypeArticleCompenent::class)->name('typearticles.index');
        Route::get('/articles',ArticleCompenent::class)->name('articles.index');
        Route::get('/articles/{articleId}/tarifications',TarificationCompenent::class)->name('articles.tarifications.index');
    });
});

Route::prefix('admin')->name('admin.')->middleware("auth")->group(function(){
    Route::prefix('gestionclients')->name('gestionclients.')->group(function(){
        Route::get('/clients',ClientCompenent::class)->name('clients.index');
    });
});

Route::prefix('admin')->name('admin.')->middleware("auth")->group(function(){
    Route::prefix('gestionlocations')->name('gestionlocations.')->group(function(){
        Route::get('/locations', LocationCompenent::class)->name('locations.index');
    });
});


Route::prefix('admin')->name('admin.')->middleware("auth")->group(function(){
    Route::prefix('gestionpaiements')->name('gestionpaiements.')->group(function(){
        Route::get('/paiements', PaiementCompenent::class)->name('paiements.index');
    });
});


Route::get('/', [HomeController::class, 'index'])->name('home');