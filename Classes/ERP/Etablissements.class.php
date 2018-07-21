<?php
namespace shoudusse\ERP;
use shoudusse\ERP\EtablissementManager;
class Etablissement  {

	private $id;
	private $code;
	private $nom;
	private $adresse1;
	private $adresse2;
	private $adresse3;
	private $codePostal;
	private $ville;
	private $dataAccess;

	public function __construct() {
		$this->dataAccess = GroupeManager::initManager(); // Singleton
		echo 'constructeur Etablissement';
		var_dump($this->dataAccess);
	}

	public function getiD() {
		return $this->id;
	}

	public function getCode() {
		return $this->code;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getAdresse1() {
		return $this->adresse1;
	}

	public function getAdresse2() {
		return $this->adresse2;
	}

	public function getAdresse3() {
		return $this->Adresse3;
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

	public function setNom($nom) {
		$this->nom = $nom;
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
		$reponse = $this->dataAccess->existsEtablissement($this);
		return $reponse;
	}

	public function setEtablissement() {	
		$this->dataAccess->setEtablissement($this);
	}

	public function getEtablissement() {
		return $this->dataAccess->getEtablissement($this);
	}

	public function deleteEtablissement() {
		$this->dataAccess->dataAccess($this, 'DELETE');
	}

}
?>