<?php
namespace shoudusse\ERP;

class FonctionaliteManager extends DataManager {
	private static $instance = null;
	const TABLE_SQL = 'Fonctionalites';

	// Methode pour initalisation Singleton
	public static function initManager() {
		if (self::$instance === null) {
			self::$instance = new FonctionaliteGroupesManager();
		}
		return self::$instance;
	} 

	public function __construct() {

	}

	// Teste l'existance d'un etablissement par recherche sur le libelle
	public function existsFonctionalite(Fonctionalite $fonctionalite) {
		$className = Utilitaires::className($fonctionalite);
		$criteres = array(':libelle' => $fonctionalite->getLibelle();
		$selection = $this->recupId(self::TABLE_SQL, $criteres, $className);
		if (count($selection) == 1) {
			return true;
		} else { 
			return false;
		}
	}


	// Retourne un tableau d'object etablissement avec 1 objet trouve par le libelle
	public function getFonctionalite(Fonctionalite $fonctionalite) {
		$criteres  = array(':libelle' => $fonctionalite->getLibelle();
		$className = Utilitaires::className($fonctionalite);
		$tableau = $this->recupId(self::TABLE_SQL, $criteres, $className);
		echo '----getIdUtilisateursGroups----';
		var_dump($tableau);
		return $tableau;
	}


	public function dataAccess(Fonctionalite $fonctionalite, $operation) {
		if ($operation == 'UPDATE') {
			if ($fonctionalite->getId() === null) {
				$retour = $this->getFonctionalite($fonctionalite);
				$fonctionalite->setId($retour[0]->getId());
			}
		}
		$instruction = $operation;
		$parametres = $this->construireParametres($fonctionalite);
		$className = Utilitaires::className($fonctionalite);
		$chaineSql = $this->buildRequest($instruction, $parametres, self::TABLE_SQL);
	} 
}




?>