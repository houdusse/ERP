CREATE TABLE IF NOT EXISTS RefAnnexesArticles (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	reference VARCHAR(100) NOT NULL,
	type CHAR(1) NOT NULL,
	idArticles INT UNSIGNED NOT NULL,
	UNIQUE(idArticles, type, reference),
	PRIMARY KEY(id),
	FOREIGN KEY(idArticles) REFERENCES Articles(id)
)