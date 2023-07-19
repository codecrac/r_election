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
//    return view('welcome');
    return redirect()->route('login');
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

        if(auth()->user()->user_type == 'agent') {
            $id_election = auth()->user()->election_id;
            $id_centre = auth()->user()->centre_id;
        }else {

            $id_election = $lelection_en_cours == null ? 0 : $lelection_en_cours->id;
            $id_centre = null;
        }

        $liste_candidat = \App\Models\Candidat::where('election_id',$id_election)->get();


        $is_admin = true;
        if(auth()->user()->user_type == 'agent') {
            $nombre_total_inscrit = auth()->user()->centre->electeurs_inscrit($id_election);
            $nombre_total_votants = \App\Models\ParticipationElectionCentre::where('election_id',$id_election)->where('centre_id',$id_centre)->sum('electeurs_effectif');
            $nombre_total_bulletin_nuls = \App\Models\ParticipationElectionCentre::where('election_id',$id_election)->where('centre_id',$id_centre)->sum('bulletin_null');
            $nombre_total_bulletin_blancs = \App\Models\ParticipationElectionCentre::where('election_id',$id_election)->where('centre_id',$id_centre)->sum('bulletin_blanc');


            $tableau_stats_votes = [];
            foreach ($liste_candidat as $item_candidat){
                $tableau_stats_votes[] = [
                    'country' => $item_candidat->nom . ' ( '.round($item_candidat->nombre_de_voix_en_tout_le_centre($id_centre) /($nombre_total_votants == 0? 1: $nombre_total_votants) *100,2) .'%) ',
                    'visits' => $item_candidat->nombre_de_voix_en_tout_le_centre($id_centre)
                ] ;
            }
            $is_admin = false;
        }else{

            $nombre_total_inscrit = \App\Models\NombreInscritCentreElections::where('election_id',$id_election)->sum('nombre_electeurs_attendus');
            $nombre_total_votants = \App\Models\ParticipationElectionCentre::where('election_id',$id_election)->sum('electeurs_effectif');
            $nombre_total_bulletin_nuls = \App\Models\ParticipationElectionCentre::where('election_id',$id_election)->sum('bulletin_null');
            $nombre_total_bulletin_blancs = \App\Models\ParticipationElectionCentre::where('election_id',$id_election)->sum('bulletin_blanc');


            $tableau_stats_votes = [];
            foreach ($liste_candidat as $item_candidat){

                $tableau_stats_votes[] = [
                    'country' => $item_candidat->nom . ' ( '.round($item_candidat->nombre_de_voix_election($id_election) /($nombre_total_votants == 0? 1: $nombre_total_votants) *100,2) .'%) ',
                    'visits' => $item_candidat->nombre_de_voix_election($id_election)
                ] ;
            }
        }



//        dd($tableau_stats_votes);

        return view('dashboard',compact(
                'nom_election_en_cours','nombre_total_inscrit',
                'nombre_total_votants','nombre_total_bulletin_blancs','nombre_total_bulletin_nuls',
                'tableau_stats_votes','is_admin','lelection_en_cours'
            )
        ); }
    )->name('dashboard');

    Route::prefix('/election')->group( function (){
        Route::get('/creer', [ELectionController::class,'creer'])->name('election.creer');
        Route::post('/creer', [ELectionController::class,'post_creer']);
        Route::get('/liste', [ELectionController::class,'index'])->name('election.liste');
        Route::get('/details/{id_election}', [ELectionController::class,'details_election'])->name('election.details');
        Route::post('/details/{id_election}', [ELectionController::class,'post_details_election']);

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
