CREATE TABLE IF NOT EXISTS `client` (
	`idClient` int(11) NOT NULL,
	`nom` varchar(30) NOT NULL,
	`prenom` varchar(30) NOT NULL,
	`adresse` varchar(30) NOT NULL,
	`description` varchar(240) DEFAULT NULL,
	`age` int(11) NOT NULL,
	`photoProfil` varchar(30) NOT NULL,
	`pays` varchar(30) DEFAULT NULL,
	`telephone` varchar(30) DEFAULT NULL,
	PRIMARY KEY (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `logement` (
	`idLogement` int(11) NOT NULL,
	`prix` int(11) NOT NULL,
	`idClient` int(11) DEFAULT NULL,
	`effectif` int(11) DEFAULT NULL,
	`nomLogement` varchar(30),
	`adresse` varchar(30) DEFAULT NULL,
	`photo` varchar(30) NOT NULL,
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
	`numeroReservation` int(11) NOT NULL,
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
	`mdp` int(11) NOT NULL,
	`idClient` int(11) DEFAULT NULL,
	FOREIGN KEY (`idClient`) REFERENCES client(`idClient`),
	PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `commentaire` (
	`idCommentaire` int(11) NOT NULL,
	`comment` varchar(500) NOT NULL,
	`idClient` int(11) NOT NULL,
	FOREIGN KEY (`idClient`) REFERENCES client(`idClient`),
	PRIMARY KEY (`idCommentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
