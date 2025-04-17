<?php
class Livre {
    protected $id;
    protected $titre;
    protected $auteur;
    protected $anneePublication;
    protected $disponible;

    public function __construct($id, $titre, $auteur, $anneePublication, $disponible = true) {
        $this->id = $id;
        $this->titre = $titre;
        $this->auteur = $auteur;
        $this->anneePublication = $anneePublication;
        $this->disponible = $disponible;
    }

    public function getId() { return $this->id; }
    public function getTitre() { return $this->titre; }
    public function getAuteur() { return $this->auteur; }
    public function getAnneePublication() { return $this->anneePublication; }
    public function estDisponible() { return $this->disponible; }

    public function setDisponible($disponible) {
        $this->disponible = $disponible;
    }

    public function getInfos() {
        return "{$this->titre} par {$this->auteur}, publié en {$this->anneePublication}.";
    }

    public function emprunter() {
        if ($this->disponible) {
            $this->disponible = false;
            return true;
        }
        return false;
    }

    public function retourner() {
        $this->disponible = true;
    }
}
?>
