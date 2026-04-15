<section class="space-y-6">

    <!-- HEADER -->
    <header>
        <h2 class="text-xl font-bold text-gray-800">
            💳 Mon adhésion
        </h2>

        <p class="text-sm text-gray-500">
            Consulte le statut de ton abonnement Woofland 🐾
        </p>
    </header>

    @php
        $adhesion = auth()->user()->adhesion;
    @endphp

    @if (!$adhesion)

        <div class="bg-gray-50 p-6 rounded-xl text-center">
            <p class="text-gray-600">
                Tu n’as pas encore d’adhésion active 🐶
            </p>
        </div>

    @else

        @php
            $active = $adhesion->date_fin_abonnement && $adhesion->date_fin_abonnement >= now();
        @endphp

        <div class="bg-gray-50 p-6 rounded-xl space-y-4">

            <!-- STATUS -->
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Statut</span>

                @if ($active)
                    <span class="text-green-600 font-semibold">✔ Actif</span>
                @else
                    <span class="text-red-600 font-semibold">❌ Expiré</span>
                @endif
            </div>

            <!-- MONTANT -->
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Cotisation</span>
                <span class="font-medium text-gray-800">
                    {{ $adhesion->montant_cotisation }} €
                </span>
            </div>

            <!-- DÉBUT -->
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Début</span>
                <span class="text-gray-800">
                    {{ optional($adhesion->date_debut_abonnement)->format('d/m/Y') }}
                </span>
            </div>

            <!-- FIN -->
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Fin</span>
                <span class="text-gray-800">
                    {{ optional($adhesion->date_fin_abonnement)->format('d/m/Y') }}
                </span>
            </div>

            <!-- DERNIERE MAJ -->
            <div class="flex items-center justify-between">
                <span class="text-gray-600">Dernière mise à jour</span>
                <span class="text-gray-800">
                    {{ optional($adhesion->date_derniere_mise_a_jour)->format('d/m/Y') }}
                </span>
            </div>

        </div>

    @endif

</section>