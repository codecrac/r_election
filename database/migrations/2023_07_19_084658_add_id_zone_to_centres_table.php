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
        Schema::table('centres', function (Blueprint $table) {
            $table->unsignedBigInteger('zone_id')->comment('communes...')->nullable();
            $table->foreign('zone_id')->references('id')->on('zone_de_votes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('centres', function (Blueprint $table) {
            $table->dropForeign('centres_zone_id_foreign');
            $table->dropColumn('zone_id');
        });
    }
};
