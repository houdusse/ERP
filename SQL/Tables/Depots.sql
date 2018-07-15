CREATE TABLE IF NOT EXISTS  depots 	(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50) NOT NULL,
	adresse1 VARCHAR(100),
	adresse2 VARCHAR(100),
	adresse3 VARCHAR(100),
	ville VARCHAR(50),
	codePostal CHAR(5),
	UNIQUE(nom),
	idEtablissement INT UNSIGNED NOT NULL,
	FOREIGN KEY(idEtablissement) REFERENCES Etablissements(id),
	PRIMARY KEY(id)
);

INSERT INTO Depots (nom, idEtablissement) VALUES
('depot rosny', 1),
('depot mellamare1', 2),
('depot mellamare2', 2)
; 