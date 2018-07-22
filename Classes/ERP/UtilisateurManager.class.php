<?php
namespace shoudusse\ERP;

class UtilisateurManager extends DataManager {

	private static $instance = null;
	private static $DB; 
	const TABLE_SQL = 'Utilisateurs';


	public static function initManager() {
		if (self::$instance === null) {
			self::$instance = new UtilisateurManager();
			self::$DB = Connexion::getDB();
		}
		return self::$instance;
	} 

  
	private function __Construct() {
		
	}


	
	// Teste l'existance d'un groupe par recherche sur le libelle
	public function existsUser(Utilisateur $utilisateur) {
		$table = 'Utilisateurs';
		$className = Utilitaires::className($group);
		$criteres = array(':login' => $utilisateur->getLogin());
		$selection = $this->recupId($table, $criteres, $className);
		if (count($selection) == 1) {
			return true;
		} else { 
			return false;
		}

	


	// Retourne un tableau d'object Groupe avec 1 objet trouve par le libelle
	public function getUser(Utilisateur $user) {
		$criteres  = array(':login' => $Group->getLogin());
		$className = Utilitaires::className($Group);
		$tableau = $this->recupId(self::TABLE_SQL, $criteres, $className);
		echo '----getUtilisateur----';
		var_dump($tableau);
		return $tableau;
	}


	public function dataAccess(Utilisateurs $user, $operation) {
		if ($operation == 'UPDATE') {
			if ($link->getId() === null) {
				$retour = $this->getUser($user);
				$etablissement->setId($retour[0]->getId());
			}
		}
		if ($operation == 'INSERT') {
			$parametres = $this->buildParameters($user, array('id'), null, null);
		} else	{
			$parametres = $this->buildParameters($user, null, null, null);
		}
		$instruction = $operation;
		$className = Utilitaires::className($user);
		$chaineSql = $this->buildRequest($instruction, $parametres, self::TABLE_SQL);
		$this->ADO($chaineSql, $parametres, $className);
	} 

}



 
?>