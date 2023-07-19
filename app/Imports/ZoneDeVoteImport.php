<?php

namespace App\Imports;

use App\Models\Centre;
use App\Models\NombreInscritCentreElections;
use App\Models\User;
use App\Models\ZoneDeVote;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ZoneDeVoteImport implements ToModel, WithHeadingRow
{

    public $id_election;

    public function __construct($id_election){
        $this->id_election = $id_election;
    }

    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
            $la_zone = ZoneDeVote::firstOrCreate([
                'nom' => $row['zone'],
            ]);

            $le_centre =  Centre::where([
                'zone_id' => $la_zone->id,
                'nom' => $row['centre'],
            ])->first();

            if($le_centre == null){
                $le_centre =  Centre::firstOrCreate([
                    'zone_id' => $la_zone->id,
                    'nom' => $row['centre'],
                ]);
            }

            $le_nombre = NombreInscritCentreElections::where(
                [
                    'centre_id' => $le_centre->id,
                    'election_id' => $this->id_election,
                ]
            )->first();

            if($le_nombre !=null){
                $le_nombre->nombre_electeurs_attendus = $row['nombre_electeurs_inscrits'] ?? null;
                $le_nombre->save();
            }else{
                NombreInscritCentreElections::create(
                    [
                        'centre_id' => $le_centre->id,
                        'election_id' => $this->id_election,
                        'nombre_electeurs_attendus' => $row['nombre_electeurs_inscrits'] ?? null
                    ]
                );
            }


            $email_user = explode(' ',$row['chef_de_centre']);
            $nom_users = User::count();

            $lagent_existant =  User::where([
                'user_type' => "agent",
                'election_id' => $this->id_election,
                'name' => $row['chef_de_centre'],
                'centre_id' => $le_centre->id
            ])->first();

            if($lagent_existant == null){
                $user_name = strtolower($email_user[0]).'_'.$nom_users;
                $email_user = strtolower($email_user[0]).'_'.$nom_users.'@gmail.com';

                $lagent =  User::firstOrCreate([
                    'user_type' => "agent",
                    'name' => $row['chef_de_centre'],
                    'email' => $email_user,
                    'user_name' => $user_name,
                    'password' => Hash::make('1234'),
                    'centre_id' => $le_centre->id,
                    'election_id' => $this->id_election,
                    'telephone' => $row['telephone'] ?? null
                ]);
            }else{
                $lagent_existant->update([
                    'telephone' => $row['telephone'] ?? null
                ]);
            }

    }
}
