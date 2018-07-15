CREATE TABLE IF NOT EXISTS ConversionsUnites (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	idUnite1 INT UNSIGNED NOT NULL,
	idUnite2 INT UNSIGNED NOT NULL,
	operateur CHAR(1) NOT NULL	,
	coeficient DECIMAL(8,3) NOT NULL,
	libelle VARCHAR(40),
	idArticle INT UNSIGNED,
	UNIQUE(idUnite1, idUnite2, idArticle),
	PRIMARY KEY(id),
	FOREIGN KEY(idArticle) REFERENCES Articles(id)
)
;

INSERT INTO ConversionsUnites (idUnite1, idUnite2, operateur, coeficient, libelle) VALUES
(5, 4, '*', 100, 'conversion Metre --> Centimetre'),
(4, 5, '/', 100, 'conversion centimetre --> Metre')
;