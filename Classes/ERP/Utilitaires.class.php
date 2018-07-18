<?php
namespace shoudusse\ERP;
use shoudusse\ERP\Utilisateur;
use \PDO;
abstract class Utilitaires {

	public static function chargeurClasse($classe) {
		$classe = strrchr($classe,'\\');
		$classe = substr($classe, 1);
		$chemin = 'Classes/';
		$nomQualifie = $chemin . $classe. '.class.php';
		var_dump($nomQualifie);
		require $nomQualifie;
	}

	// Affichage tableau
	public static function afficheTableau(array $tableau) {
		$iA = count($tableau); // nombre lignes de matrice
		$jA = count($tableau [1]); // nombre de colonne matrice 
		$chaine = '<table style="border-collapse: collapse;">' ."\n";
		for ($ligne = 0; $ligne < $iA; $ligne++) {
			$chaine .= '<tr>' ."\n";
			for ($colonne = 0; $colonne < $jA; $colonne++) {
				$chaine .= '    ' . '<td style="border: 1px solid black; font-size: x-large;">' . $tableau [$ligne] [$colonne] . "</td>\n";
			}
			$chaine .= '</tr>' . "\n";
		}
		$chaine .= '</table>';
		return $chaine;
	}

	public static function className($objet) {
		$instrospection = new \ReflectionObject($objet);
		$className = $instrospection->getName();
		return $className;
	}
	
}
?>