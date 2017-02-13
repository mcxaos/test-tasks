CREATE TABLE `images` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`original_name` VARCHAR(50) NOT NULL,
	`create_datetime` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='utf8_general_ci'
ENGINE=InnoDB
;