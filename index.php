<?php

use shoudusse\ERP\Autoload;
use shoudusse\ERP\UtilisateurManager;
use shoudusse\ERP\Connexion;
use shoudusse\ERP\Utilisateur;
use shoudusse\ERP\Utilitaires;
use shoudusse\ERP\Groupe;
use shoudusse\ERP\Module;

// Mise en place de l'autoloader
require 'classes/autoloader.class.php';
Autoload::autoloader();





Connexion::connect();
// $userADO = UtilisateurManager::initManager(Connexion::getDB()); 
$eta = new Module();
$eta->setLibelle('bidon');
var_dump($eta);
$neweta = new Module();
$neweta->setLibelle('Bidos');
$neweta->setModule();
var_dump($neweta);



?>