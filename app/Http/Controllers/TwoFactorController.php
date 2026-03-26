<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function form()
    {
        return view('auth.2fa');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'code' => 'required'
        ]);

        if (
            $request->code == session('2fa_code')
            && now()->lt(session('2fa_expires_at'))
        ) {
            $user = \App\Models\User::find(session('2fa_user_id'));

            Auth::login($user);

            session()->forget(['2fa_code', '2fa_user_id', '2fa_expires_at']);

            return redirect('/dashboard');
        }

        return back()->withErrors([
            'code' => 'Code invalide ou expiré'
        ]);
    }
}