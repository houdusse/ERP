CREATE TABLE IF NOT EXISTS Etablissements (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	code VARCHAR(4) NOT NULL,
	nom VARCHAR(25) NOT NULL,
	adresse1 VARCHAR(100) NOT NULL,
	adresse2 VARCHAR(100),
	adresse3 VARCHAR(100),
	codePostal CHAR(5),
	ville VARCHAR(50) NOT NULL,
	UNIQUE(code),
	UNIQUE(nom),
	PRIMARY KEY(id)
);

INSERT INTO Etablissements (code, nom, adresse1, ville) VALUES
('A1', 'rosny sur seine', 'za des marceaux', 'rosny sur seine'),
('A2', 'mellamare', 'fin du monde', 'mellamare en gal');