CREATE TABLE IF NOT EXISTS Utilisateurs (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	login CHAR(15) NOT NULL,
	password VARCHAR(255), -- En crypté
	prenom VARCHAR(20),
	nom VARCHAR(20),
	active BOOLEAN,
	UNIQUE(login);
	PRIMARY KEY(id)
)
;

INSERT INTO Utilisateurs (login, nom, prenom, active) VALUES
('shoudusse', 'stephane', 'houdusse', 1),
('rdlb', 'roger', 'delabroise', 1),
('comptoir', ' ', 'login comptoir', 1)
;

