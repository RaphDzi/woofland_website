<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9_-]+$/', 'unique:users,username'],
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => [
                'required',
                'confirmed',
                Rules\Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
            ],
            'voie' => ['required', 'string', 'max:255'],
            'ville' => ['required', 'string', 'max:255'],
            'code_postal' => ['required', 'digits:5'],
            'chiens.*.nom' => ['required', 'string'],
            'chiens.*.age' => ['required', 'integer'],
            'chiens.*.race' => ['required', 'string'],
        ]);



        // 1️⃣ Création User
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'membre',
        ]);

        // 2️⃣ Création Membre
        $membre = $user->membre()->create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'date_creation_compte' => now(),
        ]);

        // 3️⃣ Adresse
        $membre->adresse()->create([
            'voie' => $request->voie,
            'ville' => $request->ville,
            'code_postal' => $request->code_postal,
            'complement' => $request->complement,
        ]);

        // 4️⃣ Chiens (1 ou plusieurs)
        foreach ($request->chiens as $chien) {
            $membre->chiens()->create([
                'nom' => $chien['nom'],
                'age' => $chien['age'],
                'race' => $chien['race'],
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
