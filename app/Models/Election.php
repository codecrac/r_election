<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rules\Can;

class Election extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function candidats(){
        return $this->hasMany(Candidat::class,);
    }


}
