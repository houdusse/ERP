SELECT E.nom as Etablissment, D.nom as Depot, P.numero as Posi_stockage, P.type as Type,
 A.libelle as Article, P.quantite as QTE
FROM Etablissements as E 
JOIN Depots as D
ON D.idEtablissement = E.id
JOIN PositionsStockage as P
ON P.idDepot = D.id
JOIN Articles as A
ON P.idArticle = A.id
ORDER BY E.nom, D.nom, P.numero;
