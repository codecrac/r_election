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

    public function electeurs_inscrit($id_election){
        $le_nombre = NombreInscritCentreElections::where('election_id',$id_election)->where('centre_id',$this->id)->first();
        return $le_nombre == null ? 0 : $le_nombre->nombre_electeurs_attendus ;
    }
}
