CREATE DATABASE DB_TRAY;

use DB_TRAY;

CREATE TABLE `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `commission` float,  
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` DATETIME,

  constraint pk_vendors primary key(`id`)
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `vendors_sales` ( 
  
  `id` int(11) NOT NULL AUTO_INCREMENT,  
  `commission` float,
  `value` float,
  `date` DATETIME,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),  
  `updated_date` DATETIME,
  `id_vendor` int(11) NOT NULL,  
  
  constraint pk_vendors_sales primary key(`id`),
  constraint fk_vendors FOREIGN KEY (`id_vendor`) REFERENCES vendors (`id`)
);