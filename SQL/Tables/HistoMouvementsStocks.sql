CREATE TABLE IF NOT EXISTS HistoMouvementsStocks (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	idArticle INT UNSIGNED NOT NULL,
	type VARCHAR(3),
	origine VARCHAR(10),
	destination VARCHAR(10),
	heuroDatage DATETIME,
	utilisateur INT UNSIGNED,
	quantite DECIMAL(8,3),
	justificatif VARCHAR(100),
	PRIMARY KEY(id)
);