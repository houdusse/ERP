CREATE TABLE IF NOT EXISTS Fonctionnalites (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	libelle VARCHAR(30),
	idModule INT UNSIGNED NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(idModule) REFERENCES Modules(id)
)
;
INSERT INTO Fonctionnalites (libelle, idModule) VALUES
('commandes', 1),
('clients', 1),
('depots', 1),
('stocks', 1),
('articles',1)
;