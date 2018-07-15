CREATE TABLE IF NOT EXISTS PositionsStockage (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	numero VARCHAR(6) NOT NULL ,
	quantite DECIMAL(10,3) NOT NULL,
	idArticle INT UNSIGNED,
	idDepot INT UNSIGNED NOT NULL,
	type char(1) NOT NULL, -- P: picking R: reserve S: stockage
	UNIQUE(numero),
	FOREIGN KEY(idArticle) REFERENCES Articles(id),
	FOREIGN KEY(idDepot) REFERENCES Depot(id),
	PRIMARY KEY(id) 
);

INSERT INTO PositionsStockage (numero, idDepot, quantite, type, idArticle) VALUES
('R1', 1, 10, 'R', 1),
('R2', 1, 20, 'R', 3),
('R3', 1, 5, 'R', 1),
('R4', 1, 5, 'R', 2),
('R5', 1, 5, 'R', 3),
('M6', 2, 15, 'R', 1),
('M7', 2, 200, 'R', 1),
('M8', 2, 150, 'R', 2),
('M9', 2, 75, 'R', 3),
('M10', 2, 7, 'R', 2),
('M11', 2, 2, 'R', 2);

