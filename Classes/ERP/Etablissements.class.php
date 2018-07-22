<?php
namespace shoudusse\ERP;
use shoudusse\ERP\EtablissementsManager;
class Etablissements  {

	private $id;
	private $code;
	private $libelle;
	private $adresse1;
	private $adresse2;
	private $adresse3;
	private $codePostal;
	private $ville;
	private $dataAccess;

	public function __construct() {
		$this->dataAccess = EtablissementsManager::initManager(); // Singleton
		echo 'constructeur Etablissement';
		var_dump($this->dataAccess);
	}

	public function getiD() {
		return $this->id;
	}

	public function getCode() {
		return $this->code;
	}

	public function getLibelle() {
		return $this->libelle;
	}

	public function getAdresse1() {
		return $this->adresse1;
	}

	public function getAdresse2() {
		return $this->adresse2;
	}

	public function getAdresse3() {
		return $this->adresse3;
	}

	public function getCodePostal() {
		return $this->codePostal;
	}

	public function getVille() {
		return $this->ville;
	}

	public function setId($id) {
		if ($this->id == null) {
			$this->id = $id;
		}
	}

	public function setcode($code) {
		$this->code = $code;
	}

	public function setLibelle($libelle) {
		$this->libelle = $libelle;
	}

	public function setAdresse1($adresse1) {
		$this->adresse1 = $adresse1;
	}

	public function setAdresse2($adresse2) {
		$this->adresse2 = $adresse2;
	}

	public function setAdresse3($adresse3) {
		$this->adresse3 = $adresse3;
	}

	public function setCodePostal($codePostal) {
		$this->codePostal = $codePostal;
	}

	public function setVille($ville) {
		$this->ville = $ville;
	}

	//***********************************************************************************

	public function ifExists() {
		$reponse = $this->dataAccess->existsEtablissements($this);
		return $reponse;
	}

	public function setEtablissements() {	
		$this->dataAccess->setEtablissements($this);
	}

	public function getEtablissements() {
		return $this->dataAccess->getEtablissements($this);
	}

	public function deleteEtablissements() {
		$this->dataAccess->dataAccess($this, 'DELETE');
	}

}
?>