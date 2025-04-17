<?php
require_once 'Livre.php';

class Roman extends Livre {
    private $genre;
    private $nombrePages;

    public function __construct($id, $titre, $auteur, $anneePublication, $genre, $nombrePages, $disponible = true) {
        parent::__construct($id, $titre, $auteur, $anneePublication, $disponible);
        $this->genre = $genre;
        $this->nombrePages = $nombrePages;
    }

    public function getInfos() {
        return parent::getInfos() . " Genre : {$this->genre}, {$this->nombrePages} pages.";
    }

    public function tempsLecture() {
        return round($this->nombrePages / 2) . " minutes.";
    }
}
?>
