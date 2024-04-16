-- tournois.admin definition

CREATE TABLE `admin` (
  `user` varchar(100) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- tournois.place definition

CREATE TABLE `place` (
  `name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `place_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`place_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- tournois.`user` definition

CREATE TABLE `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `role` enum('player','judge') NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- tournois.game definition

CREATE TABLE `game` (
  `game_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `player1` int(10) unsigned DEFAULT NULL,
  `player2` int(10) unsigned DEFAULT NULL,
  `judge` int(10) unsigned DEFAULT NULL,
  `place` int(10) unsigned DEFAULT NULL,
  `score1` int(10) unsigned DEFAULT NULL,
  `score2` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`game_id`),
  KEY `game_user_FK` (`player1`),
  KEY `game_user_FK_1` (`player2`),
  CONSTRAINT `game_user_FK` FOREIGN KEY (`player1`) REFERENCES `user` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `game_user_FK_1` FOREIGN KEY (`player2`) REFERENCES `user` (`user_id`) ON DELETE SET NULL,
  CONSTRAINT `game_check` CHECK (`player1` <> `player2`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;