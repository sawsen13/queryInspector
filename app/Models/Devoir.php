<?php

namespace App\Models;
use App\Models\Promotion;
use App\Models\User;
use App\Models\Evaluation;




use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devoir extends Model
{
    use HasFactory;
    protected $table = 'devoirs';
    
     protected $primaryKey = 'id_dv';
     protected $fillable = [
         'num_tp',
         'date_debut',
         'date_fin',
         'promo',
         'file',
        
        
     ];
     public function promotion()
     {
         return $this->belongsTo(Promotion::class, 'promo');
     }

     public function evaluation()
{
    return $this->hasMany(Evaluation::class, 'devoir');
}

     
   /*  public function viewed()
    {
        $users = User::where('promo', $this->promo)->get();
        foreach ($users as $user) {
            $user->devoirsViewed()->attach($this->id);
        }
    }*/
}
