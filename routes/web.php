<?php

use App\Http\Controllers\CentreController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\ELectionController;
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
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $nom_election_en_cours = "";
        $lelection_en_cours = \App\Models\Election::where('etat','en cours')->first();
        if($lelection_en_cours != null){
            $nom_election_en_cours = $lelection_en_cours->nom;
        }

        $nombre_total_inscrit = auth()->user()->centre->electeurs_inscrit(auth()->user()->election_id);
        $nombre_total_votants = \App\Models\ParticipationElectionCentre::where('election_id',auth()->user()->election_id)->where('centre_id',auth()->user()->centre_id)->sum('electeurs_effectif');
        $nombre_total_bulletin_nuls = \App\Models\ParticipationElectionCentre::where('election_id',auth()->user()->election_id)->where('centre_id',auth()->user()->centre_id)->sum('bulletin_null');
        $nombre_total_bulletin_blancs = \App\Models\ParticipationElectionCentre::where('election_id',auth()->user()->election_id)->where('centre_id',auth()->user()->centre_id)->sum('bulletin_blanc');

        return view('dashboard',compact('nom_election_en_cours','nombre_total_inscrit','nombre_total_votants','nombre_total_bulletin_blancs','nombre_total_bulletin_nuls')); }
    )->name('dashboard');

    Route::prefix('/election')->group( function (){
        Route::get('/creer', [ELectionController::class,'creer'])->name('election.creer');
        Route::post('/creer', [ELectionController::class,'post_creer']);
        Route::get('/liste', [ELectionController::class,'index'])->name('election.liste');
        Route::get('/details/{id_election}', [ELectionController::class,'details_election'])->name('election.details');

        // Gestion
            // candidats
            Route::post('/enregistrer-candidat/{id_election}', [ELectionController::class,'enregistrer_candidat'])->name('election.enregistrer_candidat');

    });

    Route::prefix('/zone-de-vote')->group( function (){
        Route::get('/creer', [ZoneController::class,'creer'])->name('zone.creer');
        Route::post('/creer', [ZoneController::class,'post_creer']);
        Route::get('/liste', [ZoneController::class,'index'])->name('zone.liste');
    });

    // ELECTION
        Route::get('/prerequis', [CentreController::class,'definir_nombre_inscrits'])->name('centre.definir_nombre_inscrits');
        Route::post('/prerequis', [CentreController::class,'post_definir_nombre_inscrits']);

        Route::get('/resultat-candidat', [CentreController::class,'definir_resultat_candidat'])->name('centre.definir_resultat_candidat');
        Route::post('/resultat-candidat', [CentreController::class,'post_definir_resultat_candidat']);

});
