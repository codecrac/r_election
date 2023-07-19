<?php

namespace App\Http\Controllers;

use App\Imports\ZoneDeVoteImport;
use App\Models\Election;
use App\Models\ZoneDeVote;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ZoneController extends Controller
{
    public function index(Request $request){
        $liste_zone = ZoneDeVote::orderBy('id','DESC')->get();
        return view('admin.zone.liste',compact('liste_zone'));
    }

    public function creer(Request $request){
        $liste_election = Election::orderBy('id','DESC')->get();
        return view('admin.zone.creer',compact('liste_election'));
    }
    public function post_creer(Request $request){
        $df = $request->input();


        try{

            $id_election_choisi = $df['id_election'];
            if($request->file('fichier_centre_de_vote') !== null){
                Excel::import(new ZoneDeVoteImport($id_election_choisi), request()->file('fichier_centre_de_vote'));
            }

//            $liste_nom_zone = explode(',',$df['nom']);
//            foreach ($liste_nom_zone as $item_nom){
//                ZoneDeVote::create(
//                    [
//                        'nom' => trim($item_nom),
//                    ]
//                );
//            }

            $notification = "<div class='alert alert-success' > Enregistrement bien effectué </div>";
        }catch (\Exception $e){
            $notification = "<div class='alert alert-danger' > Une erreur est survenue : ". $e->getMessage() ." </div>";
        }

        return redirect()->back()->with(['notification'=>$notification]);
    }
}
