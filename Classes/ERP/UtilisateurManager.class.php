<?php
namespace shoudusse\ERP;

class UtilisateurManager extends DataManager {

	private static $instance = null;
	private $DB; 



	public static function initManager(\PDO $DB) {
		if (self::$instance === null) {
			self::$instance = new UtilisateurManager($DB);
		}
		return self::$instance;
	} 

  
	private function __Construct($DB) {
		$this->DB = $DB;
	}


	// test si utilisateur deja présent dans la BDD
	public function existsUser($login) {
		try {
			$sql = "SELECT COUNT(*) as nbr FROM Utilisateurs WHERE login = :login";
			$statement = $this->DB->prepare($sql);
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
	}


	public function getUser($critere) {
		$param = array(':critere' => $critere);
		$sql = 'SELECT * FROM Utilisateurs WHERE login = :critere';
		$tableau = $this->ADO($sql, $param, 'shoudusse\ERP\Utilisateur', $this->DB);
		return $tableau;
	}


	public function setUser(Utilisateur $user) {
		$parametres = $this->construireParametres($user);
		if ($this->existsUser($user->getLogin())) { // Si deja existant en base alors on modifie
			$this->recupId('Utilisateurs', array(':login' => $user->getLogin() ),$this->DB);
			$sql = $this->constructionRequete('UPDATE', $parametres, 'Utilisateurs');

		} else { // si non existant en base il faut le créer
				foreach ($parametres as $key => $value) {
					if ($key = ':id') {
						unset($parametres[':id']);
					}	
				}
				$sql = $this->constructionRequete('INSERT', $parametres, 'Utilisateurs');
		}
		$this->ADO($sql, $parametres, null, $this->DB); 
	}


	public function delete(Utilisateur $user) {
		$parametres = $this->construireParametres($user);
		echo '<br> par ici <br>';
		if (array_key_exists(':id', $parametres) and ($this->existsUser($user->getLogin()))) {
			$sql = $this->constructionRequete('DELETE', $parametres, 'Utilisateurs');
			$this->ADO($sql, array(':id' => $parametres[':id']), null, $this->DB);
		}	
	}

	public function testChainesql($instruction, Utilisateur $user, $table) {
		$parametres = $this->ConstruireParametres($user);
		$table = 'Utilisateurs';
		$chaine = $this->constructionRequete($instruction, $parametres, $table);

	}

}




?>