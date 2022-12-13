--En este doumentos pondremos los cambios hechos en la base de datos que hagamos en ambiente de pruebas/desarrollo 


--Pruebas/Desarrollo
ALTER TABLE `items` 
ADD COLUMN `is_area` CHAR(1) NULL DEFAULT 'N' AFTER `editable`,
ADD COLUMN `is_item_area` CHAR(1) NULL DEFAULT 'N' AFTER `is_area`,
ADD COLUMN `item_order` INT(11) NULL AFTER `is_item_area`,
ADD COLUMN `area_to_belong` INT(11) NULL AFTER `item_order`;


CREATE TABLE `item_area_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) DEFAULT NULL,
  `id_item_area` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `mr_guideline` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `guideline` TEXT NULL,
  `code` VARCHAR(45) NULL,
  `damage` INT(11) NULL,
  `deleted` INT(11) NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `mr_damages` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `request_code` VARCHAR(45) NULL,
  `damage` VARCHAR(100) NULL,
  `deleted` INT(11) NULL DEFAULT 1 ,
  PRIMARY KEY (`id`));

  CREATE TABLE `mr_items` (
  `id` int(11) NOT NULL,
  `guideline` TEXT NULL DEFAULT NULL ,
  `code` varchar(45) DEFAULT NULL,
  `request_code` VARCHAR(45) NULL,
  `mr` TEXT NULL DEFAULT NULL,
  `deleted` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `mr_guideline_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guideline` int(11) DEFAULT NULL,
  `items` int(11) DEFAULT NULL,
  `deleted` int(11) DEFAULT 1 ,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE `items` 
CHANGE COLUMN `depende` `depende` VARCHAR(45) NULL DEFAULT 'N' ;

--Prod