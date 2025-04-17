<?php

class Bibliotheque {
    private $pdo;
    private $livres = [];

    public function __construct($configFile) {
        $config = require $configFile;

        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
            $this->pdo = new PDO($dsn, $config['username'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion à la base de données réussie.<br>";
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function ajouterLivre($livre) {
        $type = get_class($livre);
        $extraInfo = null;

        if ($type === 'Roman') {
            $extraInfo = json_encode([
                'genre' => $livre->getGenre(),
                'pages' => $livre->getNombrePages()
            ]);
        }

        $stmt = $this->pdo->prepare("INSERT INTO livres (titre, auteur, annee_publication, disponible, type, extra_info)
            VALUES (:titre, :auteur, :annee, :disponible, :type, :extra_info)");
        $stmt->execute([
            'titre' => $livre->getTitre(),
            'auteur' => $livre->getAuteur(),
            'annee' => $livre->getAnneePublication(),
            'disponible' => $livre->isDisponible(),
            'type' => $type,
            'extra_info' => $extraInfo
        ]);
    }

    // Ajoute les autres méthodes ici (emprunter, retourner, etc.)
}
