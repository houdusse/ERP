SELECT U.login as login, U.prenom as prenom, U.nom as nom, G.libelle as groupe
FROM Utilisateurs as U
JOIN UtilisateursGroupes as UG 
ON U.id = UG.idUtilisateur
JOIN Groupes as G
ON G.id = UG.idGroupe
ORDER BY U.login