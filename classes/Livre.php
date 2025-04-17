<?php
class Livre {
    protected $id;
    protected $titre;
    protected $auteur;
    protected $anneePublication;
    protected $disponible;

    public function __construct($titre, $auteur, $anneePublication) {
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->anneePublication = $anneePublication;
        $this->disponible = true;
    }

    public function getTitre() {
        return $this->titre;
    }

    public function getAuteur() {
        return $this->auteur;
    }

    public function getAnneePublication() {
        return $this->anneePublication;
    }

    public function isDisponible() {
        return $this->disponible;
    }

    public function getInfos() {
        return "{$this->titre} écrit par {$this->auteur}, publié en {$this->anneePublication}";
    }

    public function emprunter() {
        $this->disponible = false;
    }

    public function retourner() {
        $this->disponible = true;
    }
}
