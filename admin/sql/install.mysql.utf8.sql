DROP TABLE IF EXISTS `#__cimpay`;
DROP TABLE IF EXISTS `#__cimpay_customers`;
DROP TABLE IF EXISTS `#__cimpay_transactions`;
DROP TABLE IF EXISTS `#__cimpay_recurring_services`;
DROP TABLE IF EXISTS `#__cimpay_recurring_packages`;
DROP TABLE IF EXISTS `#__cimpay_recurring_customers`;

# Make sure there is no other component with the same name.
#DELETE FROM `#__assets` WHERE name = 'com_cimpay';
#DELETE FROM `#__extensions` WHERE name = 'com_cimpay';
#DELETE FROM `#__menu` WHERE alias = 'cimpay';

CREATE TABLE `#__cimpay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `greeting` varchar(25) NOT NULL,
  `params` TEXT NOT NULL DEFAULT '',
  `next_invoice_number` int(11) NOT NULL DEFAULT 1,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `#__cimpay_customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `profile_id` varchar(100) NOT NULL,
  `payment_id` varchar(100) NOT NULL,
  `shipping_id` varchar(100) NOT NULL,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `#__cimpay_transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` TINYINT(1) NOT NULL DEFAULT 0,
  `customer_id` int(11) NOT NULL,
  `amount` varchar(100) NOT NULL,
  `shipping_amount` varchar(10) NOT NULL,
  `shipping_name` varchar(31) NOT NULL,
  `shipping_description` varchar(255) NOT NULL,
  `item_id` varchar(10) NOT NULL,
  `item_name` varchar(31) NOT NULL,
  `item_description` varchar(255) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `item_unit_price` varchar(10) NOT NULL,
  `item_taxable` TINYINT(1) NOT NULL DEFAULT 0,
  `order_invoice_number` varchar(10) NOT NULL,
  `billing_date` varchar(10) NOT NULL,
  `log_message` TEXT NOT NULL DEFAULT '',
  `recurring_customer_plan` int(11),
  `recurring_service_id` int(11),
  `recurring_service_months_paid` int(11) NOT NULL DEFAULT 0,
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE `#__cimpay_recurring_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` TEXT NOT NULL DEFAULT '',
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `start_at` VARCHAR(7) NOT NULL DEFAULT '2012-01',
  `months_to_bill` int(11) NOT NULL DEFAULT 1,
  `total_cost` DECIMAL(19,4) NOT NULL DEFAULT 0,
  `tag` varchar(25) NOT NULL DEFAULT '',
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

INSERT INTO `#__cimpay` (`greeting`) VALUES ('Hello from Cimpay!');