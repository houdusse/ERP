<?php
namespace shoudusse\utilitairesDBB
use shoudusse\ERP\DataManager /*juste pour la methode ADO*/

class CreateSource extends DataManager{

	private $table;
	private $schema = 'shoudusse_ERP';
	private $directory = 'c:\\sources';

	
	public function __construct() {
		/* recuperation dans $GET du parm table contenant le nom de la table (donc de l'objet) dont on
		doit générer le source*/
		if (isset($_GET['table'])) {
			/* rechercher dans le schema si la table existe*/
			$sql = 'SELECT * FROM TABLES WHERE TABLE_NAME = :table AND TABLE_SCHEMA = :schema';
			$parametre = array(':table' => $table, ':schema' => $this->getSchema());
			$resultat = ADO($sql, $paramtre, null);
			if (sizeof($resultat > 0)) {
				$this->table = $_GET['table'];
			} else
				echo "La table $_GET['table'] n'existe pas dans le schema";


		} else {
			echo 'Pas de paramètre table';
		}	
	}

	public function getSchema() {
		return $this->schema;
	}

	public function generate() { 
		$className = substr($table, 0, -1); //nom de la class est le nom de la table au singulier + class + php
		$fileNane .= $className .'class.php';
		$fullQualifiedName = $directory .'\\' .$fileName;


	}

	// methode generique lançant une requête SQL sur la base et renvoyant
	// soit un tableau d'objets soit un tableau indexé
	private function ADO($sql, array $parametres, $class) {
		try {
			$DB = Connexion::getDB();
			$tableau = null;
			$statement = $DB->prepare($sql);
			// Si le retour doit se faire par objet $class n'est pas null et contient le nom de la classe à utiliser 
			if ($class !== null) { // On recupères des objets de la classe $class
				$retour = $statement->setFetchMode(\PDO::FETCH_CLASS, $class, array($DB));
			} else { // Sinon on retourne un tableau indexé
				$retour = $statement->setFetchMode(\PDO::FETCH_NUM);
			}
 			$statement->execute($parametres);
			// si la requete est SELECT alors on parcourt le curseur
			if ( preg_match('#(^SELECT|select)#', $statement->queryString)) {
				while ($donnees = $statement->fetch()) {
					$tableau[] = $donnees;
				}
			}
		} catch (Exception $e) {
			echo 'Erreur getUtilisateur<br>';
			die($e->getMessage());
		}
		return $tableau; // soit tableau d'objet soit tableau indexé classique
}









?>