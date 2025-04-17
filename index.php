<?php
require_once 'classes/Livre.php';
require_once 'classes/Roman.php';
require_once 'classes/Bibliotheque.php';

$biblio = new Bibliotheque('config/database.php');

// Crée un roman
$roman = new Roman("L'Étranger", "Albert Camus", 1942, "Philosophique", 123);

// Ajoute le roman
$biblio->ajouterLivre($roman);
