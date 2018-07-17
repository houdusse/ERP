<?php

use shoudusse\ERP\Autoload;
use shoudusse\ERP\UtilisateurManager;
use shoudusse\ERP\Connexion;
use shoudusse\ERP\Utilisateur;
use shoudusse\ERP\Utilitaires;

// Mise en place de l'autoloader
require 'classes/autoloader.class.php';
Autoload::autoloader();




// Appel methodes Utilitaires::test($connexion, $criteres)
$user = 'shoudusse';

global $DB;
$DB =  Connexion::connect();
$userADO = UtilisateurManager::initManager($DB); 
if ($userADO->existsUser($user)) {
	$resultat = $userADO->getUser($user);
	$shoudusse = $resultat[0];
}

$shoudusse->deleteUser($shoudusse);




?>