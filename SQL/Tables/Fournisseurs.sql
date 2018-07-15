CREATE TABLE IF NOT EXISTS Fournisseurs (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom VARCHAR(50) NOT NULL,
	adresse1 VARCHAR(100) NOT NULL,
	adresse2 VARCHAR(100),
	adresse3 VARCHAR(100) ,
	codePostal CHAR(5) NOT NULL,
	ville VARCHAR(50) NOT NULL,
	UNIQUE(nom),
	PRIMARY KEY(id)

);

INSERT INTO Fournisseurs (nom, adresse1, codePostal,ville)
VALUES 	('facom', '1 rue du marechal Juin', '69300', 'preval'),
		('bosh', '2 rue vintage', '93100', 'st Denis'),
		('man', '3 allee france galle', '78500', 'glinville');		

