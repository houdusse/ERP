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


	// Construteurs
	public function __Construct( ) {
		// $UtilisateurADO = UtilisateurManager::initManager($DB); // Singleton
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

	
	// retourne un tableau associatif de toutes les propriétés de l'objet
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
	}

	public function setUser() {
		if (existeUser('$this->login')) {
			$UtilisateurADO->update($this);
		} else {
			$UtilisateurADO->insert($this);
		}
	}

	public function deleteUser() {
		if (existeUser('$this->login')) {
			$UtilisateurADO->delete($this);
		}
	}

	public function autentification() {
		// if (UtilisateurManager->)
	} 

}

?>