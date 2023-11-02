# Projet Symfony Series

## Démarrer le projet

Installer les dépendances Composer (PHP) :

```shell
composer install
```

Installer les dépendances NPM (JS) :

```shell
npm install
```

Créer le fichier `.env.local` :

```dotenv
DATABASE_URL="mysql://root:@127.0.0.1:3306/series?serverVersion=8&charset=utf8mb4"
```

Démarrer la compilation des assets avec NPM :

```shell
npm run watch
```

Ouvrir le projet en utilisant Apache ou bien avec le serveur interne de PHP :

```shell
php -S localhost:8000 -t .\public
```

OU

```shell
symfony serve
```

## Création du projet

Si besoin, configurer le proxy :

```shell
set http_proxy=10.35.0.248:8080
```

### Installation de Symfony

Se positionner dans le dossier C:\wamp64\www puis installer le projet Symfony :

```shell
composer create-project symfony/skeleton:"^5.4" my_project_directory
```

Ouvrir le projet dans PHPStorm et **activer le plugin Symfony**.

Ajouter le dossier `.idea` dans le .gitignore.

Initialiser le repo Git et synchroniser avec repo GitHub.

Optionnellement, installer webapp (Doctrine, Twig, Forms...) :

```shell
cd my_project_directory
composer require webapp
```

### Apache Pack

Si on utilise Apache, il faut installer apache-pack :

```shell
composer require symfony/apache-pack
```

### Webpack Encore (Optionnel)

Installer le package :

```shell
composer require symfony/webpack-encore-bundle
```

Installer les dépendances NPM :

```shell
npm install
```

Puis démarrer la compilation des assets :

```shell
npm run watch
```

Pour utiliser SASS : https://symfony.com/doc/current/frontend/encore/css-preprocessors.html

Et pour Bootstrap : https://symfony.com/doc/current/frontend/encore/bootstrap.html



