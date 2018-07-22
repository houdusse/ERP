<?php

use shoudusse\ERP\Autoload;
use shoudusse\ERP\UtilisateurManager;
use shoudusse\ERP\Connexion;
use shoudusse\ERP\Utilisateur;
use shoudusse\ERP\Utilitaires;
use shoudusse\ERP\Groupe;
use shoudusse\ERP\Module;
use shoudusse\ERP\Etablissements;

// Mise en place de l'autoloader
require 'classes/autoloader.class.php';
Autoload::autoloader();





Connexion::connect();
// $userADO = UtilisateurManager::initManager(Connexion::getDB()); 
$eta = new Etablissements();
$eta->setLibelle('bidon');
$eta->setCode('BID');
$eta->setAdresse1('3 allée des pinsons');
$eta->setVille('les Mureaux');
var_dump($eta);
if ($eta->ifExists())
	echo 'problème';
else
	echo 'Bien joué<br>';
$eta->setEtablissements();
$eta->deleteEtablissements();


?>