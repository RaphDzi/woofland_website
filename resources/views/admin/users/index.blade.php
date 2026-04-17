@extends('layouts.admin')

@section('content')

    <div class="max-w-6xl mx-auto">

        <!-- TITRE -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">
                👥 Gestion des utilisateurs
            </h1>
        </div>

        <!-- FLASH MESSAGES -->
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded-xl mb-4 shadow">
                {{ session('error') }}
            </div>
        @endif

        <!-- TABLE -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">

            <table class="w-full text-left">

                <!-- HEADER -->
                <thead class="bg-gray-100 text-gray-700 uppercase text-sm">
                    <tr>
                        <th class="p-4">Utilisateur</th>
                        <th class="p-4">Nom</th>
                        <th class="p-4">Prenom</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">Rôle</th>
                        <th class="p-4 text-center">Action</th>
                    </tr>
                </thead>

                <!-- BODY -->
                <tbody class="divide-y">

                    @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition">

                            <!-- USERNAME -->
                            <td class="p-4 font-medium text-gray-800">
                                {{ $user->username }}
                            </td>

                            <!-- LASTNAME -->   
                            <td class="p-4 font-medium text-gray-800">
                                {{ $user->lastname }}
                            </td>

                            <!-- FIRSTNAME -->
                            <td class="p-4 font-medium text-gray-800">
                                {{ $user->firstname }}
                            </td>


                            <!-- EMAIL -->
                            <td class="p-4 text-gray-600">
                                {{ $user->email }}
                            </td>

                            <!-- ROLE BADGE -->
                            <td class="p-4">
                                <span class="
                                        px-3 py-1 rounded-full text-sm font-semibold
                                        @if($user->role === 'admin') bg-red-100 text-red-700
                                        @elseif($user->role === 'formateur') bg-blue-100 text-blue-700
                                        @else bg-gray-100 text-gray-700
                                        @endif
                                    ">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            <!-- ACTION -->
                            <td class="p-4 text-center space-y-2">

                                <!-- ROLE -->
                                <form method="POST" action="{{ route('admin.users.updateRole', $user) }}"
                                    class="inline-flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')

                                    <select name="role" class="border rounded-lg px-2 py-1 text-sm">
                                        <option value="membre" @selected($user->role === 'membre')>Membre</option>
                                        <option value="formateur" @selected($user->role === 'formateur')>Formateur</option>
                                        <option value="admin" @selected($user->role === 'admin')>Admin</option>
                                    </select>

                                    <button onclick="return confirm('Changer le rôle de cet utilisateur ?')"
                                        class="bg-green-600 text-white px-2 py-1 rounded text-sm">
                                        OK
                                    </button>
                                </form>

                                <!-- DELETE -->
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('⚠️ ATTENTION : supprimer cet utilisateur est irréversible. Continuer ?')"
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

    </div>

@endsection