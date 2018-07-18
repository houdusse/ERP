<?php
namespace shoudusse\ERP;
use shoudusse\ERP\GroupeManager;
class Groupe  {

	private $id;
	private $libelle;
	private $dataAccess;

	public function __construct() {
		$this->dataAccess = GroupeManager::initManager(); // Singleton
		echo 'constructeur Utilisateur';
		var_dump($this->dataAccess);
	}

	public function getiD() {
		return $this->id;
	}

	public function getLibelle() {
		return $this->libelle;
	}

	public function setId($id) {
		if ($this->id == null) {
			$this->id = $id;
		}
	}

	public function setLibelle($libelle) {
		$this->libelle = $libelle;
	}

	public function ifExists() {
		$reponse = $this->dataAccess->existsGroup($this);
		return $reponse;
	}

	public function setGroup() {	
		if ($this->ifExists()) {
			$this->dataAccess->updateGroup($this);
		} else {
			$this->dataAccess->writeGroup($this);
		}
	}

	public function getGroup() {
		return $this->dataAccess->getGroup($this);
	}

	public function deleteGroup() {
		$this->dataAccess->deleteGroup($this);
	}




	


}





?>