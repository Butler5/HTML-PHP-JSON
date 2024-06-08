--
-- Table structure for table `actors`
--

DROP TABLE IF EXISTS `dogs`;
CREATE TABLE `dogs` (
  `id` int(11) NOT NULL DEFAULT '0',
  `breed_name` varchar(100) DEFAULT NULL,
  `breed_fact` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`breed_name`),
  KEY `idx_breed_name` (`breed_name`(15)),
  KEY `idx_breed_fact` (`breed_fact`(15))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


--
-- Dumping data for table `actors`
--


INSERT INTO `dogs` VALUES (1,'German Shepherd','German Shepherds Are One of The Smartest Dog Breeds'),(2,'Labrador Retriever','Labradors are famous for their love of water'),(3,'Border Collie','Border Collies were originally bred to herd sheep'),(4,'Dachshund','Dachshunds were bred to hunt badgers'),(5, 'Bulldog','The Bulldog got its name because this type of dog was preferred for the English sport of bullbaiting, which involved tethering a bull to a stake in the ground and encouraging dogs to try to bite the bulls nose.');