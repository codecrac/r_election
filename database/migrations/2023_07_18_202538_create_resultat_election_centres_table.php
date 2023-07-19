<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('resultat_election_centres', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->unsignedBigInteger('election_id')->nullable();
            $table->foreign('election_id')->references('id')->on('elections')->onDelete('set null');

            $table->unsignedBigInteger('centre_id')->nullable();
            $table->foreign('centre_id')->references('id')->on('centres')->onDelete('set null');

            $table->unsignedBigInteger('participation_id')->comment('participation_election_centre_id')->nullable(); //participation_election_centre_id
            $table->foreign('participation_id')->references('id')->on('participation_election_centres')->onDelete('set null');

            $table->unsignedBigInteger('candidat_id')->nullable();
            $table->foreign('candidat_id')->references('id')->on('candidats')->onDelete('set null');

            $table->integer('nombre_voix');
            $table->integer('pourcentage_obtenu')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resultat_election_centres');
    }
};
