CREATE TABLE IF NOT EXISTS Modules (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	libelle VARCHAR(30),
	PRIMARY KEY(id)
)
;

INSERT INTO Modules (nom) VALUES
('Gestion Commerciale'),
('Comptatbilite'),
('Depots')
;