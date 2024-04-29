CREATE DATABASE IF NOT EXISTS trashbusters;
USE trashbusters;
-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: trashbusters.c1masqqacups.eu-central-1.rds.amazonaws.com    Database: backend
-- ------------------------------------------------------
-- Server version	8.0.35

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
SET @MYSQLDUMP_TEMP_LOG_BIN = @@SESSION.SQL_LOG_BIN;
SET @@SESSION.SQL_LOG_BIN= 0;

--
-- GTID state at the beginning of the backup 
--

SET @@GLOBAL.GTID_PURGED=/*!80000 '+'*/ '';

--
-- Table structure for table `assigneds`
--

DROP TABLE IF EXISTS `assigneds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assigneds` (
  `eventId` bigint unsigned NOT NULL,
  `dumpId` bigint unsigned NOT NULL,
  PRIMARY KEY (`eventId`),
  KEY `assigneds_dumpid_foreign` (`dumpId`),
  CONSTRAINT `assigneds_dumpid_foreign` FOREIGN KEY (`dumpId`) REFERENCES `dumps` (`id`) ON DELETE CASCADE,
  CONSTRAINT `assigneds_eventid_foreign` FOREIGN KEY (`eventId`) REFERENCES `events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assigneds`
--

LOCK TABLES `assigneds` WRITE;
/*!40000 ALTER TABLE `assigneds` DISABLE KEYS */;
/*!40000 ALTER TABLE `assigneds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dumps`
--

DROP TABLE IF EXISTS `dumps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dumps` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactPhone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactEmail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dumps`
--

LOCK TABLES `dumps` WRITE;
/*!40000 ALTER TABLE `dumps` DISABLE KEYS */;
INSERT INTO `dumps` VALUES (1,'GYHG Győri Hulladékgazdálkodási Nonprofit Kft.','A háztartásokban leggyakrabban keletkező hulladékok környezetbarát elhelyezésére szolgáló lerakó','9023 Győr, Bartók Béla út 29. fszt. 4a','06-96/677-777','-'),(2,'Zöld Pont, Dél-Kom Nonprofit Kft.','Környezetbarát elhelyezésére szolgáló lerakó','7631 Pécs, Postagalamb utca 3','06-30/157-0118','-'),(3,'Aliquam voluptatem et expedita corrupti.','Ut fugiat sit quis iste provident quia. Sit aliquid perferendis earum nulla. Omnis nemo dolorem vitae voluptatem asperiores soluta.','8920 Barton Loaf\nMarshallborough, HI 06529','(346) 819-3629','windler.lorenz@gmail.com'),(4,'Qui voluptate reprehenderit ut accusantium doloremque sapiente dolorem.','Facere iure magnam commodi vero. Suscipit qui voluptatibus eos iste. Esse distinctio eos ratione perferendis occaecati.','24268 Carli Vista Suite 953\nNew Eryn, MD 25488-3978','+1-607-481-5451','hschaden@dickens.com'),(5,'Veniam sint dolores consequatur magni amet est.','Vitae magnam debitis non mollitia qui. Similique accusantium soluta cumque at eligendi. Sed autem est voluptates a est.','10549 Weimann Hills\nMarvinmouth, CO 79405','1-409-240-7805','vromaguera@gmail.com'),(6,'Quas animi perferendis vero maxime iusto culpa asperiores.','Minima recusandae maiores quasi possimus blanditiis dolorum ratione. Dicta unde ex qui assumenda impedit modi. Provident consectetur aut fugiat ea eius et.','451 Shaniya Mountains\nNew Lewisview, MN 63899','1-248-456-4671','okon.jimmie@hotmail.com'),(7,'Aut accusantium ducimus laboriosam sit aspernatur.','Esse ducimus minima nulla eum fugiat omnis iusto. Suscipit magni et est at nihil accusamus. Quis reprehenderit voluptas totam.','13211 West Shoals\nEast Heloiseton, VA 67875','+1.865.879.9868','conrad08@gmail.com'),(8,'Distinctio enim deserunt iste dolores praesentium nesciunt.','Rerum inventore sit sapiente exercitationem quasi. Consectetur nobis velit vel fuga. Laborum debitis fuga quis adipisci repellat cumque repudiandae.','61147 Bailey Drive\nJakubowskimouth, HI 01828-4060','+18722551964','greta23@gmail.com'),(9,'Est placeat veritatis earum autem eaque repellendus non.','Voluptas rerum repellat veniam. Animi adipisci dignissimos eos praesentium illo iste. Voluptates et commodi molestiae non rem nostrum.','4929 Hansen Plain\nDenesikfort, AL 34260-8066','(463) 364-1270','orval.cole@gmail.com'),(10,'Accusantium dolorem officia quia et odit soluta id.','Aperiam vel praesentium porro libero culpa. Pariatur dolorum perspiciatis inventore. Itaque nisi fugiat tenetur ea ut omnis.','1631 Gutmann Cove Apt. 050\nLeifberg, AR 11867-5569','607-585-0820','cassin.brannon@schamberger.org'),(11,'Quasi sunt non non sunt quo et voluptas minima.','Nesciunt aspernatur quis non amet nisi dicta. Eaque iusto accusantium asperiores tempore. Sit reprehenderit labore porro eos.','1008 Emmerich Street Apt. 672\nLake Chester, VT 69175-1847','585.836.5580','duane.boyle@gmail.com'),(12,'Ullam autem quisquam sint ratione quas praesentium.','Accusantium aut omnis ratione vitae. Qui ut reprehenderit similique nisi tenetur earum est ut. Illum enim quae laudantium quibusdam.','2132 Dickens Green Suite 659\nSchmelerton, CT 22029-2464','404-580-1993','shad.corwin@gmail.com');
/*!40000 ALTER TABLE `dumps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `events` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `participants` int NOT NULL DEFAULT '0',
  `creatorId` bigint unsigned NOT NULL,
  `dumpId` bigint unsigned DEFAULT NULL,
  `eventPictureURL` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_creatorid_foreign` (`creatorId`),
  KEY `events_dumpid_foreign` (`dumpId`),
  CONSTRAINT `events_creatorid_foreign` FOREIGN KEY (`creatorId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `events_dumpid_foreign` FOREIGN KEY (`dumpId`) REFERENCES `dumps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (8,'Budapest megtisztítása','Szemétszedés Budapest belvárosában','2024-06-10','13:00:00','Budapest','Széll Kálmán tér',4,16,NULL,'https://trashbusters.s3.eu-central-1.amazonaws.com/event-pictures/1710172194_NYD_9589.jpg'),(9,'Te Szedd',NULL,'2024-06-01','14:00:00','Kecskemét','József Attila utca 20.',0,12,NULL,NULL),(12,'Szemétszedés',NULL,'2024-07-12','16:00:00','Budapest','Hősök tere',0,8,NULL,NULL),(15,'Győri szemétszedés',NULL,'2024-06-12','14:00:00','Győr','Vasútállomás',5,23,1,NULL),(16,'Pécsi szemétszedés','Gyertek szemétszedésre Pécs belvárosába','2024-06-20','13:30:00','Pécs','Belváros',4,24,2,'https://trashbusters.s3.eu-central-1.amazonaws.com/event-pictures/1712326318_natgeo-pecs.png'),(17,'Vel rerum voluptas eligendi ex harum unde est.','Rerum molestias velit cupiditate reiciendis reiciendis. Esse omnis est error id nesciunt a. Ut iusto non adipisci doloribus. Beatae eos error quis necessitatibus commodi occaecati.','2024-07-19','16:19:50','Lake Boyd','35956 Huel Key\nSouth Russelton, WY 94988-5603',2,12,NULL,''),(18,'Ipsa sunt odit quisquam alias et nemo.','Eum quisquam aliquam eligendi et alias architecto. Consectetur praesentium consequatur laudantium ad soluta et.','2024-10-10','03:22:28','Tracyberg','45657 Margarete Plains\nPort Rowland, VA 24318',1,37,NULL,''),(19,'Itaque nostrum sed expedita.','Libero eum autem quia quia incidunt. Dolorum et placeat qui qui. Autem repellendus sit labore impedit vitae consectetur eos. Quas enim eveniet qui id odio repellendus natus.','2024-07-24','02:42:19','North Elena','34272 Stan Loaf Apt. 489\nNorth Callieland, OH 25916-4320',2,46,NULL,''),(20,'Atque quibusdam nihil fugiat atque.','Molestiae qui dolore qui delectus ut ut. Et eos rerum non. Rerum officiis commodi ut voluptatum quaerat. Porro exercitationem autem voluptas deleniti consectetur qui.','2024-09-01','04:31:59','Lake Sunnychester','4385 Beau Harbor Apt. 590\nMillsland, MD 65355-2570',4,40,NULL,''),(21,'Quam ut sit neque consequatur quibusdam et dignissimos.','Quos sint quo tempora aspernatur hic non expedita quia. Est iure sequi facilis impedit at libero.','2025-01-09','06:05:15','Maximilianview','5685 Alysson Canyon\nLake Ethel, MA 47752-0418',0,25,NULL,''),(22,'Tenetur eligendi laborum cumque tenetur accusantium.','Consectetur culpa fugiat consequatur placeat sapiente ullam dolores assumenda. Beatae beatae sunt enim aliquam dolorum. Porro animi id autem facilis iure tempore omnis. A error error impedit praesentium alias id illum est.','2024-06-28','02:40:26','Port Dolly','2642 Arjun Fork Apt. 311\nZoeybury, CO 55340-3506',3,26,NULL,''),(23,'Corrupti sed quia reiciendis aut ratione dolorum enim.','Quos ea velit blanditiis. Et itaque velit ut deleniti cum autem consequatur qui. Architecto itaque sed magnam perferendis itaque omnis rem.','2024-08-09','22:55:34','West Mariehaven','7676 Hintz Vista Apt. 392\nEast Dandre, SD 77350-4067',4,40,NULL,''),(24,'Eum et esse mollitia.','Non perspiciatis molestias exercitationem delectus dolor amet. Laudantium temporibus dicta dolorem explicabo quisquam hic in qui. Corrupti ipsam magnam eaque facilis. Sit voluptas quos accusantium cumque sunt dolor ratione.','2024-09-14','08:48:49','Clemmiefort','97399 Gaylord Village\nPagacburgh, WI 11125',4,8,NULL,''),(25,'Itaque ut sunt eum et.','Qui non nihil et eveniet expedita unde. Architecto cupiditate cupiditate qui. Officiis dolorem vel itaque porro vitae possimus temporibus.','2024-07-18','17:27:26','North Percy','64669 Stan Knolls Apt. 955\nRippintown, WV 00449',1,33,NULL,''),(26,'Accusantium facilis qui voluptatem.','Quod et autem eius dignissimos aut qui quia. Dolorem reprehenderit et distinctio. Deserunt voluptas accusamus sequi alias alias non animi et.','2024-08-02','13:11:38','West Sunnyborough','93425 Hickle Drive Apt. 263\nAllanton, DE 65237-7670',3,45,NULL,''),(29,'Szemétszedés',NULL,'2024-07-12','16:00:00','Budapest','Hősök tere',0,7,NULL,NULL);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2016_06_01_000001_create_oauth_auth_codes_table',1),(2,'2016_06_01_000002_create_oauth_access_tokens_table',1),(3,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(4,'2016_06_01_000004_create_oauth_clients_table',1),(5,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(6,'2019_12_14_000001_create_personal_access_tokens_table',1),(7,'2024_01_15_150046_create_users_table',1),(8,'2024_01_15_180010_create_dumps_table',1),(9,'2024_03_15_161900_create_events_table',1),(10,'2024_04_15_163854_create_participants_table',1),(11,'2024_05_27_153642_create_assigneds_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `client_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_access_tokens`
--

LOCK TABLES `oauth_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` VALUES ('010b5619cbf8b8f90df5c3812b7c2a4aa3691577659da0f58c23aa0eb082a97d8c1ea0f249d82404',15,1,'authToken','[]',0,'2024-03-11 16:52:20','2024-03-11 16:52:20','2025-03-11 16:52:20'),('049c17a842b21e1996ec63f2f0340ed4dad95b354c194042eff3302becf62c0cb6444ada65abc11b',25,1,'authToken','[]',0,'2024-04-05 15:59:59','2024-04-05 16:00:00','2025-04-05 15:59:59'),('0c7788fbec5845bdc1f6c325fec08f94cd3a8baac7190f7ab0718a643ae44b43291990e77f40b0cd',16,1,'authToken','[]',0,'2024-03-11 16:20:23','2024-03-11 16:20:23','2025-03-11 16:20:23'),('0d5967c27486503d244f80dfccf3b6750ba8a7e8758363f4bd425d6c43880ee5450b59fb72e8d403',27,1,'authToken','[]',0,'2024-04-19 20:09:03','2024-04-19 20:09:03','2025-04-19 20:09:03'),('0ffde28bdcb28abfa012982a6ba2956f496ec3cb0a30909fd29c380b38de88f2329dac4e5e603ca6',5,1,'authToken','[]',0,'2024-03-07 19:03:24','2024-03-07 19:03:24','2025-03-07 19:03:24'),('102e06c482d669a2fd65057e7e6580b4fdb520b75085fec5819df3680e3681f8765911b5553ffbb6',20,1,'authToken','[]',0,'2024-03-12 11:12:31','2024-03-12 11:12:31','2025-03-12 11:12:31'),('130564b25c06eff979d3a31dcb13af5c27c6a826c0820c37f78a4ff8858e99ee5c139909e978f656',23,1,'authToken','[]',0,'2024-04-15 15:03:27','2024-04-15 15:03:27','2025-04-15 15:03:27'),('13e241dd1af26f0040b01d87deb93cfeee4e30ed1b2b086f20032ff135e750665c2e4331378886d7',6,1,'authToken','[]',0,'2024-03-11 16:36:17','2024-03-11 16:36:17','2025-03-11 16:36:17'),('17f589fbab4af9d790201887eff41254520daefb066b0e3e939c4cc045bbf510b9eea464b1d2e194',23,1,'authToken','[]',0,'2024-04-03 20:18:19','2024-04-03 20:18:19','2025-04-03 20:18:19'),('1afd1dc689ca62f18125a6077893a2120cd6cd287504135e4df72b2535a2cf1a5e960149bc0a52ec',3,1,'authToken','[]',0,'2024-03-07 18:38:22','2024-03-07 18:38:22','2025-03-07 18:38:22'),('1f49ada585ff05f32360eaabde6523cc1c0d431f8033fbbfa3a9217df9ff2cbec94f439e9197bae1',26,1,'authToken','[]',0,'2024-04-05 15:55:28','2024-04-05 15:55:28','2025-04-05 15:55:28'),('26c612933290014099b86b97cddd573312a080054ce4cf94b8d4f71772605bec10b0131df8db4ba9',23,1,'authToken','[]',0,'2024-04-04 15:47:40','2024-04-04 15:47:40','2025-04-04 15:47:40'),('2a34a5d9b85856a074c9145ec4b771046a055ee63d995afa8950727cbc04348e89c313ab7709200a',22,1,'authToken','[]',0,'2024-03-19 20:27:46','2024-03-19 20:27:46','2025-03-19 20:27:46'),('2a66cb9ef2803a1ef1799dd3094a218aa9e1fc6cf9270c5970859e12219030c776a5c9161eb669f0',23,1,'authToken','[]',0,'2024-04-20 11:10:24','2024-04-20 11:10:24','2025-04-20 11:10:24'),('2b1acfd3d114486290d1c17ea8e3305a611ddaef2a81ee2b3ea687916bef838a035a21f3414a8a29',23,1,'authToken','[]',0,'2024-03-27 14:28:58','2024-03-27 14:28:58','2025-03-27 14:28:58'),('2bbe31080a1265d80bba29feb48407a8d9538e576cf3a19a3272ba2616940bfd0d78d8cda9e3e64c',21,1,'authToken','[]',0,'2024-03-13 09:04:53','2024-03-13 09:04:53','2025-03-13 09:04:53'),('33eddd64900382ff8ec316341f98d7b988e126f1f9b3e8bab682654f2a936a9a3d3a6d389b7dcfdc',26,1,'authToken','[]',0,'2024-04-05 15:57:42','2024-04-05 15:57:42','2025-04-05 15:57:42'),('3489c72e1ab1a33188c47fed4bbbb95fa29c3fe83669e7dee71d5ff15f23a8be9cf55826418ecc56',23,1,'authToken','[]',0,'2024-04-09 19:38:38','2024-04-09 19:38:38','2025-04-09 19:38:38'),('35e13467fd724981a9fec5268b44d03d8e00358fbc09621d6e1e0d880208cd843bfd2aa45b8218dd',5,1,'authToken','[]',0,'2024-03-07 18:59:06','2024-03-07 18:59:06','2025-03-07 18:59:06'),('35e8a1be9cdbbcd7430258ce6d84b7cd9cb818dad1968c1829f04d01fb45838d1709c65da3b5be33',23,1,'authToken','[]',0,'2024-03-22 17:08:44','2024-03-22 17:08:44','2025-03-22 17:08:44'),('3e39167874776d16cc6f8063a6db5c4d8c141cd645ad2ab43cfc628dbd66dfed7338a1a6ff695c68',20,1,'authToken','[]',0,'2024-03-12 11:04:28','2024-03-12 11:04:28','2025-03-12 11:04:28'),('3f592d048f24ffaa467ebba119f744afd44a169b44b16df81b8d92dde01f1cb11588ac26470451bf',14,1,'authToken','[]',0,'2024-03-11 16:33:14','2024-03-11 16:33:14','2025-03-11 16:33:14'),('40983ef1d8a51dc080d9350364954397b8a2ced9774c7371f2c050bd3d12d2beea1a86d0d0fb0994',23,1,'authToken','[]',0,'2024-04-15 15:37:08','2024-04-15 15:37:08','2025-04-15 15:37:08'),('424672b31dab819dce537d62dd527fab77015835e567d66aa803f21608b010ed972cdda5341eb8bf',23,1,'authToken','[]',0,'2024-03-22 17:09:07','2024-03-22 17:09:08','2025-03-22 17:09:07'),('445e17c221fa00b9715c7aa98c5db03613325b580635bc70cc1fe9a8c5adae81d5c9d46da7b78b88',18,1,'authToken','[]',0,'2024-03-22 17:07:06','2024-03-22 17:07:06','2025-03-22 17:07:06'),('47a4133b7430e8cbae58e39ac78a8f35fbf2f3ea398199bfc80e5123b13dbe2bb3ede5a88b5c4b49',18,1,'authToken','[]',0,'2024-03-22 17:02:11','2024-03-22 17:02:11','2025-03-22 17:02:11'),('485db21c423138a1a5708b8cafec081d79c8fae669623863f68ee86c4efc559aa8bb9eab5c98c5a9',22,1,'authToken','[]',0,'2024-03-22 17:05:54','2024-03-22 17:05:54','2025-03-22 17:05:54'),('4afc9a543dd789a6f6d73e9799828a36fa8cac2480cd404b9fcafb3b38d0a6a50f24d5da1c53577c',20,1,'authToken','[]',0,'2024-03-12 11:03:29','2024-03-12 11:03:29','2025-03-12 11:03:29'),('4bdee8fcb0d3e96c416b8ec00108638be59900ada70216c96f973f1b2c757f3d884e686749fb3f2a',27,1,'authToken','[]',0,'2024-04-19 19:10:05','2024-04-19 19:10:05','2025-04-19 19:10:05'),('4e019d688603c6e553b1db1dfdcdcc48af60ca58de8cb071aca43dc3bbd66c907d57ad81b4fddf51',23,1,'authToken','[]',0,'2024-04-15 15:11:50','2024-04-15 15:11:50','2025-04-15 15:11:50'),('506059e539e6f427dbfe1ee3c688a42d03c781d726b7815f4a5dff9fb036b9c1eaf9d7529c4800be',23,1,'authToken','[]',0,'2024-04-11 15:09:24','2024-04-11 15:09:24','2025-04-11 15:09:24'),('51bf468bc5e999be26b5600ec90dbbbd0209286bb1021179b87a7f0e3f15a3e44a6f9f38a3ecbf77',18,1,'authToken','[]',0,'2024-03-11 16:35:11','2024-03-11 16:35:11','2025-03-11 16:35:11'),('520d701749d40a1297473ae4c6c6b48d2af435edfec52052ede67490ac6ea5a88b89c723b7c5cd21',27,1,'authToken','[]',0,'2024-04-11 15:12:07','2024-04-11 15:12:07','2025-04-11 15:12:07'),('5238f5a20f8ed736fff7ac106e141919ca40a0ec55134b00ba1ecb1d2f4bc86071a10607e970fea1',23,1,'authToken','[]',0,'2024-04-20 10:52:10','2024-04-20 10:52:10','2025-04-20 10:52:10'),('55aa4e6698bda4fc1415feb0add6d4ba6f8aa1340f74e0c663340c47fab833c5f192cd4ae94eb7fe',13,1,'authToken','[]',0,'2024-03-11 16:50:44','2024-03-11 16:50:45','2025-03-11 16:50:44'),('560fb7bc313ca07a56b6d02effacdac486e5f16dc2c60babe2a673cff7aee67edcd9f923890de274',7,1,'authToken','[]',0,'2024-03-11 16:10:16','2024-03-11 16:10:16','2025-03-11 16:10:16'),('5a59e6d90e9dd1c667c18853d4bf3479c59d0fa59b9cfcbc2ee3e48e9ae94b5aba4047d1c6f3afae',11,1,'authToken','[]',0,'2024-03-11 16:31:09','2024-03-11 16:31:09','2025-03-11 16:31:09'),('5e08d6f2a3154d88240fef9b5ad3db083f9c23d1d8984e2a75add55e8beb13a6a0d28937831cca32',23,1,'authToken','[]',0,'2024-04-19 20:18:24','2024-04-19 20:18:24','2025-04-19 20:18:24'),('5ea78b3b039def6bf628bc8721716f7c5d6c904b3d194c392a981c279930851d663a1875794d2f33',18,1,'authToken','[]',0,'2024-03-22 17:00:36','2024-03-22 17:00:36','2025-03-22 17:00:36'),('5ed984d68f1bd35e25419c5b1740d6b717f58b0ef56fe6803ca8c9922e01de47012233bd3cb23fc1',23,1,'authToken','[]',0,'2024-04-15 15:49:42','2024-04-15 15:49:42','2025-04-15 15:49:42'),('5f00868df9681c907ba11f1d78bdae8ac75db3118bbe08d7b9c8fd69c9f6f137c10d80a1ca11d4e7',23,1,'authToken','[]',0,'2024-04-04 15:49:37','2024-04-04 15:49:37','2025-04-04 15:49:37'),('5fa24a04617515c036a30e2d4519263413a921c9b7056c2059e0371c8f0eb7de119cde4978c1ad40',4,1,'authToken','[]',0,'2024-03-07 18:47:12','2024-03-07 18:47:12','2025-03-07 18:47:12'),('647f20ba260c6e8aacf59b3cb8ee880dbad8bf91acc3b5a20501497d17330ce14285b9b8ecb12a54',23,1,'authToken','[]',0,'2024-04-19 18:42:02','2024-04-19 18:42:03','2025-04-19 18:42:02'),('68ec20ff4b361e8797ab1caaed9239c5a1045d23f50528ab3c28026950e83c70e92c44583a960d9a',27,1,'authToken','[]',0,'2024-04-15 15:58:38','2024-04-15 15:58:38','2025-04-15 15:58:38'),('6b22520bc1a0fd221c3542f1a3f7b08a96f7ebb499d6b1dcd3559a1e8fd39346625851e5d0411f3e',6,1,'authToken','[]',0,'2024-03-11 16:09:06','2024-03-11 16:09:06','2025-03-11 16:09:06'),('6d43da23823f0812d0cbe292463779cfceea93148ab6f79ff23aa5ee2f87919e7bf57fec93d4785b',18,1,'authToken','[]',0,'2024-03-22 16:49:37','2024-03-22 16:49:37','2025-03-22 16:49:37'),('6e3941916571f420bdd69c1a096ea60e14ea64a7200e0027fbdfb8ce45b718f6b549ed7903a06f08',5,1,'authToken','[]',0,'2024-03-07 18:55:39','2024-03-07 18:55:39','2025-03-07 18:55:39'),('6e5c94161f9a7439e0dd64142c0046266dac9a034f1e1eae2b8e02b8d0b88d6a05300b799b912ab9',22,1,'authToken','[]',0,'2024-03-19 20:27:27','2024-03-19 20:27:27','2025-03-19 20:27:27'),('752a72bea9a0bd93f7088b39b4f6962c5929ea35ff1cdbaac6fc350a3c48ea8019bc358d7fce1060',9,1,'authToken','[]',0,'2024-03-11 16:11:55','2024-03-11 16:11:55','2025-03-11 16:11:55'),('753c8ddf3123276a7d083661c2469ff305027366f13050b33e94c8bfc24ab389d458ea1c730a0ef7',23,1,'authToken','[]',0,'2024-04-09 18:42:29','2024-04-09 18:42:29','2025-04-09 18:42:29'),('79153c600d8aef60ff587df35d572f5dc1cd2d0af2bd668ee9996e4e6b42d3aff705e5aa87fd6c28',6,1,'authToken','[]',0,'2024-03-12 10:56:41','2024-03-12 10:56:41','2025-03-12 10:56:41'),('7bc88599445d3c9f97168acb911799896355ac9153221e1a725b2155cfeb7b1ade8030efe6661bef',23,1,'authToken','[]',0,'2024-03-27 14:33:47','2024-03-27 14:33:47','2025-03-27 14:33:47'),('7cf36aa51efd8fce6e3bfc6d26cc34a23d6d31db7c552e1753e599317922a8eefa71e99b77f9ccdd',23,1,'authToken','[]',0,'2024-04-19 18:29:13','2024-04-19 18:29:14','2025-04-19 18:29:13'),('825c13ee1c0d053243aacb8811ba75e98f362e08f9aead84ea4ab54790d159ac22c67921e8f06784',23,1,'authToken','[]',0,'2024-03-22 17:12:56','2024-03-22 17:12:56','2025-03-22 17:12:56'),('82e8e6b92fe3f07ca70702f833a12181a20764bc8b7229e1731c1ccdeab0d186b116b4bd64505e9b',23,1,'authToken','[]',0,'2024-04-17 12:31:22','2024-04-17 12:31:23','2025-04-17 12:31:22'),('8b68cf207b6436a4383dd83a7f40e85f0fb6c5e5a74806645a3b6217ca245ea8a06be366d5500327',2,1,'authToken','[]',0,'2024-03-07 18:14:26','2024-03-07 18:14:26','2025-03-07 18:14:26'),('8b79e8bfa8bb80b168825c5f57f78b8d213bf8ae0034d0e29ee21f103497527a3710a5632efb4af9',19,1,'authToken','[]',0,'2024-03-13 09:03:34','2024-03-13 09:03:34','2025-03-13 09:03:34'),('8b7a30c9db89be11948453be24faae74b46c6d239bafe823bbc5a93d81122217de9bfa79e5213add',26,1,'authToken','[]',0,'2024-04-05 15:54:33','2024-04-05 15:54:33','2025-04-05 15:54:33'),('90a91b6673a61fe1539f55bc7814fb9bbec5651c81d0f96d72b87be061f9ba916d02b308adfbcae2',23,1,'authToken','[]',0,'2024-04-19 20:09:04','2024-04-19 20:09:04','2025-04-19 20:09:04'),('90b2b6bc75faec13ebcf7c87a80925777e6d3c9bcbc4600be3b01654fa0848b5f29c9781fd21a356',23,1,'authToken','[]',0,'2024-04-04 15:57:22','2024-04-04 15:57:22','2025-04-04 15:57:22'),('91a67f96236e710ff1e42988653c7b3d5d25294475f3236fdf13f6d8f0d52cbb54a31ea71acaa543',23,1,'authToken','[]',0,'2024-04-20 11:08:57','2024-04-20 11:08:57','2025-04-20 11:08:57'),('9328fbc81a7e707b68996a36722b13031e896af405d3f050d472a28d1f365f507d15371c86169f4f',23,1,'authToken','[]',0,'2024-04-04 15:37:28','2024-04-04 15:37:28','2025-04-04 15:37:28'),('934e98b6aa9f7758aea6cb60a3ee495b371fbb9ec78f41c8fd189c764fad52e5678627a0e6b42426',9,1,'authToken','[]',0,'2024-03-11 16:30:37','2024-03-11 16:30:37','2025-03-11 16:30:37'),('94ab1715b85d5d948b19ed4a3bcead77837b0f3df5266a3166eaca102ff2ae7218cd9d6d94b5178e',18,1,'authToken','[]',0,'2024-03-11 16:35:28','2024-03-11 16:35:28','2025-03-11 16:35:28'),('94eba47ae5af2b82d43a2b47b33812c9a6270d4f0145b22e63428edf7eb9c65bd9f756c819f11ee0',5,1,'authToken','[]',0,'2024-03-07 19:02:44','2024-03-07 19:02:44','2025-03-07 19:02:44'),('a27ecf4804d266313f8865c37fa4968dc407b1e34b01957241de937a1034c732056b4287c2610885',23,1,'authToken','[]',0,'2024-04-15 15:03:19','2024-04-15 15:03:20','2025-04-15 15:03:19'),('a556a86696715b7f3fa3655f55cdf921185573d5f5f4d7b8f07daf5866d8df04c757613e265f34d5',27,1,'authToken','[]',0,'2024-04-19 19:06:43','2024-04-19 19:07:02','2025-04-19 19:06:43'),('a582db1766a587233fce58f71c68ce66ba402e8f08e0fb35cb944946b8194480b3ce90af7b7c20bc',12,1,'authToken','[]',0,'2024-03-27 14:32:50','2024-03-27 14:32:50','2025-03-27 14:32:50'),('a6675db5c710b9f3740539db628b1a473d4aa0b9275d778460ba8c90fee429169be13440a21c0423',6,1,'authToken','[]',0,'2024-03-11 16:26:19','2024-03-11 16:26:19','2025-03-11 16:26:19'),('a8e3705e84a4fade37e975df29445c60ef1e2ae37e356fde2c0cd60a6480dafc4c9c902e68b16586',14,1,'authToken','[]',0,'2024-03-11 16:17:58','2024-03-11 16:17:58','2025-03-11 16:17:58'),('ac198135b9b096f2ee57ef440c83d3b1f8709574c14b92b40623ecf9955f93d54409d9bc4f770c36',19,1,'authToken','[]',0,'2024-03-12 11:01:37','2024-03-12 11:01:37','2025-03-12 11:01:37'),('b0f6446e69fffc6166a2780fd55676eef777906f80a2c548e8dc1454c601a42812debaba31dcf81a',21,1,'authToken','[]',0,'2024-03-13 09:16:07','2024-03-13 09:16:07','2025-03-13 09:16:07'),('b13c40c0b96fa73bc6f75180ca36f631a93aac7981dd48bd623938288d9925ad417f0094dd7baee1',18,1,'authToken','[]',0,'2024-03-22 17:05:25','2024-03-22 17:05:25','2025-03-22 17:05:25'),('b33a7390472ac795e0169e3bd91260d680b0aa5a5bf9de09664352ebecd591e0254ec520fb71e4ec',17,1,'authToken','[]',0,'2024-03-11 16:21:59','2024-03-11 16:21:59','2025-03-11 16:21:59'),('b48cd50e83927678876093bc59178d8732a0a65d5a291b6a7b72512a8ca0a49bedd3fade0768ecc7',19,1,'authToken','[]',0,'2024-03-12 11:02:05','2024-03-12 11:02:05','2025-03-12 11:02:05'),('b82df1085f0128c905e8d8a669f339a5d25c6169be081279c181e5a471d4447e5b2c50ee6d962731',13,1,'authToken','[]',0,'2024-03-11 16:16:27','2024-03-11 16:16:28','2025-03-11 16:16:27'),('b954d696a73bb09a04943f6bece9309472032a294ab424e3c447a8fd1fdc921999fcb2cbe8da7cd9',18,1,'authToken','[]',0,'2024-03-22 16:52:41','2024-03-22 16:52:41','2025-03-22 16:52:41'),('bec6d29a9d8447bb00dde2e0b666b1898cb521298f22b2d9e47ee149f97259dfd3a586c557d16a92',27,1,'authToken','[]',0,'2024-04-05 16:01:01','2024-04-05 16:01:01','2025-04-05 16:01:01'),('bed2cb0b109a4655d298b3dae07af69bb5b5280945223b40b8f17ebc2cb631c3a29209eb71f655ae',2,1,'authToken','[]',0,'2024-03-07 18:03:39','2024-03-07 18:03:39','2025-03-07 18:03:39'),('bffa9fc25c0f1817a4aac13fe71c2865426a7a21f1aa0169b2304caf7b1661123ba18b86f763d602',1,1,'authToken','[]',0,'2024-03-07 17:58:55','2024-03-07 17:58:56','2025-03-07 17:58:55'),('c517894895abd8ec6fddae930af8080c1627fcbac5e66d38e4970efdbbcbf4435a6dc94bcb2f9977',16,1,'authToken','[]',0,'2024-03-27 14:26:59','2024-03-27 14:26:59','2025-03-27 14:26:59'),('c7c3d457ff91e03772acb47bc0327f8592ab850d465605f516a22c4fd47cc8694d48882f218e2395',25,1,'authToken','[]',0,'2024-04-05 15:46:39','2024-04-05 15:46:39','2025-04-05 15:46:39'),('ca22d0eff05e899dfa47b3220ae463ecefd6d55a73718172ab10ae86eeb4cddddc4b5161ac6689ba',12,1,'authToken','[]',0,'2024-03-11 16:16:04','2024-03-11 16:16:04','2025-03-11 16:16:04'),('caf6ed885a4c212fddda80a2edbc88b35765ad15d2e682be7909ddadb7f1b6174540c4b02821e409',27,1,'authToken','[]',0,'2024-04-11 15:11:40','2024-04-11 15:11:40','2025-04-11 15:11:40'),('cb44d7231291ad635e5dfa97f50f6b8c8646ea3326e09ddad67a12d76c07756927a7de160177590d',18,1,'authToken','[]',0,'2024-03-22 17:11:20','2024-03-22 17:11:20','2025-03-22 17:11:20'),('cb9dbd1d903f3c35ddaff34874144c792d24f23345d0c4993126654632fde0cb36151546aae88c32',23,1,'authToken','[]',0,'2024-03-27 14:25:53','2024-03-27 14:25:53','2025-03-27 14:25:53'),('ce3370259a1061ff00a75e155e582bd92bdbde12111063313066af800ec3e2cb65e52e27eea44794',16,1,'authToken','[]',0,'2024-03-11 16:47:59','2024-03-11 16:48:00','2025-03-11 16:47:59'),('d5f4b2edf290d2fa1eb615027b160add46d8cea0504a6b66f5a67c25387872b5bbdf5fefa8b50d26',5,1,'authToken','[]',0,'2024-03-07 18:56:05','2024-03-07 18:56:05','2025-03-07 18:56:05'),('db3170dcee92ff824e8dec23bc25b8470bba40fc65ff51cbaca027ff6d113bc0d12f44337e9727be',22,1,'authToken','[]',0,'2024-03-22 17:07:32','2024-03-22 17:07:32','2025-03-22 17:07:32'),('dca3ea2dea9f0e523b8bff01df12321a679166645bd96068ee9b09615ce1d5ddbeb9a3850364f144',8,1,'authToken','[]',0,'2024-03-11 16:11:32','2024-03-11 16:11:32','2025-03-11 16:11:32'),('e17544f721248b41fe966792ebfa0280b397ad989f8a09be947558c9bca51eaf3fb275476f17b316',21,1,'authToken','[]',0,'2024-03-13 09:16:57','2024-03-13 09:16:57','2025-03-13 09:16:57'),('e4a19c8ed58e637da7711a89e9efcbdb717e7f7b677e0cc4b33b31c963719226b63072289f384db7',11,1,'authToken','[]',0,'2024-03-11 16:15:31','2024-03-11 16:15:31','2025-03-11 16:15:31'),('e4c2d4d7f7b5dfdb11d8fe2c894667095ceb6d970bf54c64d1f70484cbdcd0f27207f97bb845c659',10,1,'authToken','[]',0,'2024-03-27 14:28:19','2024-03-27 14:28:19','2025-03-27 14:28:19'),('e5f2021612902727264efa835947f4d99d72c4084de4cf665fb81869bf5f847792e87551307f351e',18,1,'authToken','[]',0,'2024-03-22 17:03:27','2024-03-22 17:03:27','2025-03-22 17:03:27'),('e7f5fe2693ecdea6e104f0a8e6729b305f7e30cb652e4ac7cd93b426faf8283586feea3207d916fb',24,1,'authToken','[]',0,'2024-04-05 15:45:14','2024-04-05 15:45:14','2025-04-05 15:45:14'),('e8c4cf35614d08ae0683bbcd407fc39d59d1fb49255ca3b059490cabd466d10840f97a1dede064a0',18,1,'authToken','[]',0,'2024-03-22 16:52:22','2024-03-22 16:52:22','2025-03-22 16:52:22'),('ed5174c0446e5c3b41d0be3f733d22e8a22022762d18eeea0f767af19c4725dcf79ccaa7c66e3d9c',23,1,'authToken','[]',0,'2024-04-15 16:35:12','2024-04-15 16:35:12','2025-04-15 16:35:12'),('edc2d373fcd799c8bf13c7f61d2e8b782c777af36b7eb06edccec0b240ecbdbf7638d65bcc37a48e',27,1,'authToken','[]',0,'2024-04-05 16:02:19','2024-04-05 16:02:20','2025-04-05 16:02:19'),('edfced538fb0536a0ecd6ea1062003d061618a2001dd6efc1777ef55a938e6c313ed01621e93f6a8',23,1,'authToken','[]',0,'2024-04-17 11:19:05','2024-04-17 11:19:05','2025-04-17 11:19:05'),('f2c2feb07ceea64f03bc36d606585a218d2d2c5fb2c02212ac853583fd589df4b761f373c10f5d91',18,1,'authToken','[]',0,'2024-04-05 15:53:39','2024-04-05 15:53:40','2025-04-05 15:53:39'),('f42abe43d21bf8c4511f0473a59e5b4ea300951fb470134338c390f47467d3b7d1de5788a6df5bb6',10,1,'authToken','[]',0,'2024-03-11 16:14:44','2024-03-11 16:14:44','2025-03-11 16:14:44'),('f69b2fad04253215f5e50ee4fbe0097b7e2861b292462c35c42c37073344ca6b206e42c20bc03678',2,1,'authToken','[]',0,'2024-03-07 18:03:15','2024-03-07 18:03:15','2025-03-07 18:03:15'),('f71aa9fb38f8a6052496e0cd98e303dba67958b281c3455e7860777f28f8758078179735450a0b99',23,1,'authToken','[]',0,'2024-04-09 19:41:04','2024-04-09 19:41:04','2025-04-09 19:41:04'),('f75af8022c9d1def9ef5b82bce17f5ed731840072c64ecf2a4db6a90ffa93357030b705ed0510084',24,1,'authToken','[]',0,'2024-04-05 16:03:52','2024-04-05 16:03:53','2025-04-05 16:03:52'),('f81be1231a6e985cdccf30681b43db684c358261ff130892e918fdf98316d0450f8027ba50cd8b24',18,1,'authToken','[]',0,'2024-03-22 17:11:47','2024-03-22 17:11:47','2025-03-22 17:11:47'),('faa2e7a43dcb270bfe75d05877956d7fbf6fefaeb1e8810bd48408fe001f00b227c9ac7a3a943933',18,1,'authToken','[]',0,'2024-04-05 15:53:24','2024-04-05 15:53:24','2025-04-05 15:53:24'),('fd261f514cd1bc449a2ca21b0908f33c12569e04e4570f904fcc989484d6ca8e4b3d0605c8fed6a0',23,1,'authToken','[]',0,'2024-04-15 16:57:57','2024-04-15 16:57:57','2025-04-15 16:57:57'),('fe78a67b42f0057ee59028a0dacd16ccedf64db0fe2ee3f749f8dee50440a2d9684ba62ed3a2f6e5',15,1,'authToken','[]',0,'2024-03-11 16:19:35','2024-03-11 16:19:35','2025-03-11 16:19:35');
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `client_id` bigint unsigned NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_auth_codes`
--

LOCK TABLES `oauth_auth_codes` WRITE;
/*!40000 ALTER TABLE `oauth_auth_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_auth_codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_clients`
--

LOCK TABLES `oauth_clients` WRITE;
/*!40000 ALTER TABLE `oauth_clients` DISABLE KEYS */;
INSERT INTO `oauth_clients` VALUES (1,NULL,'auth','StP2rTrgD5fZANnJSIYOtgDXNCHPYQd1CNAi3Bcl',NULL,'http://localhost',1,0,0,'2024-03-07 17:58:47','2024-03-07 17:58:47');
/*!40000 ALTER TABLE `oauth_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `client_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_personal_access_clients`
--

LOCK TABLES `oauth_personal_access_clients` WRITE;
/*!40000 ALTER TABLE `oauth_personal_access_clients` DISABLE KEYS */;
INSERT INTO `oauth_personal_access_clients` VALUES (1,1,'2024-03-07 17:58:48','2024-03-07 17:58:48');
/*!40000 ALTER TABLE `oauth_personal_access_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth_refresh_tokens`
--

LOCK TABLES `oauth_refresh_tokens` WRITE;
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participants` (
  `eventId` bigint unsigned NOT NULL,
  `userId` bigint unsigned NOT NULL,
  PRIMARY KEY (`eventId`,`userId`),
  KEY `participants_userid_foreign` (`userId`),
  CONSTRAINT `participants_eventid_foreign` FOREIGN KEY (`eventId`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `participants_userid_foreign` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participants`
--

LOCK TABLES `participants` WRITE;
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
INSERT INTO `participants` VALUES (26,8),(20,9),(8,10),(22,10),(8,13),(8,15),(16,15),(24,15),(8,16),(24,16),(17,17),(18,18),(23,18),(17,20),(24,20),(15,23),(16,24),(22,24),(26,24),(15,25),(15,26),(24,26),(25,26),(22,29),(26,30),(16,31),(19,31),(23,34),(23,36),(20,37),(15,39),(20,39),(16,40),(20,41),(19,43),(15,46),(23,47);
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `profilePictureURL` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pictures/no-profile-picture.jpg',
  `verificationToken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isVerified` tinyint(1) NOT NULL DEFAULT '0',
  `passwordResetToken` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (7,'K.Isti','kovacsistvan@mail.com','Kecskemét','$2y$12$TKehjyg8ByQ7kyDLMmUiWO8mPMGkckJ1P5VqL5MzuKRFjXh5vwm3u','pictures/no-profile-picture.jpg',NULL,1,NULL),(8,'Eszter','eszter@gmail.com','Debrecen','$2y$12$S5iE/F/LkKlqTlfh4oPYwuMewemIa2hZgEVMzDlSfstBNhIXscvs6','pictures/no-profile-picture.jpg',NULL,1,NULL),(9,'Lacika','laci@gmail.com','Győr','$2y$12$H00d6Z7QgiddYD7DmzzowuQP2qT7Viw99VtRAwF.yKfinVcctOktu','pictures/no-profile-picture.jpg',NULL,1,NULL),(10,'Pityesz','pityeszke@freemail.hu','Budapest','$2y$12$Q/GwDuLa5/N7kR7mg/aOJeCHstMK.9/e.UWpP8u45NOR.zq2IE7y2','pictures/no-profile-picture.jpg',NULL,1,NULL),(11,'Zsolti','zsolt@mail.com','Győr','$2y$12$Z2TI4JWe3U2R2xQycT/8eeDIpG2OA0UFI1G7nQ9s1gnDSgx4mN7Ly','https://trashbusters.s3.eu-central-1.amazonaws.com/profile-pictures/1710171169_howto-resize-pixel-art-photoshop-f.png',NULL,1,NULL),(12,'vargazsofi','vzsofi@gmail.com','Kecskemét','$2y$12$XWh1TYYY17Bs1MSxSNuRkevuq2bvmZQ0het8OK383P95.I/ZefBN6','pictures/no-profile-picture.jpg',NULL,1,NULL),(13,'tibitoth','tothtibor@mail.com','Budapest','$2y$12$Nl5qPfvqZiFvnwLAkEIscuP/gSlOvlMAZ4efVyBCh0EQE4b6eyFOW','https://trashbusters.s3.eu-central-1.amazonaws.com/profile-pictures/1710172281_Cross-section-image-of-size-250-by-250-pixels.png',NULL,1,NULL),(14,'Markusz1','markusz@gmail.com','Győr','$2y$12$hYGthIIfYUpAv4b2iqt5cOm1BnE2VBsVcGVTQCeZfcc9mfMweVkM2','https://trashbusters.s3.eu-central-1.amazonaws.com/profile-pictures/1710171277_pride-aces-symbol-250x250.jpg',NULL,1,NULL),(15,'.anna.','anna@gmail.com','Pomáz','$2y$12$K7OhK9LfvLMh3mJ4b8A.6uoZtUDr1gnOpyuL5rCxi576eYPNrICRC','pictures/no-profile-picture.jpg',NULL,1,NULL),(16,'Varga Kornél','kv@mail.hu','Budapest','$2y$12$JOVetWvTprtbdwuwm40/ouS3ajCQ386SbHoga2psva/vOXdbIkfSy','pictures/no-profile-picture.jpg',NULL,1,NULL),(17,'CsongI','cs0ng0r@gmail.com','Kecskemét','$2y$12$TXlDdq1mWnnt5ARnuhwKA.TUTpWFX5NXSP0Q9EyvD4jsDwVESNZQm','pictures/no-profile-picture.jpg',NULL,1,NULL),(18,'TomTom','tomi@mail.com','Győr','$2y$12$01nqo4o6YY.owJQ29kLoHugDMjERft6LgNTYN9VyaGyGZhwpro85u','pictures/no-profile-picture.jpg',NULL,1,NULL),(20,'GKDávid','geresmithdavid@gmail.com','Pázmándfalu','$2y$12$ed668kKn8CCVyhVo8Y.HoOq9.SCfokKNchseUinXP5UFmXtQWzy9i','https://trashbusters.s3.eu-central-1.amazonaws.com/profile-pictures/1710239351_hydro2.jpeg',NULL,1,NULL),(23,'Geri14','horvathgergo1208@gmail.com','Győr','$2y$12$YBI8N7r/J9p7dNDS6ooQnOLkGTyTI4C8ff/3fhQ8L2Z/MWOw84v1a','https://trashbusters.s3.eu-central-1.amazonaws.com/profile-pictures/1712681043_St_George_Cross_250x250.png',NULL,1,NULL),(24,'AsdMan','asder@mail.com','Pécs','$2y$12$1W1zOmrQiVqBR5MLzrEa2.sksG0L0SiTR04GW1KeNwUaOPCP62c/G','pictures/no-profile-picture.jpg',NULL,1,NULL),(25,'_mylan_','mylan@mail.com','Tatabánya','$2y$12$DukityeHWFXcf6jW9pES.OHkYjhHwuRWu7DglSamB4X/k0Uk1OnUq','pictures/no-profile-picture.jpg',NULL,1,NULL),(26,'Levi\'s','levi@mail.hu','Mosonmagyaróvár','$2y$12$4PA4f/xWWD7GH8Cm7FTaWugmm2kaEna6YrfaNCBzoPaYO7Z6rq4dO','pictures/no-profile-picture.jpg',NULL,1,NULL),(27,'testuser','testuser@mail.com','Budapest','$2y$12$5Auv.iGxkdPgy.I1yOrfOOa7gnTnrp5LcpicTpBdYeEgwEFd5y/MC','pictures/no-profile-picture.jpg',NULL,1,NULL),(28,'whudson','adella.towne@example.com','Rueckerfurt','$2y$12$j2r1piaKoJQnUZMtAgQalONXxplf35W0b1/euAJCN/gyG9ealV/Mq','pictures/no-profile-picture.jpg',NULL,1,NULL),(29,'nwunsch','lesch.walton@example.org','Bruenton','$2y$12$1sGMcjREMCyzIIu8owwyP.85rXZXkH3atiQNazz9.aT9GkbewQ6lC','pictures/no-profile-picture.jpg',NULL,1,NULL),(30,'bradley.boehm','gunner15@example.net','Treutelfurt','$2y$12$6UAdj.EREEPfUWXuFLvblOSLYZGLfyhxZUyBV2ltZ/WVmC.e67YRi','pictures/no-profile-picture.jpg',NULL,1,NULL),(31,'hkuhlman','cassie08@example.org','Lake Vallie','$2y$12$7MNdowqECEjB3MJdkRsBFOt.PkNHr/Uf4Z0olSTD/8v78NxhpAuAC','pictures/no-profile-picture.jpg',NULL,1,NULL),(32,'rbuckridge','herman.chelsie@example.com','North Jadonland','$2y$12$m2t7b.WPnKospbRnss8I6OA9HMdX5QsVGSoW9tqUXDGZHaD9eWHUu','pictures/no-profile-picture.jpg',NULL,1,NULL),(33,'vmarquardt','lori.torp@example.com','Port Burnicehaven','$2y$12$ZPBVW0sIMPmj9kDi0rITYuqlDNMsNxBXa.2u/kXRWdBZhN67d7.JK','pictures/no-profile-picture.jpg',NULL,1,NULL),(34,'trantow.berta','delta78@example.net','Port Kenton','$2y$12$SL4mVb4pgA5S9z6SrqppxeK7EZu5ZyluSTPw5.AEnuMUgnzEO3S52','pictures/no-profile-picture.jpg',NULL,1,NULL),(35,'uboyer','dsporer@example.net','West Jairoberg','$2y$12$TFLryN4Ii6JgId4d5WKeXuB4aLH/641Dsw81gJ2dRH4DvG4qR9IoO','pictures/no-profile-picture.jpg',NULL,1,NULL),(36,'alayna.kemmer','clifton.wisozk@example.com','West Brando','$2y$12$oxucXsBTEz.WcXTzZHjkWuJErBfY1FoRbXSiiVVhWqwyQCq7DrsUG','pictures/no-profile-picture.jpg',NULL,1,NULL),(37,'nikolaus.agnes','marianne.williamson@example.net','New Triston','$2y$12$I1cbLYj7f/WN0KF7mDUWQONb5vrAYaeP.gv9CCTc5tw4SNUdHiyyC','pictures/no-profile-picture.jpg',NULL,1,NULL),(38,'jruecker','eldridge52@example.com','Brakusland','$2y$12$UJ1zTOjZQDmV0.mICZxQ/eGqUI3ItymCgAiRjG8nDcqfb8Q6X2Jti','pictures/no-profile-picture.jpg',NULL,1,NULL),(39,'rmacejkovic','powlowski.sonya@example.org','Barrowsland','$2y$12$QSotAe50Qct8TM6p7lZvFupFYC6PP7Q0g0fkLkaJaz1Odsp.MvCXG','pictures/no-profile-picture.jpg',NULL,1,NULL),(40,'alfonzo.beahan','emmie45@example.net','South Wade','$2y$12$/Vso3KNgMDPVFURlQQFFL.auxPDS4OspcLkIaOC8RgoUszT5pkMaa','pictures/no-profile-picture.jpg',NULL,1,NULL),(41,'jessyca56','ethiel@example.net','Andreburgh','$2y$12$kPHllckhqT92AJATx4X9xec9U4bQ7hRSJWn0xyyNrTDFpRnK69SJO','pictures/no-profile-picture.jpg',NULL,1,NULL),(42,'tnader','gmurazik@example.com','Ortizview','$2y$12$EewaPUP./r5.WjeT9Eh1Ue3Yn48sk/ob5nquZzV4uV2xlpuNAbwqy','pictures/no-profile-picture.jpg',NULL,1,NULL),(43,'collier.madilyn','ukoepp@example.org','Port Salliehaven','$2y$12$x/TnnpcUGNhBhDUwKQat8OE7PdUYMDjza8BoVoSqYIeLJvCofb6OS','pictures/no-profile-picture.jpg',NULL,1,NULL),(44,'alexa44','samanta65@example.com','Lake Lionelchester','$2y$12$Xkkb0TQwoxDfy9H3lfmDzeeTnqNPgT72AFQ8hgFZUa8QW5yZq/52W','pictures/no-profile-picture.jpg',NULL,1,NULL),(45,'emmie11','jordon.williamson@example.net','Mooreland','$2y$12$P75HJJZpkR5FMqyr3DHdCeuuAo2Uz5etHWba6RLrMLUIpR0tQwVn6','pictures/no-profile-picture.jpg',NULL,1,NULL),(46,'anjali.pollich','mayer.monique@example.com','Gleasonmouth','$2y$12$ya8EfeJ7oT7f5oGRuJPno.lSplUzM.v18wPhR/4QapKPxTGOMRAG2','pictures/no-profile-picture.jpg',NULL,1,NULL),(47,'gwendolyn.rutherford','katlyn43@example.org','Shanyport','$2y$12$Go0NN2uy9axXBVugUeI9p.BVU3Y1HOC7LrKLi.zDtBMphfz9ZliTy','pictures/no-profile-picture.jpg',NULL,1,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
SET @@SESSION.SQL_LOG_BIN = @MYSQLDUMP_TEMP_LOG_BIN;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-20 12:37:50
