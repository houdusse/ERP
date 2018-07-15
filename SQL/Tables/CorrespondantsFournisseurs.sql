CREATE TABLE IF NOT EXISTS CorrespondantsFournisseurs (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom VARCHAR(20),
	prenom VARCHAR(20),
	civilite VARCHAR(10),
	rang INT UNSIGNED,
	idFournisseur INT UNSIGNED NOT NULL,
	UNIQUE(id, rang),
	PRIMARY KEY(id),
	FOREIGN KEY(idFournisseur) REFERENCES Fournisseur(id)
   )
;

INSERT INTO CorrespondantsFournisseurs (nom, prenom, rang, idFournisseur) VALUES
('Charmin', 'Gerard', 1, 1),
('Duchemin', 'Marcel', 2, 1),
('Houdusse', 'Stephane', 1, 2),
('De la broise', 'Roger', 2, 2),
('De la broise', 'Yollenne', 3, 2),
('Duchard', 'Marcel', 4, 2),
('Marcelin', 'Sylvie', 5, 2),
('Vachier', 'Pascal', 1, 3),
('Rymo', 'Frederic', 2, 3),
('Aloin', 'Nathalie', 3, 3)
;
