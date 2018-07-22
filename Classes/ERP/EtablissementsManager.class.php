<?php
namespace shoudusse\ERP;

class EtablissementsManager extends DataManager {
	private static $instance = null;
	const TABLE_SQL = 'Etablissements';

	// Methode pour initalisation Singleton
	public static function initManager() {
		if (self::$instance === null) {
			self::$instance = new EtablissementsManager();
		}
		return self::$instance;
	} 

	public function __construct() {

	}

	// Teste l'existance d'un etablissement par recherche sur le libelle
	public function existsEtablissements(Etablissements $etablissement) {
		$className = Utilitaires::className($etablissement);
		$criteres = array(':libelle' => $etablissement->getLibelle());
		$selection = $this->getSelected(self::TABLE_SQL, $criteres, $className);
		if (count($selection) == 1) {
			return true;
		} else { 
			return false;
		}

	}


	// Retourne un tableau d'object etablissement avec 1 objet trouve par le libelle
	public function getEtablissements(Etablissements $etablissement) {
		$criteres  = array(':libelle' => $etablissement->getLibelle());
		$className = Utilitaires::className($etablissement);
		$tableau = $this->getSelected(self::TABLE_SQL, $criteres, $className);
		echo '----getEtablissement----';
		var_dump($tableau);
		return $tableau;
	}

	public function setEtablissements (Etablissements $etablissement) {
		if ($this->existsEtablissements($etablissement)) {
			$this->dataAccess($etablissement, 'UPDATE');
		} else {
			$this->dataAccess($etablissement, 'INSERT');
		}
	}


	public function dataAccess(Etablissements $etablissement, $operation) {
		if ($operation == 'UPDATE') {
			if ($etablissement->getId() === null) {
				$retour = $this->getEtablissements($etablissement);
				$etablissement->setId($retour[0]->getId());
			}
		}
		if ($operation == 'INSERT') {
			$parametres = $this->buildParameters($etablissement, array('id'), null, null);
		} else	{
			$parametres = $this->buildParameters($etablissement, null, null, null);
		}
		if ($operation == 'DELETE') {
			$parametres = $this->buildParameters($etablissement, array('id'), true, null);
		}
		$instruction = $operation;
		$className = Utilitaires::className($etablissement);
		$chaineSql = $this->buildRequest($instruction, $parametres, self::TABLE_SQL);
		$this->ADO($chaineSql, $parametres, $className);
	} 
}




?>