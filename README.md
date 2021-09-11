# Infos utiles

## GIT CREDENTIALS

Pour push, pull... utiliser votre *Personal Access Token* disponible sur Github. 

### ***Je vous baise.***
Si jamais la [VM](https://mega.nz/file/Y0YkHBYR#G3EmTC43aNFcLOvr2nZItY_55GiAI3JNZP-M3TRDr_Y).

## Connexion VM:

user: maxime
pass: password 

## Connexion DB:
id:user
pass:password

## Usefull:
rooting avec Symfony
https://symfony.com/doc/current/routing.html

# TODO

**En gros au niveau de la recherche des pathologies, on aura deux pages avec la même liste des pathologies mais qui différent au niveau de la recherche :**

- Pathologies_MC (Mots-Clefs) : Le but est d'avoir la liste et de rechercher par mot-clef qui sont associés aux symptômes dans la bdd, donc l'user tape, l'info est envoyée côté serveur à la bdd, la requête est faite, la liste est mise à jour.

- Pathologies_Critères : Soit on fait des requêtes tout le temps, soit on trouve un moyen de d'avoir toutes les données, et de faire du filtrage côté client en fonction des choix faits.

**Sinon reste la gestion des users :**

- Se connecter : Donne le droits de faire la recherche via mot-clef.
- S'inscrire : Ajout des données en bdd.
- Session : Rester co après un refresh...