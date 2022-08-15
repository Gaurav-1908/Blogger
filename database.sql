
users | CREATE TABLE `users` (
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`username`)
)

blogs | CREATE TABLE `blogs` (
  `heading` text,
  `content` text,
  `likes` int DEFAULT '0',
  `views` int DEFAULT '0',
  `pubdate` date DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `type` int DEFAULT '3',
  KEY `username` (`username`),
  CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`username`) REFERENCES `users` (`username`)
)