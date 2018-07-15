CREATE TABLE IF NOT EXISTS Groupes (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	libelle VARCHAR(30),
	PRIMARY KEY(id)
)
;

INSERT INTO Groupes (libelle) VALUES
('Comptabilite'),
('Commercial'),
('Comptoir'),
('Depot'),
('Direction')
;