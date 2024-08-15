# Jiri App

## Introduction 📝

Jiri est une application web conçue pour simplifier et améliorer le processus de jurys académiques
pour les projets des étudiants. Elle offre un moyen efficace pour les jurés externes et les professeurs
d'évaluer et de noter le travail des étudiants, tout en facilitant le processus global du jury.

## Temps de développement ⏳
[![wakatime](https://wakatime.com/badge/github/VanMeerbergenRenaud/jiri-app.svg)](https://wakatime.com/badge/github/VanMeerbergenRenaud/jiri-app)

## Maquette XD 🎨
[Voir la maquette de design du projet Jiri](https://xd.adobe.com/view/dd388c92-53ab-407b-9e69-4056ba7d9f75-886b/)

### Table des matières 📚
1. [Contexte](#contexte)
2. [Rôles](#rôles)
3. [Fonctionnalités](#fonctionnalités)
4. [Détails techniques](#schéma-de-la-base-de-données)
5. [Contribution & contact](#contribution--contact)
6. [Licence](#licence)
7. [Installation](#installation)

## Contexte 📖

Dans les universités et hautes écoles, les projets des étudiants sont souvent évalués par un jury
externe. Traditionnellement, les évaluations se réalisent sur papier pour collecter les notes
et les commentaires. Jiri, quant à elle, vise à numériser et à rationaliser toutes ces 
évaluations en quelque clic.

## Rôles 👨‍

Jiri propose deux rôles principaux :
- L'administrateur qui :
    - gère l'événement du jury.
    - crée et configure l'événement.
    - ajoute des étudiants et des membres d'un jury à l'événement.
    - définit les critères d'évaluation.
    - surveille la progression du jury lorsqu'une épreuve est en cours.
    - peut outrepasser la note finale calculée si nécessaire.
- Les membres du jury qui :
    - accède à l'application le jour de l'épreuve.
    - note sur 20 et fournit des commentaires sur les projets des étudiants.
    - essaye d'évaluer le plus de projets possibles d'un étudiant.
    - donne une note d'impression globale pour chaque étudiant.

## Fonctionnalités 🚀

Jiri offre une gamme de fonctionnalités, comme :

- des formulaires pour ajouter des étudiants et des membres du jury à l'événement.
- des formulaires conviviaux pour la création d'épreuves, l'enregistrement de notes et de commentaires.
- des calculs automatisés des notes pour chaque projet présenté en fonction de chaque étudiant.
- des vues détaillées aussi bien pour les professeurs que pour les membres du jury.
- un suivi en temps réel de la progression du jury lors de l'épreuve.
- des tableaux pour résumer les notes, les commentaires et les passages de chaque étudiant.

## Détails techniques 🛠️

Jiri est développé en utilisant les technologies modernes du développement web et suit de bonnes pratiques :

- Backend : Laravel respectant le modèle Eloquent.
- Backend & Frontend : Livewire.
- Frontend : Alpine.js.
- Base de données : MySQL.

## Schéma de la base de données 📦

L'application utilise les tables suivantes pour stocker les données :

- `users` : Contient les données des utilisateurs/admins qui se connectent à l'application.
- `events` : Liste les épreuves auxquelles les étudiants et les membres du jury participent.
- `contacts` : Stocke toutes les informations de contact dans l'application.
- `event_contact` : Stocke les rôles des contacts pour chaque événement.
- `projects` : Stocke toutes les informations sur les projets à réaliser.
- `tasks` : Stocke les tâches à réaliser pour chaque projet.
- `project_task` : Table pivot pour les projets et les tâches.
- `evaluator_evaluation` : Stocke les notes et les commentaires des membres du jury pour chaque projet de chaque étudiant.
- `evaluator_evaluation_statuses` : Stocke les statuts des évaluations des membres du jury.
- `event_global_comment` : Stocke les commentaires globaux de l'utilisateur/admin pour chaque étudiant.
- `evaluator_global_comment` : Stocke les commentaires globaux des membres du jury pour chaque étudiant.

## Contribution & contact 🤝

Si vous souhaitez contribuer ou me contacter à propos de ce projet, veuillez me joindre 
via l'adresse mail suivante : [renaud.vanmeerbergen@gmail.com](mailto:renaud.vanmeerbergen@gmail.com).

## Licence 📜

Ce projet est sous licence MIT. Veuillez le consulter pour plus de détails.

J'espère que cette application améliorera votre système d'encodage de résultats et améliorera
l'expérience des membres du jury, des professeurs et des étudiants.

Merci au king de la qualité web @dominiquevilain pour avoir initialisé la base de donnée de ce projet ! 🏆

## Installation 🎉

Pour commencer, clonez ce repo :
```
git clone https://github.com/VanMeerbergenRenaud/jiri-app.git
```
Ensuite, copiez votre fichier .env.example, renommez le .env et configurez ensuite votre connexion à la base de données.
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=YOUR-DATABASE-NAME
DB_USERNAME=YOUR-DATABASE-USERNAME
DB_PASSWORD=YOUR-DATABASE-PASSWROD
```
Exécuter les packages et helpers nécessaires :
```
composer install
npm install
```
Générer une nouvelle clé d'application :
```
php artisan key:generate
```
Exécutez les migrations et les seeders :
```
php artisan migrate:fresh --seed
```
Enfin, lancez le serveur en local :
```
bun run dev
```
