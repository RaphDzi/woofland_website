<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function verify(Request $request)
    {
        $user = User::find(session('2fa:user:id'));

        if (!$user) {
            return redirect('/login');
        }

        if (
            $user->two_factor_code == $request->code &&
            $user->two_factor_expires_at > now()
        ) {

            // Remember device
            if ($request->has('remember')) {
                $token = \Str::random(60);

                $user->update([
                    'remember_2fa_token' => $token,
                    'remember_2fa_expires_at' => now()->addMonths(2),
                ]);

                cookie()->queue(
                    '2fa_remember',
                    $token,
                    60 * 24 * 60 * 60
                );
            }

            Auth::guard('web')->login($user);

            $request->session()->regenerate();

            $user->update([
                'two_factor_code' => null,
                'two_factor_expires_at' => null,
            ]);

            return redirect()->intended('/');
        }

        return back()->withErrors(['code' => 'Code invalide']);
    }

    public function form()
    {
        return view('auth.2fa');
    }
}
