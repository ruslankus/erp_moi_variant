/*
Navicat MySQL Data Transfer

Source Server         : local
Source Server Version : 50538
Source Host           : localhost:3306
Source Database       : alex_erp2

Target Server Type    : MYSQL
Target Server Version : 50538
File Encoding         : 65001

Date: 2014-09-04 18:25:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `clients`
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `company_name` text,
  `surname` text,
  `personal_code` text,
  `company_code` text,
  `vat_code` text,
  `first_invoice_id` int(11) DEFAULT NULL,
  `last_invoice_id` int(11) DEFAULT NULL,
  `phones` text,
  `phone1` text,
  `phone2` text,
  `emails` text,
  `email1` text,
  `email2` text,
  `remark` text,
  `remark_for_service` text,
  `last_service_id` int(11) DEFAULT NULL,
  `next_service_id` int(11) DEFAULT NULL,
  `last_service_date` int(11) DEFAULT NULL,
  `next_service_date` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `user_modified_by` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `building_nr` varchar(255) DEFAULT NULL,
  `contract_number` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `last_service_id` (`last_service_id`),
  KEY `next_service_id` (`next_service_id`),
  KEY `first_invoice_id` (`first_invoice_id`),
  KEY `last_invoice_id` (`last_invoice_id`),
  KEY `type` (`type`),
  CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`first_invoice_id`) REFERENCES `operations_out` (`id`),
  CONSTRAINT `clients_ibfk_2` FOREIGN KEY (`last_invoice_id`) REFERENCES `operations_out` (`id`),
  CONSTRAINT `clients_ibfk_3` FOREIGN KEY (`type`) REFERENCES `client_types` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of clients
-- ----------------------------
INSERT INTO `clients` VALUES ('11', 'Viqtor', '', 'Creed', 'PER789456', '', 'VAT789789', null, null, null, '123456', '321654', null, 'test@test.com', 'mail@mail.com', 'Some info', 'Some info', null, null, null, null, '2', '1408958172', '1408958172', '1', null, null, null, 'Lithuania', 'Vilnius', 'Kalvariju g', '15 b', null);
INSERT INTO `clients` VALUES ('12', '', 'Senukai', '', 'PER78463', 'COCODE5646', 'VAT64893', null, null, null, '123456', '321654', null, 'em@ail.com', 'test@test.test', 'Some info', 'Some info', null, null, null, null, '1', '1408958292', '1408958292', '1', null, null, null, 'Lithuania', 'Vilnius', 'Kalvariju g', '89 g', null);
INSERT INTO `clients` VALUES ('13', 'Anatolij', '', 'Krupnov', 'PER9865', '', 'VAT54964', null, null, null, '123465', '', null, 'test@test.com', '', 'Some info', 'Some info', null, null, null, null, '2', '1409046662', '1409046662', '1', null, null, null, 'Lithuania', 'Panevezys', 'Krupnovo', '89 f', null);
INSERT INTO `clients` VALUES ('15', 'Igor', '', 'Strelkov', 'PER548964', '', 'VAT456DSF', null, null, null, '123456', '123456', null, 'test@test.com', 'test@test.com', 'Some info', 'Some info', null, null, null, null, '2', '1409747114', '1409747114', '1', null, null, null, 'Ukraine', 'Lugansk', 'Strelkov\'s', '89', null);

-- ----------------------------
-- Table structure for `client_types`
-- ----------------------------
DROP TABLE IF EXISTS `client_types`;
CREATE TABLE `client_types` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of client_types
-- ----------------------------
INSERT INTO `client_types` VALUES ('1', 'Juridical');
INSERT INTO `client_types` VALUES ('2', 'Physical');

-- ----------------------------
-- Table structure for `measure_units`
-- ----------------------------
DROP TABLE IF EXISTS `measure_units`;
CREATE TABLE `measure_units` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of measure_units
-- ----------------------------
INSERT INTO `measure_units` VALUES ('1', 'Units');
INSERT INTO `measure_units` VALUES ('2', 'Liters');
INSERT INTO `measure_units` VALUES ('3', 'Kg');
INSERT INTO `measure_units` VALUES ('4', 'Grams');
INSERT INTO `measure_units` VALUES ('5', 'Miligrams');
INSERT INTO `measure_units` VALUES ('6', 'Mililiters');

-- ----------------------------
-- Table structure for `operations_in`
-- ----------------------------
DROP TABLE IF EXISTS `operations_in`;
CREATE TABLE `operations_in` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) DEFAULT NULL,
  `invoice_code` text,
  `invoice_date` int(11) DEFAULT NULL,
  `warranty_days` int(11) DEFAULT NULL,
  `warranty_start_date` int(11) DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `signer_name` text,
  `date_created` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `user_modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`),
  KEY `payment_method_id` (`payment_method_id`),
  CONSTRAINT `operations_in_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`),
  CONSTRAINT `operations_in_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of operations_in
-- ----------------------------
INSERT INTO `operations_in` VALUES ('10', '9', 'INVCODE8974', null, null, null, null, 'Some Signer', '1408959961', '1408959961', null);
INSERT INTO `operations_in` VALUES ('11', '10', 'INV7896465', null, null, null, null, 'Tester', '1409308831', '1409308831', null);
INSERT INTO `operations_in` VALUES ('12', '10', 'INC5678645516', null, null, null, null, 'Igor Strelkov', '1409728901', '1409728901', null);
INSERT INTO `operations_in` VALUES ('13', '9', 'IV486465SDF', null, null, null, null, 'Igor Strelkov', '1409728965', '1409728965', null);
INSERT INTO `operations_in` VALUES ('14', '9', 'STREL5685FDS', null, null, null, null, 'Igor Strelkov', '1409743571', '1409743571', null);
INSERT INTO `operations_in` VALUES ('15', '10', 'MAV456DSF', null, null, null, null, 'Sergey Mavrin', '1409752385', '1409752385', null);

-- ----------------------------
-- Table structure for `operations_in_items`
-- ----------------------------
DROP TABLE IF EXISTS `operations_in_items`;
CREATE TABLE `operations_in_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_card_id` int(11) DEFAULT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `qnt` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `stock_qnt_after_op` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`operation_id`),
  KEY `product_card_id` (`product_card_id`),
  KEY `stock_id` (`stock_id`),
  CONSTRAINT `operations_in_items_ibfk_2` FOREIGN KEY (`product_card_id`) REFERENCES `product_cards` (`id`),
  CONSTRAINT `operations_in_items_ibfk_3` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`),
  CONSTRAINT `operations_in_items_ibfk_4` FOREIGN KEY (`operation_id`) REFERENCES `operations_in` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of operations_in_items
-- ----------------------------
INSERT INTO `operations_in_items` VALUES ('2', '9', '10', '5', '1408959961', '21000', '1', '5', '9');
INSERT INTO `operations_in_items` VALUES ('3', '10', '10', '10', '1408959961', '15000', '1', '10', '9');
INSERT INTO `operations_in_items` VALUES ('4', '11', '11', '2', '1409308831', '4000', '3', '2', '10');
INSERT INTO `operations_in_items` VALUES ('5', '12', '11', '2', '1409308831', '3000', '3', '2', '10');
INSERT INTO `operations_in_items` VALUES ('6', '11', '12', '4', '1409728901', '23000', '1', '4', '10');
INSERT INTO `operations_in_items` VALUES ('7', '9', '13', '4', '1409728965', '20000', '1', '5', '9');
INSERT INTO `operations_in_items` VALUES ('8', '10', '13', '4', '1409728965', '18000', '1', '9', '9');
INSERT INTO `operations_in_items` VALUES ('9', '9', '14', '10', '1409743571', '5000', '1', '10', '9');
INSERT INTO `operations_in_items` VALUES ('10', '10', '14', '10', '1409743571', '5000', '1', '12', '9');
INSERT INTO `operations_in_items` VALUES ('11', '11', '14', '10', '1409743571', '5000', '1', '10', '9');
INSERT INTO `operations_in_items` VALUES ('12', '12', '14', '10', '1409743571', '5000', '1', '10', '9');
INSERT INTO `operations_in_items` VALUES ('13', '9', '15', '20', '1409752385', '10000', '1', '21', '10');
INSERT INTO `operations_in_items` VALUES ('14', '10', '15', '20', '1409752385', '10000', '1', '22', '10');
INSERT INTO `operations_in_items` VALUES ('15', '11', '15', '10', '1409752385', '12000', '1', '11', '10');
INSERT INTO `operations_in_items` VALUES ('16', '12', '15', '10', '1409752385', '12000', '1', '12', '10');

-- ----------------------------
-- Table structure for `operations_out`
-- ----------------------------
DROP TABLE IF EXISTS `operations_out`;
CREATE TABLE `operations_out` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_code` text,
  `warranty_start_date` int(11) DEFAULT NULL,
  `payment_method_id` int(11) DEFAULT NULL,
  `signer_name` text,
  `client_id` int(11) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `user_modified_by` int(11) DEFAULT NULL,
  `vat_id` int(11) DEFAULT NULL,
  `invoice_date` int(11) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `payment_method_id` (`payment_method_id`),
  KEY `operations_out_ibfk_3` (`vat_id`),
  KEY `stock_id` (`stock_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `operations_out_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `operations_out_ibfk_2` FOREIGN KEY (`payment_method_id`) REFERENCES `payment_methods` (`id`),
  CONSTRAINT `operations_out_ibfk_3` FOREIGN KEY (`vat_id`) REFERENCES `vat` (`id`),
  CONSTRAINT `operations_out_ibfk_4` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`),
  CONSTRAINT `operations_out_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `operation_out_statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of operations_out
-- ----------------------------
INSERT INTO `operations_out` VALUES ('3', 'VLN_0001', '1409314430', null, '', '13', '1409314430', '1409314430', '1', '1', '1409668778', '1', '1');
INSERT INTO `operations_out` VALUES ('5', 'VLN_0002', '1409729253', null, '', '12', '1409729253', '1409729253', '1', '1', '1409729591', '1', '2');
INSERT INTO `operations_out` VALUES ('6', 'VLN_0004', '1409743000', null, '', '11', '1409743000', '1409743000', '1', '1', '1409743785', '1', '2');
INSERT INTO `operations_out` VALUES ('7', 'VLN_0003', '1409743767', null, '', '11', '1409743767', '1409743767', '1', '1', '1409743773', '1', '2');
INSERT INTO `operations_out` VALUES ('8', 'VLN_0006', '1409745246', null, '', '12', '1409745246', '1409745246', '1', '1', '1409746760', '1', '2');
INSERT INTO `operations_out` VALUES ('9', 'VLN_0005', '1409745403', null, '', '12', '1409745403', '1409745403', '1', '1', '1409746686', '1', '2');
INSERT INTO `operations_out` VALUES ('10', 'VLN_0009', '1409747202', null, '', '15', '1409747202', '1409747202', '1', '1', '1409748911', '1', '2');
INSERT INTO `operations_out` VALUES ('11', 'VLN_0010', '1409747262', null, '', '12', '1409747262', '1409747262', '1', '1', '1409748918', '1', '2');
INSERT INTO `operations_out` VALUES ('12', 'VLN_0007', '1409747464', null, '', '12', '1409747464', '1409747464', '1', '1', '1409747464', '1', '2');
INSERT INTO `operations_out` VALUES ('13', 'VLN_0008', '1409748882', null, '', '12', '1409748882', '1409748882', '1', '1', '1409748882', '1', '2');

-- ----------------------------
-- Table structure for `operations_out_items`
-- ----------------------------
DROP TABLE IF EXISTS `operations_out_items`;
CREATE TABLE `operations_out_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_card_id` int(11) DEFAULT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `qnt` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `stock_qnt_after_op` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `discount_percent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`operation_id`),
  KEY `product_card_id` (`product_card_id`),
  KEY `stock_id` (`stock_id`),
  CONSTRAINT `operations_out_items_ibfk_2` FOREIGN KEY (`product_card_id`) REFERENCES `product_cards` (`id`),
  CONSTRAINT `operations_out_items_ibfk_3` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`),
  CONSTRAINT `operations_out_items_ibfk_4` FOREIGN KEY (`operation_id`) REFERENCES `operations_out` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of operations_out_items
-- ----------------------------
INSERT INTO `operations_out_items` VALUES ('3', '9', '3', '2', null, '45000', '1', '1', '13', '40');
INSERT INTO `operations_out_items` VALUES ('4', '10', '3', '3', null, '35000', '1', '5', '13', '40');
INSERT INTO `operations_out_items` VALUES ('5', '9', '5', '3', null, '30000', '1', '2', '12', '10');
INSERT INTO `operations_out_items` VALUES ('6', '10', '5', '5', null, '28000', '1', '4', '12', '10');
INSERT INTO `operations_out_items` VALUES ('7', '11', '5', '2', null, '45000', '1', '2', '12', '15');
INSERT INTO `operations_out_items` VALUES ('8', '10', '6', '2', null, '18000', '1', '2', '11', '10');
INSERT INTO `operations_out_items` VALUES ('9', '9', '6', '2', null, '20000', '1', '0', '11', '20');
INSERT INTO `operations_out_items` VALUES ('10', '11', '6', '2', null, '23000', '1', '0', '11', '15');
INSERT INTO `operations_out_items` VALUES ('11', '10', '7', '2', null, '5000', '1', '10', '11', '20');
INSERT INTO `operations_out_items` VALUES ('12', '9', '7', '2', null, '4000', '1', '8', '11', '10');
INSERT INTO `operations_out_items` VALUES ('13', '11', '7', '3', null, '12000', '1', '7', '11', '12');
INSERT INTO `operations_out_items` VALUES ('14', '12', '7', '1', null, '11500', '1', '9', '11', '20');
INSERT INTO `operations_out_items` VALUES ('15', '10', '8', '2', null, '50000', '1', '8', '12', '30');
INSERT INTO `operations_out_items` VALUES ('16', '9', '8', '2', null, '50000', '1', '6', '12', '40');
INSERT INTO `operations_out_items` VALUES ('17', '11', '8', '2', null, '50000', '1', '5', '12', '55');
INSERT INTO `operations_out_items` VALUES ('18', '12', '8', '2', null, '50000', '1', '7', '12', '60');
INSERT INTO `operations_out_items` VALUES ('19', '10', '9', '2', null, '30000', '1', '6', '12', '10');
INSERT INTO `operations_out_items` VALUES ('20', '11', '9', '1', null, '30000', '1', '4', '12', '10');
INSERT INTO `operations_out_items` VALUES ('21', '12', '9', '2', null, '30000', '1', '5', '12', '10');
INSERT INTO `operations_out_items` VALUES ('22', '9', '9', '2', null, '30000', '1', '4', '12', '10');
INSERT INTO `operations_out_items` VALUES ('23', '9', '10', '1', null, '25000', '1', '3', '15', '10');
INSERT INTO `operations_out_items` VALUES ('24', '10', '10', '2', null, '20000', '1', '4', '15', '10');
INSERT INTO `operations_out_items` VALUES ('25', '11', '10', '2', null, '35000', '1', '2', '15', '10');
INSERT INTO `operations_out_items` VALUES ('26', '9', '11', '1', null, '50000', '1', '2', '12', '20');
INSERT INTO `operations_out_items` VALUES ('27', '10', '11', '1', null, '50000', '1', '3', '12', '20');
INSERT INTO `operations_out_items` VALUES ('28', '12', '11', '2', null, '50000', '1', '3', '12', '20');
INSERT INTO `operations_out_items` VALUES ('29', '12', '12', '1', null, '20000', '1', '2', '12', '10');
INSERT INTO `operations_out_items` VALUES ('30', '9', '13', '1', null, '1000', '1', '1', '12', '5');
INSERT INTO `operations_out_items` VALUES ('31', '10', '13', '1', null, '1000', '1', '2', '12', '5');
INSERT INTO `operations_out_items` VALUES ('32', '11', '13', '1', null, '1000', '1', '1', '12', '5');

-- ----------------------------
-- Table structure for `operations_out_opt_items`
-- ----------------------------
DROP TABLE IF EXISTS `operations_out_opt_items`;
CREATE TABLE `operations_out_opt_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operation_id` int(11) DEFAULT NULL,
  `option_card_id` int(11) DEFAULT NULL,
  `qnt` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount_percent` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option_card_id` (`option_card_id`),
  KEY `operation_id` (`operation_id`),
  CONSTRAINT `operations_out_opt_items_ibfk_2` FOREIGN KEY (`option_card_id`) REFERENCES `option_cards` (`id`),
  CONSTRAINT `operations_out_opt_items_ibfk_3` FOREIGN KEY (`operation_id`) REFERENCES `operations_out` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of operations_out_opt_items
-- ----------------------------
INSERT INTO `operations_out_opt_items` VALUES ('2', '3', '1', '1', '10000', null, '13', null);
INSERT INTO `operations_out_opt_items` VALUES ('3', '5', '1', '1', '5000', null, '12', null);
INSERT INTO `operations_out_opt_items` VALUES ('4', '8', '1', '1', '2000', null, '12', null);
INSERT INTO `operations_out_opt_items` VALUES ('5', '10', '2', '1', '2000', null, '15', null);
INSERT INTO `operations_out_opt_items` VALUES ('6', '11', '2', '1', '3000', null, '12', null);
INSERT INTO `operations_out_opt_items` VALUES ('7', '13', '1', '1', '1000', null, '12', null);

-- ----------------------------
-- Table structure for `operations_srv_items`
-- ----------------------------
DROP TABLE IF EXISTS `operations_srv_items`;
CREATE TABLE `operations_srv_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `operaion_id` int(11) DEFAULT NULL,
  `service_process_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `under_warranty` int(11) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_process_id` (`service_process_id`),
  KEY `invoice_id` (`operaion_id`),
  CONSTRAINT `operations_srv_items_ibfk_1` FOREIGN KEY (`service_process_id`) REFERENCES `service_processes` (`id`),
  CONSTRAINT `operations_srv_items_ibfk_2` FOREIGN KEY (`operaion_id`) REFERENCES `operations_out` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of operations_srv_items
-- ----------------------------

-- ----------------------------
-- Table structure for `operation_out_statuses`
-- ----------------------------
DROP TABLE IF EXISTS `operation_out_statuses`;
CREATE TABLE `operation_out_statuses` (
  `id` int(11) NOT NULL DEFAULT '0',
  `label` text,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of operation_out_statuses
-- ----------------------------
INSERT INTO `operation_out_statuses` VALUES ('1', null, 'Delivered');
INSERT INTO `operation_out_statuses` VALUES ('2', null, 'On the way');

-- ----------------------------
-- Table structure for `option_cards`
-- ----------------------------
DROP TABLE IF EXISTS `option_cards`;
CREATE TABLE `option_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `date_created` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `user_modified_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of option_cards
-- ----------------------------
INSERT INTO `option_cards` VALUES ('1', 'Delivery', '1408959551', '1408959568', '1', '1');
INSERT INTO `option_cards` VALUES ('2', 'Fast delivery', '1408959551', '1408959568', '1', '1');

-- ----------------------------
-- Table structure for `payment_methods`
-- ----------------------------
DROP TABLE IF EXISTS `payment_methods`;
CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `description` text,
  `remark` text,
  `date_created` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `user_modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of payment_methods
-- ----------------------------

-- ----------------------------
-- Table structure for `positions`
-- ----------------------------
DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `remark` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of positions
-- ----------------------------
INSERT INTO `positions` VALUES ('1', 'Manager', 'test');
INSERT INTO `positions` VALUES ('2', 'Worker', 'test');

-- ----------------------------
-- Table structure for `product_cards`
-- ----------------------------
DROP TABLE IF EXISTS `product_cards`;
CREATE TABLE `product_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `product_name` text,
  `product_code` text,
  `description` text,
  `default_price` int(11) DEFAULT NULL,
  `measure_units_id` int(11) DEFAULT NULL,
  `additional_params` text,
  `status` int(11) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `user_modified_by` int(11) DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `weight_net` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `size_units_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `measure_units_id` (`measure_units_id`),
  KEY `size_units_id` (`size_units_id`),
  CONSTRAINT `product_cards_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `product_card_categories` (`id`),
  CONSTRAINT `product_cards_ibfk_2` FOREIGN KEY (`measure_units_id`) REFERENCES `measure_units` (`id`),
  CONSTRAINT `product_cards_ibfk_3` FOREIGN KEY (`size_units_id`) REFERENCES `size_units` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_cards
-- ----------------------------
INSERT INTO `product_cards` VALUES ('9', '7', 'Intel Core i7', 'PROD1234', '4 cores, 3 Ghz, 8 MB cache', null, '1', null, '1', '1408959551', '1408959568', '1', '1020', '1000', '10', '10', '10', '1');
INSERT INTO `product_cards` VALUES ('10', '7', 'Intel Core i5', 'PROD789', '4 cores, 2.5 Ghz', null, '1', null, '1', '1408959630', '1408959630', '1', '1020', '1000', '10', '10', '10', '1');
INSERT INTO `product_cards` VALUES ('11', '8', 'nVIDIA GTX 760 ', 'PROD456', 'Some info', null, '1', null, '1', '1408959755', '1408959755', '1', '1020', '1000', '10', '10', '10', '1');
INSERT INTO `product_cards` VALUES ('12', '8', 'nVIDIA GTX 560', 'PROD5864', 'Some info', null, '1', null, '1', '1408965216', '1408965216', '1', '1020', '1000', '10', '10', '10', '1');
INSERT INTO `product_cards` VALUES ('13', '7', 'AMD Atom Xtreme', 'PROD4234', 'Some info', null, '1', null, '1', '1408970273', '1408970273', '1', '1020', '1000', '10', '10', '10', '1');
INSERT INTO `product_cards` VALUES ('14', '8', 'AMD Radeon HD 9700', 'RAD8964SDF', 'Video card', null, '1', null, '1', '1409844276', '1409844304', '1', '1200', '1000', '10', '50', '20', '2');

-- ----------------------------
-- Table structure for `product_card_categories`
-- ----------------------------
DROP TABLE IF EXISTS `product_card_categories`;
CREATE TABLE `product_card_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `remark` text,
  `status` int(11) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `user_modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_card_categories
-- ----------------------------
INSERT INTO `product_card_categories` VALUES ('7', 'Processors', 'Some info', null, '1408959409', '1408959409', '1');
INSERT INTO `product_card_categories` VALUES ('8', 'Video cards', 'Some info', null, '1408959459', '1408959805', '1');

-- ----------------------------
-- Table structure for `product_files`
-- ----------------------------
DROP TABLE IF EXISTS `product_files`;
CREATE TABLE `product_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_card_id` int(11) DEFAULT NULL,
  `filename` text,
  `label` text,
  PRIMARY KEY (`id`),
  KEY `product_card_id` (`product_card_id`),
  CONSTRAINT `product_files_ibfk_1` FOREIGN KEY (`product_card_id`) REFERENCES `product_cards` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_files
-- ----------------------------

-- ----------------------------
-- Table structure for `product_in_stock`
-- ----------------------------
DROP TABLE IF EXISTS `product_in_stock`;
CREATE TABLE `product_in_stock` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_id` int(11) DEFAULT NULL,
  `product_card_id` int(11) DEFAULT NULL,
  `qnt` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_card_id` (`product_card_id`),
  KEY `stock_id` (`stock_id`),
  CONSTRAINT `product_in_stock_ibfk_1` FOREIGN KEY (`product_card_id`) REFERENCES `product_cards` (`id`),
  CONSTRAINT `product_in_stock_ibfk_2` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_in_stock
-- ----------------------------
INSERT INTO `product_in_stock` VALUES ('1', '1', '9', '21', '1409752385', '1408959961');
INSERT INTO `product_in_stock` VALUES ('2', '1', '10', '22', '1409752385', '1408959961');
INSERT INTO `product_in_stock` VALUES ('3', '3', '11', '2', '1409308831', '1409308831');
INSERT INTO `product_in_stock` VALUES ('4', '3', '12', '2', '1409308831', '1409308831');
INSERT INTO `product_in_stock` VALUES ('5', '1', '11', '11', '1409752385', '1409728901');
INSERT INTO `product_in_stock` VALUES ('6', '1', '12', '12', '1409752385', '1409743571');

-- ----------------------------
-- Table structure for `rights`
-- ----------------------------
DROP TABLE IF EXISTS `rights`;
CREATE TABLE `rights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `label` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rights
-- ----------------------------
INSERT INTO `rights` VALUES ('1', 'can see products', 'products_see');
INSERT INTO `rights` VALUES ('2', 'can see product categories', 'categories_see');
INSERT INTO `rights` VALUES ('3', 'can edit prodcut categories', 'categories_edit');
INSERT INTO `rights` VALUES ('4', 'can delete product categories', 'categories_delete');
INSERT INTO `rights` VALUES ('5', 'can edit products', 'products_edit');
INSERT INTO `rights` VALUES ('6', 'can delete products', 'products_delete');
INSERT INTO `rights` VALUES ('7', 'can create categories', 'categories_add');
INSERT INTO `rights` VALUES ('8', 'can create products', 'products_add');
INSERT INTO `rights` VALUES ('9', 'access to products section', 'products_section_see');
INSERT INTO `rights` VALUES ('10', 'can see contractors', 'contractors_section_see');
INSERT INTO `rights` VALUES ('11', 'can see employees', 'employees_section_see');
INSERT INTO `rights` VALUES ('13', 'can see clients', 'clients_see');
INSERT INTO `rights` VALUES ('14', 'can edit clients', 'clients_edit');
INSERT INTO `rights` VALUES ('15', 'can delete clients', 'clients_delete');
INSERT INTO `rights` VALUES ('16', 'can add clients', 'clients_add');
INSERT INTO `rights` VALUES ('17', 'can see suppliers', 'suppliers_see');
INSERT INTO `rights` VALUES ('18', 'can edit suppliers', 'suppliers_edit');
INSERT INTO `rights` VALUES ('19', 'can add suppliers', 'suppliers_add');
INSERT INTO `rights` VALUES ('20', 'can delete suppliers', 'suppliers_delete');
INSERT INTO `rights` VALUES ('21', 'can see users', 'users_see');
INSERT INTO `rights` VALUES ('22', 'can add users', 'users_add');
INSERT INTO `rights` VALUES ('23', 'can suspend users', 'users_suspend');
INSERT INTO `rights` VALUES ('24', 'can change users', 'users_edit');
INSERT INTO `rights` VALUES ('25', 'can delete users', 'users_delete');
INSERT INTO `rights` VALUES ('26', 'can sell products', 'sales_add');
INSERT INTO `rights` VALUES ('27', 'can see all outgoing invoices', 'sales_see');
INSERT INTO `rights` VALUES ('28', 'call see all incoming invoices', 'purchases_see');
INSERT INTO `rights` VALUES ('29', 'can buy products', 'purchases_add');
INSERT INTO `rights` VALUES ('30', 'can see services', 'services_see');
INSERT INTO `rights` VALUES ('31', 'can edit serives', 'services_edit');
INSERT INTO `rights` VALUES ('32', 'can add services', 'services_add');
INSERT INTO `rights` VALUES ('33', 'can delete services', 'services_delete');
INSERT INTO `rights` VALUES ('34', 'cas see stock', 'stock_see');
INSERT INTO `rights` VALUES ('35', 'can edit stock', 'stock_edit');
INSERT INTO `rights` VALUES ('36', 'can add to stock', 'stock_add');

-- ----------------------------
-- Table structure for `service_problem_types`
-- ----------------------------
DROP TABLE IF EXISTS `service_problem_types`;
CREATE TABLE `service_problem_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` text,
  `description` text,
  `problem_code` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of service_problem_types
-- ----------------------------
INSERT INTO `service_problem_types` VALUES ('1', 'Голова застряла в мясорубке', 'Серьезная проблема', 'GOLMIAS846');
INSERT INTO `service_problem_types` VALUES ('2', 'Фильтр избивает человека', 'Страшно и опасно', 'FILTIZB4874D');

-- ----------------------------
-- Table structure for `service_processes`
-- ----------------------------
DROP TABLE IF EXISTS `service_processes`;
CREATE TABLE `service_processes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` text,
  `remark` text,
  `start_date` int(11) DEFAULT NULL,
  `close_date` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `operation_id` int(11) DEFAULT NULL,
  `problem_type_id` int(11) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `user_created_by` int(11) DEFAULT NULL,
  `user_modified_by` int(11) DEFAULT NULL,
  `priority` text,
  `current_employee_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `problem_type_id` (`problem_type_id`),
  KEY `service_processes_ibfk_2` (`operation_id`),
  KEY `user_modified_by` (`user_modified_by`),
  KEY `current_employee_id` (`current_employee_id`),
  KEY `user_created_by` (`user_created_by`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `service_processes_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  CONSTRAINT `service_processes_ibfk_2` FOREIGN KEY (`operation_id`) REFERENCES `operations_out_items` (`id`),
  CONSTRAINT `service_processes_ibfk_3` FOREIGN KEY (`problem_type_id`) REFERENCES `service_problem_types` (`id`),
  CONSTRAINT `service_processes_ibfk_5` FOREIGN KEY (`user_modified_by`) REFERENCES `users` (`id`),
  CONSTRAINT `service_processes_ibfk_6` FOREIGN KEY (`current_employee_id`) REFERENCES `users` (`id`),
  CONSTRAINT `service_processes_ibfk_7` FOREIGN KEY (`user_created_by`) REFERENCES `users` (`id`),
  CONSTRAINT `service_processes_ibfk_8` FOREIGN KEY (`status_id`) REFERENCES `service_process_statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of service_processes
-- ----------------------------
INSERT INTO `service_processes` VALUES ('20', null, 'Some problem description', '1409392065', '1409737665', '11', '1', null, '1', '1408960065', '1408960065', null, '1', 'medium', '5');
INSERT INTO `service_processes` VALUES ('21', null, 'Some problem description', '1409478649', '1410429049', '12', '1', null, '2', '1408960249', '1408960249', null, '1', 'low', '3');

-- ----------------------------
-- Table structure for `service_process_statuses`
-- ----------------------------
DROP TABLE IF EXISTS `service_process_statuses`;
CREATE TABLE `service_process_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` text,
  `system_id` text,
  `system` int(11) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of service_process_statuses
-- ----------------------------
INSERT INTO `service_process_statuses` VALUES ('1', 'opened', 'SYS_OPENED', '1', '1');
INSERT INTO `service_process_statuses` VALUES ('2', 'in progress', 'SYS_PROGRESS', '1', '2');
INSERT INTO `service_process_statuses` VALUES ('3', 'closed', 'SYS_CLOSED', '1', '3');

-- ----------------------------
-- Table structure for `service_resolutions`
-- ----------------------------
DROP TABLE IF EXISTS `service_resolutions`;
CREATE TABLE `service_resolutions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_process_id` int(11) DEFAULT NULL,
  `by_employee_id` int(11) DEFAULT NULL,
  `remark_for_employee` text,
  `remark_by_employee` text,
  `process_current_status` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `user_modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `service_process_id` (`service_process_id`),
  KEY `by_employee_id` (`by_employee_id`),
  CONSTRAINT `service_resolutions_ibfk_1` FOREIGN KEY (`service_process_id`) REFERENCES `service_processes` (`id`),
  CONSTRAINT `service_resolutions_ibfk_2` FOREIGN KEY (`by_employee_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of service_resolutions
-- ----------------------------
INSERT INTO `service_resolutions` VALUES ('6', '20', '5', 'Some problem description', null, '1', '1', null, null, null);
INSERT INTO `service_resolutions` VALUES ('7', '21', '3', 'Some problem description', null, '1', '1', null, null, null);

-- ----------------------------
-- Table structure for `size_units`
-- ----------------------------
DROP TABLE IF EXISTS `size_units`;
CREATE TABLE `size_units` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of size_units
-- ----------------------------
INSERT INTO `size_units` VALUES ('1', 'Meters');
INSERT INTO `size_units` VALUES ('2', 'Centimeters');
INSERT INTO `size_units` VALUES ('3', 'Milimeters');

-- ----------------------------
-- Table structure for `stocks`
-- ----------------------------
DROP TABLE IF EXISTS `stocks`;
CREATE TABLE `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `location_id` int(11) DEFAULT NULL,
  `description` text,
  `date_created` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `user_modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `location_id` (`location_id`),
  CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `user_cities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of stocks
-- ----------------------------
INSERT INTO `stocks` VALUES ('1', 'Superstock', '1', 'Some info', '0', '0', '1');
INSERT INTO `stocks` VALUES ('3', 'Hyperstock', '2', 'Some info', '0', '0', '1');
INSERT INTO `stocks` VALUES ('4', 'Terastock', '3', 'Some info', '0', '0', '1');

-- ----------------------------
-- Table structure for `suppliers`
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` text,
  `company_code` text,
  `vat_code` text,
  `phones` text,
  `phone1` text,
  `phone2` text,
  `emails` text,
  `email1` text,
  `email2` text,
  `remark` text,
  `date_created` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `user_modified_by` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `street` varchar(255) DEFAULT NULL,
  `building_nr` varchar(255) DEFAULT NULL,
  `contract_number` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES ('8', 'AMD', 'COCODE8797', 'VAT568854', null, '123456', '632145', null, 'email@mail.com', 'test@test.com', 'Some info', '1408958395', '1408958395', '1', null, null, 'USA', 'New York', 'Some Street', '56', null);
INSERT INTO `suppliers` VALUES ('9', 'Intel', 'COCODE8757', 'VAT568354', null, '123456', '321654', null, 'email@mail.com', 'test@test.com', 'Some info', '1408958465', '1408958465', '1', null, null, 'USA', 'Washington', 'Some street', '89', null);
INSERT INTO `suppliers` VALUES ('10', 'nVidia', 'COCODE8357', 'VAT568324', null, '1123456', '321654', null, 'email@mail.com', 'test@test.com', 'Some info', '1408958540', '1408958540', '1', null, null, 'China', 'Pekin', 'Some street', '56', null);

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text,
  `password` text,
  `email` text,
  `name` text,
  `surname` text,
  `phone` text,
  `address` text,
  `remark` text,
  `additional_params` text,
  `role` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `date_changed` int(11) DEFAULT NULL,
  `user_modified_by` int(11) DEFAULT NULL,
  `avatar` text,
  `position_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `position_id` (`position_id`),
  KEY `city_id` (`city_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`),
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `user_cities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'darkoffalex@yandex.ru', 'Valery', 'Gatalsky', '123456', 'test', 'test', null, '1', '1', '1405511917', '1406644184', '1', '4eyKD9En.jpg', '1', '1');
INSERT INTO `users` VALUES ('3', 'test', '81dc9bdb52d04dc20036dbd8313ed055', 'email@test.com', 'Vasia', 'Pupkin', '5468514', 'Test', 'Remark', null, '0', '1', '1405511917', '1406644178', '1', 'HBTbtBrY.jpg', '2', '2');
INSERT INTO `users` VALUES ('4', 'rest', '81dc9bdb52d04dc20036dbd8313ed055', 'darkoffalegz@yandex.ru', 'Pinislav', 'Kuriskin', '5489465', '', '', null, '0', '1', '1405511917', '1406644172', '1', 'HBTbtBrY.jpg', '2', '3');
INSERT INTO `users` VALUES ('5', 'vovan', '81dc9bdb52d04dc20036dbd8313ed055', 'vovan@vovnet.com', 'Vovan', 'Limonov', '54646', 'test', 'test', null, '0', null, '1406117121', '1406644633', '1', 'av_53d7b199d9ac7.jpg', '2', '1');

-- ----------------------------
-- Table structure for `user_cities`
-- ----------------------------
DROP TABLE IF EXISTS `user_cities`;
CREATE TABLE `user_cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` text,
  `country` text,
  `prefix` text,
  `changed_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_cities
-- ----------------------------
INSERT INTO `user_cities` VALUES ('1', 'Vilnius', 'Lithuania', 'VLN', null);
INSERT INTO `user_cities` VALUES ('2', 'Kaunas', 'Lithuania', 'KAU', null);
INSERT INTO `user_cities` VALUES ('3', 'Panevezys', 'Lithuania', 'PNV', null);

-- ----------------------------
-- Table structure for `user_rights`
-- ----------------------------
DROP TABLE IF EXISTS `user_rights`;
CREATE TABLE `user_rights` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `rights_id` int(11) DEFAULT NULL,
  `right_value` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rights_id` (`rights_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `user_rights_ibfk_1` FOREIGN KEY (`rights_id`) REFERENCES `rights` (`id`),
  CONSTRAINT `user_rights_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=372 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user_rights
-- ----------------------------
INSERT INTO `user_rights` VALUES ('327', '3', '1', '1');
INSERT INTO `user_rights` VALUES ('328', '3', '7', '1');
INSERT INTO `user_rights` VALUES ('329', '3', '2', '1');
INSERT INTO `user_rights` VALUES ('330', '3', '13', '1');
INSERT INTO `user_rights` VALUES ('331', '3', '17', '1');
INSERT INTO `user_rights` VALUES ('332', '3', '28', '1');
INSERT INTO `user_rights` VALUES ('333', '3', '27', '1');
INSERT INTO `user_rights` VALUES ('334', '1', '6', '1');
INSERT INTO `user_rights` VALUES ('335', '1', '5', '1');
INSERT INTO `user_rights` VALUES ('336', '1', '8', '1');
INSERT INTO `user_rights` VALUES ('337', '1', '1', '1');
INSERT INTO `user_rights` VALUES ('338', '1', '4', '1');
INSERT INTO `user_rights` VALUES ('339', '1', '3', '1');
INSERT INTO `user_rights` VALUES ('340', '1', '7', '1');
INSERT INTO `user_rights` VALUES ('341', '1', '2', '1');
INSERT INTO `user_rights` VALUES ('342', '1', '15', '1');
INSERT INTO `user_rights` VALUES ('343', '1', '14', '1');
INSERT INTO `user_rights` VALUES ('344', '1', '16', '1');
INSERT INTO `user_rights` VALUES ('345', '1', '13', '1');
INSERT INTO `user_rights` VALUES ('346', '1', '20', '1');
INSERT INTO `user_rights` VALUES ('347', '1', '18', '1');
INSERT INTO `user_rights` VALUES ('348', '1', '19', '1');
INSERT INTO `user_rights` VALUES ('349', '1', '17', '1');
INSERT INTO `user_rights` VALUES ('350', '1', '29', '1');
INSERT INTO `user_rights` VALUES ('351', '1', '28', '1');
INSERT INTO `user_rights` VALUES ('352', '1', '26', '1');
INSERT INTO `user_rights` VALUES ('353', '1', '27', '1');
INSERT INTO `user_rights` VALUES ('354', '1', '33', '1');
INSERT INTO `user_rights` VALUES ('355', '1', '31', '1');
INSERT INTO `user_rights` VALUES ('356', '1', '32', '1');
INSERT INTO `user_rights` VALUES ('357', '1', '30', '1');
INSERT INTO `user_rights` VALUES ('358', '1', '25', '1');
INSERT INTO `user_rights` VALUES ('359', '1', '24', '1');
INSERT INTO `user_rights` VALUES ('360', '1', '22', '1');
INSERT INTO `user_rights` VALUES ('361', '1', '21', '1');
INSERT INTO `user_rights` VALUES ('362', '5', '1', '1');
INSERT INTO `user_rights` VALUES ('363', '5', '2', '1');
INSERT INTO `user_rights` VALUES ('364', '5', '13', '1');
INSERT INTO `user_rights` VALUES ('365', '5', '17', '1');
INSERT INTO `user_rights` VALUES ('366', '5', '28', '1');
INSERT INTO `user_rights` VALUES ('367', '5', '27', '1');
INSERT INTO `user_rights` VALUES ('368', '5', '21', '1');
INSERT INTO `user_rights` VALUES ('369', '1', '34', '1');
INSERT INTO `user_rights` VALUES ('370', '1', '35', '1');
INSERT INTO `user_rights` VALUES ('371', '1', '36', '1');

-- ----------------------------
-- Table structure for `vat`
-- ----------------------------
DROP TABLE IF EXISTS `vat`;
CREATE TABLE `vat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `percent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of vat
-- ----------------------------
INSERT INTO `vat` VALUES ('1', '21');
INSERT INTO `vat` VALUES ('2', '19');
INSERT INTO `vat` VALUES ('3', '0');
