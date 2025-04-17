<?php
require_once 'classes/Bibliotheque.php';

$biblio = new Bibliotheque('config/database.php');
$biblio->chargerLivres();

// Créer des livres
$roman = new Roman(null, "Le Petit Prince", "Antoine de Saint-Exupéry", 1943, "Philosophie", 96);
$bd = new BandeDessinee(null, "Astérix chez les Bretons", "René Goscinny", 1966, "Albert Uderzo", "Astérix", 8);

// Ajouter à la bibliothèque
$biblio->ajouterLivre($roman);
$biblio->ajouterLivre($bd);

// Afficher infos
echo $roman->getInfos() . "<br>";
echo $bd->getInfos() . "<br>";

// Vérifier série
echo $bd->estDansLaMemeSerieQue($bd) ? "Même série<br>" : "Série différente<br>";

// Emprunter
$biblio->emprunterLivre(1);
$biblio->retournerLivre(1);

// Lister livres disponibles
echo "<h3>Livres disponibles :</h3>";
foreach ($biblio->getLivresDisponibles() as $livre) {
    echo $livre->getInfos() . "<br>";
}
?>
