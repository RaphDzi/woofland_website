@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        ✏️ Modifier la publication
    </h1>

    <!-- ERREURS -->
    @if ($errors->any())
    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
        <ul>
            @foreach ($errors->all() as $error)
            <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST"
        action="{{ route('admin.publications.update', $publication) }}"
        enctype="multipart/form-data"
        class="space-y-4">

        @csrf
        @method('PUT')

        <!-- TITRE -->
        <div>
            <label class="block mb-1 font-semibold">Titre</label>
            <input type="text"
                name="title"
                value="{{ old('title', $publication->titre) }}"
                placeholder="Titre"
                class="w-full border p-2 rounded">
        </div>
        <!-- DESCRIPTION -->
        <div>
            <label class="block mb-1 font-semibold">Description</label>
            <textarea name="description"
                placeholder="Description"
                class="w-full border p-2 rounded">{{ old('description', $publication->contenu) }}</textarea>
        </div>


        <!-- IMAGE ACTUELLE -->
        <div>
            <label class="block mb-1 font-semibold">Image actuelle</label>

            @if($publication->image)
            <img src="{{ asset($publication->image) }}"
                class="w-32 h-32 object-cover rounded mb-2">
            @else
            <div class="w-32 h-32 bg-gray-100 flex items-center justify-center text-gray-400 rounded">
                Aucune image
            </div>
            @endif
        </div>

        <!-- NOUVELLE IMAGE -->
        <div>
            <label class="block mb-1 font-semibold">Remplacer l'image</label>
            <input type="file" name="image"
                class="w-full border p-2 rounded">
        </div>

        <!-- VISIBILITÉ -->
        <select name="visibilite" class="w-full border p-2 rounded">

            <option value="members_only"
                @selected(old('visibilite', $publication->visibilite) === 'members_only')>
                Membres uniquement
            </option>

            <option value="members_and_visitors"
                @selected(old('visibilite', $publication->visibilite) === 'members_and_visitors')>
                Publique (membres et visiteurs)
            </option>

        </select>

        <!-- BOUTONS -->
        <div class="flex gap-3">
            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Mettre à jour
            </button>

            <a href="{{ route('admin.publications.index') }}"
                class="bg-gray-300 px-4 py-2 rounded">
                Annuler
            </a>
        </div>

    </form>

</div>

@endsection