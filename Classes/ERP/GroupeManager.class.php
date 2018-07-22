<?php
namespace shoudusse\ERP;

class GroupeManager extends DataManager {
	private static $instance = null;
	const TABLE_SQL = 'Groupes';

	// Methode pour initalisation Singleton
	public static function initManager() {
		if (self::$instance === null) {
			self::$instance = new GroupeManager();
		}
		return self::$instance;
	} 

	public function __construct() {

	}

	// Teste l'existance d'un groupe par recherche sur le libelle
	public function existsGroup(Groupe $group) {
		$className = Utilitaires::className($group);
		$criteres = array(':libelle' => $group->getLibelle());
		$selection = $this->recupId(self::TABLE_SQL, $criteres, $className);
		if (count($selection) == 1) {
			return true;
		} else { 
			return false;
		}

	}


	// Retourne un tableau d'object Groupe avec 1 objet trouve par le libelle
	public function getGroup(Groupe $Group) {
		$criteres  = array(':libelle' => $Group->getLibelle());
		$className = Utilitaires::className($Group);
		$tableau = $this->recupId(self::TABLE_SQL, $criteres, $className);
		echo '----getGroup----';
		var_dump($tableau);
		return $tableau;
	}


	public function dataAccess(Groupe $group, $operation) {
		if ($operation == 'UPDATE') {
			if ($group->getId() === null) {
				$retour = $this->getGroupe($fonctionalite);
				$fonctionalite->setId($retour[0]->getId());
			}
		}
		if ($operation == 'INSERT') {
			$parametres = $this->buildParameters($group, array('id'), null, null);
		} else	{
			$parametres = $this->buildParameters($group, null, null, null);
		}
		$instruction = $operation;
		$className = Utilitaires::className($group);
		$chaineSql = $this->buildRequest($instruction, $parametres, self::TABLE_SQL);
	}  
}




?>