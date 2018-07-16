SELECT D.id as id, G.libelle as Groupe, F.nom as Fnct, D.niveau as Level 
FROM Droits as D 
JOIN Groupes as G
ON D.idGroupe = G.id
JOIN Fonctionnalitees as F
ON idFonctionnalitee = F.id