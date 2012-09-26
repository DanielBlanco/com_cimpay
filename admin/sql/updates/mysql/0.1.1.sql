DROP TABLE IF EXISTS `#__cimpay_recurring_services`;
DROP TABLE IF EXISTS `#__cimpay_recurring_packages`;
DROP TABLE IF EXISTS `#__cimpay_recurring_customers`;

CREATE TABLE `#__cimpay_recurring_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` TEXT NOT NULL DEFAULT '',
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `start_at` DATE NOT NULL,
  `months_to_bill` int(11) NOT NULL DEFAULT 1,
  `total_cost` DECIMAL(19,4) NOT NULL,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `#__cimpay_recurring_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` TEXT NOT NULL DEFAULT '',
  `months_to_pay` INT(11) NOT NULL DEFAULT 0,
  `recurring` INT(1) NOT NULL DEFAULT 0,
  `active` INT(1) NOT NULL DEFAULT 1,
  `discount` INT(11) NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `#__cimpay_recurring_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `months_paid` int(11) NOT NULL DEFAULT 0,
  `created_at` DATETIME NOT NULL,
  `updated_at` DATETIME NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;