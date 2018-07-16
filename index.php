<?php

use shoudusse\ERP\Autoload;
use shoudusse\ERP\UtilisateurManager;
use shoudusse\ERP\Connexion;

// Mise en place de l'autoloader
require 'classes/autoloader.class.php';
Autoload::autoloader();




// Appel methodes Utilitaires::test($connexion, $criteres)
$user = 'shoudusse'; 
$maconnexion =  Connexion::connect();
$userADO = UtilisateurManager::initManager($maconnexion); 
if ($userADO->existsUser($user)) {
	$shoudusse = $userADO->getUser($user);
}
/*$classe = 'shoudusse\ERP\Utilisateur';
shoudusse\ERP\Utilitaires::test($maconnexion, $classe);

$sql = 'SELECT * FROM Utilisateurs WHERE login = :login';
$critere = array(':login' => 'shoudusse');
$enregistrement2 = Utilitaires::ADO($sql, $critere, 'shoudusse\ERP\Utilisateur', $maconnexion );
var_dump($enregistrement2); */

/*$sql = 'SELECT * FROM Utilisateurs where login = :login';
$tab = array(':login' => 'shoudusse');
$state = $maconnexion->prepare($sql);
$state->setFetchMode(PDO::FETCH_CLASS, 'shoudusse\ERP\Utilisateur');
$state->execute($tab);
$user = $state->fetch();
var_dump($user);
*/


/*$param = array(	':id' => 4,
				':login' => 'bidoni',
				':password' => ' ',
				':nom' => 'bidoni',
				':prenom' => 'marcel',
				':active' => 1 );
$insert = $userADO->SetUser('bidoni', $param);*/






?>