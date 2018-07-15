SELECT G.libelle as groupe, U.login as login, U.prenom as prenom, U.nom as nom 
FROM Utilisateurs as U
JOIN UtilisateursGroupes as UG 
ON U.id = UG.idUtilisateur
JOIN Groupes as G
ON G.id = UG.idGroupe
ORDER BY G.libelle