<?php
namespace shoudusse\ERP;
abstract  class DataManager {

	// methode generique lançant une requête SQL sur la base et renvoyant
	// soit un tableau d'objets soit un tableau indexé
	protected function ADO($sql, array $parametres, $class) {
		try {
			$DB = Connexion::getDB();
			$tableau = null;
			$statement = $DB->prepare($sql);
			// Si le retour doit se faire par objet $class n'est pas null et contient le nom de la classe à utiliser 
			if ($class !== null) {
				echo 'fetch_class';
				$retour = $statement->setFetchMode(\PDO::FETCH_CLASS, $class, array($DB));
			} else { // Sinon on retourne un tableau indexé
				$retour = $statement->setFetchMode(\PDO::FETCH_NUM);
			}
			var_dump($sql);
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


	// Methode qui renvoie un tableau associatif contenent tout les parametres
	protected function construireParametres($objet) {
		$tableau = null;
		$instrospection = new \ReflectionObject($objet);
		$className = $instrospection->getName();
		$proprietes = $instrospection->getProperties();
		foreach ($proprietes as $attribut) {
			$attribut->setAccessible(true);
			$nomAttribut = $attribut->getName();
			$nomMethode = 'get'. ucfirst($nomAttribut); // nom du getter dans objet
			if (method_exists($objet, $nomMethode)) {
				$scalaire = true;
				if (is_array($objet->$nomMethode()) OR is_object($objet->$nomMethode())) {
					$scalaire = false;
				}
				if ( $scalaire) { 
					$tableau[':' . $nomAttribut] = $attribut->getValue($objet);
					$attribut->setAccessible(false);
				}
			}	
		}
		return $tableau;
	}

	protected function constructionRequete($instruction, array $paramètres, $table) {
		$chainesql = '';
		switch ($instruction) {
			case 'SELECT':
				break;

			case 'INSERT': 
				$chainesql .= $instruction .' INTO ' . $table .' (';
				foreach ($paramètres as $key => $value) {
					if ($key !== ':id') {
						$chainesql .=  substr($key, 1) .', ';
					}
				}
				// Suppression de la derniere ','
				$chainesql = substr_replace($chainesql, ')', -2, -1);
				$chainesql .= ' VALUES (';
				foreach ($paramètres as $key => $value) {
					if ($key !== ':id') {
						$chainesql .=  $key .', ';
					}
				}
				// Suppression de la derniere ','
				$chainesql = substr_replace($chainesql, ')', -2, -1);

				break;
			case 'DELETE':
				$chainesql .= $instruction .' FROM ' .$table .' WHERE id = :id';

				break;
			case 'UPDATE':
				$chainesql = $instruction . ' ' .$table .' SET ';
				foreach ($paramètres as $key => $value) {
					if ($key !== ':id') {
						$chainesql .=  substr($key, 1) . ' = ' .$key .', ';
					}
				}
				// Suppression de  la derniere ','
				$chainesql = substr_replace($chainesql, ' ', -2, -1);
				$chainesql .= ' WHERE id = :id';
				break;
			
			default:
				$chainesql = 'ERREUR INSTRUCTION ' .$instruction;
				break;
		}
		return $chainesql;
	}


	protected function recupId($table, array $valeurs, $className) {
		$sql = 'SELECT * FROM ' . $table .' WHERE ';
		foreach ($valeurs as $key => $value) {
			$pattern = '/(^:)/';
			$remplacement = "";
			$clefs = preg_replace($pattern, $remplacement, $key);
			$sql .= "$clefs = $key AND "; 
		}
		// suppression du dernier AND
		$sql = trim($sql);
		$pattern = '/(AND$)/';
		$sql = preg_replace($pattern, $remplacement, $sql);
		$resultat = $this->ADO($sql, $valeurs, $className);
		return $resultat;
	}

} 










?>





