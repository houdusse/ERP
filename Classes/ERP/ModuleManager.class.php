<?php
namespace shoudusse\ERP;

class ModuleManager extends DataManager {
	private static $instance = null;
	const TABLE_SQL = 'Modules';

	// Methode pour initalisation Singleton
	public static function initManager() {
		if (self::$instance === null) {
			self::$instance = new ModuleManager();
		}
		return self::$instance;
	} 

	public function __construct() {

	}

	// Teste l'existance d'un etablissement par recherche sur le libelle
	public function existsModule(Module $module) {
		$className = Utilitaires::className($module);
		$criteres = array(':libelle' => $module->getLibelle());
		$selection = $this->getSelected(self::TABLE_SQL, $criteres, $className);
		if (count($selection) == 1) {
			return true;
		} else { 
			return false;
		}
	}


	// Retourne un tableau d'object etablissement avec 1 objet trouve par le libelle
	public function getModule(Module $module) {
		$criteres  = array(':libelle' => $module->getLibelle());
		$className = Utilitaires::className($module);
		$tableau = $this->getSelected(self::TABLE_SQL, $criteres, $className);
		return $tableau;
	}


	

	public function setModule (Module $module) {
		if ($this->existsModule($module)) {
			$this->dataAccess($module, 'UPDATE');
		} else {
			$this->dataAccess($module, 'INSERT');
		}
	}

	public function dataAccess(Module $module, $operation) {
		if ($operation == 'UPDATE') {
			if ($module->getId() === null) {
				$retour = $this->getModule($module);
				$module->setId($retour[0]->getId());
			}
		}
		$instruction = $operation;
		echo '--Operation--';
		if ($operation == 'INSERT') {
			$parametres = $this->construireParametres($module, array('id'), null, null);
		} else	{
			$parametres = $this->construireParametres($module, null, null, null);
		}	
		$className = Utilitaires::className($module);
		$chaineSql = $this->buildRequest($instruction, $parametres, self::TABLE_SQL);
		$this->ADO($chaineSql, $parametres, $className);

	} 
}




?>