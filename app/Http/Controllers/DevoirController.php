<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Devoir;
use App\Models\User;
use App\Models\Evaluation;
use App\Models\Groupe;

use App\Models\Promotion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;





class DevoirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    /*afficher la liste des devoirs pour les 2 utilisateurs*/
    public function index()
{
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role == 'etudiant') {
            // If the user is an etudiant, retrieve all devoirs for their associated promotion
            $devoirs = Devoir::where('promo', $user->promo)->get();
            return view('etudiant.devoirs', ['devoirs' => $devoirs]);
        } }//else {
            // If the user is an enseignant, retrieve all devoirs
            $listDevoir = Devoir::with('promotion')->get();
            $promotions = Promotion::where('annee_debut', '=', date('Y'))
                ->orWhere('annee_fin', '=', date('Y'))
                ->get();
            return view('enseingnant.devoirs', ['devoirs' => $listDevoir, 'promotions' => $promotions]);
       // }
    /*} else {
        // Handle the case where no user is authenticated
        return redirect()->route('login');
    }*/
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('enseingnant.devoirs');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'num_tp' => ['required'],
        'date_debut' => ['required'],
        'date_fin' => ['required'],
        'promo' => ['required', 'exists:promotions,id_pr'],
        'file' => ['required', 'file', 'mimes:pdf,doc,docx']
    ]);

    // Check if the num_tp already exists for the selected promotion
    $num_tp = $request->input('num_tp');
    $promo_id = $request->input('promo');

    $file = $request->file('file');
    $path = $file->store('TPs', 'public');
    
    //recuperer le devoir qui a mm num tp qu'on est entrain de creer
    $existing_devoir = Devoir::where('num_tp', $num_tp)
                             ->where('promo', $promo_id)
                             ->first();
    //verifier si ce devoir pour le tp donné existe deja                       
    if ($existing_devoir) {
        return redirect()->back()->withErrors(['num_tp' => 'Devoir existe déjà pour la promotion sélectionnée.'])->withInput();
    }

    $devoir = new Devoir();
    $devoir->num_tp = $request->input('num_tp');
    $devoir->date_debut = $request->input('date_debut');
    $devoir->date_fin = $request->input('date_fin');
    $devoir->promo = $request->input('promo');
    $devoir->file = $path;
    $devoir->save();

    // Récupérer tous les utilisateurs appartenant à la promotion du nouveau devoir
    $users = User::where('promo', $request->input('promo'))->get();
    foreach ($users as $user) {
        $evaluation = new Evaluation();
        $evaluation->devoir = $devoir->id_dv;
        $evaluation->etudiant = $user->id;
        $evaluation->note = 0;

        $evaluation->save();
    }

    return redirect()->route('devoir.index')->with('success', 'Data saved');
}



public function submitDevoir(Request $request)
{
    // Validate the submitted file
    $validatedData = $request->validate([
        'file' => 'required|file|mimes:c|max:4096',
        'devoir_id' => 'required|exists:devoirs,id_dv',
    ]);

    // Get the authenticated user's ID
    $userId = auth()->user()->id;

    // Update the evaluation record of the authenticated user
    $evaluation = Evaluation::where('devoir', $validatedData['devoir_id'])
                            ->where('etudiant', $userId)
                            ->firstOrFail();

    $evaluation->note = 0;
    $evaluation->soumis = true;
    $evaluation->date_de_soumission = now();
    $evaluation->file = $request->file('file')->store('devoirs');

    $evaluation->save();

    return redirect()->back()->with('success', 'Your file has been submitted successfully.');
}


public function resubmitDevoir(Request $request, $id_ev)
{
    // Validate the submitted file
    $validatedData = $request->validate([
        'file' => 'required|file|mimes:c|max:4096',
    ]);
    
    // Find the evaluation record with the given ID
    $evaluation = Evaluation::find($id_ev);

    // Check that the evaluation record exists and belongs to the authenticated user
    if(!$evaluation || $evaluation->etudiant != auth()->id()) {
        return redirect()->back()->with('error', 'Invalid evaluation ID.');
    }

    // Delete the existing file
    Storage::delete($evaluation->file);

    // Store the uploaded file
    $file = $request->file('file');
    $path = $file->store('devoirs');

    // Update the evaluation record with the new file
    $evaluation->file = $path;
    $evaluation->date_de_soumission = now();

    $evaluation->save();

    return redirect()->back()->with('success', 'Your file has been resubmitted successfully.');
}


    
    /**
     * Display the specified resource.
     */
    public function devoirsSub($id_dev)
    {
        $evaluations = Evaluation::where('devoir', $id_dev)->get();
    
        //findOrFail method throws an exception if the specified record is not found
        $devoir = Devoir::findOrFail($id_dev);
        //$etudiants = User::where('promo',$devoir->promo)->get();


        $etudiants = User::join('groupes', 'users.groupe', '=', 'groupes.id_gr')
                 ->where('groupes.promotion', $devoir->promo)
                 //selects all the columns of the users table and the num_gr column of the groupes table, and retrieves all the matching records
                 ->select('users.*', 'groupes.num_gr')
                 ->get();

    
        return view('enseingnant.devoirssub', compact('evaluations','etudiants', 'devoir'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function voirCode($id_ev)
    {
        $evaluation = Evaluation::findOrFail($id_ev);
        $content = file_get_contents(storage_path('app/'.$evaluation->file));
        return view('enseingnant.code', compact('content'));
    }
    public function supprimer($id_dv)
    {
        Devoir::find($id_dv)->forceDelete();
 
        return redirect()->back()->with('status','Devoir Deleted Successfully');
    }

    //telecharger fiche de TP
    public function download($id)
{
    $devoir = Devoir::findOrFail($id);
    $file = storage_path("app/public/{$devoir->file}");
    return response()->download($file);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
