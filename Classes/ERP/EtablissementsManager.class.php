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
	public function existsEtablissement(Etablissement $etablissement) {
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

	public function setModule (Etablissement $etablissement) {
		if ($this->existsEtablissement($etablissement)) {
			$this->dataAccess($etablissement, 'UPDATE');
		} else {
			$this->dataAccess($etablissement, 'INSERT');
		}
	}

	/

	public function dataAccess(Etablissement $etablissement, $operation) {
		if ($operation == 'UPDATE') {
			if ($etablissement->getId() === null) {
				$retour = $this->getEtablissement($etablissement);
				$etablissement->setId($retour[0]->getId());
			}
		}
		if ($operation == 'INSERT') {
			$parametres = $this->construireParametres($module, array('id'));
		} else	{
			$parametres = $this->construireParametres($module);
		}
		$instruction = $operation;
		$parametres = $this->construireParametres($etablissement);
		$className = Utilitaires::className($etablissement);
		$chaineSql = $this->buildRequest($instruction, $parametres, self::TABLE_SQL);
		$this->ADO($chaineSql, $parametres, $className);
	} 
}




?>