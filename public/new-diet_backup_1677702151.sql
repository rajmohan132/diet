

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `categorycode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoryname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO categories VALUES("1","CG0001","BreakFast","20230225123540.jpeg","1","2023-02-25 12:35:40","2023-02-25 12:35:40");
INSERT INTO categories VALUES("2","CG0002","Lunch","20230225123554.jpeg","1","2023-02-25 12:35:54","2023-02-25 12:35:54");
INSERT INTO categories VALUES("3","CG0003","Snacks","20230225123608.jpeg","1","2023-02-25 12:36:08","2023-02-25 12:36:08");
INSERT INTO categories VALUES("4","CG0004","Dinner","20230225124434.jpeg","1","2023-02-25 12:44:34","2023-02-25 12:44:34");
INSERT INTO categories VALUES("5","CG0005","Arabic Biryani","20230227091158.jpeg","0","2023-02-27 09:11:58","2023-02-27 09:18:44");



CREATE TABLE `customer_plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer` int(11) NOT NULL,
  `plan` int(11) NOT NULL,
  `subplan` int(11) NOT NULL,
  `category` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plan_from` datetime NOT NULL,
  `plan_to` datetime NOT NULL,
  `assign_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO customer_plans VALUES("1","2","1","1","1,2,3,4","[{"date":"28-02-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"01-03-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"02-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"03-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"04-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"05-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"06-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"}]","2023-02-28 00:00:00","2023-03-07 00:00:00","1","1","2023-02-28 09:16:50","2023-02-28 09:18:04");
INSERT INTO customer_plans VALUES("3","1","1","1","1,2,3,4","[{"date":"28-02-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"01-03-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"02-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"03-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"04-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"05-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"06-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"}]","2023-02-28 00:00:00","2023-03-07 00:00:00","1","1","2023-02-28 09:20:52","2023-02-28 09:21:37");



CREATE TABLE `customers` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `image` text DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `streetaddress` varchar(255) NOT NULL,
  `streetaddress1` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `mobno` varchar(255) NOT NULL,
  `alternativemob` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime NOT NULL,
  `sponsor_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

INSERT INTO customers VALUES("1","2","20230225145139.jpeg","alexyyy","alexyyy","Ahmad Bin Ali St 232 Building 142 Zone 20, Doha","sdsdsd","qar","121212","12122","1","2023-03-01 22:45:11","2023-02-25 14:51:39","2");
INSERT INTO customers VALUES("2","3","20230225145220.jpeg","Anu","g","Thandaoorazhikatu veedu,thekkumpuram ,","puthoor, kollam","qar","121212","9746243645","1","2023-02-25 14:52:20","2023-02-25 14:52:20","2");



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




CREATE TABLE `kitchen_displays` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `menucode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menuname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO menus VALUES("1","MN0001","1","oats","20230227123156.png","1","2023-02-27 12:31:56","2023-02-27 12:31:56");
INSERT INTO menus VALUES("2","MN0002","2","Arabic Lunch","20230227123214.png","1","2023-02-27 12:32:14","2023-02-27 12:32:14");
INSERT INTO menus VALUES("3","MN0003","3","Snack 1","20230227123224.png","1","2023-02-27 12:32:24","2023-02-27 12:32:24");
INSERT INTO menus VALUES("4","MN0004","3","Snack 2","20230227123235.png","1","2023-02-27 12:32:35","2023-02-27 12:32:35");
INSERT INTO menus VALUES("5","MN0005","4","Dinner 1","20230227134037.png","1","2023-02-27 13:40:37","2023-02-27 13:40:37");



CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("1","2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("2","2014_10_12_100000_create_password_resets_table","1");
INSERT INTO migrations VALUES("3","2019_08_19_000000_create_failed_jobs_table","1");
INSERT INTO migrations VALUES("4","2023_01_09_142447_create_categories_table","2");
INSERT INTO migrations VALUES("5","2023_01_10_102941_create_menus_table","3");
INSERT INTO migrations VALUES("7","2023_01_10_112136_create_plans_table","4");
INSERT INTO migrations VALUES("8","2023_01_10_121240_create_sub_plans_table","4");
INSERT INTO migrations VALUES("9","2023_01_12_112449_create_customers_table","4");
INSERT INTO migrations VALUES("10","2023_01_14_081333_create_userroles_table","4");
INSERT INTO migrations VALUES("11","2023_02_12_062132_create_products_table","5");
INSERT INTO migrations VALUES("12","2023_02_13_160903_create_user_privileges_table","6");
INSERT INTO migrations VALUES("14","2023_02_13_174000_create_privilages_table","7");
INSERT INTO migrations VALUES("16","2023_02_16_065405_alter_plans_table","8");
INSERT INTO migrations VALUES("20","2023_02_19_134036_create_custom_plans_table","9");
INSERT INTO migrations VALUES("21","2023_02_26_131523_create_custom_menus_table","10");
INSERT INTO migrations VALUES("22","2023_02_27_073346_create_kitchen_displays_table","11");
INSERT INTO migrations VALUES("23","2023_03_01_094043_create_orders_table","12");



CREATE TABLE `orders` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_plan_id` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  `food` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_id` bigint(20) DEFAULT NULL,
  `order_status` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO orders VALUES("12","3","2023-03-01 00:00:00","[{"date":"28-02-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"01-03-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"02-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"03-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"04-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"05-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"06-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"}]","9","2","2023-03-01 13:40:06","2023-03-01 16:09:16");
INSERT INTO orders VALUES("14","1","2023-03-01 00:00:00","[{"date":"28-02-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"01-03-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"02-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"03-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"04-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"05-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"06-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"}]","9","2","2023-03-01 16:06:16","2023-03-01 19:47:11");
INSERT INTO orders VALUES("15","2","2023-03-01 00:00:00","[{"date":"01-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"02-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"}]","","1","2023-03-01 19:45:46","2023-03-01 19:45:46");
INSERT INTO orders VALUES("16","1","2023-03-01 00:00:00","[{"date":"28-02-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"01-03-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"02-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"03-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"04-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"05-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"06-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"}]","9","2","2023-03-01 19:46:21","2023-03-01 19:47:11");
INSERT INTO orders VALUES("17","1","2023-03-01 00:00:00","[{"date":"28-02-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"01-03-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"02-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"03-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"04-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"05-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"06-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"}]","9","2","2023-03-01 19:46:24","2023-03-01 19:47:11");
INSERT INTO orders VALUES("18","1","2023-03-01 00:00:00","[{"date":"28-02-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"01-03-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"02-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"03-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"04-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"05-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"06-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"}]","9","2","2023-03-01 19:46:25","2023-03-01 19:47:11");
INSERT INTO orders VALUES("19","1","2023-03-01 00:00:00","[{"date":"28-02-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"01-03-2023","breakfast":"1,2","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"02-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"03-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"04-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"05-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"},{"date":"06-03-2023","breakfast":"1","lunch":"2","snacks":"3,4","dinner":"5"}]","9","2","2023-03-01 19:46:27","2023-03-01 19:47:11");



CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO password_resets VALUES("anug8181@gmail.com","$2y$10$IR3C.fc4l6RIltNU0P01deOa3YkdIvXZcmUWfoYKJj2u/NaSDGPAq","2023-01-09 08:15:36");
INSERT INTO password_resets VALUES("anug8181@gmail.com","$2y$10$IR3C.fc4l6RIltNU0P01deOa3YkdIvXZcmUWfoYKJj2u/NaSDGPAq","2023-01-09 08:15:36");



CREATE TABLE `plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `plancode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `planname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_days` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `planmessage` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `planimage` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO plans VALUES("1","PL0001","1month","1","active","20230226092136.png","1","2023-02-26 09:21:36","2023-02-26 09:21:36");
INSERT INTO plans VALUES("2","PL0002","2month","3","123","20230226092458.png","1","2023-02-26 09:24:58","2023-02-26 09:24:58");
INSERT INTO plans VALUES("3","PL0003","5 mnth","2","aas","20230226092756.png","1","2023-02-26 09:27:56","2023-02-26 09:27:56");
INSERT INTO plans VALUES("4","PL0004","6 mnth","3","aa","20230226093556.png","1","2023-02-26 09:35:56","2023-02-26 09:35:56");
INSERT INTO plans VALUES("5","PL0005","2 weeks","2","jhjh","20230226142808.png","1","2023-02-26 14:28:09","2023-02-26 14:28:09");



CREATE TABLE `privilages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `privilage` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO privilages VALUES("1","Manage Category","","");
INSERT INTO privilages VALUES("2","Add Category","","");
INSERT INTO privilages VALUES("3","View Category","","");
INSERT INTO privilages VALUES("4","Edit Category","","");
INSERT INTO privilages VALUES("5","Delete Category","","");
INSERT INTO privilages VALUES("6","Manage Menu","","");
INSERT INTO privilages VALUES("7","View Menu","","");
INSERT INTO privilages VALUES("8","Add Menu","","");
INSERT INTO privilages VALUES("9","Delete Menu","","");
INSERT INTO privilages VALUES("10","Edit Menu","","");
INSERT INTO privilages VALUES("11","Manage Plans","","");
INSERT INTO privilages VALUES("12","Enter Plans","","");
INSERT INTO privilages VALUES("13","View Plans","","");
INSERT INTO privilages VALUES("14","Add New Plans","","");
INSERT INTO privilages VALUES("15","Manage SubPlan","","");
INSERT INTO privilages VALUES("16","Add SubPlan","","");
INSERT INTO privilages VALUES("17","Edit SubPlan","","");
INSERT INTO privilages VALUES("18","View SubPlan","","");



CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `plan` int(11) NOT NULL,
  `subplan` int(11) NOT NULL,
  `category` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_custom` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products VALUES("1","1","1","1,2,3,4","1,2,3,4,5","1","1","2023-02-28 09:15:01","2023-02-28 09:15:01");



CREATE TABLE `sub_plans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subplancode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `splanname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `planname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO sub_plans VALUES("1","SP0001","1500 c","1","1080","1","2023-02-26 09:23:34","2023-02-26 09:23:34");
INSERT INTO sub_plans VALUES("2","SP0002","2000c","2","2563","1","2023-02-26 09:25:16","2023-02-26 09:25:16");
INSERT INTO sub_plans VALUES("3","SP0003","3 mnth","3","2323","1","2023-02-26 09:28:51","2023-02-26 09:28:51");
INSERT INTO sub_plans VALUES("4","SP0004","1800","1","2500","1","2023-02-26 09:33:07","2023-02-26 09:33:07");
INSERT INTO sub_plans VALUES("5","SP0005","70000 C","4","1080","1","2023-02-26 09:36:32","2023-02-26 09:36:32");
INSERT INTO sub_plans VALUES("6","SP0006","1800 cal","5","5000","1","2023-02-26 14:28:33","2023-02-26 14:28:33");
INSERT INTO sub_plans VALUES("7","SP0007","4500","5","1500","1","2023-02-27 13:06:20","2023-02-27 13:06:20");



CREATE TABLE `user_privileges` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_role` bigint(20) NOT NULL,
  `privilages` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO user_privileges VALUES("3","2","1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18","2023-02-13 17:54:36","2023-02-13 17:54:36");
INSERT INTO user_privileges VALUES("4","1","1,2,3,4,6,7,8,10,11,12,13,14,15,16,17,18","2023-02-13 17:55:20","2023-02-15 15:50:29");



CREATE TABLE `userroles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `rolename` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO userroles VALUES("1","Admin","1","2023-02-12 09:27:52","2023-02-12 09:27:52");
INSERT INTO userroles VALUES("2","Admin2","1","2023-02-12 09:28:48","2023-02-12 09:28:48");
INSERT INTO userroles VALUES("3","Managerdd","0","2023-02-12 09:29:06","2023-02-13 11:36:26");
INSERT INTO userroles VALUES("4","abc","1","2023-02-13 11:37:14","2023-02-13 11:38:11");
INSERT INTO userroles VALUES("5","tester1","1","2023-02-13 17:53:27","2023-02-13 17:53:27");
INSERT INTO userroles VALUES("6","Driver","1","2023-02-28 09:06:18","2023-02-28 09:06:18");
INSERT INTO userroles VALUES("7","Managers","1","2023-02-28 09:06:33","2023-02-28 09:06:33");



CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `userrole` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES("1","Anu","admin@gmail.com","","$2y$10$CYNAhLYccwDtUwPqthmB4O4gEdC3RWoV9XOklc.IjZrREK3OievfW","0","","2023-02-25 17:50:36","2023-02-25 17:50:36","1");
INSERT INTO users VALUES("2","alexyyy","admin@asapqatar.com","","$2y$10$rSE2XkIVrlYCSw4.N5jNNehUl/T0a1OTIWpsOVOkybGPahFTfJmuS","5","","2023-02-25 14:51:39","2023-02-25 14:51:39","1");
INSERT INTO users VALUES("3","Anu","admin@theflowershop.com.qa","","$2y$10$/Z1tKb7v6Y9ewGckj6x30uaKFtnQ6EpQTNg5tikpDiIqN7MBhQLNK","5","","2023-02-25 14:52:20","2023-02-25 14:52:20","1");
INSERT INTO users VALUES("4","suresh","admin@123.co","","$2y$10$5ILXtZ59r4KAFQiXR5trp.K274odwzO1TYQWm9Z5tRjmDZ/oJ9xnW","5","","2023-02-26 07:34:23","2023-02-26 07:34:23","1");
INSERT INTO users VALUES("5","vinod","inod@gmail.com","","$2y$10$zFCkErrKkjBxDwIEWdurFucW.5OAcqz6SxUvUUDTmpVhHTOd2Vwra","6","","2023-03-01 10:28:39","2023-03-01 10:28:39","1");
INSERT INTO users VALUES("6","ajith","ajith@gmail.com","","$2y$10$/SpDqduWxdJPDZt0nOYHt.Z7SM6L6s51yIaJYcPXPEUwDmo/ePOf.","6","","2023-03-01 10:29:04","2023-03-01 10:29:04","1");
INSERT INTO users VALUES("7","anish","anish@gmail.com","","$2y$10$lTHW7dbBk.HtA47YD2mi3.JvurAL7Fh5Mrd7uqeClCC0tX9.8rCoC","6","","2023-03-01 10:29:30","2023-03-01 10:29:30","1");
INSERT INTO users VALUES("8","anandhu","anadhu@gmail.com","","$2y$10$gWKrY0frGrSHe9c./pdhDO0PdVcg45t./Tje1OW43QG2mT2iAElfy","6","","2023-03-01 10:29:54","2023-03-01 10:29:54","1");
INSERT INTO users VALUES("9","rahul","rahul@gmail.com","","$2y$10$Lyd5sG5BmzPzKG5s9d2jJu6uANHnnowC9PUxJy3dGsM6QElSyIhBy","6","","2023-03-01 12:17:04","2023-03-01 12:17:04","1");

