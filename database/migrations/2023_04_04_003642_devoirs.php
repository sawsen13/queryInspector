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
        Schema::create('devoirs', function (Blueprint $table) {
            $table->id('id_dv');
            $table->timestamps();
            $table->integer('num_tp');
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->unsignedBigInteger('promo')->nullable()->index();
            $table->binary('file')->nullable();

            $table->timestamp('deleted_at')->nullable()->useCurrentOnDelete();
        });
        Schema::table('devoirs', function (Blueprint $table) {
          
            
            $table->foreign('promo')
                  ->references('id_pr')
                  ->on('promotions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devoirs', function (Blueprint $table) {
            $table->dropForeign(['promo']);
        });
        Schema::dropIfExists('devoirs');
    }
};
