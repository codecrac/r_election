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
        Schema::create('nombre_inscrit_centre_elections', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->integer('nombre_electeurs_attendus')->comment('inscrits')->nullable();

            $table->unsignedBigInteger('centre_id')->nullable();
            $table->foreign('centre_id')->references('id')->on('centres')->onDelete('set null');

            $table->unsignedBigInteger('election_id')->nullable();
            $table->foreign('election_id')->references('id')->on('elections')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nombre_inscrit_centre_elections');
    }
};
