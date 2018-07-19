<?php
namespace shoudusse\ERP;

class ModuleManager extends DataManager {
	private static $instance = null;
	const TABLE_SQL = 'Modules';

	// Methode pour initalisation Singleton
	public static function initManager() {
		if (self::$instance === null) {
			self::$instance = new ModuleGroupesManager();
		}
		return self::$instance;
	} 

	public function __construct() {

	}

	// Teste l'existance d'un etablissement par recherche sur le libelle
	public function existsModule(Module $module) {
		$className = Utilitaires::className($module);
		$criteres = array(':libelle' => $module->getLibelle();
		$selection = $this->recupId(self::TABLE_SQL, $criteres, $className);
		if (count($selection) == 1) {
			return true;
		} else { 
			return false;
		}
	}


	// Retourne un tableau d'object etablissement avec 1 objet trouve par le libelle
	public function getModule(Module $module) {
		$criteres  = array(':libelle' => $module->getLibelle();
		$className = Utilitaires::className($module);
		$tableau = $this->recupId(self::TABLE_SQL, $criteres, $className);
		echo '----getIdUtilisateursGroups----';
		var_dump($tableau);
		return $tableau;
	}


	public function dataAccess(Module $module, $operation) {
		if ($operation == 'UPDATE') {
			if ($module->getId() === null) {
				$retour = $this->getModule($module);
				$module->setId($retour[0]->getId());
			}
		}
		$instruction = $operation;
		$parametres = $this->construireParametres($module);
		$className = Utilitaires::className($module);
		$chaineSql = $this->buildRequest($instruction, $parametres, self::TABLE_SQL);
	} 
}




?>