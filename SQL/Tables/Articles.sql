CREATE TABLE IF NOT EXISTS Articles (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	code VARCHAR(20) NOT NULL,
	libelle VARCHAR(60) NOT NULL,
	idDepartemet INT UNSIGNED,
	idFamille INT UNSIGNED,
	idSousFamille INT UNSIGNED,
	poids DECIMAL(7,3),
	hauteur DECIMAL(7,3),
	largeur DECIMAL(7,3),
	profondeur DECIMAL(7,3),
	tracabilite BOOLEAN, 
	UNIQUE(code),
	PRIMARY KEY(id),
	FOREIGN KEY(idDepartemet) REFERENCES Departements(id),
	FOREIGN KEY(idFamille) REFERENCES Familles(id),
	FOREIGN KEY(idSousFamille) REFERENCES SousFamilles(id)
);

INSERT INTO Articles (code, libelle) VALUES
('H7402', 'Tounevis qui visse'),
('A444', 'Marteau qui frappe'),
('B4205', 'clef qui ne sert a rien');