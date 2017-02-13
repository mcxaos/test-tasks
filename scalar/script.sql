use skalar;

CREATE TABLE department (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VaRCHAR(100) NOT NULL
);
CREATE TABLE employees (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VaRCHAR(100) NOT NULL,
date DATETIME  NOT NULL
);

CREATE TABLE type (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VaRCHAR(100) NOT NULL
);

CREATE TABLE work (
employee_id INT(6) UNSIGNED NOT NULL,
department_id INT(6) UNSIGNED NOT NULL,
type_id INT(6) UNSIGNED NOT NULL,
RATE int(6) NOT NULL,
hours INT(6)  NOT NULL,
position VARCHAR(100) NOT NULL,
FOREIGN KEY (type_id) REFERENCES type(id) ON DELETE CASCADE,
FOREIGN KEY (department_id) REFERENCES department(id) ON DELETE CASCADE,
FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
);

INSERT INTO `employees`( `name`, `date`) VALUES ('1','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('2','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('3','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('4','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('1','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('2','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('3','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('4','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('1','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('2','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('3','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('4','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('1','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('2','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('3','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('4','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('1','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('2','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('3','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('4','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('1','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('2','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('3','10-01-2017');
INSERT INTO `employees`( `name`, `date`) VALUES ('4','10-01-2017');