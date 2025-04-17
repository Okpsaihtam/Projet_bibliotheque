<?php
require_once 'Livre.php';
require_once 'Roman.php';
require_once 'BandeDessinee.php';

class Bibliotheque {
    private $pdo;
    private $livres = [];

    public function __construct($configFile) {
        $config = require $configFile;
        $dsn = "mysql:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
        try {
            $this->pdo = new PDO($dsn, $config['username'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "Connexion à la base de données réussie.<br>";
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function ajouterLivre($livre) {
        $this->livres[] = $livre;

        $type = get_class($livre);
        $stmt = $this->pdo->prepare("
            INSERT INTO livres (titre, auteur, annee_publication, disponible, type, extra_info)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $extraInfo = '';
        if ($type === 'Roman') {
            $extraInfo = json_encode([
                'genre' => $livre->getGenre(),
                'pages' => $livre->getNombrePages()
            ]);
            
        
        } elseif ($type === 'BandeDessinee') {
            $extraInfo = json_encode([
                'dessinateur' => $livre->dessinateur,
                'serie' => $livre->serie,
                'tome' => $livre->tome
            ]);
        }

        $stmt->execute([
            $livre->getTitre(),
            $livre->getAuteur(),
            $livre->getAnneePublication(),
            $livre->estDisponible(),
            $type,
            $extraInfo
        ]);
    }

    public function emprunterLivre($id) {
        foreach ($this->livres as $livre) {
            if ($livre->getId() == $id && $livre->emprunter()) {
                $stmt = $this->pdo->prepare("UPDATE livres SET disponible = 0 WHERE id = ?");
                $stmt->execute([$id]);
                return true;
            }
        }
        return false;
    }

    public function retournerLivre($id) {
        foreach ($this->livres as $livre) {
            if ($livre->getId() == $id) {
                $livre->retourner();
                $stmt = $this->pdo->prepare("UPDATE livres SET disponible = 1 WHERE id = ?");
                $stmt->execute([$id]);
                return true;
            }
        }
        return false;
    }

    public function getLivresDisponibles() {
        $livresDisponibles = [];
        foreach ($this->livres as $livre) {
            if ($livre->estDisponible()) {
                $livresDisponibles[] = $livre;
            }
        }
        return $livresDisponibles;
    }

    public function getLivresParAuteur($auteur) {
        $livresAuteur = [];
        foreach ($this->livres as $livre) {
            if ($livre->getAuteur() === $auteur) {
                $livresAuteur[] = $livre;
            }
        }
        return $livresAuteur;
    }

    public function chargerLivres() {
        $sql = "SELECT * FROM livres";
        $result = $this->pdo->query($sql);
        foreach ($result as $row) {
            $extra = json_decode($row['extra_info'], true);
            switch ($row['type']) {
                case 'Roman':
                    $livre = new Roman($row['id'], $row['titre'], $row['auteur'], $row['annee_publication'], $extra['genre'], $extra['pages'], $row['disponible']);
                    break;
                case 'BandeDessinee':
                    $livre = new BandeDessinee($row['id'], $row['titre'], $row['auteur'], $row['annee_publication'], $extra['dessinateur'], $extra['serie'], $extra['tome'], $row['disponible']);
                    break;
                default:
                    $livre = new Livre($row['id'], $row['titre'], $row['auteur'], $row['annee_publication'], $row['disponible']);
            }
            $this->livres[] = $livre;
        }
        echo "Chargement de " . count($this->livres) . " livres terminé.<br>";
    }
}
?>
