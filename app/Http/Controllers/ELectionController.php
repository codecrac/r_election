<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
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

        if($lelection == null){
            return redirect()->route('election.liste');
        }

        return view('admin.election.details',compact('lelection','liste_zones_de_vote'));

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
