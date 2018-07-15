CREATE TABLE IF NOT EXISTS RefAnnexesFournisseurs (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	reference VARCHAR(100) NOT NULL,
	type CHAR(1) NOT NULL,
	idFournisseurs INT UNSIGNED NOT NULL,
	UNIQUE(idFournisseurs, type, reference),
	PRIMARY KEY(id),
	FOREIGN KEY(idFournisseurs) REFERENCES Fournisseurs(id)
)