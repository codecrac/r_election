<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function nombre_de_voix_centre_date($id_centre, $date_decompte){
        $resultat_id_centre = ResultatElectionCentre::where('centre_id',$id_centre)->where('candidat_id',$this->id)->where('date_decompte',$date_decompte)->first();
        if($resultat_id_centre == null){
            return 0;
        }
        return $resultat_id_centre->nombre_voix;
    }
    public function nombre_de_voix_en_tout_le_centre($id_centre){
        $nombre_voix = ResultatElectionCentre::where('centre_id',$id_centre)->where('candidat_id',$this->id)->sum('nombre_voix');

        return $nombre_voix;
    }
    public function nombre_de_voix_election($id_election){
        $nombre_voix = ResultatElectionCentre::where('election_id',$id_election)->where('candidat_id',$this->id)->sum('nombre_voix');

        return $nombre_voix;
    }

}
