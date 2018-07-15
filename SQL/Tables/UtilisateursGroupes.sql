CREATE TABLE IF NOT EXISTS UtilisateursGroupes (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	idUtilisateur INT UNSIGNED,
	idGroupe INT UNSIGNED,
	UNIQUE(idUtilisateur, idGroupe),
	PRIMARY KEY(id),
	FOREIGN KEY(idUtilisateur) REFERENCES Utilisateurs(id),
	FOREIGN KEY(idGroupe) REFERENCES Groupes(id)
)
;

INSERT INTO UtilisateursGroupes (idUtilisateur, idGroupe) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 5),
(3, 3)
;