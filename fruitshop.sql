SELECT * FROM phpcrud.people;CREATE TABLE `fruits` (
  `fruit_id` int NOT NULL AUTO_INCREMENT,
  `fruit_name` varchar(45) NOT NULL,
  `inStock` int NOT NULL,
  `unit_id` int NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  `fruit_image` varchar(225) NOT NULL,
  PRIMARY KEY (`fruit_id`),
  UNIQUE KEY `fruit_name_UNIQUE` (`fruit_name`),
  KEY `fk_unit_id_idx` (`unit_id`),
  KEY `fk_created_by_idx` (`created_by`),
  KEY `fk_updated_by_idx` (`updated_by`),
  CONSTRAINT `fk_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`),
  CONSTRAINT `fk_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`),
  CONSTRAINT `fk_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


CREATE TABLE `unit` (
  `unit_id` int NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(45) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  PRIMARY KEY (`unit_id`),
  UNIQUE KEY `unit_name_UNIQUE` (`unit_name`),
  KEY `fk_created_by_idx` (`created_by`),
  KEY `fk_updated_by_idx` (`updated_by`),
  KEY `fk_unit_created_by_idx` (`created_by`),
  KEY `fk_unit_updated_by_idx` (`updated_by`),
  CONSTRAINT `fk_unit_created_by` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`),
  CONSTRAINT `fk_unit_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;




CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_account` varchar(255) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int NOT NULL,
  `date_updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_by` int NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_account_UNIQUE` (`user_account`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='list of users';

