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


	// test si utilisateur deja présent dans la BDD
	/*public function existsUser($login) {
		try {
			$sql = "SELECT COUNT(*) as nbr FROM Utilisateurs WHERE login = :login";
			$statement = self::$DB->prepare($sql);
			$statement->bindValue(':login', $login);
			$statement->execute();
			$result = $statement->fetch(\PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			die($e->getMessage());
		}
		if ($result['nbr'] == 0) {
			return false;
		}
		return true;
	}*/

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


	/*public function setUser(Utilisateur $user) {
		$parametres = $this->construireParametres($user);
		if ($this->existsUser($user->getLogin())) { // Si deja existant en base alors on modifie
			$retour = $this->recupId('Utilisateurs', array(':login' => $user->getLogin()));
			$user->setId($retour[0]->getId());  

			$sql = $this->constructionRequete('UPDATE', $parametres, 'Utilisateurs');

		} else { // si non existant en base il faut le créer
				foreach ($parametres as $key => $value) {
					if ($key = ':id') {
						unset($parametres[':id']);
					}	
				}
				$sql = $this->constructionRequete('INSERT', $parametres, 'Utilisateurs');
		}
		$this->ADO($sql, $parametres, null); 
	}*/


	/*public function delete(Utilisateur $user) {
		$parametres = $this->construireParametres($user);
		echo '<br> par ici <br>';
		if (array_key_exists(':id', $parametres) and ($this->existsUser($user->getLogin()))) {
			$sql = $this->constructionRequete('DELETE', $parametres, 'Utilisateurs');
			$this->ADO($sql, array(':id' => $parametres[':id']), null);
		}	
	}*/

	// met a jours la base avec l'objet reçu en parametre
	public function updateUser(Utilisateur $user) {
	 	if ($user->getId() === null) {
			$retour = $this->getUser($user);
			$user->setId($retour[0]->getId());
		}
		$instruction = 'UPDATE';
		$parametres = $this->construireParametres($user);
		$className = Utilitaires::className($user);
		$chaineSql = $this->buildRequest($instruction, $parametres, self::TABLE_SQL);
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
		// $this->ADO($chaineSql, $parametres, $className);
	} 

}




?>