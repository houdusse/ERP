CREATE TABLE IF NOT EXISTS Droits (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	idUtilisateur INT UNSIGNED,
	idGroupe INT UNSIGNED,
	idFonctionnalitee INT UNSIGNED,
	niveau DECIMAL(2,0),
	PRIMARY KEY(id),
	FOREIGN KEY(idUtilisateur) REFERENCES Utilisateurs(id),
	FOREIGN KEY(idGroupe) REFERENCES Groupes(id),
	FOREIGN KEY(idFonctionnalitee) REFERENCES Fonctionnalitees(id)
)
;

INSERT INTO Droits (niveau, idGroupe, idFonctionnalitee) VALUES
(1, 2, 1),
(1, 2, 2),
(1, 2, 3),
(1, 3, 1),
(3, 3, 2),
(3, 3, 4),
(3, 3, 5)
;