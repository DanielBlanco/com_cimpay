DROP TABLE IF EXISTS `#__cimpay`;
DROP TABLE IF EXISTS `#__cimpay_customers`;
 
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

INSERT INTO `#__cimpay` (`greeting`) VALUES ('Hello from Cimpay!');