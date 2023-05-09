<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Groupe;
use App\Models\Devoir;
use App\Models\Evaluation;



use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::PROFILE;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255'],
        'prenom' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'promotion' => ['required', 'exists:promotions,id_pr'],
        'groupe' => ['required', 'exists:groupes,id_gr'],

    ]);
}

protected function create(array $data)
{
    // Check if a devoir already exists for the user's promotion
    $devoirs = Devoir::where('promo', $data['promotion'])->get();

   

    // Create the new user
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'prenom' => $data['prenom'],
        'promo' => $data['promotion'],
        'groupe' => $data['groupe'],
        'password' => Hash::make($data['password']),
    ]);

    // Add the user to the evaluation table for the devoir
    if($devoirs) {
        foreach ($devoirs as $devoir) {
            $evaluation = new Evaluation();
            $evaluation->devoir = $devoir->id_dv;
            $evaluation->etudiant = $user->id;
            $evaluation->note = 0;
            $evaluation->save();
        }}

    return $user;
}


public function showRegistrationForm()
{
    $promotions = Promotion::where('annee_debut', '=', date('Y'))
    ->orWhere('annee_fin', '=', date('Y'))
    ->get();
    $groupes = Groupe::all(); 
    return view('auth.register', compact('promotions', 'groupes'));
}

}
