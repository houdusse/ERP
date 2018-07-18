<?php
namespace shoudusse\ERP;

class EtablissementManager extends DataManager {
	private static $instance = null;
	const TABLE_SQL = 'Etablissements';

	// Methode pour initalisation Singleton
	public static function initManager() {
		if (self::$instance === null) {
			self::$instance = new EtablissementManager();
		}
		return self::$instance;
	} 

	public function __construct() {

	}

	// Teste l'existance d'un etablissement par recherche sur le libelle
	public function existsEtablissment(Etablissement $etablissement) {
		$className = Utilitaires::className($Etablissement);
		$criteres = array(':libelle' => $etablissement->getLibelle());
		$selection = $this->recupId(self::TABLE_SQL, $criteres, $className);
		if (count($selection) == 1) {
			return true;
		} else { 
			return false;
		}

	}


	// Retourne un tableau d'object etablissement avec 1 objet trouve par le libelle
	public function getEtablissement(Etablissement $etablissement) {
		$criteres  = array(':libelle' => $etablissement->getLibelle());
		$className = Utilitaires::className($etablissement);
		$tableau = $this->recupId(self::TABLE_SQL, $criteres, $className);
		echo '----getEtablissement----';
		var_dump($tableau);
		return $tableau;
	}

	// Supprime le l'etablissement de la base
	/*public function deleteEtablissement(Etablissement $etablissement) {
		$instruction = 'DELETE';
		$parametres = array(':id' => $etablissement->getId());
		$className = Utilitaires::className($etablissement);
		$chaineSql = $this->constructionRequete($instruction, $parametres, self::TABLE_SQL);
		echo '---DELETE----';
		var_dump($chaineSql);

		// $this->ADO($chaineSql, $parametres, $className);
	} */

	// met a jours la base avec l'objet reçu en parametre
	/*public function updateEtablissement(Etablissement $etablissement) {
		if ($etablissement->getId() === null) {
			$retour = $this->getEtablissement($etablissement);
			$etablissement->setId($retour[0]->getId());
		}
		$instruction = 'UPDATE';
		$parametres = $this->construireParametres($etablissement);
		$className = Utilitaires::className($etablissement);
		$chaineSql = $this->constructionRequete($instruction, $parametres, self::TABLE_SQL);
		echo '---UPDATE----';
		var_dump($chaineSql);
		// $this->ADO($chaineSql, $parametres, $className);
	}*/

	// Insere l'objet reçu en parametre dans la base
	/*public function writeEtablissement(Etablissement $etablissement) {
		$instruction = 'INSERT';
		$parametres = $this->construireParametres($etablissement);
		$className = Utilitaires::className($etablissement);
		$chaineSql = $this->constructionRequete($instruction, $parametres, self::TABLE_SQL);
		echo '---INSERT----';
		var_dump($chaineSql);

	}*/

	public function dataAccess(Etablissement $etablissement, $operation) {
		if ($operation == 'UPDATE') {
			if ($etablissement->getId() === null) {
				$retour = $this->getEtablissement($etablissement);
				$etablissement->setId($retour[0]->getId());
			}
		}
		$instruction = $operation;
		$parametres = $this->construireParametres($etablissement);
		$className = Utilitaires::className($etablissement);
		$chaineSql = $this->constructionRequete($instruction, $parametres, self::TABLE_SQL);
	} 
}




?>