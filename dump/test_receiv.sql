CREATE DATABASE DB_RECEIVE;

use DB_RECEIVE;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birth` date NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` DATETIME,

  constraint pk_users primary key(`id`)

  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users_debt` ( 
  
  `id` int(11) NOT NULL,  
  `description` text,
  `value` float,
  `date_due` date,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),  
  `updated_date` DATETIME,
  `id_user` int(11) NOT NULL,  
  
  constraint pk_users_debt primary key(`id`),
  constraint fk_users FOREIGN KEY (`id_user`) REFERENCES users (`id`)
);