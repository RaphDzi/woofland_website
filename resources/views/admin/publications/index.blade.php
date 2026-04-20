@extends('layouts.admin')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            📰 Gestion des publications
        </h1>

        <a href="{{ route('admin.publications.create') }}"
            class="bg-green-600 text-white px-4 py-2 rounded-lg shadow hover:bg-green-700">
            + Nouvelle publication
        </a>
    </div>

    <!-- FLASH -->
    @if(session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-4 shadow">
        {{ session('success') }}
    </div>
    @endif

    <!-- FILTRES -->
    <form method="GET" class="flex gap-4 mb-6">

        <!-- SEARCH -->
        <input type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Rechercher une publication..."
            class="border rounded-lg px-4 py-2 w-full">

        <!-- SORT -->
        <select name="sort" class="border rounded-lg px-3 py-2">
            <option value="desc" @selected(request('sort')==='desc' )>Plus récentes</option>
            <option value="asc" @selected(request('sort')==='asc' )>Plus anciennes</option>
        </select>

        <button class="bg-gray-800 text-white px-4 py-2 rounded-lg">
            Filtrer
        </button>

    </form>

    <!-- TABLE -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <table class="w-full text-left">

            <!-- HEADER -->
            <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                <tr>
                    <th class="p-4">Titre</th>
                    <th class="p-4">Auteur</th>
                    <th class="p-4">Date</th>
                    <th class="p-4">Description</th>
                    <th class="p-4">Image</th>
                    <th class="p-4">Visibilité</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="divide-y">

                @foreach($publications as $pub)
                <tr class="hover:bg-gray-50 transition">

                    <!-- TITRE -->
                    <td class="p-4 font-semibold text-gray-800">
                        {{ $pub->titre }}
                    </td>

                    <!-- AUTEUR -->
                    <td class="p-4 text-gray-600">
                        {{ $pub->user->username ?? 'N/A' }}
                    </td>

                    <!-- DATE -->
                    <td class="p-4 text-gray-500 text-sm">
                        {{ $pub->created_at->format('d/m/Y H:i') }}
                    </td>

                    <!-- DESCRIPTION -->
                    <td class="p-4 text-gray-600">
                        {{ Str::limit($pub->contenu, 80) }}
                    </td>

                    <!-- IMAGE -->
                    <td class="p-4">
                        @if($pub->image)
                        <img src="{{ asset($pub->image) }}"
                            class="w-16 h-16 object-cover rounded">
                        @else
                        <span class="text-gray-400">Pas d'image</span>
                        @endif
                    </td>

                    <!-- VISIBILITÉ -->
                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold @if($pub->visibilite === 'members_only') bg-blue-100 text-blue-700 @else bg-green-100 text-green-700 @endif
">
                            @if($pub->visibilite === 'members_only')
                            Membres uniquement
                            @else
                            Public
                            @endif
                        </span>
                    </td>

                    <!-- ACTIONS -->
                    <td class="p-4 text-center space-x-2">

                        <a href="{{ route('admin.publications.edit', $pub) }}"
                            class="bg-blue-500 text-white px-3 py-1 rounded text-sm">
                            Modifier
                        </a>

                        <form method="POST"
                            action="{{ route('admin.publications.destroy', $pub) }}"
                            class="inline">
                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('⚠️ Supprimer cette publication ?')"
                                class="bg-red-600 text-white px-3 py-1 rounded text-sm">
                                Supprimer
                            </button>
                        </form>

                    </td>

                </tr>
                @endforeach

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $publications->links() }}
    </div>

</div>

@endsection