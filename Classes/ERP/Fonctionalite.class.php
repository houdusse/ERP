<?php
namespace shoudusse\ERP;
use shoudusse\ERP\Fonctionalite;
class Fonctionalite  {

	private $id;
	private $libelle;
	private $dataAccess;


	public function __construct() {
		$this->dataAccess = UtilisateursGroupesManager::initManager(); // Singleton
		echo 'constructeur UtilisateursGroupes';
	}

	public function getiD() {
		return $this->id;
	}

	public function getlibelle($libelle) {
		return $this->idUtilisateur;
	}

	public function setId($id) {
		if ($this->id == null) {
			$this->id = $id;
		}
	}

	public function setLibelle($libelle) {
		$this->libelle = $libelle;
	}
	//**************************************************************

	public function ifExists() {
		$reponse = $this->dataAccess->existsModule($this);
		return $reponse;
	}

	public function setFonctionalite() {	
		if ($this->ifExists()) {
			$this->dataAccess->dataAccess($this, 'UPDATE');
		} else {
			$this->dataAccess->dataAccess($this, 'INSERT');
		}
	}

	public function getFonctionalite() {
		return $this->dataAccess->getModule($this);
	}

	public function deleteFonctionalite() {
		$this->dataAccess->dataAccess($this, 'DELETE');
	}
	
 }
?>