CREATE TABLE IF NOT EXISTS `client` (
	`idClient` int(11) NOT NULL,
	`nom` varchar(30) DEFAULT NULL,
	`adresse` varchar(30) DEFAULT NULL,
	`pays` varchar(30) DEFAULT NULL,
	`telephone` varchar(30) DEFAULT NULL,
	PRIMARY KEY (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `hote` (
	`idHote` int(11) NOT NULL,
	`nom` varchar(30) DEFAULT NULL,
	`adresse` varchar(30) DEFAULT NULL,
	`pays` varchar(30) DEFAULT NULL,
	`telephone` varchar(30) DEFAULT NULL,
	PRIMARY KEY (`idHote`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `logement` (
	`idLogement` int(11) NOT NULL,
	`idHote` int(11) DEFAULT NULL,
	`adresse` varchar(30) DEFAULT NULL,
	`ville` varchar(30) DEFAULT NULL,
	`pays` varchar(30) DEFAULT NULL,
	`wifi` BOOL DEFAULT FALSE,
	`cuisine` BOOL DEFAULT FALSE,
	`salledebain` BOOL DEFAULT FALSE,
	FOREIGN KEY (`idHote`) REFERENCES hote(`idHote`),
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