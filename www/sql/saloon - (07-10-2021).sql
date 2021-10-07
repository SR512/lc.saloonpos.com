/*
SQLyog Community v13.1.6 (64 bit)
MySQL - 10.4.17-MariaDB : Database - test_saloonpos
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`test_saloonpos` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `test_saloonpos`;

/*Table structure for table `appointments` */

DROP TABLE IF EXISTS `appointments`;

CREATE TABLE `appointments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `service_id` bigint(20) unsigned NOT NULL,
  `employee_id` bigint(20) unsigned DEFAULT NULL,
  `appointment_date_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `appointment_status` enum('PENDING','COMPLETED','CANCEL') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PENDING',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `appointments_customer_id_foreign` (`customer_id`),
  KEY `appointments_service_id_foreign` (`service_id`),
  KEY `appointments_employee_id_foreign` (`employee_id`),
  CONSTRAINT `appointments_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `appointments_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`),
  CONSTRAINT `appointments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `appointments` */

insert  into `appointments`(`id`,`customer_id`,`service_id`,`employee_id`,`appointment_date_time`,`appointment_status`,`created_at`,`updated_at`) values 
(1,1,2,1,'2021-10-07 13:30:17','COMPLETED','2021-10-07 07:25:46','2021-10-07 08:00:17'),
(2,1,3,3,'2021-10-07 13:30:00','CANCEL','2021-10-07 07:28:48','2021-10-07 08:04:05');

/*Table structure for table `attribute_size` */

DROP TABLE IF EXISTS `attribute_size`;

CREATE TABLE `attribute_size` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `attribute_size` */

insert  into `attribute_size`(`id`,`size`,`created_at`,`updated_at`) values 
(1,'Color-Black','2021-10-06 09:48:51','2021-10-06 09:57:07'),
(2,'Color-Red','2021-10-06 09:49:01','2021-10-06 09:56:41'),
(3,'500ml','2021-10-06 09:49:11','2021-10-06 09:54:32'),
(4,'100ml','2021-10-06 09:49:20','2021-10-06 09:54:23');

/*Table structure for table `customers` */

DROP TABLE IF EXISTS `customers`;

CREATE TABLE `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_anniversary` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `customers_email_unique` (`email`),
  UNIQUE KEY `customers_mobile_number_unique` (`mobile_number`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `customers` */

insert  into `customers`(`id`,`first_name`,`last_name`,`email`,`mobile_number`,`date_of_birth`,`date_of_anniversary`,`address`,`city`,`pin_code`,`status`,`created_at`,`updated_at`) values 
(1,'Keaton','Garrison','bitez@mailinator.com','1111111111','2004-06-03','1975-03-04','Beatae assumenda cor','Eu eligendi adipisic',NULL,0,'2021-10-06 09:40:10','2021-10-06 09:40:10');

/*Table structure for table `employees` */

DROP TABLE IF EXISTS `employees`;

CREATE TABLE `employees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `date_of_anniversary` date DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_type` enum('SALARIED','COMMISSION','BOTH') COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission_percentage` decimal(8,2) DEFAULT NULL,
  `salary` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commission` enum('YES','NO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NO',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_mobile_number_unique` (`mobile_number`),
  UNIQUE KEY `employees_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `employees` */

insert  into `employees`(`id`,`first_name`,`last_name`,`gender`,`email`,`mobile_number`,`date_of_birth`,`date_of_anniversary`,`address`,`city`,`pin_code`,`job_type`,`commission_percentage`,`salary`,`commission`,`created_at`,`updated_at`) values 
(1,'Cameron','Mcfadden','MALE','xylowaja@mailinator.com','7405512512','1977-09-12','1979-10-03','Iusto laborum Illum','Voluptatem tenetur q','111111','COMMISSION',4.00,NULL,'NO','2021-10-06 09:41:16','2021-10-06 09:41:16'),
(2,'Maia','Booth','MALE','vugeded@mailinator.com','1111111111','2007-08-21','2004-01-27','Sit non ratione quid','Eos et quae tempora','401111','SALARIED',NULL,'3000','NO','2021-10-06 09:42:00','2021-10-06 09:42:00'),
(3,'demo','demo','MALE',NULL,'2222222222',NULL,NULL,'sdsdsad','Rajkot','360002','BOTH',2.00,'10000','NO','2021-10-06 09:42:48','2021-10-06 09:42:48');

/*Table structure for table `expenses` */

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `expenses_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `expenses` */

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `invoices` */

DROP TABLE IF EXISTS `invoices`;

CREATE TABLE `invoices` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoicedate` date DEFAULT NULL,
  `duedate` date DEFAULT NULL,
  `items` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `discount_type` enum('FLAT','%') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `discount_value` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `paid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `due` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `method` enum('CASH','CHEQUE','CARD','ONLINE') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_type` enum('CUSTOMER','SELLER') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'CUSTOMER',
  `status` enum('PARTIALLY_PAID','UNPAID','PENDING','CANCELLED','PAID') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `invoices` */

insert  into `invoices`(`id`,`product_id`,`employee_id`,`name`,`email`,`mobile`,`invoicedate`,`duedate`,`items`,`subtotal`,`tax`,`discount_type`,`discount`,`discount_value`,`amount`,`paid`,`due`,`note`,`method`,`invoice_type`,`status`,`created_at`,`updated_at`) values 
(1,1,1,'Sanjay',NULL,'7000000000','2021-10-06','2021-10-06','[{\"name\":\"product 1\",\"product_id\":\"1\",\"size\":\"100ml\",\"size_id\":\"1\",\"descr\":null,\"quantity\":\"3\",\"cost\":\"300\",\"price\":\"900\"},{\"name\":\"Hair Color\",\"product_id\":\"2\",\"size\":\"Color-Black\",\"size_id\":\"3\",\"descr\":null,\"quantity\":\"2\",\"cost\":\"300\",\"price\":\"600\"}]',1500.00,5.00,'FLAT',500.00,500.00,1075.00,'1000','75','sasasasasasasasasas','CASH','CUSTOMER','PARTIALLY_PAID','2021-10-06 09:58:25','2021-10-06 09:58:25');

/*Table structure for table `memberships` */

DROP TABLE IF EXISTS `memberships`;

CREATE TABLE `memberships` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `membership_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `package_id` bigint(20) unsigned NOT NULL,
  `packagedetail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `end_date` date DEFAULT NULL,
  `status` enum('ACTIVE','DEACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `memberships_customer_id_foreign` (`customer_id`),
  CONSTRAINT `memberships_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `memberships` */

insert  into `memberships`(`id`,`membership_no`,`customer_id`,`package_id`,`packagedetail`,`end_date`,`status`,`created_at`,`updated_at`) values 
(1,'M00001',1,3,'[{\"size\":\"Service 1\",\"qty\":\"2\"},{\"size\":\"Service 2\",\"qty\":\"3\"},{\"size\":\"Service 3\",\"qty\":\"4\"}]','2021-12-07','DEACTIVE','2021-10-07 10:38:20','2021-10-07 11:16:41');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values 
(1,'2014_10_12_000000_create_users_table',1),
(2,'2014_10_12_100000_create_password_resets_table',1),
(3,'2019_08_19_000000_create_failed_jobs_table',1),
(4,'2021_07_30_160134_create_customers_table',1),
(5,'2021_08_10_111413_create_services_table',1),
(6,'2021_08_10_111743_create_products_table',1),
(7,'2021_08_10_112604_create_employees_table',1),
(8,'2021_08_10_113904_create_expenses_table',1),
(9,'2021_08_10_114151_create_appointments_table',1),
(10,'2021_08_23_065227_create_stocks_table',1),
(11,'2021_08_23_065528_create_attributes_table',1),
(12,'2021_08_25_065128_create_invoices_table',1),
(13,'2021_08_25_094211_create_payments_table',1),
(14,'2021_09_12_060609_add_column_invoice_type_invoice',1),
(15,'2021_09_12_065822_create_settings_table',1),
(16,'2021_10_07_080757_create_memberships_table',2),
(17,'2021_10_07_081750_create_packages_table',2);

/*Table structure for table `packages` */

DROP TABLE IF EXISTS `packages`;

CREATE TABLE `packages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `packagename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) DEFAULT NULL,
  `totalprice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packagedetail` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `packagedesc` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ACTIVE','DEACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `packages` */

insert  into `packages`(`id`,`packagename`,`duration`,`totalprice`,`packagedetail`,`packagedesc`,`status`,`created_at`,`updated_at`) values 
(3,'Package 1',2,'3000','[{\"size\":\"Service 1\",\"qty\":\"2\"},{\"size\":\"Service 2\",\"qty\":\"3\"},{\"size\":\"Service 3\",\"qty\":\"4\"}]',NULL,'ACTIVE','2021-10-07 09:44:30','2021-10-07 09:45:38');

/*Table structure for table `password_resets` */

DROP TABLE IF EXISTS `password_resets`;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_resets` */

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_id` bigint(20) unsigned NOT NULL,
  `payment_date` date NOT NULL,
  `amount` date NOT NULL,
  `method` enum('CASH','CHEQUE','CARD','ONLINE') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_invoice_id_foreign` (`invoice_id`),
  CONSTRAINT `payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `payments` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ACTIVE','DEACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`product_name`,`serial_number`,`status`,`created_at`,`updated_at`) values 
(1,'product 1','QS1591','ACTIVE','2021-10-06 09:50:02','2021-10-06 09:50:02'),
(2,'Hair Color','QS48921','ACTIVE','2021-10-06 09:50:52','2021-10-06 09:50:52');

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `services` */

insert  into `services`(`id`,`service_name`,`price`,`created_at`,`updated_at`) values 
(1,'Service 1','100','2021-10-07 05:27:37','2021-10-07 05:27:37'),
(2,'Service 3','300','2021-10-07 05:36:35','2021-10-07 05:39:48'),
(3,'Service 2','200','2021-10-07 05:40:01','2021-10-07 05:40:01');

/*Table structure for table `settings` */

DROP TABLE IF EXISTS `settings`;

CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `site_logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `settings` */

insert  into `settings`(`id`,`site_logo`,`name`,`mobile`,`email`,`address`,`gst`,`created_at`,`updated_at`) values 
(1,NULL,'Mods Saloon','7777777777','admin@gmail.com','Rajkot','12345678','2021-10-06 09:47:55','2021-10-06 09:47:55');

/*Table structure for table `stocks` */

DROP TABLE IF EXISTS `stocks`;

CREATE TABLE `stocks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) unsigned NOT NULL,
  `attribute_size_id` bigint(20) unsigned NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_quantity` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchased_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stocks_product_id_foreign` (`product_id`),
  CONSTRAINT `stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `stocks` */

insert  into `stocks`(`id`,`product_id`,`attribute_size_id`,`quantity`,`min_quantity`,`purchase_price`,`price`,`purchased_date`,`created_at`,`updated_at`) values 
(1,1,4,'97','10','300','300','2021-10-06 09:50:02','2021-10-06 09:50:02','2021-10-06 09:58:26'),
(2,1,3,'150','20','500','500','2021-10-06 09:50:02','2021-10-06 09:50:02','2021-10-06 09:50:02'),
(3,2,1,'18','10','300','300','2021-10-06 09:50:52','2021-10-06 09:50:52','2021-10-06 09:58:26'),
(4,2,2,'30','20','130','130','2021-10-06 09:50:52','2021-10-06 09:50:52','2021-10-06 09:50:52');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`email`,`email_verified_at`,`password`,`remember_token`,`created_at`,`updated_at`) values 
(1,'admin','admin@gmail.com',NULL,'$2y$10$Ig6lq94g/MFdTkN.4paY4OPvXUbcliBa4FBriGP2KedkaY.jNsRlC',NULL,'2021-10-06 09:13:20','2021-10-06 09:13:20');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
