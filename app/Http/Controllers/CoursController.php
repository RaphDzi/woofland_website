<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cours;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class CoursController extends Controller
{
    public function index(Request $request)
    {
        $query = Cours::where('date', '>=', now()->toDateString());

        if ($request->type_cours) {
            $query->where('type_cours', $request->type_cours);
        }

        if ($request->terrain) {
            $query->where('terrain', $request->terrain);
        }

        if ($request->date) {
            $query->whereDate('date', $request->date);
        }

        $cours = $query->with(['animateur', 'inscrits'])
            ->orderBy('date', 'asc')
            ->orderBy('heure_debut', 'asc')
            ->get();

        $typesCours = Cours::select('type_cours')->distinct()->pluck('type_cours');
        $terrains = Cours::select('terrain')->distinct()->pluck('terrain');

        return view('cours.index', compact('cours', 'typesCours', 'terrains'));
    }

    public function inscrire($id)
    {
        $cours = Cours::findOrFail($id);

        $dateCours = Carbon::parse($cours->date . ' ' . $cours->heure_debut);

        if (now()->diffInHours($dateCours, false) < 6) {
            return back()->with('error', 'Moins de 6h avant le cours');
        }
        Auth::user()->coursInscrits()->syncWithoutDetaching($id);

        return back()->with('success', 'Inscription OK');
    }

    public function desinscrire($id)
    {
        $cours = Cours::findOrFail($id);

        $dateCours = Carbon::parse($cours->date . ' ' . $cours->heure_debut);

        if (now()->diffInHours($dateCours, false) < 6) {
            return back()->with('error', 'Moins de 6h avant le cours');
        }
        Auth::user()->coursInscrits()->detach($id);

        return back()->with('success', 'Désinscription OK');
    }
}
