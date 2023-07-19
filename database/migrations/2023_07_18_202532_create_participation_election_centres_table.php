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
        Schema::create('participation_election_centres', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('election_id')->nullable();
            $table->foreign('election_id')->references('id')->on('elections')->onDelete('set null');

            $table->unsignedBigInteger('centre_id')->nullable();
            $table->foreign('centre_id')->references('id')->on('centres')->onDelete('set null');

            $table->integer('electeurs_effectif'); //votant

            $table->integer('bulletin_null');
            $table->integer('bulletin_blanc');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participation_election_centres');
    }
};
