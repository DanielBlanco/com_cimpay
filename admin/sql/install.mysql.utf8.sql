DROP TABLE IF EXISTS `#__cimpay`;
DROP TABLE IF EXISTS `#__cimpay_customers`;
DROP TABLE IF EXISTS `#__cimpay_transactions`;
 
CREATE TABLE `#__cimpay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `greeting` varchar(25) NOT NULL,
  `params` TEXT NOT NULL DEFAULT '',
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
   PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

INSERT INTO `#__cimpay` (`greeting`) VALUES ('Hello from Cimpay!');