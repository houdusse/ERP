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

	// Supprime le Groupe de la base
	public function deleteGroup(Groupe $group) {
		$instruction = 'DELETE';
		$parametres = array(':id' => $group->getId());
		$className = Utilitaires::className($group);
		$chaineSql = $this->constructionRequete($instruction, $parametres, self::TABLE_SQL);
		echo '---DELETE----';
		var_dump($chaineSql);

		// $this->ADO($chaineSql, $parametres, $className);
	} 

	// met a jours la base avec l'objet reçu en parametre
	public function updateGroup(Groupe $group) {
		if ($group->getId() === null) {
			$retour = $this->getGroup($group);
			$group->setId($retour[0]->getId());
		}
		$instruction = 'UPDATE';
		$parametres = $this->construireParametres($group);
		$className = Utilitaires::className($group);
		$chaineSql = $this->constructionRequete($instruction, $parametres, self::TABLE_SQL);
		echo '---UPDATE----';
		var_dump($chaineSql);
		// $this->ADO($chaineSql, $parametres, $className);
	}

	// Insere l'objet reçu en parametre dans la base
	public function writeGroup(Groupe $group) {
		$instruction = 'INSERT';
		$parametres = $this->construireParametres($group);
		$className = Utilitaires::className($group);
		$chaineSql = $this->constructionRequete($instruction, $parametres, self::TABLE_SQL);
		echo '---INSERT----';
		var_dump($chaineSql);

	} 
}




?>