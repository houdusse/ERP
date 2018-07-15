<?php
namespace shoudusse\ERP;

class UtilisateurManager {

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
			$result = $statement->fetch(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			die($e->getMessage());
		}
		if ($result['nbr'] == 0) {
			return false;
		}
		return true;
	}

	public function getUtilisateur($critere) {
			$bidon = new shoudusse\ERP\Utilisateur();
		try {
			$sql = 'SELECT * FROM Utilisateurs WHERE login = :critere';
			$statement = $this->DB->prepare($sql);
			$statement->bindValue(':critere', $critere);
			$statement->execute();
			$statement->setFetchMode(PDO::FETCH_CLASS, 'shoudusse\ERP\Utilisateur');
			$user = $statement->fetch();
		} catch (Exception $e) {
			echo 'Erreur getUtilisateur<br>';
			die($e->getMessage());
		}
		var_dump($user);
		return $user;
	}

}




?>