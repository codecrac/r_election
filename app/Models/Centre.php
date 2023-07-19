<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Centre extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function zone(){
        return $this->belongsTo(ZoneDeVote::class,'zone_id');
    }

    public function chef_de_service(){
        return $this->hasOne(User::class,'centre_id');
    }

    public function electeurs_inscrit($id_election){
        $le_nombre = NombreInscritCentreElections::where('election_id',$id_election)->where('centre_id',$this->id)->first();
        return $le_nombre == null ? 0 : $le_nombre->nombre_electeurs_attendus ;
    }

    public function nombre_total_votants($id_election){
        return ResultatElectionCentre::where('election_id',$id_election)->where('centre_id',$this->id)->sum('nombre_voix');
    }
    public function nombre_bulletins_nuls($id_election){
        return ParticipationElectionCentre::where('election_id',$id_election)->where('centre_id',$this->id)->sum('bulletin_null');
    }
    public function nombre_bulletins_blanc($id_election){
        return ParticipationElectionCentre::where('election_id',$id_election)->where('centre_id',$this->id)->sum('bulletin_null');
    }
}
