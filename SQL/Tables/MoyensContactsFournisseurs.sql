CREATE TABLE IF NOT EXISTS MoyensContactsFournisseurs (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	typeMoyen VARCHAR(5) NOT NULL,
	contenu VARCHAR(100),
	rang INT UNSIGNED NOT NULL,
	idCorrespondant INT UNSIGNED NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(idCorrespondant) REFERENCES CorrespondantsFournisseurs(id)
)
;

INSERT INTO MoyensContactsFournisseurs (typeMoyen, contenu, rang, idCorrespondant) VALUES
('TEL', '01 54 64 12 34', 1, 1),
('MOB', '06 54 64 12 34', 2, 1)
;
