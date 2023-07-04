<?php

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

Route::get('/', function () {
    return view('auth/login');
})->name('login');






Route::get('/register', 'App\Http\Controllers\RegisterController@showRegistrationForm')->name('register');


/*Route::get('/promotions', function () {
    return view('enseingnant\promotions');
})->name('promotions');

Route::get('/devoirs', function () {
    return view('enseingnant\devoirs');
})->name('devoirs');
*/


/*Route::get('/profile', function () {
    return view('etudiant\profile');
})->name('profile');*/
Route::middleware('auth')->group(function () {




/*************coté enseignant *****************/

/***********************Les promotions*********************/
//Liste des promotions
Route::get('/promotions', 'App\Http\Controllers\PromotionController@index')->name('promotion.index');
Route::get('/promotions-a', 'App\Http\Controllers\PromotionController@indexa')->name('promotion.indexa');

//ajouter une promotion
Route::get('/createpr', 'App\Http\Controllers\PromotionController@create');
Route::post('promotions', 'App\Http\Controllers\PromotionController@store')->name('promotion.store');
//modifier une promotion
Route::get('promotions/{id_pr}', 'App\Http\Controllers\PromotionController@edit')->name('promotions.edit');
Route::put('promotions/{id_pr}', 'App\Http\Controllers\PromotionController@update')->name('promotions.update');
//supprimer une promotion
Route::post('promotions/{id_pr}', 'App\Http\Controllers\PromotionController@supprimer')->name('promotions.supp');




/***********************devoirs coté enseignant*********************/
//liste des devoirs
Route::get('/devoirs', 'App\Http\Controllers\DevoirController@index')->name('devoir.index');
//supprimer un devoir
Route::post('devoirs/{id_dv}', 'App\Http\Controllers\DevoirController@supprimer')->name('devoirs.supp');

//ajouter un devoir
Route::get('/createdv', 'App\Http\Controllers\DevoirController@create');
Route::post('devoirs', 'App\Http\Controllers\DevoirController@store')->name('devoir.store');
//liste des etudiants de la promo pour un devoir donné avec la possibilité de savoir s'ils ont envoyé leurs devoirs ou non
Route::get('/devoirssub/{id_dev}', 'App\Http\Controllers\DevoirController@devoirsSub')->name('devoirssub');

//liste des etudiants
Route::get('/etudiants/{id_pr}', 'App\Http\Controllers\PromotionController@showStudents')->name('etudiants');
//admin
Route::get('/etudiants-a/{id_pr}', 'App\Http\Controllers\PromotionController@showStudentsa')->name('etudiants-a');

//supprimer un etudiant
Route::post('/etudiants/{id}', 'App\Http\Controllers\EtudiantController@supprimer')->name('etudiant.supp');

//code
Route::get('/code/{id_ev}/voir', 'App\Http\Controllers\DevoirController@voirCode')->name('voir.code');

/*************coté etudiant *****************/

//profile
Route::get('/profile', 'App\Http\Controllers\EtudiantController@profile')->name('profile');

//modifier profile
Route::get('/editprofile', 'App\Http\Controllers\EtudiantController@editProfile')->name('profile.edit');
Route::put('profile/{id}', 'App\Http\Controllers\EtudiantController@updateProfile')->name('profile.update');


/***********************devoirs coté etudiant*********************/
//liste des devoirs
Route::get('/listeDevoirs', 'App\Http\Controllers\DevoirController@index')->name('listeDevoirs');
//envoyer un devoir
Route::post('/submit-devoir', 'App\Http\Controllers\DevoirController@submitDevoir')->name('submit-devoir');
//re-envoyer un devoir
Route::post('/resubmit-devoir/{id}', 'App\Http\Controllers\DevoirController@resubmitDevoir')->name('resubmit-devoir');
//telecharger fiche de TP
Route::get('download-devoir/{id}', 'App\Http\Controllers\DevoirController@download')->name('download-devoir');

//liste des notes de chaque TP
Route::get('/notes', 'App\Http\Controllers\EtudiantController@showNotes')->name('notes');






Route::get('/dashboard', [App\Http\Controllers\EnseignantController::class, 'index'])->name('dashboard');
});

/*log out */
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Auth::routes();