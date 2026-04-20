<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - WoofLand</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-green-700 text-white p-6 space-y-4">
        <h2 class="text-2xl font-bold mb-6">🐶 Admin</h2>

        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="block hover:underline">Dashboard</a>
            <a href="{{ route('admin.cours.index') }}" class="block hover:underline">Cours</a>
            <a href="{{ route('admin.publications.index') }}" class="block hover:underline">Publications</a>
            <a href="{{ route('admin.users.index') }}" class="block hover:underline">Membres</a>
            <a href="{{ route('admin.abonnements.index') }}" class="block hover:underline">Abonnements</a>
        </nav>

    <a href="{{ route('dashboard') }}" class="block hover:underline">Back</a>
    </aside>

    <!-- CONTENU -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</div>

</body>
</html>