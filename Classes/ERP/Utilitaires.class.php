<?php
namespace shoudusse\ERP;
use shoudusse\ERP\Utilisateur;
use \PDO;
abstract class Utilitaires {

	public static function chargeurClasse($classe) {
		var_dump($classe);
		$classe = strrchr($classe,'\\');
		$classe = substr($classe, 1);
		var_dump($classe);
		$chemin = 'Classes/';
		$nomQualifie = $chemin . $classe. '.class.php';
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

	// methode generique lançant une requête SQL sur la base et renvoyant
	// soit un tableau d'objets soit un tableau indexé
	public static function ADO($sql, array $parametres, $class, $DB) {
		try {
			$tableau = null;
			$statement = $DB->prepare($sql);
			// Si le retour doit se faire par objet $class n'est pas null et contient le nom de la classe à utiliser 
			if ($class !== null) {
				$retour = $statement->setFetchMode(PDO::FETCH_CLASS, $class);
			} else { // Sinon on retourne un tableau indexé
				$retour = $statement->setFetchMode(PDO::FETCH_NUM);
			}
 			$statement->execute($parametres);
			// si la requete est SELECT alors on parcourt le curseur
			if ( preg_match('#(^SELECT|select)#', $statement->queryString)) {
				while ($donnees = $statement->fetch()) {
					$tableau[] = $donnees;
				}
			}
		} catch (Exception $e) {
			echo 'Erreur getUtilisateur<br>';
			die($e->getMessage());
		}
		return $tableau; // soit tableau d'objet soit tableau indexé classique
	}

	public static function test($maconnexion, $laClasse) {
		$sql = 'SELECT * FROM Utilisateurs where login = :login';
		$tab = array(':login' => 'rdlb');
		$state = $maconnexion->prepare($sql);
		$state->setFetchMode(PDO::FETCH_CLASS, $laClasse);
		$state->execute($tab);
		$user = $state->fetch();
		echo 'RRRRResultat';
		var_dump($user);

	}
}



?>