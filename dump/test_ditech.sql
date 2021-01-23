CREATE DATABASE ditech;

use ditech;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `login` varchar(10) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` DATETIME,

  constraint pk_users primary key(`id`)
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `rooms` ( 
  
  `id` int(11) NOT NULL AUTO_INCREMENT,  
  `description` varchar(100),
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),  
  `updated_date` DATETIME,
  
  constraint pk_rooms primary key(`id`)
);

CREATE TABLE `rented_rooms` ( 
  
  `id` int(11) NOT NULL AUTO_INCREMENT,  
  `id_user` int(11) NOT NULL,
  `id_room` int(11) NOT NULL,
  `start_reserved` DATETIME,
  `end_reserved` DATETIME,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),  
  `updated_date` DATETIME,
  
  constraint pk_rented_rooms primary key(`id`),
  constraint fk_users FOREIGN KEY (`id_user`) REFERENCES users (`id`),
  constraint fk_rooms FOREIGN KEY (`id_room`) REFERENCES rooms (`id`)
);