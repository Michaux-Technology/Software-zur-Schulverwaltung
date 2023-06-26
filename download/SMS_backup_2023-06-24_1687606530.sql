

CREATE TABLE `average` (
  `code` int(30) NOT NULL AUTO_INCREMENT,
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `student` int(30) NOT NULL,
  `worktype` int(30) NOT NULL,
  `average` int(30) NOT NULL,
  `coef` decimal(10,2) NOT NULL,
  `averagecoef` decimal(10,2) NOT NULL,
  `totalaverage` decimal(10,2) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=743 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




CREATE TABLE `averagescale` (
  `code` int(30) NOT NULL AUTO_INCREMENT,
  `niveauE` varchar(10) NOT NULL,
  `niveauG` varchar(10) NOT NULL,
  `point` int(11) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO averagescale VALUES("33","0","0","6");
INSERT INTO averagescale VALUES("34","5","5","1");
INSERT INTO averagescale VALUES("31","5","5","2");
INSERT INTO averagescale VALUES("30","5","4","3");
INSERT INTO averagescale VALUES("29","4","4","4");
INSERT INTO averagescale VALUES("28","4","3","5");
INSERT INTO averagescale VALUES("27","4","3","6");
INSERT INTO averagescale VALUES("26","3","2","7");
INSERT INTO averagescale VALUES("25","3","2","8");
INSERT INTO averagescale VALUES("24","3","2","9");
INSERT INTO averagescale VALUES("23","2","1","10");
INSERT INTO averagescale VALUES("22","2","1","11");
INSERT INTO averagescale VALUES("21","2","1","12");
INSERT INTO averagescale VALUES("20","1","1","13");
INSERT INTO averagescale VALUES("19","1","1","14");
INSERT INTO averagescale VALUES("35","6","6","0");
INSERT INTO averagescale VALUES("37","11","11","15");



CREATE TABLE `averagetotal` (
  `code` int(30) NOT NULL AUTO_INCREMENT,
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `student` int(30) NOT NULL,
  `average` int(11) NOT NULL,
  `coef` decimal(5,2) NOT NULL,
  `coursename` varchar(30) NOT NULL,
  `niveau` varchar(30) NOT NULL,
  `niveauG` tinyint(1) NOT NULL,
  `averagecoef` decimal(10,2) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=608 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




CREATE TABLE `classe` (
  `classe` varchar(30) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `classe` (`classe`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO classe VALUES("10a","5");
INSERT INTO classe VALUES("10b","6");
INSERT INTO classe VALUES("11a","3");
INSERT INTO classe VALUES("11b","4");
INSERT INTO classe VALUES("12a","1");
INSERT INTO classe VALUES("12b","2");
INSERT INTO classe VALUES("1a","23");
INSERT INTO classe VALUES("1b","24");
INSERT INTO classe VALUES("2a","21");
INSERT INTO classe VALUES("2b","22");
INSERT INTO classe VALUES("3a","19");
INSERT INTO classe VALUES("3b","20");
INSERT INTO classe VALUES("4a","17");
INSERT INTO classe VALUES("4b","18");
INSERT INTO classe VALUES("5a","15");
INSERT INTO classe VALUES("5b","16");
INSERT INTO classe VALUES("6a","13");
INSERT INTO classe VALUES("6b","14");
INSERT INTO classe VALUES("7a","11");
INSERT INTO classe VALUES("7b","12");
INSERT INTO classe VALUES("8a","9");
INSERT INTO classe VALUES("8b","10");
INSERT INTO classe VALUES("9a","7");
INSERT INTO classe VALUES("9b","8");



CREATE TABLE `classerequired` (
  `code` int(30) NOT NULL AUTO_INCREMENT,
  `classe` varchar(10) NOT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO classerequired VALUES("1","13");
INSERT INTO classerequired VALUES("2","12");
INSERT INTO classerequired VALUES("3","11");
INSERT INTO classerequired VALUES("4","10");
INSERT INTO classerequired VALUES("5","9");
INSERT INTO classerequired VALUES("6","8");
INSERT INTO classerequired VALUES("7","7");
INSERT INTO classerequired VALUES("8","6");
INSERT INTO classerequired VALUES("9","5");
INSERT INTO classerequired VALUES("10","4");
INSERT INTO classerequired VALUES("11","3");
INSERT INTO classerequired VALUES("12","2");
INSERT INTO classerequired VALUES("13","1");



CREATE TABLE `coefwork` (
  `code` int(30) NOT NULL AUTO_INCREMENT,
  `worktype` int(11) NOT NULL,
  `course` varchar(30) NOT NULL,
  `coef` int(11) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO coefwork VALUES("12","0","FR02","100");
INSERT INTO coefwork VALUES("14","1","FR01","50");
INSERT INTO coefwork VALUES("15","2","FR01","25");
INSERT INTO coefwork VALUES("16","4","FR01","25");
INSERT INTO coefwork VALUES("17","6","FR02","100");
INSERT INTO coefwork VALUES("18","0","FR02","0");
INSERT INTO coefwork VALUES("20","1","BIO","100");
INSERT INTO coefwork VALUES("21","1","CHE","100");
INSERT INTO coefwork VALUES("22","1","SPOR","100");
INSERT INTO coefwork VALUES("23","1","MUS","100");
INSERT INTO coefwork VALUES("24","4","FR02","50");



CREATE TABLE `course` (
  `code` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `coef` float(3,2) NOT NULL,
  `coursegroup` varchar(30) NOT NULL,
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO course VALUES("BIO","Biologie","1.00","");
INSERT INTO course VALUES("CHE","Chemie","1.00","");
INSERT INTO course VALUES("DE01","Deutsch schreiben","0.40","DE");
INSERT INTO course VALUES("DE02","Deutsch Mündlich","0.60","DE");
INSERT INTO course VALUES("EN01","Englisch schreiben","0.40","EN");
INSERT INTO course VALUES("EN02","Englisch Mündlich","0.60","EN");
INSERT INTO course VALUES("FR01","FranzÃ¶sisch schreiben","0.40","FR");
INSERT INTO course VALUES("FR02","FranzÃ¶sisch Mündlich","0.60","FR");
INSERT INTO course VALUES("GEO","Geografie","1.00","");
INSERT INTO course VALUES("GES","Geschichte","1.00","");
INSERT INTO course VALUES("MATH","Mathematik","1.00","");
INSERT INTO course VALUES("SPOR","Sport","1.00","");
INSERT INTO course VALUES("test","matiÃ¨re test","1.00","");
INSERT INTO course VALUES("WAHL01","Musik","1.00","WAHL");
INSERT INTO course VALUES("WAHL02","Technik","1.00","WAHL");
INSERT INTO course VALUES("WAHL03","Bildende Kunst","1.00","WAHL");
INSERT INTO course VALUES("WAHL04","Hauswirtschaft","1.00","WAHL");
INSERT INTO course VALUES("WIRT","Wirtschaft, Arbeit, Technik","1.00","");



CREATE TABLE `coursegroup` (
  `code` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO coursegroup VALUES("DE","Deutsch");
INSERT INTO coursegroup VALUES("EN","Englisch");
INSERT INTO coursegroup VALUES("FR","FranzÃ¶sisch");
INSERT INTO coursegroup VALUES("WAHL","Wahlunterricht");



CREATE TABLE `entry` (
  `code` int(30) NOT NULL AUTO_INCREMENT,
  `registration` int(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `niveauG` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




CREATE TABLE `generation` (
  `code` int(30) NOT NULL AUTO_INCREMENT,
  `year` varchar(30) DEFAULT NULL,
  `semester` varchar(30) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `visibility` tinyint(1) NOT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `year` (`year`,`semester`,`classe`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO generation VALUES("130","2018/2019","2. Schulhalbjahr","12b","0");
INSERT INTO generation VALUES("133","2018/2019","2. Schulhalbjahr","6b","0");



CREATE TABLE `homework` (
  `year` text NOT NULL,
  `semester` text NOT NULL,
  `classe` text NOT NULL,
  `course` text NOT NULL,
  `date` date NOT NULL,
  `homework` text NOT NULL,
  `code` int(30) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




CREATE TABLE `interface` (
  `code` int(30) NOT NULL,
  `titre` text NOT NULL,
  `message1` text NOT NULL,
  `titre2` text NOT NULL,
  `titre3` text NOT NULL,
  `message2` text NOT NULL,
  `message3` text NOT NULL,
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO interface VALUES("1","Schule aus Deutschland","Willkommen","Lehrer","Schüler","Ihre Nachrichten 1","Ihre Nachrichten 2");



CREATE TABLE `level` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `Elevel` varchar(2) NOT NULL,
  `Glevel` varchar(2) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO level VALUES("1","E","G");



CREATE TABLE `message` (
  `code` int(30) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `message2` text NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO message VALUES("1","Willkommen in School Management Software<br>
<br>
Herr Michaux<br>
","Willkommen in School Management Software<br>
<br>
Herr Michaux<br>");



CREATE TABLE `presence` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `presence` varchar(100) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `course` varchar(30) NOT NULL,
  `zeugnis` varchar(30) NOT NULL,
  `year` varchar(4) NOT NULL,
  `semester` int(100) NOT NULL,
  `classe` varchar(30) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




CREATE TABLE `profcourse` (
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `prof` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `code` int(30) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




CREATE TABLE `reference` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO reference VALUES("1","2018/2019","2. Schulhalbjahr");



CREATE TABLE `registration` (
  `code` int(30) NOT NULL AUTO_INCREMENT,
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `student` int(30) NOT NULL,
  `classerequired` varchar(3) NOT NULL,
  PRIMARY KEY (`code`),
  UNIQUE KEY `year` (`year`,`semester`,`classe`,`student`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




CREATE TABLE `school` (
  `schoolname1` varchar(50) NOT NULL,
  `schoolname2` varchar(30) NOT NULL,
  `schoolzip` varchar(10) NOT NULL,
  `schooladdress` varchar(30) NOT NULL,
  `groupname` varchar(50) NOT NULL,
  `groupname2` varchar(30) NOT NULL,
  `groupaddress` varchar(30) NOT NULL,
  `groupzip` varchar(10) NOT NULL,
  `schoolcity` varchar(30) NOT NULL,
  `Groupcity` varchar(30) NOT NULL,
  `code` int(11) NOT NULL,
  UNIQUE KEY `schoolname` (`schoolname1`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO school VALUES("Schule aus Berlin","Integrierte Sekundarschule","13000   ","Straße 6-7     ","Schule aus Deutschland","Das Sekretariat        ","Blumenstraße, 10","14585","    Berlin      ","Berlin  ","1");



CREATE TABLE `security` (
  `code` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `hour` time NOT NULL,
  `IP` varchar(30) NOT NULL,
  `computer` varchar(30) NOT NULL,
  `col1` varchar(30) NOT NULL,
  `success` tinyint(1) NOT NULL,
  `page` varchar(30) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO security VALUES("1","2023-06-23","23:12:18","127.0.0.1","Windows","Admin","1",".../index.php");
INSERT INTO security VALUES("2","2023-06-23","23:12:30","127.0.0.1","Windows","admin","0",".../index.php");
INSERT INTO security VALUES("3","2023-06-23","23:12:41","127.0.0.1","Windows","Admin","1",".../index.php");
INSERT INTO security VALUES("4","2023-06-23","23:49:42","127.0.0.1","Windows","admin","0",".../index.php");
INSERT INTO security VALUES("5","2023-06-23","23:49:46","127.0.0.1","Windows","admin","1",".../index.php");
INSERT INTO security VALUES("6","2023-06-23","23:50:21","127.0.0.1","Windows","admin","1",".../index.php");
INSERT INTO security VALUES("7","2023-06-23","23:50:58","127.0.0.1","Windows","admin","1",".../index.php");
INSERT INTO security VALUES("8","2023-06-24","00:25:58","127.0.0.1","Windows","admin","1",".../index.php");
INSERT INTO security VALUES("9","2023-06-24","00:26:37","127.0.0.1","Windows","admin","1",".../teacher/user2.php");
INSERT INTO security VALUES("10","2023-06-24","00:27:20","127.0.0.1","Windows","admin","1",".../teacher/user2.php");
INSERT INTO security VALUES("11","2023-06-24","11:32:07","127.0.0.1","Windows","admin","0",".../index.php");
INSERT INTO security VALUES("12","2023-06-24","11:32:12","127.0.0.1","Windows","admin","1",".../index.php");
INSERT INTO security VALUES("13","2023-06-24","11:33:46","127.0.0.1","Windows","admin","1",".../teacher/testad.php");
INSERT INTO security VALUES("14","2023-06-24","11:33:49","127.0.0.1","Windows","admin","1",".../teacher/testad.php");
INSERT INTO security VALUES("15","2023-06-24","11:33:54","127.0.0.1","Windows","admin","1",".../teacher/testad.php");
INSERT INTO security VALUES("16","2023-06-24","11:41:47","127.0.0.1","Windows","admin","1",".../teacher/testad.php");
INSERT INTO security VALUES("17","2023-06-24","11:42:39","127.0.0.1","Windows","admin","1",".../teacher/testad.php");
INSERT INTO security VALUES("18","2023-06-24","11:42:47","127.0.0.1","Windows","admin","1",".../teacher/testad.php");
INSERT INTO security VALUES("19","2023-06-24","11:42:57","127.0.0.1","Windows","admin","1",".../teacher/testad.php");
INSERT INTO security VALUES("20","2023-06-24","11:43:01","127.0.0.1","Windows","admin","1",".../teacher/testad.php");
INSERT INTO security VALUES("21","2023-06-24","13:26:41","127.0.0.1","Windows","admin","0",".../index.php");
INSERT INTO security VALUES("22","2023-06-24","13:26:46","127.0.0.1","Windows","admin","1",".../index.php");



CREATE TABLE `semester` (
  `semester` varchar(30) NOT NULL,
  UNIQUE KEY `semester` (`semester`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO semester VALUES("1. Schulhalbjahr");
INSERT INTO semester VALUES("2. Schulhalbjahr");



CREATE TABLE `student` (
  `code` int(30) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `adresse` varchar(30) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL,
  `birthdate` date NOT NULL,
  UNIQUE KEY `CODE` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




CREATE TABLE `test` (
  `code` int(30) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `point` float(5,2) NOT NULL,
  `worktype` int(11) NOT NULL,
  `year` varchar(30) NOT NULL,
  `semester` varchar(30) NOT NULL,
  `classe` varchar(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT 0,
  `prof` varchar(30) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




CREATE TABLE `testline` (
  `code` int(30) NOT NULL AUTO_INCREMENT,
  `student` int(30) NOT NULL,
  `grade` int(11) NOT NULL,
  `point` int(11) NOT NULL,
  `niveauG` varchar(30) NOT NULL,
  `niveauE` varchar(30) NOT NULL,
  `test` int(30) NOT NULL,
  `codeline` int(30) NOT NULL,
  `note` float(5,2) NOT NULL,
  `niveau` varchar(30) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;




CREATE TABLE `users` (
  `login` varchar(30) NOT NULL,
  `pwd` varchar(500) NOT NULL,
  `nom` varchar(30) NOT NULL,
  `prenom` varchar(30) NOT NULL,
  `Prof` tinyint(1) NOT NULL,
  `email` varchar(30) NOT NULL,
  `datepwd` date NOT NULL,
  `open` tinyint(1) NOT NULL,
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO users VALUES("Admin","887375daec62a9f02d32a63c9e14c7641a9a8a42e4fa8f6590eb928d9744b57bb5057a1d227e4d40ef911ac030590bbce2bfdb78103ff0b79094cee8425601f5","Name","Vorname","2","michaux@free.fr","0000-00-00","1");



CREATE TABLE `usertype` (
  `code` int(30) NOT NULL,
  `name` text NOT NULL,
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO usertype VALUES("0","Eltern");
INSERT INTO usertype VALUES("1","Lehrer");
INSERT INTO usertype VALUES("2","Administrator");



CREATE TABLE `worktype` (
  `code` int(30) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO worktype VALUES("1","Klassenarbeit");
INSERT INTO worktype VALUES("2","Vokabeltest");
INSERT INTO worktype VALUES("4","Hausaufgabe");
INSERT INTO worktype VALUES("7","Mündlich");



CREATE TABLE `worktypescale` (
  `point` int(11) NOT NULL,
  `percentagefrom` int(11) NOT NULL,
  `percentagebis` int(11) NOT NULL,
  `niveauE` varchar(30) NOT NULL,
  `niveauG` varchar(30) NOT NULL,
  `worktype` int(30) NOT NULL,
  `course` varchar(30) NOT NULL,
  `code` int(30) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=496 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","FR01","2");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","FR01","3");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","FR01","4");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","FR01","5");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","FR01","6");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","FR01","7");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","FR01","8");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","FR01","9");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","FR01","10");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","FR01","11");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","FR01","12");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","FR01","13");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","FR01","14");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","FR01","15");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","FR01","16");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","FR01","31");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","BIO","32");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","BIO","33");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","BIO","34");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","BIO","35");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","BIO","36");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","BIO","37");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","BIO","38");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","BIO","39");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","BIO","40");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","BIO","41");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","BIO","42");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","BIO","43");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","BIO","44");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","BIO","45");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","BIO","46");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","BIO","47");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","CHE","48");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","CHE","49");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","CHE","50");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","CHE","51");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","CHE","52");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","CHE","53");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","CHE","54");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","CHE","55");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","CHE","56");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","CHE","57");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","CHE","58");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","CHE","59");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","CHE","60");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","CHE","61");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","CHE","62");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","CHE","63");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","DE01","64");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","DE01","65");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","DE01","66");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","DE01","67");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","DE01","68");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","DE01","69");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","DE01","70");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","DE01","71");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","DE01","72");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","DE01","73");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","DE01","74");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","DE01","75");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","DE01","76");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","DE01","77");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","DE01","78");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","DE01","79");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","DE02 ","80");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","DE02 ","81");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","DE02 ","82");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","DE02 ","83");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","DE02 ","84");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","DE02 ","85");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","DE02 ","86");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","DE02 ","87");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","DE02 ","88");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","DE02 ","89");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","DE02 ","90");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","DE02 ","91");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","DE02 ","92");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","DE02 ","93");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","DE02 ","94");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","DE02 ","95");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","EN01","96");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","EN01","97");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","EN01","98");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","EN01","99");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","EN01","100");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","EN01","101");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","EN01","102");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","EN01","103");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","EN01","104");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","EN01","105");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","EN01","106");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","EN01","107");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","EN01","108");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","EN01","109");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","EN01","110");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","EN01","111");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","EN02","112");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","EN02","113");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","EN02","114");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","EN02","115");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","EN02","116");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","EN02","117");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","EN02","118");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","EN02","119");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","EN02","120");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","EN02","121");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","EN02","122");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","EN02","123");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","EN02","124");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","EN02","125");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","EN02","126");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","EN02","127");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","FR02","128");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","FR02","129");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","FR02","130");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","FR02","131");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","FR02","132");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","FR02","133");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","FR02","134");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","FR02","135");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","FR02","136");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","FR02","137");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","FR02","138");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","FR02","139");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","FR02","140");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","FR02","141");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","FR02","142");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","FR02","143");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","GEO","144");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","GEO","145");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","GEO","146");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","GEO","147");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","GEO","148");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","GEO","149");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","GEO","150");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","GEO","151");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","GEO","152");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","GEO","153");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","GEO","154");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","GEO","155");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","GEO","156");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","GEO","157");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","GEO","158");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","GEO","159");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","GES","160");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","GES","161");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","GES","162");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","GES","163");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","GES","164");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","GES","165");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","GES","166");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","GES","167");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","GES","168");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","GES","169");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","GES","170");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","GES","171");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","GES","172");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","GES","173");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","GES","174");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","GES","175");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","KUN","176");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","KUN","177");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","KUN","178");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","KUN","179");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","KUN","180");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","KUN","181");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","KUN","182");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","KUN","183");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","KUN","184");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","KUN","185");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","KUN","186");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","KUN","187");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","KUN","188");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","KUN","189");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","KUN","190");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","KUN","191");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","MATH","192");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","MATH","193");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","MATH","194");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","MATH","195");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","MATH","196");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","MATH","197");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","MATH","198");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","MATH","199");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","MATH","200");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","MATH","201");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","MATH","202");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","MATH","203");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","MATH","204");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","MATH","205");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","MATH","206");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","MATH","207");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","MUS","208");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","MUS","209");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","MUS","210");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","MUS","211");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","MUS","212");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","MUS","213");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","MUS","214");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","MUS","215");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","MUS","216");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","MUS","217");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","MUS","218");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","MUS","219");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","MUS","220");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","MUS","221");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","MUS","222");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","MUS","223");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","SPOR","224");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","SPOR","225");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","SPOR","226");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","SPOR","227");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","SPOR","228");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","SPOR","229");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","SPOR","230");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","SPOR","231");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","SPOR","232");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","SPOR","233");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","SPOR","234");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","SPOR","235");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","SPOR","236");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","SPOR","237");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","SPOR","238");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","SPOR","239");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","1","WIRT","240");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","1","WIRT","241");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","1","WIRT","242");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","1","WIRT","243");
INSERT INTO worktypescale VALUES("11","88","93","2","1","1","WIRT","244");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","1","WIRT","245");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","1","WIRT","246");
INSERT INTO worktypescale VALUES("8","77","81","3","2","1","WIRT","247");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","1","WIRT","248");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","1","WIRT","249");
INSERT INTO worktypescale VALUES("5","65","70","4","3","1","WIRT","250");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","1","WIRT","251");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","1","WIRT","252");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","1","WIRT","253");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","1","WIRT","254");
INSERT INTO worktypescale VALUES("0","0","44","6","6","1","WIRT","255");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","BIO","256");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","BIO","257");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","BIO","258");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","BIO","259");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","BIO","260");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","BIO","261");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","BIO","262");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","BIO","263");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","BIO","264");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","BIO","265");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","BIO","266");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","BIO","267");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","BIO","268");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","BIO","269");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","BIO","270");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","BIO","271");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","CHE","272");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","CHE","273");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","CHE","274");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","CHE","275");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","CHE","276");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","CHE","277");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","CHE","278");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","CHE","279");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","CHE","280");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","CHE","281");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","CHE","282");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","CHE","283");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","CHE","284");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","CHE","285");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","CHE","286");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","CHE","287");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","DE01","288");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","DE01","289");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","DE01","290");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","DE01","291");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","DE01","292");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","DE01","293");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","DE01","294");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","DE01","295");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","DE01","296");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","DE01","297");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","DE01","298");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","DE01","299");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","DE01","300");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","DE01","301");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","DE01","302");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","DE01","303");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","DE02 ","304");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","DE02 ","305");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","DE02 ","306");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","DE02 ","307");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","DE02 ","308");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","DE02 ","309");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","DE02 ","310");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","DE02 ","311");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","DE02 ","312");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","DE02 ","313");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","DE02 ","314");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","DE02 ","315");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","DE02 ","316");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","DE02 ","317");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","DE02 ","318");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","DE02 ","319");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","EN01","320");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","EN01","321");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","EN01","322");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","EN01","323");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","EN01","324");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","EN01","325");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","EN01","326");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","EN01","327");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","EN01","328");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","EN01","329");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","EN01","330");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","EN01","331");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","EN01","332");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","EN01","333");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","EN01","334");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","EN01","335");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","EN02","336");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","EN02","337");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","EN02","338");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","EN02","339");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","EN02","340");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","EN02","341");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","EN02","342");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","EN02","343");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","EN02","344");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","EN02","345");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","EN02","346");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","EN02","347");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","EN02","348");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","EN02","349");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","EN02","350");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","EN02","351");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","FR02","352");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","FR02","353");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","FR02","354");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","FR02","355");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","FR02","356");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","FR02","357");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","FR02","358");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","FR02","359");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","FR02","360");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","FR02","361");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","FR02","362");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","FR02","363");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","FR02","364");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","FR02","365");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","FR02","366");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","FR02","367");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","GEO","368");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","GEO","369");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","GEO","370");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","GEO","371");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","GEO","372");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","GEO","373");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","GEO","374");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","GEO","375");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","GEO","376");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","GEO","377");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","GEO","378");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","GEO","379");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","GEO","380");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","GEO","381");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","GEO","382");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","GEO","383");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","GES","384");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","GES","385");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","GES","386");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","GES","387");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","GES","388");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","GES","389");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","GES","390");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","GES","391");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","GES","392");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","GES","393");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","GES","394");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","GES","395");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","GES","396");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","GES","397");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","GES","398");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","GES","399");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","KUN","400");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","KUN","401");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","KUN","402");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","KUN","403");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","KUN","404");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","KUN","405");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","KUN","406");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","KUN","407");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","KUN","408");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","KUN","409");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","KUN","410");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","KUN","411");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","KUN","412");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","KUN","413");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","KUN","414");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","KUN","415");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","MATH","416");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","MATH","417");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","MATH","418");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","MATH","419");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","MATH","420");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","MATH","421");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","MATH","422");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","MATH","423");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","MATH","424");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","MATH","425");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","MATH","426");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","MATH","427");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","MATH","428");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","MATH","429");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","MATH","430");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","MATH","431");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","MUS","432");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","MUS","433");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","MUS","434");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","MUS","435");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","MUS","436");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","MUS","437");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","MUS","438");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","MUS","439");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","MUS","440");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","MUS","441");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","MUS","442");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","MUS","443");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","MUS","444");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","MUS","445");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","MUS","446");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","MUS","447");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","SPOR","448");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","SPOR","449");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","SPOR","450");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","SPOR","451");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","SPOR","452");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","SPOR","453");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","SPOR","454");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","SPOR","455");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","SPOR","456");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","SPOR","457");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","SPOR","458");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","SPOR","459");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","SPOR","460");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","SPOR","461");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","SPOR","462");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","SPOR","463");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","WIRT","464");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","WIRT","465");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","WIRT","466");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","WIRT","467");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","WIRT","468");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","WIRT","469");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","WIRT","470");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","WIRT","471");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","WIRT","472");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","WIRT","473");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","WIRT","474");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","WIRT","475");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","WIRT","476");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","WIRT","477");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","WIRT","478");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","WIRT","479");
INSERT INTO worktypescale VALUES("15","100","100","1+","1+","4","FR01","480");
INSERT INTO worktypescale VALUES("14","97","99","1","1+","4","FR01","481");
INSERT INTO worktypescale VALUES("13","95","96","1-","1+","4","FR01","482");
INSERT INTO worktypescale VALUES("12","94","94","2+","1+","4","FR01","483");
INSERT INTO worktypescale VALUES("11","88","93","2","1","4","FR01","484");
INSERT INTO worktypescale VALUES("10","83","87","2-","1-","4","FR01","485");
INSERT INTO worktypescale VALUES("9","82","82","3+","2+","4","FR01","486");
INSERT INTO worktypescale VALUES("8","77","81","3","2","4","FR01","487");
INSERT INTO worktypescale VALUES("7","72","76","3-","2-","4","FR01","488");
INSERT INTO worktypescale VALUES("6","71","71","4+","3+","4","FR01","489");
INSERT INTO worktypescale VALUES("5","65","70","4","3","4","FR01","490");
INSERT INTO worktypescale VALUES("4","60","64","4-","4+","4","FR01","491");
INSERT INTO worktypescale VALUES("3","59","59","5+","4-","4","FR01","492");
INSERT INTO worktypescale VALUES("2","52","58","5","5+","4","FR01","493");
INSERT INTO worktypescale VALUES("1","45","51","5-","5","4","FR01","494");
INSERT INTO worktypescale VALUES("0","0","44","6","6","4","FR01","495");



CREATE TABLE `years` (
  `years` varchar(30) NOT NULL,
  UNIQUE KEY `years` (`years`),
  UNIQUE KEY `years_2` (`years`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO years VALUES("2018/2019");
INSERT INTO years VALUES("2019/2020");
INSERT INTO years VALUES("2020/2021");

