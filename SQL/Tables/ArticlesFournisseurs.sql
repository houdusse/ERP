CREATE TABLE IF NOT EXISTS ArticlesFournisseurs (
	id INT UNSIGNED NOT NULL AUTO_INCREMENT,
	idArticle INT UNSIGNED NOT NULL,
	idFournisseur INT UNSIGNED NOT NULL,
	UNIQUE(idFournisseur, idArticle),
	FOREIGN KEY(idArticle) REFERENCES Articles(id),
	FOREIGN KEY(idFournisseur) REFERENCES Fournisseurs(id),
	PRIMARY KEY(id)
 );

INSERT INTO ArticlesFournisseurs (idArticle, idFournisseur) VALUES
(1,1),
(1,3),
(2,1),
(3,3);

