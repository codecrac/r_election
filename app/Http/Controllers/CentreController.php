<?php

namespace App\Http\Controllers;

use App\Models\Candidat;
use App\Models\Centre;
use App\Models\NombreInscritCentreElections;
use App\Models\ParticipationElectionCentre;
use App\Models\ResultatElectionCentre;
use Illuminate\Http\Request;

class CentreController extends Controller
{

    public function definir_nombre_inscrits(){
        return view('admin.zone.centre.definir_prerequis');
    }

    public function post_definir_nombre_inscrits(Request $request){
        $df = $request->input();

        try{

            $le_nombre = NombreInscritCentreElections::where(
                [
                    'centre_id' => auth()->user()->id,
                    'election_id' => $this->id_election,
                ]
            )->first();

            if($le_nombre !=null){
                $le_nombre->nombre_electeurs_attendus = $df['electeurs_attendus'];
                $le_nombre->save();
            }else{
                NombreInscritCentreElections::create(
                    [
                        'centre_id' => auth()->user()->id,
                        'election_id' => $this->id_election,
                        'nombre_electeurs_attendus' => $row['nombre_electeurs_inscrits'] ?? null
                    ]
                );
            }

            $notification = "<div class='alert alert-success' > Enregistrement bien effectué </div>";
        }catch (\Exception $e){
        $notification = "<div class='alert alert-danger' > Une erreur est survenue : ". $e->getMessage() ." </div>";
        }

        return redirect()->back()->with(['notification'=>$notification]);
    }

    //------

    public function definir_resultat_candidat(){
        $liste_resultat_du_centre = ResultatElectionCentre::where([
            'election_id' => auth()->user()->election_id ,
            'centre_id' => auth()->user()->centre_id
        ])->get();


        $date_decompte = null;

        if(isset($_GET['d'])){
            $date_decompte = $_GET['d'];
        }


        $participation_existant = ParticipationElectionCentre::where([
            'election_id' => auth()->user()->election_id ,
            'centre_id' => auth()->user()->centre_id,
            'date_decompte' => $date_decompte
        ])->first();

        $liste_candidats_de_leclection = Candidat::where('election_id',auth()->user()->election_id)->get();

        return view('admin.zone.centre.definir_resultat_candidat',compact('liste_resultat_du_centre','liste_candidats_de_leclection','date_decompte','participation_existant'));
    }


    public function post_definir_resultat_candidat(Request $request){
        $df = $request->input();


//        try{


            $liste_id_candidat = $df['id_candidat'];
            $liste_nombre_de_voix = $df['nombre_de_voix'];
            $date_decompte = $df['date_decompte'];

            $participation_existant = ParticipationElectionCentre::where([
                'election_id' => auth()->user()->election_id ,
                'centre_id' => auth()->user()->centre_id,
                'date_decompte' => $date_decompte
            ])->first();

            if($participation_existant ==null){
                $nombre_votant_du_jour = array_sum($liste_nombre_de_voix);
                $participation_existant = ParticipationElectionCentre::create([
                    'election_id' => auth()->user()->election_id ,
                    'centre_id' => auth()->user()->centre_id,
                    'date_decompte' => $date_decompte,
                    'bulletin_null' => $df['nb_bulletins_nuls'],
                    'bulletin_blanc' => $df['nb_bulletins_blancs'],
                    'electeurs_effectif' => $nombre_votant_du_jour, //votant
                ]);
            }

            for ($i=0;$i<sizeof($liste_id_candidat);$i++){
                $le_resultat_existant = ResultatElectionCentre::where('election_id',$df['election_id'])->where('candidat_id',$liste_id_candidat[$i])->where('centre_id',$liste_id_candidat[$i])->where('date_decompte',$date_decompte)->first();

                if($le_resultat_existant ==null ){
                    ResultatElectionCentre::create(
                        [
                            'election_id' => $df['election_id'],
                            'centre_id' => $df['id_centre'],
                            'participation_id' => $participation_existant->id,
                            'candidat_id' => $liste_id_candidat[$i],
                            'nombre_voix' => $liste_nombre_de_voix[$i],
                            'date_decompte' => $date_decompte,
                        ]
                    );
                }else{
                    $le_resultat_existant->update(
                        [
                            'nombre_voix' => $liste_nombre_de_voix[$i]
                        ]
                    );
                }

            }

            $notification = "<div class='alert alert-success' > Enregistrement bien effectué </div>";
//        }catch (\Exception $e){
//            $notification = "<div class='alert alert-danger' > Une erreur est survenue : ". $e->getMessage() ." </div>";
//        }

        return redirect()->back()->with(['notification'=>$notification]);
    }

}
