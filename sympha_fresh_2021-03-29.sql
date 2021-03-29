# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.100.150 (MySQL 5.5.5-10.1.33-MariaDB)
# Database: sympha_fresh
# Generation Time: 2021-03-29 08:33:44 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table category
# ------------------------------------------------------------

DROP TABLE IF EXISTS `category`;

CREATE TABLE `category` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Category_Name` varchar(100) NOT NULL DEFAULT '',
  `Icon` varchar(255) DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Category_Name` (`Category_Name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;

INSERT INTO `category` (`id`, `Category_Name`, `Icon`, `Created_at`, `Updated_at`)
VALUES
	(1,'Chicken Products','chicken.png','2021-03-25 19:43:18','2021-03-25 19:47:36'),
	(2,'Fish','fish.png','2021-03-25 19:43:43','2021-03-25 19:47:50'),
	(3,'Vegetables','vegetables.png','2021-03-25 19:43:58','2021-03-25 19:48:02'),
	(4,'Meat','meat.png','2021-03-25 19:44:03','2021-03-25 19:48:11');

/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table customers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `Number` varchar(20) NOT NULL DEFAULT '',
  `Deliverer` varchar(255) DEFAULT '',
  `Location` varchar(255) NOT NULL DEFAULT '',
  `Status` varchar(255) NOT NULL DEFAULT 'clean',
  `Note` varchar(500) DEFAULT 'Add Note...',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Number` (`Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;

INSERT INTO `customers` (`id`, `Name`, `Number`, `Deliverer`, `Location`, `Status`, `Note`, `Created_at`, `Updated_at`)
VALUES
	(2,'Christine Washiali','0713932945','','Langata, Nairobi, Kenya','clean','Add Note...','2021-03-21 15:25:02',NULL);

/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table departments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `departments`;

CREATE TABLE `departments` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;

INSERT INTO `departments` (`id`, `Name`, `Created_at`, `Updated_at`)
VALUES
	(1,'Drivers','0000-00-00 00:00:00',NULL),
	(2,'Cleaning','0000-00-00 00:00:00',NULL),
	(3,'Kitchen','0000-00-00 00:00:00',NULL),
	(4,'Office','0000-00-00 00:00:00',NULL);

/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table employee_leave
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employee_leave`;

CREATE TABLE `employee_leave` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Staff_id` bigint(11) unsigned DEFAULT NULL,
  `rem_leave_days` int(11) DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_id_foreign` (`Staff_id`),
  CONSTRAINT `staff_id_foreign` FOREIGN KEY (`Staff_id`) REFERENCES `users` (`staffID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table employee_leave_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employee_leave_data`;

CREATE TABLE `employee_leave_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Staff_id` bigint(11) unsigned DEFAULT NULL,
  `rem_leave_days` int(11) DEFAULT '21',
  `Stand_in_employee` bigint(11) unsigned DEFAULT NULL,
  `Start_day` date DEFAULT NULL,
  `leave_days_no` int(11) DEFAULT NULL,
  `End_day` date DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_id_relation` (`Staff_id`),
  CONSTRAINT `employee_id_relation` FOREIGN KEY (`Staff_id`) REFERENCES `users` (`staffID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table employee_sickoff_data
# ------------------------------------------------------------

DROP TABLE IF EXISTS `employee_sickoff_data`;

CREATE TABLE `employee_sickoff_data` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Staff_id` bigint(11) unsigned DEFAULT NULL,
  `Reason` varchar(255) DEFAULT NULL,
  `Start_day` date DEFAULT NULL,
  `sickoff_days_no` int(11) DEFAULT NULL,
  `End_day` date DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_ID_foreign` (`Staff_id`),
  CONSTRAINT `employee_ID_foreign` FOREIGN KEY (`Staff_id`) REFERENCES `users` (`staffID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table event
# ------------------------------------------------------------

DROP TABLE IF EXISTS `event`;

CREATE TABLE `event` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `User_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_event` datetime DEFAULT NULL,
  `end_event` datetime DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `User_id_foreign` (`User_id`),
  CONSTRAINT `User_id_foreign` FOREIGN KEY (`User_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;

INSERT INTO `event` (`id`, `User_id`, `title`, `start_event`, `end_event`, `Created_at`, `Updated_at`)
VALUES
	(1,2,'Happy Birthday','2021-03-28 00:00:00','2021-03-29 00:00:00','2021-03-28 07:53:38',NULL);

/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table expense_details
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expense_details`;

CREATE TABLE `expense_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Expense_id` bigint(11) unsigned NOT NULL,
  `Expense_particular` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '',
  `Party` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `Total_amount` double NOT NULL,
  `Paid_amount` double NOT NULL,
  `Due_amount` double NOT NULL,
  `Payment_date` date NOT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_id_foreign` (`Expense_id`),
  CONSTRAINT `expense_id_foreign` FOREIGN KEY (`Expense_id`) REFERENCES `expenses` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table expenses
# ------------------------------------------------------------

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table inventory_units
# ------------------------------------------------------------

DROP TABLE IF EXISTS `inventory_units`;

CREATE TABLE `inventory_units` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(200) NOT NULL DEFAULT '',
  `Created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `inventory_units` WRITE;
/*!40000 ALTER TABLE `inventory_units` DISABLE KEYS */;

INSERT INTO `inventory_units` (`id`, `Name`, `Created_at`, `Updated_at`)
VALUES
	(1,'None','2020-11-12 11:50:25',NULL),
	(2,'Litre(s)','2020-11-13 05:37:19',NULL),
	(3,'Packs','0000-00-00 00:00:00',NULL),
	(4,'Packets','0000-00-00 00:00:00',NULL),
	(5,'Dozen','0000-00-00 00:00:00',NULL),
	(6,'Box','0000-00-00 00:00:00',NULL),
	(7,'Sachets','0000-00-00 00:00:00',NULL),
	(8,'Tins','0000-00-00 00:00:00',NULL),
	(9,'Containers','0000-00-00 00:00:00',NULL),
	(10,'Kilogram(s)','2020-11-13 05:37:06',NULL),
	(11,'Bags','2020-11-12 05:10:30',NULL),
	(12,'Rolls','0000-00-00 00:00:00',NULL),
	(13,'Pieces','2020-11-12 14:01:18',NULL),
	(14,'Bundles','2020-11-17 08:29:49',NULL),
	(15,'Trays','2021-03-27 12:13:52',NULL),
	(16,'Eggs','2021-03-27 12:15:04',NULL),
	(17,'Bunches','2021-03-27 13:27:08',NULL);

/*!40000 ALTER TABLE `inventory_units` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table jobs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `jobs`;

CREATE TABLE `jobs` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Department_id` bigint(11) unsigned DEFAULT NULL,
  `Name` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `department_id_foreign` (`Department_id`),
  CONSTRAINT `department_id_foreign` FOREIGN KEY (`Department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;

INSERT INTO `jobs` (`id`, `Department_id`, `Name`, `Created_at`, `Updated_at`)
VALUES
	(1,4,'Software','0000-00-00 00:00:00',NULL),
	(2,4,'CEO','0000-00-00 00:00:00',NULL),
	(3,4,'Data Entry Clerk','0000-00-00 00:00:00',NULL),
	(4,4,'Director','0000-00-00 00:00:00',NULL),
	(5,1,'Driver','0000-00-00 00:00:00',NULL),
	(6,3,'Cook','0000-00-00 00:00:00',NULL),
	(7,4,'Sales','0000-00-00 00:00:00',NULL),
	(8,2,'Cleaner','0000-00-00 00:00:00',NULL),
	(9,4,'Stores Manager','0000-00-00 00:00:00',NULL),
	(10,4,'Stores Supervisor','0000-00-00 00:00:00',NULL);

/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table notes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `notes`;

CREATE TABLE `notes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `User_id` bigint(11) unsigned DEFAULT NULL,
  `Title` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Note` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Public` tinyint(1) DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `note_user_id` (`User_id`),
  CONSTRAINT `note_user_id` FOREIGN KEY (`User_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `orders`;

CREATE TABLE `orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Customer_id` bigint(20) unsigned NOT NULL,
  `Category_id` bigint(20) unsigned NOT NULL,
  `Stock_id` bigint(20) unsigned NOT NULL,
  `Quantity` int(20) NOT NULL,
  `Discount` float NOT NULL DEFAULT '0',
  `Debt` float NOT NULL,
  `MPesa` float NOT NULL DEFAULT '0',
  `Cash` float NOT NULL DEFAULT '0',
  `Fine` float NOT NULL DEFAULT '0',
  `Balance` float NOT NULL,
  `Late_Order` varchar(20) NOT NULL DEFAULT '0',
  `Returned` int(11) DEFAULT '0',
  `Banked` float DEFAULT '0',
  `Slip_Number` varchar(255) DEFAULT 'N/A',
  `Banked_By` varchar(255) DEFAULT 'N/A',
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_customer_id_foreign` (`Customer_id`),
  KEY `order_stock_id_foreign` (`Stock_id`),
  KEY `order_category_id_foreign` (`Category_id`),
  CONSTRAINT `order_category_id_foreign` FOREIGN KEY (`Category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_customer_id_foreign` FOREIGN KEY (`Customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_stock_id_foreign` FOREIGN KEY (`Stock_id`) REFERENCES `stock` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table stock
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stock`;

CREATE TABLE `stock` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Category_id` bigint(20) unsigned NOT NULL,
  `Supplier_id` bigint(20) unsigned NOT NULL,
  `Name` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(200) DEFAULT NULL,
  `Unit_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `Subunit_id` bigint(20) unsigned NOT NULL DEFAULT '1',
  `Contains` int(11) NOT NULL DEFAULT '1',
  `subunit_replenish_qty` int(11) NOT NULL DEFAULT '0',
  `Buying_price` float NOT NULL,
  `Price` float DEFAULT NULL,
  `Opening_stock` float DEFAULT '0',
  `Quantity` float DEFAULT NULL,
  `Restock_Level` int(11) NOT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Name` (`Name`),
  KEY `stock_category_id_foreign` (`Category_id`),
  KEY `stock_supplier_id_foreign` (`Supplier_id`),
  KEY `stock_unit_foreign` (`Unit_id`),
  KEY `subunit_id_foreign` (`Subunit_id`),
  CONSTRAINT `stock_category_id_foreign` FOREIGN KEY (`Category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stock_supplier_id_foreign` FOREIGN KEY (`Supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `stock_unit_foreign` FOREIGN KEY (`Unit_id`) REFERENCES `inventory_units` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subunit_id_foreign` FOREIGN KEY (`Subunit_id`) REFERENCES `inventory_units` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `stock` WRITE;
/*!40000 ALTER TABLE `stock` DISABLE KEYS */;

INSERT INTO `stock` (`id`, `Category_id`, `Supplier_id`, `Name`, `image`, `Unit_id`, `Subunit_id`, `Contains`, `subunit_replenish_qty`, `Buying_price`, `Price`, `Opening_stock`, `Quantity`, `Restock_Level`, `Created_at`, `Updated_at`)
VALUES
	(1,1,1,'Whole Chicken','full-broiler-chicken.jpeg',13,1,0,0,297,550,206,206,20,'2021-03-22 17:48:32','2021-03-27 22:09:10'),
	(2,1,1,'Chicken liver','chicken-liver.jpeg',10,1,0,0,100,200,206,206,20,'2021-03-22 17:48:32','2021-03-27 22:09:34'),
	(3,1,1,'Eggs','eggs.jpeg',15,16,30,0,250,350,206,206,3,'2021-03-22 17:48:32','2021-03-27 22:09:57'),
	(4,2,2,'Fillet','fillet.jpeg',10,1,0,0,600,750,45,45,10,'2021-03-27 12:55:17','2021-03-27 22:45:10'),
	(5,2,2,'Tilapia','tilapia.jpeg',13,1,0,0,250,300,46,46,5,'2021-03-27 13:07:00','2021-03-27 22:45:47'),
	(6,3,1,'Cogets','coget.jpeg',10,1,0,0,50,100,50,50,5,'2021-03-27 13:10:36','2021-03-27 22:46:19'),
	(7,3,1,'Sukuma Wiki (Kales)','kales.jpeg',17,1,0,0,15,25,34,34,10,'2021-03-27 21:58:40','2021-03-27 22:46:34'),
	(8,4,1,'Pork','pork.jpeg',10,1,0,0,600,750,24,24,5,'2021-03-27 22:00:08','2021-03-27 22:54:49'),
	(9,1,1,'Chicken Drumsticks','chicken-drumsticks.jpeg',10,1,0,0,500,600,46,46,5,'2021-03-27 22:02:13','2021-03-27 22:47:16'),
	(10,1,1,'Chicken Breasts','chicken-breasts.png',10,1,0,0,550,650,34,34,10,'2021-03-27 22:03:01','2021-03-27 22:47:29'),
	(11,1,1,'Chicken Wings','chicken-wings.jpeg',10,1,0,0,300,400,56,56,10,'2021-03-27 22:03:38','2021-03-27 22:47:52'),
	(12,1,1,'Chicken Gizzards','chicken-gizzards.jpeg',10,1,0,0,250,300,0,0,10,'2021-03-27 22:05:02','2021-03-27 22:48:05');

/*!40000 ALTER TABLE `stock` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table stock_flow
# ------------------------------------------------------------

DROP TABLE IF EXISTS `stock_flow`;

CREATE TABLE `stock_flow` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Stock_id` bigint(11) unsigned DEFAULT NULL,
  `Buying_price` float DEFAULT NULL,
  `Selling_price` float DEFAULT NULL,
  `Received_date` date DEFAULT NULL,
  `Purchased` int(11) DEFAULT NULL,
  `Damaged` int(11) NOT NULL DEFAULT '0',
  `Expiry_date` date DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_flow_stock_id` (`Stock_id`),
  CONSTRAINT `stock_flow_stock_id` FOREIGN KEY (`Stock_id`) REFERENCES `stock` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `stock_flow` WRITE;
/*!40000 ALTER TABLE `stock_flow` DISABLE KEYS */;

INSERT INTO `stock_flow` (`id`, `Stock_id`, `Buying_price`, `Selling_price`, `Received_date`, `Purchased`, `Damaged`, `Expiry_date`, `Created_at`, `Updated_at`)
VALUES
	(1,4,600,750,'2021-03-25',45,0,'2021-03-25','2021-03-27 12:55:17',NULL),
	(2,1,297,550,'2021-03-25',206,0,'2021-03-25','2021-03-27 12:55:17',NULL),
	(3,2,100,200,'2021-03-25',206,0,'2021-03-25','2021-03-27 12:55:17',NULL),
	(4,3,250,350,'2021-03-25',206,0,'2021-03-25','2021-03-27 12:55:17',NULL),
	(5,5,250,300,'2021-03-25',46,0,'2021-11-24','2021-03-27 13:07:00',NULL),
	(6,6,50,100,'2021-03-24',50,0,'2021-03-25','2021-03-27 13:10:36',NULL),
	(7,7,15,25,'2021-03-25',34,0,'2021-03-31','2021-03-27 21:58:40',NULL),
	(8,8,600,750,'2021-03-24',24,0,'2021-07-31','2021-03-27 22:00:08',NULL),
	(9,9,500,600,'2021-03-24',46,0,'2021-03-31','2021-03-27 22:02:13',NULL),
	(10,10,550,650,'2021-03-26',34,0,'2021-03-31','2021-03-27 22:03:01',NULL),
	(11,11,300,400,'2021-03-24',56,0,'2021-03-31','2021-03-27 22:03:39',NULL),
	(12,12,250,300,'2021-03-27',0,0,'2021-03-31','2021-03-27 22:05:02',NULL);

/*!40000 ALTER TABLE `stock_flow` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table suppliers
# ------------------------------------------------------------

DROP TABLE IF EXISTS `suppliers`;

CREATE TABLE `suppliers` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Supplier_contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `suppliers` WRITE;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;

INSERT INTO `suppliers` (`id`, `Name`, `Supplier_contact`, `Created_at`, `Updated_at`)
VALUES
	(1,'Sympha Farm','0733821479','2021-03-26 22:26:42',NULL),
	(2,'Victoria Farms',NULL,'2021-03-27 12:53:16',NULL);

/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL DEFAULT '',
  `lastname` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `nationalID` varchar(10) DEFAULT NULL,
  `staffID` bigint(10) unsigned DEFAULT NULL,
  `yob` varchar(4) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `salary` varchar(50) DEFAULT NULL,
  `KRA` int(255) DEFAULT NULL,
  `NSSF` int(11) DEFAULT NULL,
  `NHIF` int(11) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `access` varchar(50) NOT NULL DEFAULT 'customer',
  `password` varchar(255) NOT NULL DEFAULT '',
  `number` varchar(17) NOT NULL DEFAULT '',
  `active` int(11) DEFAULT '1',
  `Job_id` bigint(11) unsigned DEFAULT NULL,
  `ipAddress` varchar(100) NOT NULL DEFAULT '0',
  `loginattempt` int(11) NOT NULL DEFAULT '0',
  `token` varchar(255) DEFAULT NULL,
  `tokenExpire` datetime DEFAULT NULL,
  `online` tinyint(1) NOT NULL DEFAULT '1',
  `lastActivity` datetime DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Update_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `staffID` (`staffID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `nationalID`, `staffID`, `yob`, `gender`, `salary`, `KRA`, `NSSF`, `NHIF`, `location`, `access`, `password`, `number`, `active`, `Job_id`, `ipAddress`, `loginattempt`, `token`, `tokenExpire`, `online`, `lastActivity`, `Created_at`, `Update_at`)
VALUES
	(1,'Samuel','Mariwa','samuel.mariwa@strathmore.edu',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Sabaki, Nairobi, Kenya','customer','$2y$10$yIBQgZl0/e52ibN91dR5WOM5rzJem.Nhvan4Tvi2XWBLoscPtRpFC','+254 713 932 911',1,NULL,'0',0,NULL,NULL,0,'2021-03-24 21:11:04','2021-03-12 14:59:49',NULL),
	(2,'Irene','Mariwa','irene.mariwa@gmail.com','10008450',1,NULL,NULL,NULL,NULL,NULL,NULL,'Langata, Nairobi, Kenya','admin','$2y$10$RAixUcGePbHtghOAddG49es9c2q3a3eIsb/YXGIon.tQFHDCUJacW','+254 733 821 479',1,2,'192.168.64.1',0,NULL,NULL,1,'2021-03-29 11:05:03','2021-03-13 16:51:16',NULL),
	(4,'Christine','Washiali','christine@gmail.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Langata, Nairobi, Kenya','customer','$2y$10$OLEzOKYy3b1jGP6eHrkHYON4fdtALuI0ao77VgQP8bf5c5TI8imFm','+254 713 932 945',1,NULL,'0',0,NULL,NULL,0,'2021-03-21 15:25:23','2021-03-21 15:25:02',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table vehicle_inspection
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vehicle_inspection`;

CREATE TABLE `vehicle_inspection` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Vehicle_id` bigint(11) unsigned NOT NULL,
  `Last_Inspection` date DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `Next_Inspection` date DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicles_id_relation` (`Vehicle_id`),
  CONSTRAINT `vehicles_id_relation` FOREIGN KEY (`Vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



# Dump of table vehicle_service
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vehicle_service`;

CREATE TABLE `vehicle_service` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Vehicle_id` bigint(11) unsigned DEFAULT NULL,
  `Last_service` date DEFAULT NULL,
  `notes` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Next_service` date DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vehicle_service_vehicle_id` (`Vehicle_id`),
  CONSTRAINT `vehicle_service_vehicle_id` FOREIGN KEY (`Vehicle_id`) REFERENCES `vehicles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



# Dump of table vehicles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `vehicles`;

CREATE TABLE `vehicles` (
  `id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `Driver_id` bigint(11) unsigned DEFAULT NULL,
  `Type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Reg_Number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Mileage` int(11) NOT NULL DEFAULT '0',
  `Route` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `Reg_Number` (`Reg_Number`),
  KEY `vehicles_driver_id` (`Driver_id`),
  CONSTRAINT `vehicle_driver_id` FOREIGN KEY (`Driver_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
