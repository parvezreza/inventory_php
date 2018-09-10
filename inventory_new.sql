/*
Navicat MySQL Data Transfer

Source Server         : Localhost
Source Server Version : 100132
Source Host           : localhost:3306
Source Database       : inventory_new

Target Server Type    : MYSQL
Target Server Version : 100132
File Encoding         : 65001

Date: 2018-09-10 12:11:55
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for attributes
-- ----------------------------
DROP TABLE IF EXISTS `attributes`;
CREATE TABLE `attributes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of attributes
-- ----------------------------
INSERT INTO `attributes` VALUES ('4', 'Color', '1');
INSERT INTO `attributes` VALUES ('5', 'Size', '1');
INSERT INTO `attributes` VALUES ('7', 'Test', '1');

-- ----------------------------
-- Table structure for attribute_value
-- ----------------------------
DROP TABLE IF EXISTS `attribute_value`;
CREATE TABLE `attribute_value` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `value` varchar(255) NOT NULL,
  `attribute_parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of attribute_value
-- ----------------------------
INSERT INTO `attribute_value` VALUES ('5', 'Blue', '4');
INSERT INTO `attribute_value` VALUES ('6', 'White', '4');
INSERT INTO `attribute_value` VALUES ('7', 'M', '5');
INSERT INTO `attribute_value` VALUES ('8', 'L', '5');
INSERT INTO `attribute_value` VALUES ('9', 'Green', '4');
INSERT INTO `attribute_value` VALUES ('10', 'Black', '4');
INSERT INTO `attribute_value` VALUES ('12', 'Grey', '4');
INSERT INTO `attribute_value` VALUES ('13', 'S', '5');
INSERT INTO `attribute_value` VALUES ('16', 'Red', '4');
INSERT INTO `attribute_value` VALUES ('17', 'sammy', '7');
INSERT INTO `attribute_value` VALUES ('18', 'Sammy Double', '7');
INSERT INTO `attribute_value` VALUES ('19', 'Parvez 4', '7');
INSERT INTO `attribute_value` VALUES ('21', 'test', '7');

-- ----------------------------
-- Table structure for brands
-- ----------------------------
DROP TABLE IF EXISTS `brands`;
CREATE TABLE `brands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of brands
-- ----------------------------
INSERT INTO `brands` VALUES ('26', 'Parvez  sdf', '1');
INSERT INTO `brands` VALUES ('29', 'sohag ', '1');
INSERT INTO `brands` VALUES ('30', 'Tomal 3', '1');
INSERT INTO `brands` VALUES ('32', 'Rashed ', '1');
INSERT INTO `brands` VALUES ('35', 'farukd ', '1');
INSERT INTO `brands` VALUES ('55', 'Wali ', '1');
INSERT INTO `brands` VALUES ('64', 'Hello', '1');
INSERT INTO `brands` VALUES ('66', 'Imran Khan ', '1');
INSERT INTO `brands` VALUES ('82', 'test', '1');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('4', 'Cori3', '1');
INSERT INTO `categories` VALUES ('5', 'Dual Core', '1');
INSERT INTO `categories` VALUES ('6', 'Corei5', '1');
INSERT INTO `categories` VALUES ('7', 'Corei7', '1');
INSERT INTO `categories` VALUES ('8', 'Dell', '1');
INSERT INTO `categories` VALUES ('17', 'sdfs', '1');
INSERT INTO `categories` VALUES ('18', 'Parvez', '1');
INSERT INTO `categories` VALUES ('19', 'White', '1');
INSERT INTO `categories` VALUES ('20', 'Parvez Reza', '1');
INSERT INTO `categories` VALUES ('21', 'Corei3 ', '1');
INSERT INTO `categories` VALUES ('25', 'Parvez Reza', '1');
INSERT INTO `categories` VALUES ('32', 'sohag', '1');

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) NOT NULL,
  `service_charge_value` varchar(255) NOT NULL,
  `vat_charge_value` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `currency` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of company
-- ----------------------------
INSERT INTO `company` VALUES ('1', 'Digital Smart', '5', '10', 'Dhaka', '07743434453', 'Bangladesh', 'hello everyone one&nbsp;', 'BDT');

-- ----------------------------
-- Table structure for currency
-- ----------------------------
DROP TABLE IF EXISTS `currency`;
CREATE TABLE `currency` (
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of currency
-- ----------------------------
INSERT INTO `currency` VALUES ('Albania', 'Leke', 'ALL', 'Lek');
INSERT INTO `currency` VALUES ('America', 'Dollars', 'USD', '$');
INSERT INTO `currency` VALUES ('Afghanistan', 'Afghanis', 'AFN', '؋');
INSERT INTO `currency` VALUES ('Argentina', 'Pesos', 'ARS', '$');
INSERT INTO `currency` VALUES ('Aruba', 'Guilders', 'AWG', 'ƒ');
INSERT INTO `currency` VALUES ('Australia', 'Dollars', 'AUD', '$');
INSERT INTO `currency` VALUES ('Azerbaijan', 'New Manats', 'AZN', 'ман');
INSERT INTO `currency` VALUES ('Bahamas', 'Dollars', 'BSD', '$');
INSERT INTO `currency` VALUES ('Barbados', 'Dollars', 'BBD', '$');
INSERT INTO `currency` VALUES ('Belarus', 'Rubles', 'BYR', 'p.');
INSERT INTO `currency` VALUES ('Belgium', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Beliz', 'Dollars', 'BZD', 'BZ$');
INSERT INTO `currency` VALUES ('Bermuda', 'Dollars', 'BMD', '$');
INSERT INTO `currency` VALUES ('Bolivia', 'Bolivianos', 'BOB', '$b');
INSERT INTO `currency` VALUES ('Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM');
INSERT INTO `currency` VALUES ('Botswana', 'Pula', 'BWP', 'P');
INSERT INTO `currency` VALUES ('Bulgaria', 'Leva', 'BGN', 'лв');
INSERT INTO `currency` VALUES ('Brazil', 'Reais', 'BRL', 'R$');
INSERT INTO `currency` VALUES ('Britain (United Kingdom)', 'Pounds', 'GBP', '£');
INSERT INTO `currency` VALUES ('Brunei Darussalam', 'Dollars', 'BND', '$');
INSERT INTO `currency` VALUES ('Cambodia', 'Riels', 'KHR', '៛');
INSERT INTO `currency` VALUES ('Canada', 'Dollars', 'CAD', '$');
INSERT INTO `currency` VALUES ('Cayman Islands', 'Dollars', 'KYD', '$');
INSERT INTO `currency` VALUES ('Chile', 'Pesos', 'CLP', '$');
INSERT INTO `currency` VALUES ('China', 'Yuan Renminbi', 'CNY', '¥');
INSERT INTO `currency` VALUES ('Colombia', 'Pesos', 'COP', '$');
INSERT INTO `currency` VALUES ('Costa Rica', 'Colón', 'CRC', '₡');
INSERT INTO `currency` VALUES ('Croatia', 'Kuna', 'HRK', 'kn');
INSERT INTO `currency` VALUES ('Cuba', 'Pesos', 'CUP', '₱');
INSERT INTO `currency` VALUES ('Cyprus', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Czech Republic', 'Koruny', 'CZK', 'Kč');
INSERT INTO `currency` VALUES ('Denmark', 'Kroner', 'DKK', 'kr');
INSERT INTO `currency` VALUES ('Dominican Republic', 'Pesos', 'DOP ', 'RD$');
INSERT INTO `currency` VALUES ('East Caribbean', 'Dollars', 'XCD', '$');
INSERT INTO `currency` VALUES ('Egypt', 'Pounds', 'EGP', '£');
INSERT INTO `currency` VALUES ('El Salvador', 'Colones', 'SVC', '$');
INSERT INTO `currency` VALUES ('England (United Kingdom)', 'Pounds', 'GBP', '£');
INSERT INTO `currency` VALUES ('Euro', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Falkland Islands', 'Pounds', 'FKP', '£');
INSERT INTO `currency` VALUES ('Fiji', 'Dollars', 'FJD', '$');
INSERT INTO `currency` VALUES ('France', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Ghana', 'Cedis', 'GHC', '¢');
INSERT INTO `currency` VALUES ('Gibraltar', 'Pounds', 'GIP', '£');
INSERT INTO `currency` VALUES ('Greece', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Guatemala', 'Quetzales', 'GTQ', 'Q');
INSERT INTO `currency` VALUES ('Guernsey', 'Pounds', 'GGP', '£');
INSERT INTO `currency` VALUES ('Guyana', 'Dollars', 'GYD', '$');
INSERT INTO `currency` VALUES ('Holland (Netherlands)', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Honduras', 'Lempiras', 'HNL', 'L');
INSERT INTO `currency` VALUES ('Hong Kong', 'Dollars', 'HKD', '$');
INSERT INTO `currency` VALUES ('Hungary', 'Forint', 'HUF', 'Ft');
INSERT INTO `currency` VALUES ('Iceland', 'Kronur', 'ISK', 'kr');
INSERT INTO `currency` VALUES ('India', 'Rupees', 'INR', 'Rp');
INSERT INTO `currency` VALUES ('Indonesia', 'Rupiahs', 'IDR', 'Rp');
INSERT INTO `currency` VALUES ('Iran', 'Rials', 'IRR', '﷼');
INSERT INTO `currency` VALUES ('Ireland', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Isle of Man', 'Pounds', 'IMP', '£');
INSERT INTO `currency` VALUES ('Israel', 'New Shekels', 'ILS', '₪');
INSERT INTO `currency` VALUES ('Italy', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Jamaica', 'Dollars', 'JMD', 'J$');
INSERT INTO `currency` VALUES ('Japan', 'Yen', 'JPY', '¥');
INSERT INTO `currency` VALUES ('Jersey', 'Pounds', 'JEP', '£');
INSERT INTO `currency` VALUES ('Kazakhstan', 'Tenge', 'KZT', 'лв');
INSERT INTO `currency` VALUES ('Korea (North)', 'Won', 'KPW', '₩');
INSERT INTO `currency` VALUES ('Korea (South)', 'Won', 'KRW', '₩');
INSERT INTO `currency` VALUES ('Kyrgyzstan', 'Soms', 'KGS', 'лв');
INSERT INTO `currency` VALUES ('Laos', 'Kips', 'LAK', '₭');
INSERT INTO `currency` VALUES ('Latvia', 'Lati', 'LVL', 'Ls');
INSERT INTO `currency` VALUES ('Lebanon', 'Pounds', 'LBP', '£');
INSERT INTO `currency` VALUES ('Liberia', 'Dollars', 'LRD', '$');
INSERT INTO `currency` VALUES ('Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF');
INSERT INTO `currency` VALUES ('Lithuania', 'Litai', 'LTL', 'Lt');
INSERT INTO `currency` VALUES ('Luxembourg', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Macedonia', 'Denars', 'MKD', 'ден');
INSERT INTO `currency` VALUES ('Malaysia', 'Ringgits', 'MYR', 'RM');
INSERT INTO `currency` VALUES ('Malta', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Mauritius', 'Rupees', 'MUR', '₨');
INSERT INTO `currency` VALUES ('Mexico', 'Pesos', 'MXN', '$');
INSERT INTO `currency` VALUES ('Mongolia', 'Tugriks', 'MNT', '₮');
INSERT INTO `currency` VALUES ('Mozambique', 'Meticais', 'MZN', 'MT');
INSERT INTO `currency` VALUES ('Namibia', 'Dollars', 'NAD', '$');
INSERT INTO `currency` VALUES ('Nepal', 'Rupees', 'NPR', '₨');
INSERT INTO `currency` VALUES ('Netherlands Antilles', 'Guilders', 'ANG', 'ƒ');
INSERT INTO `currency` VALUES ('Netherlands', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('New Zealand', 'Dollars', 'NZD', '$');
INSERT INTO `currency` VALUES ('Nicaragua', 'Cordobas', 'NIO', 'C$');
INSERT INTO `currency` VALUES ('Nigeria', 'Nairas', 'NGN', '₦');
INSERT INTO `currency` VALUES ('North Korea', 'Won', 'KPW', '₩');
INSERT INTO `currency` VALUES ('Norway', 'Krone', 'NOK', 'kr');
INSERT INTO `currency` VALUES ('Oman', 'Rials', 'OMR', '﷼');
INSERT INTO `currency` VALUES ('Pakistan', 'Rupees', 'PKR', '₨');
INSERT INTO `currency` VALUES ('Panama', 'Balboa', 'PAB', 'B/.');
INSERT INTO `currency` VALUES ('Paraguay', 'Guarani', 'PYG', 'Gs');
INSERT INTO `currency` VALUES ('Peru', 'Nuevos Soles', 'PEN', 'S/.');
INSERT INTO `currency` VALUES ('Philippines', 'Pesos', 'PHP', 'Php');
INSERT INTO `currency` VALUES ('Poland', 'Zlotych', 'PLN', 'zł');
INSERT INTO `currency` VALUES ('Qatar', 'Rials', 'QAR', '﷼');
INSERT INTO `currency` VALUES ('Romania', 'New Lei', 'RON', 'lei');
INSERT INTO `currency` VALUES ('Russia', 'Rubles', 'RUB', 'руб');
INSERT INTO `currency` VALUES ('Saint Helena', 'Pounds', 'SHP', '£');
INSERT INTO `currency` VALUES ('Saudi Arabia', 'Riyals', 'SAR', '﷼');
INSERT INTO `currency` VALUES ('Serbia', 'Dinars', 'RSD', 'Дин.');
INSERT INTO `currency` VALUES ('Seychelles', 'Rupees', 'SCR', '₨');
INSERT INTO `currency` VALUES ('Singapore', 'Dollars', 'SGD', '$');
INSERT INTO `currency` VALUES ('Slovenia', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Solomon Islands', 'Dollars', 'SBD', '$');
INSERT INTO `currency` VALUES ('Somalia', 'Shillings', 'SOS', 'S');
INSERT INTO `currency` VALUES ('South Africa', 'Rand', 'ZAR', 'R');
INSERT INTO `currency` VALUES ('South Korea', 'Won', 'KRW', '₩');
INSERT INTO `currency` VALUES ('Spain', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Sri Lanka', 'Rupees', 'LKR', '₨');
INSERT INTO `currency` VALUES ('Sweden', 'Kronor', 'SEK', 'kr');
INSERT INTO `currency` VALUES ('Switzerland', 'Francs', 'CHF', 'CHF');
INSERT INTO `currency` VALUES ('Suriname', 'Dollars', 'SRD', '$');
INSERT INTO `currency` VALUES ('Syria', 'Pounds', 'SYP', '£');
INSERT INTO `currency` VALUES ('Taiwan', 'New Dollars', 'TWD', 'NT$');
INSERT INTO `currency` VALUES ('Thailand', 'Baht', 'THB', '฿');
INSERT INTO `currency` VALUES ('Trinidad and Tobago', 'Dollars', 'TTD', 'TT$');
INSERT INTO `currency` VALUES ('Turkey', 'Lira', 'TRY', 'TL');
INSERT INTO `currency` VALUES ('Turkey', 'Liras', 'TRL', '£');
INSERT INTO `currency` VALUES ('Tuvalu', 'Dollars', 'TVD', '$');
INSERT INTO `currency` VALUES ('Ukraine', 'Hryvnia', 'UAH', '₴');
INSERT INTO `currency` VALUES ('United Kingdom', 'Pounds', 'GBP', '£');
INSERT INTO `currency` VALUES ('United States of America', 'Dollars', 'USD', '$');
INSERT INTO `currency` VALUES ('Uruguay', 'Pesos', 'UYU', '$U');
INSERT INTO `currency` VALUES ('Uzbekistan', 'Sums', 'UZS', 'лв');
INSERT INTO `currency` VALUES ('Vatican City', 'Euro', 'EUR', '€');
INSERT INTO `currency` VALUES ('Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs');
INSERT INTO `currency` VALUES ('Vietnam', 'Dong', 'VND', '₫');
INSERT INTO `currency` VALUES ('Yemen', 'Rials', 'YER', '﷼');
INSERT INTO `currency` VALUES ('Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$');
INSERT INTO `currency` VALUES ('Bangladesh', 'Taka', 'BDT', '৳');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) NOT NULL,
  `permission` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES ('1', 'Administrator', 'a:36:{i:0;s:10:\"createUser\";i:1;s:10:\"updateUser\";i:2;s:8:\"viewUser\";i:3;s:10:\"deleteUser\";i:4;s:11:\"createGroup\";i:5;s:11:\"updateGroup\";i:6;s:9:\"viewGroup\";i:7;s:11:\"deleteGroup\";i:8;s:11:\"createBrand\";i:9;s:11:\"updateBrand\";i:10;s:9:\"viewBrand\";i:11;s:11:\"deleteBrand\";i:12;s:14:\"createCategory\";i:13;s:14:\"updateCategory\";i:14;s:12:\"viewCategory\";i:15;s:14:\"deleteCategory\";i:16;s:11:\"createStore\";i:17;s:11:\"updateStore\";i:18;s:9:\"viewStore\";i:19;s:11:\"deleteStore\";i:20;s:15:\"createAttribute\";i:21;s:15:\"updateAttribute\";i:22;s:13:\"viewAttribute\";i:23;s:15:\"deleteAttribute\";i:24;s:13:\"createProduct\";i:25;s:13:\"updateProduct\";i:26;s:11:\"viewProduct\";i:27;s:13:\"deleteProduct\";i:28;s:11:\"createOrder\";i:29;s:11:\"updateOrder\";i:30;s:9:\"viewOrder\";i:31;s:11:\"deleteOrder\";i:32;s:11:\"viewReports\";i:33;s:13:\"updateCompany\";i:34;s:11:\"viewProfile\";i:35;s:13:\"updateSetting\";}');
INSERT INTO `groups` VALUES ('2', 'Editor', 'a:6:{i:0;s:11:\"createBrand\";i:1;s:14:\"createCategory\";i:2;s:11:\"createStore\";i:3;s:15:\"createAttribute\";i:4;s:13:\"createProduct\";i:5;s:11:\"createOrder\";}');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bill_no` varchar(255) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `gross_amount` varchar(255) NOT NULL,
  `service_charge_rate` varchar(255) NOT NULL,
  `service_charge` varchar(255) NOT NULL,
  `vat_charge_rate` varchar(255) NOT NULL,
  `vat_charge` varchar(255) NOT NULL,
  `net_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `paid_status` tinyint(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('2', 'tes4', 'parvez', 'kushtia', '34343', '2018-09-05', '100', '13', '13', '10', '10', '120', '3', '1', '1');
INSERT INTO `orders` VALUES ('3', 'tes4', 'parvez', 'kushtia', '34343', '2018-09-05', '100', '13', '13', '10', '10', '120', '3', '1', '1');
INSERT INTO `orders` VALUES ('4', 'tes4', 'parvez', 'kushtia', '34343', '2018-09-05', '100', '13', '13', '10', '10', '120', '3', '1', '1');
INSERT INTO `orders` VALUES ('5', 'ACP76', 'parvez', 'kushtia', '34343', '2018-09-05', '100', '13', '13', '10', '10', '120', '3', '1', '1');
INSERT INTO `orders` VALUES ('6', 'AKNJ7', 'Shohel Rana', 'natore', '03439843', '2018-09-05 17:23:54', '400', '13', '52.00', '10', '40.00', '400.00', '92', '1', '1');
INSERT INTO `orders` VALUES ('7', 'A5S8P', 'Shohag Dash', 'Natore', '343798', '2018-09-05 17:29:00', '38000', '13', '4940.00', '10', '3800.00', '46700.00', '40', '1', '1');
INSERT INTO `orders` VALUES ('8', 'AJ0VS', 'Shohag Dash', 'Natore', '343798', '2018-09-05 17:31:32', '38000', '13', '4940.00', '10', '3800.00', '46700.00', '40', '1', '1');
INSERT INTO `orders` VALUES ('9', 'AZIJ9', 'Reza', 'Dhaka', '3435', '2018-09-05 17:33:05', '34000', '13', '4420.00', '10', '3400.00', '41820.00', '', '1', '1');
INSERT INTO `orders` VALUES ('10', 'A0Q97', 'Waliulla', 'Dhaka', '459438543', '2018-09-05 17:34:50', '38000', '13', '4940.00', '10', '3800.00', '46000.00', '740', '1', '1');
INSERT INTO `orders` VALUES ('11', 'A1031', 'Mamun', 'Kushtia', '989454', '2018-09-05 19:51:23', '76000', '13', '9880.00', '10', '7600.00', '93400.00', '80', '1', '1');

-- ----------------------------
-- Table structure for orders_item
-- ----------------------------
DROP TABLE IF EXISTS `orders_item`;
CREATE TABLE `orders_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders_item
-- ----------------------------
INSERT INTO `orders_item` VALUES ('1', '7', '0', 'Array', 'Array', 'Array');
INSERT INTO `orders_item` VALUES ('2', '8', '0', 'Array', 'Array', 'Array');
INSERT INTO `orders_item` VALUES ('3', '9', '0', '1', '34000', '34000');
INSERT INTO `orders_item` VALUES ('4', '10', '3', '1', '38000', '38000');
INSERT INTO `orders_item` VALUES ('5', '11', '3', '2', '38000', '76000');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `qty` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `attribute_value_id` varchar(255) NOT NULL,
  `brand_id` text NOT NULL,
  `category_id` text NOT NULL,
  `store_id` int(11) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('2', 'Cori3 laptop', 'cori3-laptop', '34000', '100', 'assets/images/product_image/5b51b3f7339d6.jpg', '<p>This is description model</p>', '[\"9\",\"9\",\"10\"]', '26', '4', '3', '1', null);
INSERT INTO `products` VALUES ('3', 'Cori3 laptop', 'cori3laptop', '38000', '150', 'assets/images/product_image/5b960a748f81d1.97110897.jpg', '', '[\"9\",\"7\",\"17\"]', '26', '29', '3', '1', null);
INSERT INTO `products` VALUES ('6', 'product test', 'product-test', '100', '200', 'assets/images/product_image/5b960a64727378.29605693.jpg', '<p>dfsfs</p>', '[\"9\",\"7\",\"17\"]', '26', '5', '3', '1', '2018-08-06 16:55:48');
INSERT INTO `products` VALUES ('8', 'Photo product', 'Photo-product', '200', '30', 'assets/images/product_image/5b688c6a6b9ed5.45927866.jpg', '<p>\r\n\r\nà¦†à¦²à¦¹à¦¾à¦®à¦¦à§à¦°à¦¿à¦²à§à¦²à¦¾à¦¹ à¥¤ à¦†à¦²à§à¦²à¦¾à¦¹à§ à¦¤à¦¾à¦²à¦¾ à¦°à¦¾à¦¬à§à¦¬à§à¦²à¦†à¦² à¦†à¦®à¦¿à¦¨à§‡à¦° à¦…à¦¶à§‡à¦· à¦¦à¦¯à¦¼à¦¾à¦¯à¦¼ à¦†à¦®à¦°à¦¾ à¦®à¦¾ à¦“ à¦›à§‡à¦²à§‡ à¦­à¦¾à¦² à¦†à¦›à¦¿à¥¤ à¦¸à¦¬à¦¾à¦‡ à¦†à¦®à¦¾à¦° à¦•à¦²à¦¿à¦œà¦¾à¦° à¦œà¦¨à§à¦¯ à¦¦à§‹à¦¯à¦¼à¦¾ à¦•à¦°à¦¬à§‡à¦¨ à¥¤\r\n\r\n<br></p>', '[\"5\",\"8\",\"17\"]', '29', '5', '3', '1', '2018-08-06 19:59:06');
INSERT INTO `products` VALUES ('9', 'Product test', 'product-test', '600', '200', 'assets/images/product_image/5b960a834c1d07.67275438.jpg', '<p>\r\n\r\n</p><ul><li>PHP Extension curl.</li><li>PHP Extension gd.</li><li>PHP Extension iconv.</li><li>PHP Extension mcrypt.</li><li>PHP Extension simplexml.</li><li>PHP Extension spl.</li><li>PHP Extension xsl.</li><li>PHP Extension dom.</li><li>PHP Extension intl.</li><li>PHP Extension mbstring.</li><li>PHP Extension ctype.</li><li>PHP Extension hash.</li><li>PHP Extension pdo_mysql.</li><li>PHP Extension soap.</li><li>PHP Extension openssl.</li><li>PHP Extension zip.</li><li>PHP Extension phar.</li><li>PHP Extension libxml.</li><li>PHP Extension xmlwriter.</li><li>PHP Extension pcre.</li><li>PHP Extension bcmath.</li></ul>\r\n\r\n<br><p></p>', '[\"10\",\"7\",\"19\"]', '32', '5', '3', '1', '2018-08-07 11:13:17');
INSERT INTO `products` VALUES ('10', 'test3', 'test3', '454', '12', 'assets/images/product_image/5b6967ac2713e4.67790215.jpg', '<p></p><pre>test\r\n<br></pre><br><p></p>', '[\"12\",\"7\",\"21\"]', '30', '7', '3', '1', '2018-08-07 11:34:36');
INSERT INTO `products` VALUES ('11', 'test3', 'test3', '454', '12', 'assets/images/product_image/5b960a94333e31.26053753.jpg', '<p></p><pre><br></pre><br><p></p>', '[\"12\",\"8\",\"19\"]', '30', '7', '3', '1', '2018-08-07 11:36:03');
INSERT INTO `products` VALUES ('12', 'test5', 'tees', '400', '100', 'assets/images/product_image/5b960ab6f198e4.20956069.jpg', '<p>dsfds</p>', '[\"16\",\"8\",\"18\"]', '26', '4', '3', '1', '2018-08-07 11:48:25');
INSERT INTO `products` VALUES ('13', 'test6', 'test6', '100', '200', 'assets/images/product_image/5b696c4ad54730.20777472.jpg', '<p>dfgdg</p>', '[\"6\",\"13\",\"21\"]', '26', '4', '3', '1', '2018-08-07 11:54:18');
INSERT INTO `products` VALUES ('14', 'test7', 'test7', '2000', '400', 'assets/images/product_image/5b69777100caa4.78138084.jpg', '<p>this is the product</p>', '[\"5\",\"7\",\"17\"]', '32', '5', '3', '1', '2018-08-07 12:41:53');
INSERT INTO `products` VALUES ('18', 'Laptop e', 'Laptop-e', '500', '100', 'assets/images/product_image/5b952d9fe61c66.35564803.jpg', '<p>THis is product</p>', '[\"9\",\"7\",\"17\"]', '35', '7', '3', '1', '2018-09-08 09:18:45');
INSERT INTO `products` VALUES ('20', 'test', 'testy', '300', '266', 'assets/images/product_image/5b952e0729edc6.38879338.png', '<p>this is product description&nbsp;</p>', '[\"9\",\"13\",\"18\"]', '26', '5', '3', '1', '2018-09-09 16:28:23');
INSERT INTO `products` VALUES ('23', 'dsf', 'ddsfs', '200', '100', 'assets/images/product_image/5b96067e6a44e5.83383643.png', '<p>fhf</p>', '[\"12\",\"8\",\"19\"]', '30', '6', '3', '1', '2018-09-09 19:32:52');

-- ----------------------------
-- Table structure for stores
-- ----------------------------
DROP TABLE IF EXISTS `stores`;
CREATE TABLE `stores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stores
-- ----------------------------
INSERT INTO `stores` VALUES ('3', 'Stor1', '1');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'adminknst', '$2y$10$yfi5nUQGXUZtMdl27dWAyOd/jMOmATBpiUvJDmUu9hJ5Ro6BE5wsK', 'admin@admin.com', 'john', 'doe', '80789998', '1');
INSERT INTO `users` VALUES ('2', 'mamun', '$2y$10$a0TwZeg/FUrpsrMZphUgUu47uIUz0jkBYSj8Evbck37IOk3zLcJqO', 'mamunzet@gmail.com', 'Mamun', 'Rashed', '01722945055', '1');

-- ----------------------------
-- Table structure for user_group
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_group
-- ----------------------------
