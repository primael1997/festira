# Festira

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- PHP >= 8.2
- Composer
- Node.js >= 20
- npm
- MySQL ou MariaDB
- Git

## Installation

### 1. Cloner le projet

```bash
git clone https://github.com/primael1997/festira.git
```

### 2. Accéder au dossier du projet

```bash
cd nom-du-projet
```

### 3. Installer les dépendances PHP

```bash
composer install
```

### 4. Installer les dépendances JavaScript

```bash
npm install
```

### 5. Copier le fichier d'environnement

```bash
cp .env.example .env
```

Sous Windows :

```cmd
copy .env.example .env
```

### 6. Configurer la base de données

Modifier le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nom_de_la_base
DB_USERNAME=root
DB_PASSWORD=
```

### 7. Générer la clé de l'application

```bash
php artisan key:generate
```

### 8. Exécuter les migrations

```bash
php artisan migrate
```

Si le projet contient des seeders :

```bash
php artisan migrate --seed
```

### 9. Créer le lien de stockage

```bash
php artisan storage:link
```

### 10. Compiler les ressources

En développement :

```bash
npm run dev
```

En production :

```bash
npm run build
```

### 11. Démarrer le serveur

```bash
php artisan serve
```

L'application sera disponible à :

```
http://127.0.0.1:8000
```

## Identifiants de test (si disponibles)

```
Email : admin@admin.com
Mot de passe : password
```

## Commandes utiles

Vider les caches :

```bash
php artisan optimize:clear
```

Relancer les migrations :

```bash
php artisan migrate:fresh --seed
```

Lancer les tests :

```bash
php artisan test
```

## Technologies utilisées

- Laravel
- PHP
- MySQL
- inertia
- Vue
