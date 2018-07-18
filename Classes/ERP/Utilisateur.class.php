<?php
namespace shoudusse\ERP;

class Utilisateur {

	// Propriétés alimentées pa la BDD
	private $id; // id de l'utilisateur
	private $login; // login de l'utilisateur
	private $password; // password crypté de l'utilisateur
	private $prenom; // prénom de l'utilisateur
	private $nom; // nom de l'utilisateur
	private $active; // Utilisateur activé
	// Autres propriétés

	// tableau des groupes auquel est rataché l'utilisateur
	private $groupe = array();
	// private $DB; 
	private $dataAccess;

	// Construteurs
	public function __Construct($DB ) {
		$this->dataAccess = UtilisateurManager::initManager(); // Singleton
		echo 'constructeur Utilisateur';
	} 


	// les accesseurs

	public function getId() {
		return $this->id;
	}

	public function getLogin() {
		return $this->login;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getPrenom() {
		return $this->prenom;
	}

	public function getNom() {
		return $this->nom;
	}

	public function getActive() {
	return $this->active;
	}

	public function getGroupe() {
		return $this->groupe;
	}

	public function getDataAccess() {
		return $this->dataAccess;
	}

	// les Seters

	public function setId($id) {
		if ($this->getId() == null) {
			$this->id = $id;
		}
	}
	public function setLogin($login) {
		$this->login = $login;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function setPrenom($prenom) {
		$this->prenom = $prenom;
	}

	public function setNom($nom) {
		$this->nom = $nom;
	}

	public function setActive($active) {
		$this->active = $active;
	}

	public function setGroupe() {
		return $this->groupe;
	}

	public function setDataAccess() {
		return $this->dataAccess;
	}
	
	/*// retourne un tableau associatif de toutes les propriétés de l'objet
	public function listeAttributs() {
		$tableau = array(
			'id' => $this->getId(),
			'login' => $this->getLogin(),
			'password' => $this->getPassword(),
			'prenom' => $this->getPrenom(),
			'nom' => $this->getNom(),
			'active' => $this->getActive(),
		);
		return $tableau;
	}*/

	public function setUser() {
		$this->dataAccess->setUser($this);
		var_dump($this);
	}

	/*public function deleteUser() {
		if ($this->dataAccess->existsUser($this->login)) {
			$this->dataAccess->delete($this);
		}
	}*/

	public function setUser() {	
		if ($this->ifExists()) {
			$this->dataAccess->updateUser($this);
		} else {
			$this->dataAccess->writeUser($this);
		}
	}

	public function myGroups($this) {
		$action = new UtilisateursGroupe();
		$tableau  = $action->myGroups($this);
		// Parcours du tableau pour recuperation des objets Groupe
		foreach ($tableau as  $group) {
		 	// recherche du groupe
		 	$this->groupe[] =$group->getGroup();
		 } 
	}

	public function autentification() {
		// if (UtilisateurManager->)
	} 

}

?>