<?php

use shoudusse\ERP\Autoload;
use shoudusse\ERP\UtilisateurManager;
use shoudusse\ERP\Connexion;
use shoudusse\ERP\Utilisateur;
use shoudusse\ERP\Utilitaires;
use shoudusse\ERP\Groupe;

// Mise en place de l'autoloader
require 'classes/autoloader.class.php';
Autoload::autoloader();




// Appel methodes Utilitaires::test($connexion, $criteres)
$user = 'shoudusse';

Connexion::connect();
$userADO = UtilisateurManager::initManager(Connexion::getDB()); 
if ($userADO->existsUser($user)) {
	$resultat = $userADO->getUser($user);
	$shoudusse = $resultat[0];
}

// $shoudusse->deleteUser($shoudusse);
// $shoudusse->setNom('trucmuche');
// $shoudusse->setUser();
$groupe = new Groupe();
$groupe->setLibelle('Depot');
var_dump($groupe);
if ($groupe->ifExists())
	echo '<br>Bien joué<br>';
$mongroupe = $groupe->getGroup();
var_dump($mongroupe[0]);
$mongroupe[0]->setGroup();
$mongroupe[0]->deleteGroup();
$nouveau = new Groupe();
$nouveau->setLibelle('Informatique');
$nouveau->setGroup();




?>