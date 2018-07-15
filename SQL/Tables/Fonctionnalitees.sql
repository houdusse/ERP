CREATE TABLE IF NOT EXISTS Fonctionnalitees (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom VARCHAR(30),
	idModule INT UNSIGNED NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(idModule) REFERENCES Modules(id)
)
;
INSERT INTO Fonctionnalitees (nom, idModule) VALUES
('commandes', 1),
('clients', 1),
('depots', 1),
('stocks', 1),
('articles',1)
;