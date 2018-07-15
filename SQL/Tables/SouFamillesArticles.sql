CREATE TABLE IF NOT EXISTS SousFamillesAritcles (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	libelle VARCHAR(60),
	idFamille NOT NULL,
	UNIQUE(libelle),
	PRIMARY KEY(id),
	FOREIGN KEY (idFamille) REFERENCES Familles(id)
)
;