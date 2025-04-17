<?php
require_once 'Livre.php';

class BandeDessinee extends Livre {
    private $dessinateur;
    private $serie;
    private $tome;

    public function __construct($id, $titre, $auteur, $anneePublication, $dessinateur, $serie, $tome, $disponible = true) {
        parent::__construct($id, $titre, $auteur, $anneePublication, $disponible);
        $this->dessinateur = $dessinateur;
        $this->serie = $serie;
        $this->tome = $tome;
    }

    public function getInfos() {
        return parent::getInfos() . " Série : {$this->serie}, Tome : {$this->tome}, Dessinateur : {$this->dessinateur}.";
    }

    public function estDansLaMemeSerieQue($autreBD) {
        return $this->serie === $autreBD->serie;
    }
}
?>
