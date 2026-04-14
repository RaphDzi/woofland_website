<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        
        $request->authenticate();

        $user = Auth::user();
        if (
            $user->remember_2fa_token &&
            $user->remember_2fa_expires_at &&
            $user->remember_2fa_expires_at->isFuture()
        ) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        $code = rand(100000, 999999);

        $user->two_factor_code = $code;
        $user->two_factor_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        \Mail::raw("Votre code WoofLand : $code", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Code de connexion WoofLand');
        });

        session(['2fa:user:id' => $user->id]);

        Auth::logout();

        $request->session()->regenerateToken();

        return redirect('/2fa');


    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
