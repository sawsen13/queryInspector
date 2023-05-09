<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Groupe;
use App\Models\User;
use App\Models\Devoir;


use App\Models\Evaluation;


class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
 /*   public function viewDevoirs()
    {
        $devoir = session()->get('devoir');
        dd($devoir);
      //  var_dump($devoir);
     /*   if (!is_array($devoir) && !is_object($devoir)) {
            // handle case where $devoir is not an array or object
            $devoir = [];
        }

        return view('etudiant.devoirs', ['devoir' => $devoir]);

    }*/
    public function profile()
    {
        
    // Retrieve the currently authenticated user
    $user = Auth::user();

    // Check if a user is authenticated
    if ($user) {
        // If authenticated, return the user information to the view
        return view('etudiant.profile', ['user' => $user]);
    } else {
        // If not authenticated, redirect to login page
        return redirect()->route('login');
    }


    }

    public function editProfile(){

    $user = Auth::user();

        
        return view('etudiant.editprofile',['user'=>$user]);
    }
     public function updateProfile(Request $request)
    {       $user = Auth::user();

          
        $user->name = $request->input('nom');
        $user->prenom = $request->input('prenom');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        //dd($contact);
        return redirect('/profile')->with('status','Etudiant Updated Successfully'); 
    }

    public function showNotes()
{
     $userId = auth()->user()->id;

    $notes = Evaluation::where('etudiant', $userId)
        ->join('devoirs', 'evaluation.devoir', '=', 'devoirs.id_dv')
        ->select('devoirs.num_tp', 'evaluation.note')
        ->get();

    $notesByNumTp = $notes->groupBy('num_tp');
    

    return view('etudiant.notes', ['notes' => $notesByNumTp]);
}


public function supprimer($id)
{
    User::find($id)->forceDelete();

    return redirect()->back()->with('status','Etudiant Deleted Successfully');
}

    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
