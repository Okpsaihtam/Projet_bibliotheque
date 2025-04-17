<?php

require_once 'Livre.php';

class Roman extends Livre {
    private $genre;
    private $nombrePages;

    public function __construct($titre, $auteur, $anneePublication, $genre, $nombrePages) {
        parent::__construct($titre, $auteur, $anneePublication);
        $this->genre = $genre;
        $this->nombrePages = $nombrePages;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function getNombrePages() {
        return $this->nombrePages;
    }

    public function getInfos() {
        return "{$this->titre} écrit par {$this->auteur}, genre : {$this->genre}, {$this->nombrePages} pages.";
    }

    public function tempsLecture() {
        return ceil($this->nombrePages / 2); // 2 pages par minute
    }
}
