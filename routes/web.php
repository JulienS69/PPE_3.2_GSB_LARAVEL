<?php

use App\Http\Controllers\FicheFraisController;
use App\Http\Controllers\FicheFraisHorsForfaitController;
use App\Http\Controllers\FicheFraisOpeReussieController;
use App\Http\Controllers\GenerationPDFController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModificationFichesFraisController;
use App\Http\Controllers\ModificationFichesFraisHorsForfaitsController;
use App\Http\Controllers\TelechargementFicheFraisController;
use App\Http\Controllers\VisualisationFicheFraisController;
use App\Http\Controllers\VisualisationFicheFraisHorsForfaitController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Route N°1 */
Route::get('/', function () {
    return view('welcome');
});

/* Route N°2 */
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Fiche de frais
/* Route N°3 */
Route::get('/fichefrais/generation', [FicheFraisController::class, 'index'])->name('fichefrais.index');

/* Route N°4 */
Route::post('/fichefrais/ajout', [FicheFraisController::class, 'store']);

//Fiche de frais hors forfait
/* Route N°5 */
Route::get('/fichefraishorsforfait/generation', [FicheFraisHorsForfaitController::class, 'index'])->name('fichefraishorsforfait.index');

/* Route N°6 */
Route::post('/fichefraishorsforfait/ajout', [FicheFraisHorsForfaitController::class, 'store']);


//Opération Réussie enregistrement fiche de frais.
/* Route N°7 */
Route::get('/enregistrementfichefraisreussie/generation', [FicheFraisOpeReussieController::class, 'index'])->name('enregistrementfichefraisreussie.index');

//Visualisation des fiches de frais.
/* Route N°8 */
Route::get('/VisualisationFicheFrais/generation', [VisualisationFicheFraisController::class, 'show'])->name('visualisationfichefrais.show');

/* Route N°9 */
Route::get('/VisualisationFicheFraisHorsForfait/generation', [VisualisationFicheFraisHorsForfaitController::class, 'show'])->name('visualisationfichefraishorsforfait.show');


// Route pour ce qui concerne la génération du PDF
/* Route N°10 */
Route::post('/GénérationPDFFF/generation', [GenerationPDFController::class, 'GenerationPDF'])->name('generation');

// Route pour ce qui concerne la génération du PDF
/* Route N°11 */
Route::get('/TelechargementFicheFrais/generation', [GenerationPDFController::class, 'index'])->name('TelechargementFicheFrais.index');

// Modification des fiches de frais
/* Route N°12 */
Route::get('/ModificationFicheFrais/modification/{idFicheFraisForfait}', [ModificationFichesFraisController::class, 'ModifierFF']);

// Modification des fiches de frais Hors Forfaits
/* Route N°13 */
Route::get('/ModificationFicheFraisHorsForfaits/modification/{idFicheHorsForfait}', [ModificationFichesFraisHorsForfaitsController::class, 'ModifierFFHF']);

//Vérification des modifications des fiches de frais
/* Route N°14 */
Route::post('/ModificationFicheFrais/Verification_Modification', [ModificationFichesFraisController::class, 'Verification_Modification'])->name("verrifier_modif");

//Vérification des modifications des fiches de frais hors forfaits
/* Route N°15 */
Route::get('/ModificationFicheFraisHorsForfaits/Verification_ModificationFFHF', [ModificationFichesFraisHorsForfaitsController::class, 'Verification_ModificationFFHF'])->name("verrifier_modifFFHF");
