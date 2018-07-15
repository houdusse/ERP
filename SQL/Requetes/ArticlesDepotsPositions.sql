SELECT A.code, A.libelle, D.nom as nom_depot, SP.quantite as QTE, SP.numero as position, SP.type as Type 
FROM articles as A
JOIN PositionsStockage as SP
ON  SP.IDaRTICLE = A.id
JOIN Depots as D
ON SP.idDepot = D.id
ORDER BY A.code, D.nom, SP.numero