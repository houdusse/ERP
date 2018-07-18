<?php
namespace shoudusse\ERP;

class UtilisateurManager extends DataManager {

	private static $instance = null;
	private static $DB; 
	private $table = 'Utilisateurs';


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

	}


	/*public function getUser($critere) {
		$param = array(':critere' => $critere);
		$sql = 'SELECT * FROM Utilisateurs WHERE login = :critere';
		$tableau = $this->ADO($sql, $param, 'shoudusse\ERP\Utilisateur');
		return $tableau;
	}*/


	// Retourne un tableau d'object Groupe avec 1 objet trouve par le libelle
	public function getUser(Utilisateur $user) {
		$criteres  = array(':login' => $Group->getLogin());
		$className = Utilitaires::className($Group);
		$tableau = $this->recupId($this->table, $criteres, $className);
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
		$table = 'Utilisateurs';
		$instruction = 'UPDATE';
		$parametres = $this->construireParametres($user);
		$className = Utilitaires::className($user);
		$chaineSql = $this->constructionRequete($instruction, $parametres, $table);
		echo '---UPDATE----';
		var_dump($chaineSql);
		// $this->ADO($chaineSql, $parametres, $className);
	}

	// Insere l'objet reçu en parametre dans la base
	public function writeUser(Utilisateur $user) {
		$table = 'Utilisateur';
		$instruction = 'INSERT';
		$parametres = $this->construireParametres($user);
		$className = Utilitaires::className($user);
		$chaineSql = $this->constructionRequete($instruction, $parametres, $table);
		echo '---INSERT----';
		var_dump($chaineSql);
	}

	// Supprime le Groupe de la base
	public function deleteUser(Utilisateur $user) {
		$table = 'Utilisateurs';
		$instruction = 'DELETE';
		$parametres = array(':id' => $user->getId());
		$className = Utilitaires::className($group);
		$chaineSql = $this->constructionRequete($instruction, $parametres, $table);
		echo '---DELETE----';
		var_dump($chaineSql);

		// $this->ADO($chaineSql, $parametres, $className);
	}

}




?>