# Jiri App

## Introduction 📝

Jiri est une application web conçue pour simplifier et améliorer le processus de jurys académiques
pour les projets des étudiants. Elle offre un moyen efficace pour les jurés externes et les professeurs
d'évaluer et de noter le travail des étudiants, tout en facilitant le processus global du jury.

### Table des matières 📚
1. [Contexte](#contexte)
2. [Rôles](#rôles)
3. [Fonctionnalités](#fonctionnalités)
4. [Détails techniques](#schéma-de-la-base-de-données)
5. [Contribution & contact](#contribution--contact)
6. [Licence](#licence)

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

- `jiries` : Liste les événements de jury.
- `users` : Contient les données des utilisateurs, y compris les professeurs et les jurés.
- `students` : Stocke les informations sur les étudiants.
- `people` : Utilisé pour les relations polymorphes entre les utilisateurs et les étudiants.
- `projects` : Liste tous les projets à évaluer.
- `implementations` : Enregistre les réalisations de projets des étudiants.
- `scores` : Stocke les scores et les commentaires des jurés.
- `performances` : Enregistre les notes finales des étudiants.
- `impressions` : Contient les impressions globales des étudiants.

## Contribution & contact 🤝

Si vous souhaitez contribuer ou me contacter à propos de ce projet, veuillez me joindre 
via l'adresse mail suivante : [renaud.vanmeerbergen@gmail.com](mailto:renaud.vanmeerbergen@gmail.com).

## Licence 📜

Ce projet est sous licence MIT. Veuillez le consulter pour plus de détails.

J'espère que cette application améliorera votre système d'encodage de résultats et améliorera
l'expérience des membres du jury, des professeurs et des étudiants.

Merci au king de la qualité web @dominiquevilain pour avoir initialisé la base de donnée de ce projet ! 🏆
