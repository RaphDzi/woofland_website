<x-app-layout>

    <div class="mx-10 mt-6">

        <!-- PRESENTATION -->
        <div class="bg-gray-300 border border-gray-500 p-4 min-h-[200px]">
            <h2 class="text-sm text-gray-700 mb-2">Présentation :</h2>

            <p class="text-gray-600 text-sm">
                Bienvenue sur Woofland 🐾<br><br>

                Woofland est une association passionnée dédiée à l’éducation canine, fondée sur des valeurs essentielles
                : la bienveillance, la patience et le respect du bien-être animal. Ici, chaque chien est considéré comme
                un individu unique, et chaque apprentissage se fait dans la douceur, sans contrainte ni méthode
                coercitive.<br><br>

                Nous croyons que l’éducation doit être un moment de partage et de plaisir, autant pour le chien que pour
                son maître. C’est pourquoi nous privilégions des approches positives, basées sur la récompense,
                l’encouragement et la complicité. Friandises, jouets, câlins et petites voix aiguës deviennent alors de
                véritables outils pour apprendre efficacement… tout en s’amusant !<br><br>

                Que vous souhaitiez renforcer les bases, améliorer le comportement de votre compagnon ou simplement
                vivre une belle expérience à ses côtés, Woofland vous accompagne à chaque étape. Nos séances sont
                pensées pour créer une relation de confiance durable entre vous et votre chien, dans une ambiance
                conviviale et motivante.<br><br>

                Rejoindre Woofland, c’est faire le choix d’une éducation respectueuse, joyeuse et tournée vers le
                bien-être de tous. 🐶✨
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">

            @foreach($publications as $publication)
                <x-publication-card :publication="$publication" />
            @endforeach

        </div>

    </div>

</x-app-layout>