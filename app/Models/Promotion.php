<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Groupe;
use App\Models\User;


class Promotion extends Model
{
    use HasFactory;
    protected $table = 'promotions';
    
     protected $primaryKey = 'id_pr';
     protected $fillable = [
         'libelle_pr',
         'annee_debut',
         'annee_fin',
        
        
     ];

     public function groupes()
    {
        return $this->hasMany(Groupe::class, 'promotion');
    }

    public function users()
    {
        return $this->hasManyThrough(User::class, Groupe::class, 'promotion', 'groupe');
    }

    



}
