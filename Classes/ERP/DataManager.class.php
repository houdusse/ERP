<?php
namespace shoudusse\ERP;
abstract  class DataManager {

	// methode generique lançant une requête SQL sur la base et renvoyant
	// soit un tableau d'objets soit un tableau indexé
	protected function ADO($sql, array $parametres, $class,$DB) {
		try {
			$tableau = null;
			$statement = $DB->prepare($sql);
			// Si le retour doit se faire par objet $class n'est pas null et contient le nom de la classe à utiliser 
			if ($class !== null) {
				$retour = $statement->setFetchMode(\PDO::FETCH_CLASS, $class);
			} else { // Sinon on retourne un tableau indexé
				$retour = $statement->setFetchMode(\PDO::FETCH_NUM);
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


	// Methode qui renvoie un tableau associatif contenent tout les
	protected function construireParametres($objet) {
		$tableau = null;
		$instrospection = new \ReflectionObject($objet);
		
		foreach ($instrospection ->getProperties() as $attribut) {
			$attribut->setAccessible(true);
			$nomAttribut = $attribut->getName();
			// On ne recherche que les attributs scalaire (non tableau et non objet)
			$nomMethode = 'get'. ucfirst($nomAttribut); // nom du getter dans objet
			$scalaire = true;
			if (is_array($objet->$nomMethode()) OR is_object($objet->$nomMethode())) {
				$scalaire = false;
			}
			if ( $scalaire) { 
			$tableau[':' . $nomAttribut] = $attribut->getValue($objet);
			$attribut->setAccessible(false);
			}
		}
		
		return $tableau;
	}

} 










?>





