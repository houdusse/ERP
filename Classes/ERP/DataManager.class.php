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
			if ($class !== null) { // On recupères des objets de la classe $class
				$retour = $statement->setFetchMode(\PDO::FETCH_CLASS, $class, array($DB));
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


	// Methode qui renvoie un tableau associatif contenent tout les parametres
	// $objet = objet dont on liste le propriétées et les valeurs
	// $exclude est un tableau qui contient les propritées à exclure du resultat
	// $permute bool si a true alors le tableau $exculde contient les attributs à inculre dans le résulat
	// $colonChar bool si a true rejoute ':' devant le nom des attributs selectionnés
	// Si exclude est vide alors touts les attributs de l'objet sont sélectionnés 
	protected function buildParameters($objet, $exclude = null,  $permute = false, $colonChar ) {
		if ($exclude === null) {
			$exclude = array();
		} 
		$tableau = $this->ObjectToArray($objet, $exclude, $permute, true);			
		return $tableau;
	}


	/* Methode qui construit la chaine sql utilisée dans PDO:prepare()
	le parametre $instruction contient la commande sql à executer
	Le parametre $parametre contient la liste des variables :var à utiliser dans
	la requete.
	le parametre $table contient le nom de la table utilisée dans la commande SQL
	requetes générées :
	SELECT * FROM $table WHERE var = :var1 AND var2 = :var2 AND var3 = :var3 ...
	INSERT INTO $table (var1, var2, var3, ...) VALUES (:var1, :var2, :var3, ...) 
	UPDATE $TABLE SET var1 = :var1, var2 = :var2, ... WHERE id = :id
	DELETE FROM $table WHERE id = :id */
	protected function BuildRequest($instruction, array $parametres, $table) {
		$chainesql = '';
		switch ($instruction) {
			
			case 'SELECT':
				// Le tableau $parametres contient les paramètres se situant après le WHERE de la requete
				// car le SELECT  est toujours *
				// Si plusieurs paramètres reçus alors ils sont enchainés avec des AND
				$chainesql = $instruction .' * WHERE ';
				foreach ($valeurs as $key => $value) {
					$pattern = '/(^:)/';
					$remplacement = "";
					$clefs = preg_replace($pattern, $remplacement, $key);
					$chainesql .= "$clefs = $value AND "; 
				}
				// suppression du dernier AND
				$chainesql = trim($sql);
				$pattern = '/(AND$)/';
				$chainesql = preg_replace($pattern, $remplacement, $sql);
				break;

			case 'INSERT': 
				$chainesql .= $instruction .' INTO ' . $table .' (';
				foreach ($paramètres as $key => $value) {
					if ($key !== ':id') {
						$chainesql .=  substr($key, 1) .', ';  // à ce niveau les paramètres sont sans ":" INSERT (parm1, parm2, parm3)
					}
				}
				// Suppression de la derniere ','
				$chainesql = substr_replace($chainesql, ')', -2, -1);
				$chainesql .= ' VALUES (';
				foreach ($paramètres as $key => $value) {
					if ($key !== ':id') {  // id n'est JAMAIS mis à jour
						$chainesql .=  $key .', '; // dans la clause VALUES les paramètres sont sous la forme :nom = 'xxx'
					}
				}
				// Suppression de la derniere ','
				$chainesql = substr_replace($chainesql, ')', -2, -1);
				break;

			case 'DELETE':
				$chainesql .= $instruction .' FROM ' .$table .' WHERE id = :id'; // le DELETE se fait toujours sur l'id de l'enregistrement (non ambigue)
				break;

			case 'UPDATE':
				$chainesql = $instruction . ' ' .$table .' SET ';
				foreach ($paramètres as $key => $value) {
					if ($key !== ':id') {
						$chainesql .=  substr($key, 1) . ' = ' .$key .', '; // les paramètre sont sous la forme SET parm1 = 'xxxx', parm2 = 'xxxx' 
					}
				}
				// Suppression de  la derniere ','
				$chainesql = substr_replace($chainesql, ' ', -2, -1);
				$chainesql .= ' WHERE id = :id';
				break;
			
			default:
				$chainesql = 'ERREUR INSTRUCTION ' .$instruction; // si instruction sql inconnue 
				break;
		}
		return $chainesql; // la chaine sql prête à l'emploie
	}


	protected function getSelected ($table, array $valeurs, $className) {
		$sql = 'SELECT * FROM ' . $table .' WHERE ';
		foreach ($valeurs as $key => $value) {
			$pattern = '/(^:)/';
			$remplacement = "";
			$clefs = preg_replace($pattern, $remplacement, $key);
			$sql .= "$clefs = $value AND "; 
		}
		// suppression du dernier AND
		$sql = trim($sql);
		$pattern = '/(AND$)/';
		$sql = preg_replace($pattern, $remplacement, $sql);
		$resultat = $this->ADO($sql, $valeurs, $className);
		return $resultat;
	}

	/*Methode generique listant dans un tableau associatif l'ensemble des attributs
	scalaires de l'objet $objet ainsi que leurs valeurs respectives, à l'exclusion des attributs listés  dans le tableau $exclude. Si le parametre $colonChar = true alors on ajoute ':' devant les nom des attributs afin de pouvoir les utiliser en SQL avec PDO::prepare()*/ 
	public function ObjectToArray($objet, array $exclude, $permute, $colonChar ) {
		$tableau = null;
		$colon = '';
		if ($colonChar) {
			$colon = ':';
		}
		$instrospection = new \ReflectionObject($objet);
		$className = $instrospection->getName();
		$proprietes = $instrospection->getProperties();
		foreach ($proprietes as $attribut) {
			$attribut->setAccessible(true);
			$nomAttribut = $attribut->getName();
			$nomMethode = 'get'. ucfirst($nomAttribut); // nom du getter dans objet
			if (method_exists($objet, $nomMethode)) {
				$scalaire = true;
				if (is_array($objet->$nomAttribut)) OR is_object($objet->$nomAttribut)) {
					$scalaire = false;
				}
				if ( $scalaire AND !( in_array($nomAttribut, $exclude)) AND ($permute !== true)) { 
					$tableau[$colon . $nomAttribut] = $attribut->getValue($objet);
				}
				if ( $scalaire AND ( in_array($nomAttribut, $exclude)) AND ($permute == true)) { 
					$tableau[$colon . $nomAttribut] = $attribut->getValue($objet);
				}

					$attribut->setAccessible(false);
			}	
		}
		return $tableau; // tableau associatif contenanant la liste des atributs scalaires de l'objet ainsi que les valeurs correspondantes	
	}

} 










?>





