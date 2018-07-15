SELECT U.libelle as Unite1, U2.libelle as Unite2, CU.operateur as operateur, CU.coeficient as coeficient,
CU.libelle as commentaire
FROM ConversionsUnites as CU
JOIN Unites as U
ON U.id  = CU.idUnite1
JOIN Unites as U2
ON U2.id = CU.idUnite2
; 
