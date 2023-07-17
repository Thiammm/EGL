<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Utilisateurs;
use App\Http\Livewire\TypeArticleCompenent;
use App\Http\Livewire\ArticleCompenent;
use App\Http\Livewire\TarificationCompenent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::prefix('admin')->name('admin.')->middleware("auth", "auth.admin")->group(function(){
    Route::prefix('habilitations')->name('habilitations.')->group(function(){
        Route::get('/', [HomeController::class, 'index']);
        Route::get('/utilisateurs', Utilisateurs::class)->name('users.index');
        Route::get('/roles', [admin\UsersController::class, "index"])->name('roles.index');
    });
});

Route::prefix('admin')->name('admin.')->middleware("auth", "auth.admin")->group(function(){
    Route::prefix('gestionarticles')->name('gestionarticles.')->group(function(){
        Route::get('/', [HomeController::class, 'index']);
        Route::get('/typearticles', TypeArticleCompenent::class)->name('typearticles.index');
        Route::get('/articles',ArticleCompenent::class)->name('articles.index');
        Route::get('/articles/{articleId}/tarifications',TarificationCompenent::class)->name('articles.tarifications.index');
    });
});

// Route::prefix('admin')->name('admin.')->middleware("auth", "auth.admin")->group(function(){
//     Route::prefix('gestionarticles')->name('gestionarticles.')->group(function(){
//         Route::get('/', [HomeController::class, 'index']);
//         Route::get('/articles',ArticleCompenent::class)->name('articles.index');
//     });
// });

// Route::prefix('admin')->name('admin.')->middleware("auth", "auth.admin")->group(function(){
//     Route::prefix('gestionarticles')->name('gestionarticles.')->group(function(){
//         Route::get('/', [HomeController::class, 'index']);
//         Route::get('/tarifications',TarificationCompenent::class)->name('tarifications.index');
//     });
// });




Route::get('/', [HomeController::class, 'index'])->name('home');