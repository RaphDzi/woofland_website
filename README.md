# Woofland Website

Site officiel de l'association Woofland La Sentinelle.

Woofland est une application Laravel permettant de presenter l'association, publier des actualites, gerer les membres, les chiens, les cours canins et les echanges entre utilisateurs.

## Fonctionnalites

- Page d'accueil avec les dernieres publications.
- Page de presentation de l'association.
- Inscription et connexion des membres.
- Verification d'email et authentification a deux facteurs.
- Gestion du profil membre, de l'adresse et des chiens.
- Consultation, filtrage, inscription et desinscription aux cours.
- Messagerie interne entre utilisateurs.
- Espace d'administration protege par role.
- Gestion des publications avec images et visibilite.
- Gestion des utilisateurs et des roles.
- Tableau de bord administrateur avec statistiques.

## Stack technique

- PHP 8.2+
- Laravel 12
- Laravel Breeze
- MySQL
- MongoDB pour les conversations et messages
- Vite
- Tailwind CSS
- Alpine.js
- PHPUnit
- Docker et Docker Compose
- GitHub Actions
- SonarQube

## Prerequis

Pour une installation locale classique :

- PHP 8.2 ou plus
- Composer
- Node.js et npm
- MySQL
- MongoDB

Pour une installation Docker :

- Docker
- Docker Compose

## Installation locale

Cloner le projet, puis installer les dependances :

```bash
composer install
npm install
```

Creer le fichier d'environnement :

```bash
cp .env.example .env
php artisan key:generate
```

Configurer ensuite les variables de base de donnees dans `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_la_base
DB_USERNAME=utilisateur_mysql
DB_PASSWORD=mot_de_passe_mysql

MONGODB_URI=mongodb://127.0.0.1:27017
MONGODB_DATABASE=nom_de_la_base_mongodb
```

Lancer les migrations :

```bash
php artisan migrate
```

Demarrer l'application en developpement :

```bash
composer run dev
```

L'application Laravel est ensuite accessible sur l'URL affichee dans le terminal. Vite compile les assets en parallele.

## Installation avec Docker

Le projet fournit une configuration Docker Compose avec :

- un conteneur Laravel PHP-FPM ;
- un conteneur Nginx ;
- un conteneur MySQL ;
- un conteneur MongoDB ;
- des volumes persistants pour les bases de donnees et les fichiers televerses.

Demarrer l'environnement :

```bash
docker compose up -d --build
```

Executer les migrations dans le conteneur applicatif :

```bash
docker compose exec app php artisan migrate --force
```

L'application est disponible par defaut sur :

```text
http://localhost:8080
```

Les variables Docker peuvent etre surchargees avec les variables suivantes :

```env
WOOFLAND_APP_NAME=Woofland
WOOFLAND_APP_ENV=local
WOOFLAND_APP_KEY=
WOOFLAND_APP_DEBUG=true
WOOFLAND_APP_URL=http://localhost:8080

WOOFLAND_DB_DATABASE=
WOOFLAND_DB_USERNAME=
WOOFLAND_DB_PASSWORD=
WOOFLAND_DB_ROOT_PASSWORD=
WOOFLAND_MONGODB_DATABASE=
```

## Commandes utiles

Installer et preparer le projet :

```bash
composer run setup
```

Lancer le serveur Laravel, la queue et Vite :

```bash
composer run dev
```

Compiler les assets de production :

```bash
npm run build
```

Executer les tests :

```bash
composer test
```

Ou directement :

```bash
php artisan test
```

## Structure du projet

```text
app/                 Code applicatif Laravel
app/Http/Controllers Controleurs publics, membres et admin
app/Models           Modeles Eloquent et modeles MongoDB
database/migrations  Structure des tables SQL
resources/views      Vues Blade
routes/web.php       Routes web de l'application
public/uploads       Images de publications televersees
docker/              Configuration PHP-FPM et Nginx
tests/               Tests automatises
docs/                Documentation projet
```

## Roles

L'application utilise trois roles principaux :

- `membre` : acces a l'espace membre, profil, chiens, cours et messagerie.
- `formateur` : role metier prevu pour les encadrants.
- `admin` : acces au tableau de bord d'administration, aux utilisateurs et aux publications.

## Publications

Les publications peuvent etre visibles :

- uniquement par les membres ;
- par les membres et les visiteurs.

Les images sont stockees dans `public/uploads/publications`.

## Messagerie

Les conversations et messages utilisent MongoDB via le package `mongodb/laravel-mongodb`.

Pour que la messagerie fonctionne en local, MongoDB doit etre demarre et les variables `MONGODB_URI` et `MONGODB_DATABASE` doivent etre configurees.

## Integration continue

Le projet contient un workflow GitHub Actions decoupe en quatre jobs :

- `Build` : installe les dependances PHP et front-end, puis compile les assets Vite ;
- `Test` : prepare l'environnement Laravel, lance MySQL, execute les migrations et les tests avec couverture ;
- `Quality` : lance l'analyse SonarQube a partir du rapport de couverture ;
- `Deploy` : construit et pousse les images Docker PHP-FPM et Nginx dans GitHub Container Registry.

Le deploiement Docker respecte la configuration Docker Compose du projet :

- image applicative PHP-FPM : variable `WOOFLAND_APP_IMAGE` ;
- image serveur Nginx : variable `WOOFLAND_NGINX_IMAGE`.

Sans ces variables, Docker Compose continue d'utiliser des noms d'images locaux et peut toujours reconstruire les services avec les Dockerfiles du projet.

Secrets GitHub Actions a prevoir :

```text
DB_DATABASE
DB_PASSWORD
SONAR_TOKEN
```

Le push vers GitHub Container Registry utilise le `GITHUB_TOKEN` fourni automatiquement par GitHub Actions avec la permission `packages: write`.

Les identifiants et mots de passe ne doivent pas etre ecrits directement dans le workflow ou dans le depot. Ils doivent etre stockes dans les secrets GitHub.

## Securite

- Ne pas versionner le fichier `.env`.
- Ne pas commiter d'identifiants, de mots de passe ou de cles API.
- Utiliser `.env.example` pour documenter les variables attendues.
- Generer une nouvelle cle `APP_KEY` pour chaque environnement.
- Utiliser des secrets GitHub Actions pour la CI.

## Licence

Projet realise pour l'association Woofland La Sentinelle.
