# Projet_bibliotheque
 # Mini Système de Gestion de Bibliothèque

Ce projet illustre l'utilisation de la POO en PHP avec PDO pour manipuler une base de données MySQL. Il inclut :
- Une classe `Livre` abstraite
- Deux sous-classes `Roman` et `BandeDessinee`
- Une classe `Bibliotheque` pour la gestion

## Base de données
Table `livres` :
```sql
CREATE TABLE livres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255),
    auteur VARCHAR(255),
    annee_publication INT,
    disponible BOOLEAN,
    type VARCHAR(50),
    extra_info TEXT
);
