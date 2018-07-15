CREATE TABLE IF NOT EXISTS MoyensPaiements (
	id INT NOT NULL AUTO_INCREMENT,
	abrege VARCHAR(5),
	libelle VARCHAR(50),
	UNIQUE(abrege),
	PRIMARY KEY(id)
)
;

INSERT INTO MoyensPaiements (abrege, libelle) VALUE
('LIQ', 'Liquide'),
('CHQ', 'Cheque'),
('CB', 'Carte Bancaire'),
('BO', 'Billet a Ordre'),
('LC', 'Lettre de Change'),
('VIR', 'Virement')
;