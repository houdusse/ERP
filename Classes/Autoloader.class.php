<?php
namespace shoudusse\ERP;

abstract class Autoload{
	
	public static function autoLoader() {
		spl_autoload_register(array(__CLASS__,'chargeurClasse'));
	}


	public static function chargeurClasse($classe) {
		if ( preg_match('#(^shoudusse)#', $classe)) { // Si la classe concerne mon domaine
			$classe = str_replace('shoudusse','', $classe);
			// var_dump($classe);
			$classe = str_replace('\\', '/', $classe);
			// var_dump($classe);
			$chemin = 'Classes';
			$nomQualifie = $chemin . $classe. '.class.php';
			// echo "nom qualifié : $nomQualifie<br>";
		require $nomQualifie;
		}
	}





}	


?>