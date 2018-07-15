CREATE TABLE IF NOT EXISTS FamillesArticles (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	libelle VARCHAR(60),
	idDepartement INT NOT NULL,
	UNIQUE(libelle),
	PRIMARY KEY(id),
	FOREIGN KEY(idDepartement) REFERENCES DepartementsProduits(id)
)
;