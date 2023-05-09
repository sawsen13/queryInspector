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
        Schema::create('groupes', function (Blueprint $table) {
            $table->id('id_gr');
            $table->timestamps();
            $table->integer('num_gr');
            $table->unsignedBigInteger('promotion')->nullable()->index();
            $table->timestamp('deleted_at')->nullable()->useCurrentOnDelete();
        });

        Schema::table('groupes', function (Blueprint $table) {
          
            
            $table->foreign('promotion')
                  ->references('id_pr')
                  ->on('promotions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('groupe')->nullable()->index();
            $table->foreign('groupe')->references('id_gr')->on('groupes')
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
            $table->dropForeign(['groupe']);
$table->dropColumn('groupe');

        });
    }
};
