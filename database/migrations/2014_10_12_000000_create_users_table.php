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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role',  ['etudiant','enseignant']);
            $table->boolean('nouveau_devoir')->default(false);
            $table->rememberToken();
            $table->timestamps();

           
        });

        DB::table('users')->insert(array('name'=>'enseignant','prenom'=>'enseignant','email'=>'enseignant@gmail.com', 'password'=>bcrypt('enseignant123'),'role'=>'enseignant'));

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
       
    }
};
