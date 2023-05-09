<?php

namespace App\Http\Controllers;
use App\Models\Promotion;
use App\Models\Groupe;
use App\Models\User;



use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
            $listPromo = Promotion::get();
        
 
        return view('enseingnant.promotions', ['promotions' => $listPromo]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('enseingnant.promotions');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'annee_debut' => ['required'],
                 'annee_fin' => ['required'],
           
      ]);
 $promotion = new Promotion();
 $promotion->annee_debut = $request->input('annee_debut');
 $promotion->annee_fin = $request->input('annee_fin');
 $promotion->libelle_pr ='Promo'.$promotion->annee_debut.'-'.$promotion->annee_fin; 

 $promotion->save();
 $nbr_groupes = $request->input('nbr_groupes');

    // Generate groupes records
    for ($i = 1; $i <= $nbr_groupes; $i++) {
        $groupe = new Groupe();
        $groupe->num_gr = $i;
        $groupe->promotion = $promotion->id_pr;
        $groupe->save();
    }

  return redirect()->route('promotion.index')->with('success', 'Data saved');
    }

    /**
     * Display the specified resource.
     */
    public function showStudents($id_pr)
    {
        $etudiants = User::where('promo', $id_pr)->get();

        return view('enseingnant.ListeDesEtudiants', compact('etudiants'));


    }


    public function edit($id_pr)
    {
        
         $promotion = Promotion::find($id_pr);
        return view('enseignant.promotions', ['promotions'=>$promotion]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pr)
    {
        //
        $promotion = Promotion::find($id_pr);
        $promotion->annee_debut = $request->input('anneeD');
        $promotion->annee_fin = $request->input('anneeF');
        $promotion->libelle_pr ='Promo'.$promotion->annee_debut.'-'.$promotion->annee_fin; 
        $promotion->annee_fin = $request->input('anneeF');
        $promotion->save();

        $nbr_groupes = $request->input('nbr_groupes');
        //je dois supprimer les groupes existants
        // Generate groupes records
    for ($i = 1; $i <= $nbr_groupes; $i++) {
        $groupe = new Groupe();
        $groupe->num_gr = $i;
        $groupe->promotion = $promotion->id_pr;
        $groupe->save();
    }

        return redirect()->back()->with('status','Promotions Updated Successfully');        
    }

    /**
     * Show the form for editing the specified resource.
     */
   

    /**
     * Update the specified resource in storage.
     */
   

    /**
     * Remove the specified resource from storage.
     */
    public function supprimer($id_pr)
    {
        Promotion::find($id_pr)->forceDelete();
 
        return redirect()->back()->with('status','Promotion Deleted Successfully');
    }
}
