<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function nombre_de_voix_centre($id_centre,$date_decompte){
        $resultat_id_centre = ResultatElectionCentre::where('centre_id',$id_centre)->where('candidat_id',$this->id)->where('date_decompte',$date_decompte)->first();
        if($resultat_id_centre == null){
            return 0;
        }
        return $resultat_id_centre->nombre_voix;
    }

}
