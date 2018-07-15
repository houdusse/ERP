CREATE TABLE IF NOT EXISTS FamillesAritcles (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	libelle VARCHAR(60),
	idDepartement NOT NULL,
	UNIQUE(libelle),
	PRIMARY KEY(id),
	FOREIGN KEY (idDepartement) REFERENCES Departements(id)
)
;