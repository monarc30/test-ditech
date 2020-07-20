CREATE DATABASE DB_RECEIV;

use DB_RECEIV;

CREATE TABLE `debtors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `birth` date NOT NULL,  
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_date` DATETIME,

  constraint pk_debtors primary key(`id`)

  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `debtors_debt` ( 
  
  `id` int(11) NOT NULL AUTO_INCREMENT,  
  `description` text,
  `value` float,
  `date_due` date,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),  
  `updated_date` DATETIME,
  `id_debtor` int(11) NOT NULL,  
  
  constraint pk_debtors_debt primary key(`id`),
  constraint fk_debtors FOREIGN KEY (`id_debtor`) REFERENCES debtors (`id`)
);