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
			$tableau = Utilitaires::ADO($sql, $param, 'shoudusse\ERP\Utilisateur', $this->DB); //'shoudusse\ERP\Utilisateur'
		var_dump($tableau);
		return $tableau;
	}

}




?>