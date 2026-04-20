@extends('layouts.admin')

@section('content')

<div class="max-w-3xl mx-auto">

    <h1 class="text-2xl font-bold mb-6">
        📰 Créer une publication
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
        action="{{ route('admin.publications.store') }}"
        enctype="multipart/form-data"
        class="space-y-4">
        @csrf

        <input type="text" name="title" placeholder="Titre"
            class="w-full border p-2 rounded">

        <textarea name="description" placeholder="Description"
            class="w-full border p-2 rounded"></textarea>

        <div>
            <label class="block mb-1 font-semibold">Image</label>
            <input type="file" name="image"
                class="w-full border p-2 rounded">
        </div>

        <select name="visibilite" class="w-full border p-2 rounded">
            <option value="members_only">Membres uniquement</option>
            <option value="members_and_visitors">Public</option>
        </select>

        <button class="bg-green-600 text-white px-4 py-2 rounded">
            Créer
        </button>

    </form>

</div>

@endsection