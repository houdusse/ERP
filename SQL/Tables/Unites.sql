CREATE TABLE IF NOT EXISTS Unites (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	libelle VARCHAR(20) NOT NULL,
	symbol VARCHAR(5),
	PRIMARY KEY(id)
);

INSERT INTO Unites (libelle, symbol) VALUES
('Kilo', 'kg'),
('Gramme', 'g'),
('Tonne', 't'),
('Centimetre', 'cm'),
('Metre', 'm'),
('Litre', 'l'),
('Centilitre', 'cl'),
('Piece', 'pi');