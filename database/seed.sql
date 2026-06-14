/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-11.8.5-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: wilcorrected
-- ------------------------------------------------------
-- Server version	11.8.5-MariaDB-3 from Debian

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `amenities`
--

DROP TABLE IF EXISTS `amenities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `amenities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `icon` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amenities`
--

LOCK TABLES `amenities` WRITE;
/*!40000 ALTER TABLE `amenities` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `amenities` VALUES
(1,'fas fa-swimmer','4 Swimming Pools','Four beautifully maintained pools surrounded by tropical gardens.',1,1,'2026-06-15 03:37:42','2026-06-15 03:37:42'),
(2,'fas fa-shield-alt','24/7 Security','Gated entry with round-the-clock security personnel.',2,1,'2026-06-15 03:37:42','2026-06-15 03:37:42'),
(3,'fas fa-leaf','Tropical Gardens','Lush walkways and mature landscaping throughout the complex.',3,1,'2026-06-15 03:37:42','2026-06-15 03:37:42'),
(4,'fas fa-car','Owner Parking','Dedicated parking space included with the unit.',4,1,'2026-06-15 03:37:42','2026-06-15 03:37:42'),
(5,'fas fa-umbrella-beach','Direct Beach Access','Private back gate opens onto the sand.',5,1,'2026-06-15 03:37:42','2026-06-15 03:37:42'),
(6,'fas fa-sun','Sunset Views','Incredible Pacific sunsets from the complex.',6,1,'2026-06-15 03:37:42','2026-06-15 03:37:42');
/*!40000 ALTER TABLE `amenities` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `articles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `source` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `url` varchar(500) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `articles`
--

LOCK TABLES `articles` WRITE;
/*!40000 ALTER TABLE `articles` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `articles` VALUES
(1,'National Geographic','Costa Rica: The Happiest Country in the World','An in-depth look at Costa Rica top ranking on the World Happiness Index.','https://www.nationalgeographic.com/magazine/article/worlds-happiest-places',1,1,'2026-06-15 03:32:57','2026-06-15 03:32:57'),
(2,'Lonely Planet','Discover Jaco, Costa Rica','Your guide to Jaco beaches, surf culture, dining, and nightlife.','https://www.lonelyplanet.com/costa-rica/central-pacific-coast/jaco',2,1,'2026-06-15 03:32:57','2026-06-15 03:32:57'),
(3,'Travel + Leisure','Costa Rica: The Ultimate Wellness Destination','Why Costa Rica Pura Vida lifestyle makes it a top travel destination.','https://www.travelandleisure.com/travel-guide/costa-rica',3,1,'2026-06-15 03:32:57','2026-06-15 03:32:57');
/*!40000 ALTER TABLE `articles` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `gallery_images`
--

DROP TABLE IF EXISTS `gallery_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `gallery_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `image_path` varchar(255) NOT NULL,
  `alt_text` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gallery_images`
--

LOCK TABLES `gallery_images` WRITE;
/*!40000 ALTER TABLE `gallery_images` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `gallery_images` VALUES
(4,'/lp-photos/pool.jpeg','Pool area at La Paloma Blanca',3,1,'2026-06-15 04:12:06','2026-06-15 04:14:15'),
(5,'/lp-photos/rancho.jpeg','Rancho outdoor area',2,1,'2026-06-15 04:12:06','2026-06-15 04:13:56'),
(6,'/lp-photos/living-room2.jpeg','Living room 2',4,1,'2026-06-15 04:12:06','2026-06-15 04:12:06'),
(7,'/lp-photos/kitchen.jpeg','Kitchen',5,1,'2026-06-15 04:12:06','2026-06-15 04:12:06'),
(8,'/lp-photos/terraza.jpeg','Terrace',6,1,'2026-06-15 04:12:06','2026-06-15 04:12:06'),
(9,'/lp-photos/terraza2.jpeg','Terrace 2',7,1,'2026-06-15 04:12:06','2026-06-15 04:12:06');
/*!40000 ALTER TABLE `gallery_images` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `property_contents`
--

DROP TABLE IF EXISTS `property_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `property_contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `hero_image` varchar(255) DEFAULT NULL,
  `hero_badge` varchar(255) DEFAULT NULL,
  `hero_subtitle` varchar(255) DEFAULT NULL,
  `hero_title` varchar(255) DEFAULT NULL,
  `hero_accent` varchar(255) DEFAULT NULL,
  `hero_tagline` text DEFAULT NULL,
  `details_image` varchar(255) DEFAULT NULL,
  `details_title` varchar(255) DEFAULT NULL,
  `details_intro` text DEFAULT NULL,
  `details_description` text DEFAULT NULL,
  `feature_list` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`feature_list`)),
  `life_title` varchar(255) DEFAULT NULL,
  `surf_title` varchar(255) DEFAULT NULL,
  `life_text` text DEFAULT NULL,
  `surf_text` text DEFAULT NULL,
  `life_highlights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`life_highlights`)),
  `beach_image_1` varchar(255) DEFAULT NULL,
  `beach_image_2` varchar(255) DEFAULT NULL,
  `beach_intro` text DEFAULT NULL,
  `beach_text_1` text DEFAULT NULL,
  `beach_text_2` text DEFAULT NULL,
  `beach_highlights_title` varchar(255) DEFAULT NULL,
  `surfing_title` varchar(255) DEFAULT NULL,
  `sunset_title` varchar(255) DEFAULT NULL,
  `surfing_text` text DEFAULT NULL,
  `sunset_text` text DEFAULT NULL,
  `beach_highlights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`beach_highlights`)),
  `video_1_src` varchar(255) DEFAULT NULL,
  `video_1_label` varchar(255) DEFAULT NULL,
  `video_2_src` varchar(255) DEFAULT NULL,
  `video_2_label` varchar(255) DEFAULT NULL,
  `video_title` varchar(255) DEFAULT NULL,
  `video_intro` text DEFAULT NULL,
  `contact_title` varchar(255) DEFAULT NULL,
  `owner_name` varchar(255) DEFAULT NULL,
  `contact_intro` text DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `contact_whatsapp` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `property_contents`
--

LOCK TABLES `property_contents` WRITE;
/*!40000 ALTER TABLE `property_contents` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `property_contents` VALUES
(1,'La Paloma Blanca - Beachfront Condo for Sale, South Jaco, Costa Rica','2-bed, 2-bath beachfront condo for sale at La Paloma Blanca in South Jaco, Costa Rica.',1,'lp-photos/01KV447WT408ZNT5ZTNCDJHK6K.jpeg','For Sale - Owned by William','South Jaco, Costa Rica','Beachfront Condo','La Paloma Blanca','2 Bedrooms - 2 Bathrooms - Approx. 1,000 sq ft','lp-photos/01KV42TDP9BRY0EVWVR401VE5K.jpeg','Beachfront Condo for Sale','Experience beachfront living in one of South Jaco most desirable boutique condominium communities, located directly on the Pacific Ocean.','Whether you are looking for a full-time residence, a vacation getaway, or an investment property, this condominium offers an exceptional opportunity in one of Jaco premier beachfront communities.','[{\"icon\":\"fa-solid fa-bed\",\"text\":\"2 spacious bedrooms\"},{\"icon\":\"fas fa-bath\",\"text\":\"2 full bathrooms\"},{\"icon\":\"fas fa-vector-square\",\"text\":\"Approximately 1,000 sq ft of living space\"},{\"icon\":\"fas fa-car\",\"text\":\"Dedicated owner parking\"},{\"icon\":\"fas fa-shield-alt\",\"text\":\"24-hour gated security\"},{\"icon\":\"fas fa-swimmer\",\"text\":\"Four swimming pools\"},{\"icon\":\"fas fa-leaf\",\"text\":\"Tropical gardens throughout the property\"},{\"icon\":\"fas fa-umbrella-beach\",\"text\":\"Direct beach access\"},{\"icon\":\"fas fa-chart-line\",\"text\":\"Strong rental and investment potential\"}]','Life at La Paloma Blanca','A Surfer Paradise','Nestled on the quieter south end of Jaco Beach, La Paloma Blanca combines privacy and tranquility with easy access to restaurants, shops, entertainment, and outdoor activities.','The beach directly in front of La Paloma Blanca is renowned for its consistent surf conditions and expansive shoreline.','[{\"icon\":\"fas fa-umbrella-beach\",\"text\":\"Direct access to one of Jaco most beautiful beaches\"},{\"icon\":\"fas fa-sun\",\"text\":\"Spectacular Pacific sunsets\"},{\"icon\":\"fas fa-temperature-high\",\"text\":\"Year-round warm weather\"},{\"icon\":\"fas fa-tree\",\"text\":\"Tropical landscaping and mature gardens\"},{\"icon\":\"fas fa-water\",\"text\":\"Resort-style amenities in a boutique community\"}]',NULL,NULL,'Just steps from La Paloma Blanca, you will find one of the most beautiful stretches of beach in Jaco.','Whether you are enjoying a morning walk, watching the sunset, surfing, or simply relaxing by the ocean, the beach becomes an extension of your everyday living space.','Every evening, residents and visitors gather along the shoreline to experience the colorful Pacific sunsets.','Beach Highlights','Surfing','Sunset Views','Jaco is one of Costa Rica most popular surfing destinations. The beach in front of La Paloma Blanca offers consistent waves suitable for a variety of skill levels.','Every evening, residents and visitors gather along the shoreline to experience the colorful Pacific sunsets that make Costa Rica famous.','[{\"text\":\"Direct beach access from the property\"},{\"text\":\"Wide sandy shoreline\"},{\"text\":\"Consistent surf year-round\"},{\"text\":\"Spectacular Pacific sunsets\"},{\"text\":\"Excellent beach walks\"},{\"text\":\"Tropical scenery and wildlife\"},{\"text\":\"Minutes from downtown Jaco\"}]','videos/01KV44C3XF41X9D6849SHCTJ57.mp4','Outside the Complex','videos/01KV44ENEH45225NFWY3JE99NS.mp4','Street and Neighborhood','See the Neighborhood',NULL,'Interested in This Property?','William','This is my personal unit - I am selling it directly, no agents involved.','willishel77@gmail.com','+1 845 943 0404','+18459430404','2026-06-15 03:23:21','2026-06-15 04:38:19');
/*!40000 ALTER TABLE `property_contents` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `users` VALUES
(1,'Admin','admin@wilcorrected.com',1,NULL,'$2y$12$l.Aok0u7HLLFP4cM4yMdse6VM8ZFad6nba2rvIX0y7Ap/H2cYSVoO',NULL,'2026-06-15 03:12:58','2026-06-15 03:19:38');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2026-06-14 16:41:28
