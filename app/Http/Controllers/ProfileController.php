<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Chien;

class ProfileController extends Controller
{

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request)
    {
        $user = $request->user();

        return view('profile.edit', [
            'user' => $user,
            'chiens' => $request->user()->chiens()->latest()->get(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    //ADDRESS METHODS

    public function updateAddress(Request $request)
    {
        $request->validate([
            'voie' => 'nullable|string|max:255',
            'ville' => 'nullable|string|max:255',
            'code_postal' => 'nullable|string|max:20',
            'complement' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        $user->adresse()->updateOrCreate([], [
            'voie' => $request->voie,
            'ville' => $request->ville,
            'code_postal' => $request->code_postal,
            'complement' => $request->complement,
        ]);

        return back()->with('status', 'address-updated');
    }

    //DOGS METHODS

    public function storeDog(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $user = auth()->user();

        $user->chiens()->create([
            'nom' => $validated['nom'],
            'age' => 0,
            'race' => 'Ex: Labrador',
        ]);

        return back();
    }


    public function updateDog(Request $request, $id)
    {
        $chien = auth()->user()->chiens()->findOrFail($id);

        $chien->update($request->only('nom', 'age', 'race'));

        return back();
    }

    public function deleteDog($id)
    {
        $chien = auth()->user()->chiens()->findOrFail($id);

        $chien->delete();

        return back();
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
