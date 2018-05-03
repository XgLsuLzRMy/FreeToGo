DROP TABLE IF EXISTS commentaire;
DROP TABLE IF EXISTS session;
DROP TABLE IF EXISTS reserver;
DROP TABLE IF EXISTS logement;
DROP TABLE IF EXISTS client;

CREATE TABLE IF NOT EXISTS `client` (
	`idClient` int(11) NOT NULL AUTO_INCREMENT,
	`nom` varchar(30) NOT NULL,
	`mail` varchar(30) NOT NULL,
	`prenom` varchar(30) DEFAULT NULL,
	`adresse` varchar(30) DEFAULT NULL,
	`description` varchar(240) DEFAULT NULL,
	`age` int(11) DEFAULT NULL,
	`photoProfil` varchar(30) DEFAULT NULL,
	`pays` varchar(30) DEFAULT NULL,
	`telephone` varchar(30) DEFAULT NULL,
	PRIMARY KEY (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `logement` (
	`idLogement` int(11) NOT NULL AUTO_INCREMENT,
	`prix` int(11) NOT NULL,
	`type` varchar(30) NOT NULL,
	`idClient` int(11) NOT NULL,
	`nomLogement` varchar(30) NOT NULL,
	`effectif` int(11) DEFAULT NULL,
	`adresse` varchar(30) DEFAULT NULL,
	`photo` varchar(30) DEFAULT NULL,
	`description` varchar(240) DEFAULT NULL,
	`ville` varchar(30) DEFAULT NULL,
	`pays` varchar(30) DEFAULT NULL,
	`wifi` BOOL DEFAULT FALSE,
	`cuisine` BOOL DEFAULT FALSE,
	`salledebain` BOOL DEFAULT FALSE,
	FOREIGN KEY (`idClient`) REFERENCES client(`idClient`),
	PRIMARY KEY (`idLogement`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `reserver` (
	`numeroReservation` int(11) NOT NULL AUTO_INCREMENT,
	`idClient` int(11) DEFAULT NULL,
	`idLogement` int(11) DEFAULT NULL,
	`dateDebut` date DEFAULT NULL,
	`dateFin` date DEFAULT NULL CHECK (dateDebut < dateFin),
	FOREIGN KEY (`idClient`) REFERENCES client(`idClient`),
	FOREIGN KEY (`idLogement`) REFERENCES logement(`idLogement`),
	PRIMARY KEY (`numeroReservation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `session` (
	`login` varchar(30) NOT NULL,
	`mdp` varchar(512) NOT NULL,
	`idClient` int(11) DEFAULT NULL,
	FOREIGN KEY (`idClient`) REFERENCES client(`idClient`),
	PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `commentaire` (
	`idCommentaire` int(11) NOT NULL AUTO_INCREMENT,
	`comment` varchar(500) NOT NULL,
	`idClient` int(11) NOT NULL,
	`idLogement` int(11) NOT NULL,
	FOREIGN KEY (`idClient`) REFERENCES client(`idClient`),
	PRIMARY KEY (`idCommentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
