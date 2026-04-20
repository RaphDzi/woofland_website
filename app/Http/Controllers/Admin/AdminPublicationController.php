<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class AdminPublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Publication::with('user');

        // 🔍 SEARCH
        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('titre', 'like', "%{$search}%")
                    ->orWhere('contenu', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($u) use ($search) {
                        $u->where('username', 'like', "%{$search}%");
                    });
            });
        }

        // 🎯 VISIBILITÉ FILTER
        if ($request->filled('visibilite')) {
            $query->where('visibilite', $request->visibilite);
        }

        // 📅 SORT
        $sort = $request->get('sort', 'desc');
        $query->orderBy('created_at', $sort);

        $publications = $query->paginate(10)->appends($request->query());

        return view('admin.publications.index', compact('publications'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.publications.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'visibilite' => 'required|in:members_only,members_and_visitors',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        // 📸 UPLOAD IMAGE
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/publications'), $filename);
            $imagePath = 'uploads/publications/' . $filename;
        }

        Publication::create([
            'titre' => $request->title,
            'contenu' => $request->description,
            'visibilite' => $request->visibilite,
            'image' => $imagePath,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.publications.index')
            ->with('success', 'Publication créée');
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
    public function destroy(Publication $publication)
    {
        // 🧹 SUPPRESSION IMAGE SI EXISTE
        if ($publication->image && File::exists(public_path($publication->image))) {
            File::delete(public_path($publication->image));
        }

        // 🗑️ SUPPRESSION EN BDD
        $publication->delete();

        return redirect()
            ->route('admin.publications.index')
            ->with('success', 'Publication supprimée');
    }
}
