@extends('layouts.admin')

@section('content')

<h1 class="text-3xl font-bold mb-6">Dashboard</h1>

<div class="grid grid-cols-3 gap-6">

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold">Utilisateurs</h2>
        <p class="text-2xl mt-2">{{ $usersCount ?? 0 }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold">Cours</h2>
        <p class="text-2xl mt-2">{{ $coursesCount ?? 0 }}</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <h2 class="text-lg font-semibold">Publications</h2>
        <p class="text-2xl mt-2">{{ $publicationsCount ?? 0 }}</p>
    </div>

</div>

@endsection