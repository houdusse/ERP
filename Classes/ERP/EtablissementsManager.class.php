<?php
namespace shoudusse\ERP;

class EtablissementManager extends DataManager {
	private static $instance = null;

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
		$table = 'Etablissements';
		$className = Utilitaires::className($Etablissement);
		$criteres = array(':libelle' => $group->getLibelle());
		$selection = $this->recupId($table, $criteres, $className);
		if (count($selection) == 1) {
			return true;
		} else { 
			return false;
		}

	}


	// Retourne un tableau d'object etablissement avec 1 objet trouve par le libelle
	public function getEtablissement(Etablissement $etablissement) {
		$criteres  = array(':libelle' => $etablissement->getLibelle());
		$table = 'Etablissements';
		$className = Utilitaires::className($etablissement);
		$tableau = $this->recupId($table, $criteres, $className);
		echo '----getEtablissement----';
		var_dump($tableau);
		return $tableau;
	}

	// Supprime le l'etablissement de la base
	public function deleteEtablissement(Etablissement $etablissement) {
		$table = 'Etablissements';
		$instruction = 'DELETE';
		$parametres = array(':id' => $etablissement->getId());
		$className = Utilitaires::className($etablissement);
		$chaineSql = $this->constructionRequete($instruction, $parametres, $table);
		echo '---DELETE----';
		var_dump($chaineSql);

		// $this->ADO($chaineSql, $parametres, $className);
	} 

	// met a jours la base avec l'objet reçu en parametre
	public function updateEtablissement(Etablissement $etablissement) {
		if ($etablissement->getId() === null) {
			$retour = $this->getEtablissement($etablissement);
			$etablissement->setId($retour[0]->getId());
		}
		$table = 'Etablissements';
		$instruction = 'UPDATE';
		$parametres = $this->construireParametres($etablissement);
		$className = Utilitaires::className($etablissement);
		$chaineSql = $this->constructionRequete($instruction, $parametres, $table);
		echo '---UPDATE----';
		var_dump($chaineSql);
		// $this->ADO($chaineSql, $parametres, $className);
	}

	// Insere l'objet reçu en parametre dans la base
	public function writeEtablissement(Etablissement $etablissement) {
		$table = 'Etablissements';
		$instruction = 'INSERT';
		$parametres = $this->construireParametres($etablissement);
		$className = Utilitaires::className($etablissement);
		$chaineSql = $this->constructionRequete($instruction, $parametres, $table);
		echo '---INSERT----';
		var_dump($chaineSql);

	} 
}




?>