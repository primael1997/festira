<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BanniereController;
<<<<<<< HEAD
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
=======
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryDocumentController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\EditionController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\SponsortController;
use App\Http\Controllers\Admin\StandeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Foundation\Application;
>>>>>>> bdb5ef0 (projet final)
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/festira', [PagesController::class, 'festira'])->name('festira');
Route::get('/mediatheque', [PagesController::class, 'mediatheque'])->name('mediatheque');
Route::get('/infos-pratiques', [PagesController::class, 'infos'])->name('infos');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/actualites', [PostController::class, 'index'])->name('actualites.index');
Route::get('/actualites/{post:slug}', [PostController::class, 'show'])->name('actualites.show');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::group(['prefix' => 'admin','middleware' => 'redirectAdmin'], function() {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');
});

<<<<<<< HEAD
Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::resource('banniere', BanniereController::class);
    Route::put('change-status', [BanniereController::class, 'changeStatus'])->name('banniere.change-status');
=======
Route::group(['middleware' =>['auth', 'verified'], 'prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile', [ProfileController::class, 'updatePassword'])->name('password.update');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
>>>>>>> bdb5ef0 (projet final)

    Route::resource('banniere', BanniereController::class);
    Route::put('banniere-change-status', [BanniereController::class, 'changeStatus'])->name('banniere.change-status');

    Route::resource('edition', EditionController::class);
    Route::put('edition-change-status', [EditionController::class, 'changeStatus'])->name('edition.change-status');

    Route::resource('standes', StandeController::class);
    Route::get('standes-lire-pdf-{id}', [StandeController::class, 'lirePdf'])->name('stande.presentation');
    Route::put('valider-demande-stande-{id}', [StandeController::class, 'valideStand'])->name('valide.stande');
    Route::get('standes-valides', [StandeController::class, 'standeValides'])->name('stande.valide');
    Route::get('standes-rejette', [StandeController::class, 'standeRejettes'])->name('stande.rejette');

    Route::resource('sponsort', SponsortController::class);
    Route::put('valider-demande-sponsort-{id}', [SponsortController::class, 'valideSponsort'])->name('valide.sponsort');
    Route::get('sponsort-valides', [SponsortController::class, 'sponsortValides'])->name('sponsort.valide');
    Route::get('sponsort-rejette', [SponsortController::class, 'sponsortRejettes'])->name('sponsort.rejette');

    Route::resource('category', CategoryController::class);

    Route::resource('posts', PostController::class);

    Route::resource('category-document', CategoryDocumentController::class);

    Route::resource('documents', DocumentController::class);

    Route::resource('galleries', GalleryController::class);

    Route::resource('users', UserController::class);

    Route::get('setting', [SettingController::class, 'index'])->name('setting.index');

    Route::put('general-setting-update', [SettingController::class, 'generalSettingUpdate'])->name('general-setting.update');
    Route::put('email-setting-update', [SettingController::class, 'emailConfigSettingUpdate'])->name('email-setting.update');
    Route::put('logo-setting-update', [SettingController::class, 'logoSettingUpdate'])->name('logo-setting.update');
});

require __DIR__.'/auth.php';
