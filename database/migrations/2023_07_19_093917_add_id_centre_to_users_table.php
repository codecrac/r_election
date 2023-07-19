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
        Schema::table('users', function (Blueprint $table) {

            $table->string('user_name')->nullable();

            $table->unsignedBigInteger('centre_id')->comment('communes...')->nullable();
            $table->foreign('centre_id')->references('id')->on('centres')->onDelete('set null');

            $table->unsignedBigInteger('election_id')->comment('communes...')->nullable();
            $table->foreign('election_id')->references('id')->on('elections')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn('user_name');

            $table->dropForeign('users_centre_id_foreign');
            $table->dropColumn('centre_id');

            $table->dropForeign('users_election_id_foreign');
            $table->dropColumn('election_id');

        });
    }
};
