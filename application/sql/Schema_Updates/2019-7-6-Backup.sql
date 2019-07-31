-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: rentable
-- ------------------------------------------------------
-- Server version	5.7.23

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
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `Company_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Company_Name` varchar(45) NOT NULL,
  `Address_1` varchar(45) DEFAULT NULL,
  `Address_2` varchar(45) DEFAULT NULL,
  `City` varchar(45) DEFAULT NULL,
  `State` varchar(45) DEFAULT NULL,
  `Zip` varchar(45) DEFAULT NULL,
  `Country` varchar(45) DEFAULT NULL,
  `Phone` varchar(45) DEFAULT NULL,
  `Fax` varchar(45) DEFAULT NULL,
  `Website` varchar(45) DEFAULT NULL,
  `Sales_Tax_Rate` float DEFAULT NULL,
  `Local_Timezone` varchar(45) NOT NULL,
  PRIMARY KEY (`Company_ID`),
  UNIQUE KEY `Company_ID_UNIQUE` (`Company_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'AG','7369 Fulton St','','San Diego','CA','92111','United States','3256602651','','',3.5,'America/Los_Angeles'),(2,'1989','7369 Fulton St','','San Diego','California','92111','USA','3256602651','','',0,'America/Los_Angeles');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `Customer_ID` int(11) NOT NULL AUTO_INCREMENT,
  `First_Name` varchar(45) DEFAULT NULL,
  `Last_Name` varchar(45) NOT NULL,
  `Billing_Address_1` varchar(45) DEFAULT NULL,
  `Billing_Address_2` varchar(45) DEFAULT NULL,
  `Billing_City` varchar(45) DEFAULT NULL,
  `Billing_State` varchar(45) DEFAULT NULL,
  `Billing_Zip` varchar(45) DEFAULT NULL,
  `Billing_Country` varchar(45) DEFAULT NULL,
  `Delivery_Address_1` varchar(45) DEFAULT NULL,
  `Delivery_Address_2` varchar(45) DEFAULT NULL,
  `Delivery_City` varchar(45) DEFAULT NULL,
  `Delivery_State` varchar(45) DEFAULT NULL,
  `Delivery_Zip` varchar(45) DEFAULT NULL,
  `Delivery_Country` varchar(45) DEFAULT NULL,
  `Phone_1` varchar(45) DEFAULT NULL,
  `Phone_2` varchar(45) DEFAULT NULL,
  `Notes` varchar(255) DEFAULT NULL,
  `Company_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Active` tinyint(1) NOT NULL,
  PRIMARY KEY (`Customer_ID`),
  UNIQUE KEY `Customer_ID_UNIQUE` (`Customer_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'','','','','','','','United States','','','','','','United States','','','',1,2,1),(4,'John','Aguilar','234 4th Ave','','Seattle','WA','98101','USA','','','','','','USA','','','',1,2,0),(5,'John','Zachary','','','','','','USA','','','','','','USA','','','',1,2,0),(6,'Blaine','Davis','','','','','','USA','','','','','','USA','','','',1,2,1),(7,'James','Taylor','','','','','','USA','','','','','','USA','','','',1,2,1),(8,'Tina','Watson','','','','','','USA','','','','','','USA','','','',1,2,1),(11,'Dwain','Johnson','','','','','','USA','','','','','','USA','','','',1,2,1),(12,'Carey','Underwood','','','','','','USA','','','','','','USA','','','',1,2,1),(13,'Andrew','Garrett','7369 Fulton St','7369 Fulton St','San Diego','CA','92111','USA','','','','','','USA','','','',1,2,1),(14,'Captian','Planet','','','','','','USA','','','','','','USA','','','',1,2,1),(15,'Bob','Sagget','','','Renton','WA','98115',NULL,'','','',NULL,'',NULL,'',NULL,'',1,2,1);
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'admin','Administrator'),(2,'members','General User');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `item_categories`
--

DROP TABLE IF EXISTS `item_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `item_categories` (
  `Item_Category_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) NOT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `Company_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Active` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Item_Category_ID`),
  UNIQUE KEY `Item_Category_ID_UNIQUE` (`Item_Category_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `item_categories`
--

LOCK TABLES `item_categories` WRITE;
/*!40000 ALTER TABLE `item_categories` DISABLE KEYS */;
INSERT INTO `item_categories` VALUES (1,'Lift Chairs',NULL,1,2,NULL),(2,'Power Scooters',NULL,1,2,NULL);
/*!40000 ALTER TABLE `item_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `items` (
  `Item_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Item_Category_ID` int(11) DEFAULT NULL,
  `Vendor_ID` int(11) DEFAULT NULL,
  `Item_Name` varchar(45) NOT NULL,
  `Part_Number` varchar(45) NOT NULL,
  `Serial_Number` varchar(45) DEFAULT NULL,
  `Tracking_Number` varchar(45) DEFAULT NULL,
  `Status` varchar(45) NOT NULL,
  `Date_In_Service` datetime NOT NULL,
  `Date_Sold` datetime DEFAULT NULL,
  `Taxable_Status` tinyint(1) DEFAULT NULL,
  `Company_ID` varchar(45) NOT NULL,
  `User_ID` varchar(45) NOT NULL,
  `Active` tinyint(1) DEFAULT NULL,
  `Item_TimeStamp` datetime DEFAULT NULL,
  PRIMARY KEY (`Item_ID`),
  UNIQUE KEY `Item_ID_UNIQUE` (`Item_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `items`
--

LOCK TABLES `items` WRITE;
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
INSERT INTO `items` VALUES (1,1,1,'Cloud Medium Large','PR510MLA','GT1901FAS22344','1028','On-Hand','2019-06-30 00:00:00',NULL,1,'1','2',1,'2019-07-01 05:27:32');
/*!40000 ALTER TABLE `items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_attempts`
--

LOCK TABLES `login_attempts` WRITE;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_order_items`
--

DROP TABLE IF EXISTS `sales_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_order_items` (
  `SO_Item_ID` int(11) NOT NULL AUTO_INCREMENT,
  `SO_ID` int(11) NOT NULL,
  `Item_ID` int(11) NOT NULL,
  `SO_Item_Quantity` int(11) NOT NULL,
  `SO_Item_Amount` float NOT NULL,
  `SO_Item_Tax` float NOT NULL,
  `SO_Item_Notes` text,
  `SO_Item_TimeStamp` datetime NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Company_ID` int(11) NOT NULL,
  PRIMARY KEY (`SO_Item_ID`),
  UNIQUE KEY `SO_Item_ID` (`SO_Item_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_order_items`
--

LOCK TABLES `sales_order_items` WRITE;
/*!40000 ALTER TABLE `sales_order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_orders`
--

DROP TABLE IF EXISTS `sales_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_orders` (
  `SO_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Customer_ID` int(11) NOT NULL,
  `Subtotal_Amount` float NOT NULL,
  `Tax_Amount` float NOT NULL,
  `Total_Amount` float NOT NULL,
  `Total_Taxable` float NOT NULL,
  `Total_NonTaxable` float NOT NULL,
  `SO_Notes` text,
  `SO_TimeStamp` datetime NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Company_ID` int(11) NOT NULL,
  `SO_Status` varchar(45) NOT NULL,
  PRIMARY KEY (`SO_ID`),
  UNIQUE KEY `SO_ID_UNIQUE` (`SO_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_orders`
--

LOCK TABLES `sales_orders` WRITE;
/*!40000 ALTER TABLE `sales_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'127.0.0.1','administrator','$2y$12$xRTwayz/s0cjEMsEsO1G8OO31hXEpxFJ4QriISETKlGA7puxYRJZ6','admin@admin.com',NULL,'',NULL,NULL,NULL,NULL,NULL,1268889823,1559693252,1,'Admin','istrator','ADMIN','0'),(2,'127.0.0.1','athomasgarrett@gmail.com','$2y$12$irSNuYS0WFBOfNb.YydGAuq7zSXBHHQ2K7mLflPlR1tpKACDx/JQK','athomasgarrett@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1559680378,1559694948,1,'Andrew','Garrett','AG','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`),
  CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_groups`
--

LOCK TABLES `users_groups` WRITE;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` VALUES (1,1,1),(2,1,2),(4,2,1),(5,2,2);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendors` (
  `Vendor_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Vendor_Name` varchar(45) DEFAULT NULL,
  `Vendor_Address_1` varchar(45) DEFAULT NULL,
  `Vendor_Address_2` varchar(45) DEFAULT NULL,
  `Vendor_City` varchar(45) DEFAULT NULL,
  `Vendor_State` varchar(45) DEFAULT NULL,
  `Vendor_Zip` varchar(45) DEFAULT NULL,
  `Vendor_Country` varchar(45) DEFAULT NULL,
  `Phone` varchar(45) DEFAULT NULL,
  `Fax` varchar(45) DEFAULT NULL,
  `Website` varchar(45) DEFAULT NULL,
  `Company_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL,
  `Active` tinyint(1) DEFAULT NULL,
  `Vendor_Notes` text,
  PRIMARY KEY (`Vendor_ID`),
  UNIQUE KEY `Vendor_ID_UNIQUE` (`Vendor_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
INSERT INTO `vendors` VALUES (1,'AG','','','San Diego','CA','92111',NULL,'3256602651','','ag.com',1,2,1,'');
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-06 10:49:38
