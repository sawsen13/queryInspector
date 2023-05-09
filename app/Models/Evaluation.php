<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Devoir;


class Evaluation extends Model
{
    use HasFactory;
    protected $table = 'evaluation';
    
     protected $primaryKey = 'id_ev';
     protected $fillable = [
         'note',
         'date_de_soumission',
         'devoir',
         'etudiant',
         'file',
         'soumis'
        
        
     ];
     public function devoir()
{
    return $this->belongsTo(Devoir::class, 'devoir');
}

public function etudiant()
{
    return $this->belongsTo(User::class, 'etudiant');
}
}
