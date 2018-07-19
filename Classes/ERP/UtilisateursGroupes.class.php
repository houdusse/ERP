<?php
namespace shoudusse\ERP;
use shoudusse\ERP\UtilisateursGroupesManager;
class UtilisateursGroupes  {

	private $id;
	private $idUtilisateur;
	private $idGroupe;
	private $user;
	private $group
	public function __construct() {
		$this->dataAccess = UtilisateursGroupesManager::initManager(); // Singleton
		echo 'constructeur UtilisateursGroupes';
	}

	public function getiD() {
		return $this->id;
	}

	public function getidUtilisateur() {
		return $this->idUtilisateur;
	}

	public function setId($id) {
		if ($this->id == null) {
			$this->id = $id;
		}
	}

	public function setIdUtilisateur($code) {
		$this->code = $code;
	}

	public function setIdGroupe($nom) {
		$this->nom = $nom;
	}

	private function fetchUser() {

	}

	private function fetchGroup() {

	}

	public function ifExists() {
		$reponse = $this->dataAccess->existsUtilisateursGroupes($this);
		return $reponse;
	}

	public function setUtilisateursGroupes() {	
		if ($this->ifExists()) {
			$this->dataAccess->dataAccess($this, 'UPDATE');
		} else {
			$this->dataAccess->dataAccess($this, 'INSERT');
		}
	}

	public function getUtilisateursGroupes() {
		return $this->dataAccess->getUtilisateursGroupes($this);
	}

	public function deleteUtilisateursGroupes() {
		$this->dataAccess->dataAccess($this, 'DELETE');
	}

	public function hisGroups(Utilisateur $user) {
		$resultat =$this->dataAccess($user);
		return $resultat;
	}
 }
?>