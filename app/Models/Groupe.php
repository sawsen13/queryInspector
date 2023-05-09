<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groupe extends Model
{
    use HasFactory;
    protected $table = 'groupes';
    
     protected $primaryKey = 'id_gr';
     protected $fillable = [
         'num_gr',
         'promotion',
         
        
        
     ];
     public function promotion()
{
    return $this->belongsTo(Promotion::class);
}

}
