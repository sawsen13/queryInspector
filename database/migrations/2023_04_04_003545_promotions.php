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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id('id_pr');
            $table->timestamps();
            $table->string('libelle_pr');
            $table->year('annee_debut');
            $table->year('annee_fin');
            $table->timestamp('deleted_at')->nullable()->useCurrentOnDelete();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('promo')->nullable()->index();
            $table->foreign('promo')->references('id_pr')->on('promotions')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['promo']);
            $table->dropColumn('promo');
            
        });
    }
};
