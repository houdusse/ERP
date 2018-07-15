CREATE TABLE IF NOT EXISTS AdressesFournisseurs (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	adresse1 VARCHAR(100)  NOT NULL,
	adresse2 VARCHAR(100)  ,
	adresse3 VARCHAR(100)  ,
	ville VARCHAR(50) NOT NULL,
	codePostal VARCHAR(5) NOT NULL,
	idFournisseur INT UNSIGNED NOT NULL,
	rang INT UNSIGNED,
	UNIQUE(idFournisseur, rang),
	PRIMARY KEY(id),
	FOREIGN KEY(idFournisseur) REFERENCES Fournisseurs(id)
)
;

INSERT INTO AdressesFournisseurs (adresse1, ville, codePostal, rang, idFournisseur) VALUES
('3 allee des pinsons', 'Les Mureaux', '78130', 1, 1),
('1 alle Zigler', 'Maximum', '34130', 2, 1),
('12 rue des usines', 'Brocomme sur Bron', '69120', 1, 2),
('ZI les poissons bulles', 'Arsac', '33270', 1, 3)
;