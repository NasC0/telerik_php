CREATE DATABASE  IF NOT EXISTS `books` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `books`;
-- MySQL dump 10.13  Distrib 5.6.11, for Win32 (x86)
--
-- Host: localhost    Database: books
-- ------------------------------------------------------
-- Server version	5.5.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(250) NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `authors`
--

LOCK TABLES `authors` WRITE;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
INSERT INTO `authors` VALUES (1,'Робърт Хайнлайн'),(2,'Клифърд Саймък'),(3,'Тери Пратчет'),(4,'Тери Гудкайнд'),(5,'Джордж Р. Р. Мартин'),(6,'Джон Толкин'),(7,'Лоис Макмастър Бюджолд'),(14,'Светлин Наков'),(13,'Нийл Геймън'),(15,'Веселин Колев'),(17,'Бай Иван');
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_title` varchar(250) NOT NULL,
  `msg_count` int(11) DEFAULT '0',
  PRIMARY KEY (`book_id`),
  UNIQUE KEY `book_id_UNIQUE` (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'Добри Поличби',0),(2,'Въведение в програмирането със C#',0),(3,'Първото правило на Магьосника',0),(4,'Игра на тронове',1),(5,'Бараяр',1),(6,'Дипломатически Имунитет',1),(7,'Морт',1),(8,'Стражата! Стражата!',0),(9,'Времето е най-простото нещо',0),(10,'Странник в странна страна',0),(11,'Магизточник',0),(12,'Някво заглавие',3),(13,'Вещици в чужбина',0),(14,'Те вървяха като хора',0),(15,'Енфие',1),(16,'Технология на Ракията',1),(17,'100 народни лека против махмурлук',2),(18,'Как да изтрезнеем по нашенски',0),(19,'Клин-клин избива!',0);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books_authors`
--

DROP TABLE IF EXISTS `books_authors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_authors` (
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  KEY `book_id` (`book_id`),
  KEY `author_id` (`author_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books_authors`
--

LOCK TABLES `books_authors` WRITE;
/*!40000 ALTER TABLE `books_authors` DISABLE KEYS */;
INSERT INTO `books_authors` VALUES (1,3),(1,13),(2,14),(2,15),(3,4),(4,5),(5,7),(6,7),(7,3),(8,3),(9,2),(10,1),(11,3),(12,2),(12,3),(12,4),(12,5),(12,6),(12,7),(12,13),(13,3),(14,2),(15,3),(16,17),(17,17),(18,17),(19,17);
/*!40000 ALTER TABLE `books_authors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books_messages`
--

DROP TABLE IF EXISTS `books_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books_messages` (
  `book_id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL,
  KEY `book_id` (`book_id`),
  KEY `msg_id` (`msg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books_messages`
--

LOCK TABLES `books_messages` WRITE;
/*!40000 ALTER TABLE `books_messages` DISABLE KEYS */;
INSERT INTO `books_messages` VALUES (12,1),(5,2),(12,3),(12,4),(7,5),(15,6),(6,7),(4,8),(17,9),(17,10),(16,11);
/*!40000 ALTER TABLE `books_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT,
  `msg_body` text NOT NULL,
  `msg_datetime` datetime NOT NULL,
  PRIMARY KEY (`msg_id`),
  UNIQUE KEY `msg_id_UNIQUE` (`msg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'Я да видим ще се добави ли коментарааа','2013-10-20 22:21:50'),(2,'Много добра книга','2013-10-20 22:23:49'),(3,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi porttitor id est eu hendrerit. Vivamus consequat porttitor rhoncus. Morbi porta, velit a laoreet tincidunt, dui elit venenatis erat, vitae fringilla urna risus eget tortor. Fusce vel est sem. Mauris iaculis orci consequat, adipiscing neque non, ornare nisl. Sed vel ante urna. Aliquam nibh dolor, blandit vitae consectetur id, elementum ac sem. Mauris sem nisi, venenatis quis ultricies et, lobortis ut libero. Cras quis augue vel felis vulputate ullamcorper.','2013-10-20 22:24:39'),(4,'Phasellus vel semper est. Suspendisse sodales, risus vestibulum tincidunt aliquet, tellus quam convallis dui, eget faucibus elit felis id nisi. Duis porttitor elementum interdum. Duis eleifend commodo nulla, et sagittis neque mollis et. Nam et viverra tortor. Fusce tortor felis, cursus vitae tortor et, lobortis interdum diam. Nunc ultricies risus eu adipiscing egestas. Duis fermentum, lectus id vulputate rutrum, arcu risus hendrerit metus, vitae placerat ligula sem ac massa. Cras convallis magna arcu, auctor tincidunt est venenatis id. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse elementum, libero id ultricies porttitor, diam sem malesuada turpis, ut volutpat purus lacus sit amet ligula. Nulla ut tincidunt urna. Nulla neque quam, aliquam eget porta posuere, imperdiet nec ipsum. Ut blandit risus et nisi tristique aliquam.','2013-10-20 22:25:04'),(5,'Cras ullamcorper erat ut varius rutrum. Etiam a eleifend quam. Aenean tincidunt nunc porta quam blandit vulputate. Curabitur porta eros nisl, et pellentesque arcu egestas sed. Duis sagittis ligula in lacus tempor, et porta diam euismod. Nulla rhoncus, libero vel placerat cursus, felis nisi interdum ligula, eu lobortis est dolor quis magna. Morbi quis risus quam. Nulla facilisi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;','2013-10-20 22:25:42'),(6,'Integer vestibulum vitae sapien imperdiet convallis. Donec adipiscing nisi in dui rutrum, vel sollicitudin purus bibendum. Pellentesque pretium sem purus, eu vulputate ipsum vulputate non. Proin ut egestas dui. Suspendisse vitae neque neque. Suspendisse aliquet augue eu justo pulvinar scelerisque. Suspendisse molestie ac mauris non porta. Curabitur tellus tortor, hendrerit vitae metus eu, rhoncus tincidunt eros. Donec et velit eu dolor egestas vestibulum et id lectus. Aenean interdum cursus purus feugiat semper. Sed eros ante, tempor ac lectus non, sagittis aliquet leo. Cras sit amet erat quis tortor adipiscing blandit sed id purus. Ut ac lorem ante. Nulla ultrices ante sem, eget auctor nunc aliquam id. Fusce at ante tellus.','2013-10-20 22:25:52'),(7,'Vivamus nec enim urna. Nulla rhoncus cursus orci in rutrum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc vitae mattis diam, vel bibendum lorem. Praesent vehicula condimentum nulla, sit amet consectetur nibh vulputate eu. Mauris eget tortor a lorem condimentum rhoncus. Nulla tempor magna felis, vitae lobortis lectus porttitor vitae. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed vel nibh dolor.','2013-10-20 22:26:12'),(8,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae elit vitae augue dictum volutpat. Ut quis orci dui. Aliquam lacinia mollis imperdiet. In viverra mi sed viverra luctus. Quisque pellentesque faucibus lorem id varius. Aenean in arcu quis ligula venenatis porttitor. Pellentesque sit amet accumsan velit, eu rutrum lacus. Etiam viverra dui vitae magna posuere posuere at sollicitudin risus. Cras fringilla ut ligula at ornare.','2013-10-20 22:26:57'),(9,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam vitae elit vitae augue dictum volutpat. Ut quis orci dui. Aliquam lacinia mollis imperdiet. In viverra mi sed viverra luctus. Quisque pellentesque faucibus lorem id varius. Aenean in arcu quis ligula venenatis porttitor. Pellentesque sit amet accumsan velit, eu rutrum lacus. Etiam viverra dui vitae magna posuere posuere at sollicitudin risus. Cras fringilla ut ligula at ornare.','2013-10-20 23:01:20'),(10,'Pellentesque sed arcu dolor. Curabitur in augue mattis, consectetur felis sit amet, malesuada diam. Nullam congue non sem eget tempus. Vestibulum at ultricies erat, eu molestie sem. Integer euismod mauris urna. In diam elit, imperdiet blandit sem ut, dapibus dapibus justo. Aenean imperdiet sem eget leo elementum tempor. Pellentesque sodales arcu eget massa sollicitudin, quis interdum ipsum aliquam. Curabitur sodales, leo sed aliquet facilisis, nisl tortor vehicula tortor, vel tristique quam elit ut sem. Proin eu nibh feugiat, adipiscing mauris eu, adipiscing massa. Integer congue facilisis turpis, lacinia suscipit diam pulvinar vel. Mauris malesuada nec ipsum scelerisque imperdiet.','2013-10-20 23:02:40'),(11,'Pellentesque sed arcu dolor. Curabitur in augue mattis, consectetur felis sit amet, malesuada diam. Nullam congue non sem eget tempus. Vestibulum at ultricies erat, eu molestie sem. Integer euismod mauris urna. In diam elit, imperdiet blandit sem ut, dapibus dapibus justo. Aenean imperdiet sem eget leo elementum tempor. Pellentesque sodales arcu eget massa sollicitudin, quis interdum ipsum aliquam. Curabitur sodales, leo sed aliquet facilisis, nisl tortor vehicula tortor, vel tristique quam elit ut sem. Proin eu nibh feugiat, adipiscing mauris eu, adipiscing massa. Integer congue facilisis turpis, lacinia suscipit diam pulvinar vel. Mauris malesuada nec ipsum scelerisque imperdiet.','2013-10-20 23:02:40');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'teehee','qwerty'),(2,'kickass','qwerty'),(3,'blabla','qwerty');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_messages`
--

DROP TABLE IF EXISTS `users_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_messages` (
  `user_id` int(11) NOT NULL,
  `msg_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `msg_id` (`msg_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_messages`
--

LOCK TABLES `users_messages` WRITE;
/*!40000 ALTER TABLE `users_messages` DISABLE KEYS */;
INSERT INTO `users_messages` VALUES (1,1),(2,2),(2,3),(3,4),(3,5),(3,6),(1,7),(1,8),(1,9),(2,10),(2,11);
/*!40000 ALTER TABLE `users_messages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-20 23:03:47
