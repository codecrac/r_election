<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoneDeVote extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function centres(){
        return $this->hasMany(Centre::class,'zone_id');
    }

}
