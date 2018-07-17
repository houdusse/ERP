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
		// $bidon = new shoudusse\ERP\Utilisateur();
		$param = array(':critere' => $critere);
		$sql = 'SELECT * FROM Utilisateurs WHERE login = :critere';
		$tableau = $this->ADO($sql, $param, 'shoudusse\ERP\Utilisateur', $this->DB);
		var_dump($tableau);
		return $tableau;
	}


	public function setUser(Utilisateur $user) {
		$parametres = $this->contruireParametres($user);
		if (existsUser($user->getLogin())) { // Si deja existant en base alors on modifie
			foreach ($parametres as $key => $value) {
				if ($id = 'id') {
					unset($parametres['id']);
				}
			}
			$sql = 'UPDATE Utilisateurs
				SET 
					nom = :nom,
					prenom = : prenom,
					password = :password,
					active = :active
				WHERE
					id = :id';
		} else { // si non existant en base il faut le créer
			$sql = 'INSERT INTO Utilisateurs 
					(login, nom, prenom, password, valide)
					VALUES
					(:login, :nom, :prenom, :password, :valide)';  		
		}
		$this->ADO($sql, $parametres, null, $DB); 
	}


	public function delete(Utilisateur $user) {
		$parametres = $this->construireParametres($user);
		echo '<br> par ici <br>';
		var_dump($parametres);
		if (array_key_exists(':id', $parametres) and ($this->existsUser($user->getLogin()))) {
			$sql = $this->constructionRequete('DELETE', $parametres, 'Utilisateurs');
			$this->ADO($sql, array(':id' => $parametres[':id']), null, $this->DB);
		}	
	}

	public function testChainesql($instruction, Utilisateur $user, $table) {
		$parametres = $this->ConstruireParametres($user);
		$table = 'Utilisateurs';
		$chaine = $this->constructionRequete($instruction, $parametres, $table);
		var_dump($chaine);
		echo '<br>';

	}

}




?>