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
        Schema::create('evaluation', function (Blueprint $table) {
            $table->id('id_ev');
            $table->timestamps();
            $table->decimal('note',4,2);
            $table->dateTime('date_de_soumission')->nullable();
            $table->unsignedBigInteger('devoir')->nullable()->index();
            $table->unsignedBigInteger('etudiant')->nullable()->index();
            $table->binary('file')->nullable();
            $table->boolean('soumis')->default(false);

            $table->timestamp('deleted_at')->nullable()->useCurrentOnDelete();
        });

        Schema::table('evaluation', function (Blueprint $table) {
          
            
            $table->foreign('devoir')
                  ->references('id_dv')
                  ->on('devoirs')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->foreign('etudiant')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
       

        Schema::table('evaluation', function (Blueprint $table) {
            $table->dropForeign(['devoir']);
            $table->dropForeign(['etudiant']);
        });

        Schema::dropIfExists('evaluation');
    }
};
