<?php

namespace App\Http\Controllers;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function store(Request $request)
    {
        // ✅ validation (recommandé)
        $request->validate([
            'titre' => 'required|string',
            'contenu' => 'required|string',
            'image' => 'nullable|image',
        ]);

        // 📸 IMAGE UPLOAD ICI
        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/publications');
        }

        // 💾 INSERT BDD ICI
        Publication::create([
            'titre' => $request->titre,
            'contenu' => $request->contenu,
            'date_publication' => now(),
            'visibilite' => 1,
            'user_id' => auth()->id(),
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Publication créée avec succès');
    }

    public function show(Publication $publication)
    {
        return view('publications.show', compact('publication'));
    }
}