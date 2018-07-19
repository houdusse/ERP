<?php
namespace shoudusse\ERP;

class UtilisateursGroupesManager extends DataManager {
	private static $instance = null;
	const TABLE_SQL = 'UtilisateursGroupes';

	// Methode pour initalisation Singleton
	public static function initManager() {
		if (self::$instance === null) {
			self::$instance = new UtilisateursGroupesManager();
		}
		return self::$instance;
	} 

	public function __construct() {

	}

	// Teste l'existance d'un etablissement par recherche sur le libelle
	public function existsUtilisateursGroupes(UtilisateursGroupes $link) {
		$className = Utilitaires::className($link);
		$criteres = array(':Iduser' => $link->getIduser(),
							'Idgroupe' => $link->getIdgroupe);
		$selection = $this->recupId(self::TABLE_SQL, $criteres, $className);
		if (count($selection) == 1) {
			return true;
		} else { 
			return false;
		}
	}


	// Retourne un tableau d'object etablissement avec 1 objet trouve par le libelle
	public function getUserGroup(UtilisateursGroupes $link) {
		$criteres  = array(':libelle' => $link->getIdUtilisateur(),
							':idGroupe' => $link->getIdGroupe());
		$className = Utilitaires::className($link);
		$tableau = $this->recupId(self::TABLE_SQL, $criteres, $className);
		echo '----getIdUtilisateursGroups----';
		var_dump($tableau);
		return $tableau;
	}

	// retourne l'ensemble de liens UtilisateursGroupes pour un utilisateur donné ($user)
	public function hisGroups($utilisateurs $user) {
		$criteres  = array(':idUtilisateur' => $user->getI());
		$className = Utilitaires::className($this);
		$tableau = $this->recupId(self::TABLE_SQL, $criteres, $className);
		echo '----getIdUtilisateursGroups----';
		var_dump($tableau);
		return $tableau;
	}

	public function dataAccess(UtilisateursGroupes $link, $operation) {
		if ($operation == 'UPDATE') {
			if ($link->getId() === null) {
				$retour = $this->getUsersGroups($link);
				$etablissement->setId($retour[0]->getId());
			}
		}
		$instruction = $operation;
		$parametres = $this->construireParametres($etablissement);
		$className = Utilitaires::className($etablissement);
		$chaineSql = $this->buildRequest($instruction, $parametres, self::TABLE_SQL);
	} 
}




?>