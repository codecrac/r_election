<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Centre;
use App\Models\Election;
use App\Models\ZoneDeVote;
use Illuminate\Http\Request;

class ELectionController extends Controller
{

    public function creer(Request $request){
        return view('admin.election.creer');
    }

    public function post_creer(Request $request){
        $df = $request->input();
        try{
            $nouvel_item = Election::create(
                [
                    'nom' => $df['nom'],
                    'etat' => $df['etat'],
                ]
            );

            $notification = "<div class='alert alert-success' > Enregistrement bien effectué </div>";
        }catch (\Exception $e){
            $notification = "<div class='alert alert-danger' > Une erreur est survenue : ". $e->getMessage() ." </div>";
        }

        return redirect()->back()->with(['notification'=>$notification]);
    }


    public function index(Request $request){
        $liste_election = Election::orderBy('id','DESC')->get();
        return view('admin.election.liste',compact('liste_election'));
    }

    public function details_election(Request $request,$id_election){
        $lelection = Election::find($id_election);
        $liste_zones_de_vote = ZoneDeVote::orderBy('nom','ASC')->get();
        $liste_centre = Centre::orderBy('nom','ASC')->get();

        if($lelection == null){
            return redirect()->route('election.liste');
        }


        $id_election = $lelection->id;
        $nombre_total_inscrit = \App\Models\NombreInscritCentreElections::where('election_id',$id_election)->sum('nombre_electeurs_attendus');
        $nombre_total_votants = \App\Models\ParticipationElectionCentre::where('election_id',$id_election)->sum('electeurs_effectif');
        $nombre_total_bulletin_nuls = \App\Models\ParticipationElectionCentre::where('election_id',$id_election)->sum('bulletin_null');
        $nombre_total_bulletin_blancs = \App\Models\ParticipationElectionCentre::where('election_id',$id_election)->sum('bulletin_blanc');


        $tableau_stats_votes = [];
        $liste_candidat = \App\Models\Candidat::where('election_id',$id_election)->get();
        foreach ($liste_candidat as $item_candidat){

            $tableau_stats_votes[] = [
                'country' => $item_candidat->nom . ' ( '.round($item_candidat->nombre_de_voix_election($id_election) /($nombre_total_votants == 0? 1: $nombre_total_votants) *100,2) .'%) ',
                'visits' => $item_candidat->nombre_de_voix_election($id_election)
            ] ;
        }

        return view('admin.election.details',compact(
            'lelection','liste_zones_de_vote','liste_centre',
            'nombre_total_inscrit',
            'nombre_total_votants','nombre_total_bulletin_blancs','nombre_total_bulletin_nuls',
            'tableau_stats_votes','liste_candidat'
        ));

    }

    public function post_details_election(Request $request, $id_election){

        try{
            $df = $request->input();
            $lelection = Election::find($id_election);
            $lelection->nom = $df['nom'];
            $lelection->etat = $df['etat'];
            $lelection->save();

            $notification = "<div class='alert alert-success' > Enregistrement bien effectué </div>";
        }catch (\Exception $e){
            $notification = "<div class='alert alert-danger' > Une erreur est survenue : ". $e->getMessage() ." </div>";
        }

        return redirect()->back()->with(['notification'=>$notification]);

    }

    public function enregistrer_candidat(Request $request, $id_election){

        $df = $request->input();

        $liste_nom_candidat = explode(',',$df['nom']);

        try{
            foreach ($liste_nom_candidat as $item_nom){
                Candidat::create(
                    [
                        'nom' => $item_nom,
                        'election_id' => $id_election,
                    ]
                );
            }

            $notification = "<div class='alert alert-success' > Enregistrement bien effectué </div>";
        }catch (\Exception $e){
            $notification = "<div class='alert alert-danger' > Une erreur est survenue : ". $e->getMessage() ." </div>";
        }

        return redirect()->back()->with(['notification'=>$notification]);
    }
}
