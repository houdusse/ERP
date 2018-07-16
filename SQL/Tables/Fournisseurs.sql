CREATE TABLE IF NOT EXISTS Fournisseurs (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50) NOT NULL,
	idMoyenPaiement INT UNSIGNED,
	UNIQUE(nom),
	PRIMARY KEY(id),
	FOREIGN KEY(idMoyenPaiement) REFERENCES MoyensPaiements(id)
);

INSERT INTO Fournisseurs (nom, idMoyenPaiement)
VALUES 	('facom', 3),
		('bosh', 4),
		('man', 3)
		;		

