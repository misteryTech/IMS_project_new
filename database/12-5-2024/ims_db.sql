/*
 Navicat Premium Dump SQL

 Source Server         : miste_ry
 Source Server Type    : MySQL
 Source Server Version : 100432 (10.4.32-MariaDB)
 Source Host           : localhost:3306
 Source Schema         : ims_db

 Target Server Type    : MySQL
 Target Server Version : 100432 (10.4.32-MariaDB)
 File Encoding         : 65001

 Date: 05/12/2024 09:57:46
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for inventory_trans
-- ----------------------------
DROP TABLE IF EXISTS `inventory_trans`;
CREATE TABLE `inventory_trans`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `productid` int NULL DEFAULT NULL,
  `transaction_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `transaction_date` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of inventory_trans
-- ----------------------------
INSERT INTO `inventory_trans` VALUES (1, 10, 'In', '123', '2024-09-26');
INSERT INTO `inventory_trans` VALUES (2, 11, 'In', '222222', '2024-09-13');
INSERT INTO `inventory_trans` VALUES (3, 10, 'In', '1', '2024-09-26');
INSERT INTO `inventory_trans` VALUES (4, 10, 'In', '', '2024-09-26');
INSERT INTO `inventory_trans` VALUES (5, 10, 'In', '', '2024-09-26');

-- ----------------------------
-- Table structure for meat_new_db
-- ----------------------------
DROP TABLE IF EXISTS `meat_new_db`;
CREATE TABLE `meat_new_db`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `meat_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `meat_parts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meat_new_db
-- ----------------------------
INSERT INTO `meat_new_db` VALUES (1, 'Pork', 'Loin');
INSERT INTO `meat_new_db` VALUES (2, 'Pork', 'Hump');
INSERT INTO `meat_new_db` VALUES (3, 'Beef', 'Hump');
INSERT INTO `meat_new_db` VALUES (4, 'Chicken', 'Wings');
INSERT INTO `meat_new_db` VALUES (5, 'Pork', 'Limbs');

-- ----------------------------
-- Table structure for meat_parts
-- ----------------------------
DROP TABLE IF EXISTS `meat_parts`;
CREATE TABLE `meat_parts`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `meat_type_id` int NOT NULL,
  `part_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `meat_type_id`(`meat_type_id` ASC) USING BTREE,
  CONSTRAINT `meat_parts_ibfk_1` FOREIGN KEY (`meat_type_id`) REFERENCES `meat_types` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meat_parts
-- ----------------------------
INSERT INTO `meat_parts` VALUES (6, 4, 'loin', '2024-11-08 00:16:38');
INSERT INTO `meat_parts` VALUES (7, 6, 'Hump', '2024-11-08 00:33:24');
INSERT INTO `meat_parts` VALUES (8, 4, 'Ribs', '2024-12-03 11:13:41');
INSERT INTO `meat_parts` VALUES (9, 4, 'Cowl', '2024-12-03 11:13:41');
INSERT INTO `meat_parts` VALUES (10, 4, 'Head', '2024-12-03 11:13:41');
INSERT INTO `meat_parts` VALUES (11, 7, 'Wings ', '2024-12-04 18:48:17');
INSERT INTO `meat_parts` VALUES (12, 7, 'Neck', '2024-12-04 18:48:17');
INSERT INTO `meat_parts` VALUES (13, 7, 'Feet', '2024-12-04 18:48:59');
INSERT INTO `meat_parts` VALUES (14, 7, 'Head', '2024-12-04 18:48:59');
INSERT INTO `meat_parts` VALUES (15, 7, 'Intistine', '2024-12-04 18:48:59');

-- ----------------------------
-- Table structure for meat_registration_db
-- ----------------------------
DROP TABLE IF EXISTS `meat_registration_db`;
CREATE TABLE `meat_registration_db`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `meat_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `part_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `date` date NULL DEFAULT NULL,
  `dispatch_date` date NULL DEFAULT NULL,
  `batch_number` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `supplier` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `stock` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meat_registration_db
-- ----------------------------
INSERT INTO `meat_registration_db` VALUES (1, 'Pork', 'Loin', 50.00, '2024-10-18', '2024-10-26', '2', 'Mistery', NULL);
INSERT INTO `meat_registration_db` VALUES (2, 'Pork', 'Loin', 50.00, '2024-10-18', '2024-10-26', '2', 'Mistery', NULL);
INSERT INTO `meat_registration_db` VALUES (4, 'Beef', 'Hump', 2.00, '2024-10-18', '2024-10-19', '22', 'a', NULL);
INSERT INTO `meat_registration_db` VALUES (6, 'Beef', 'Hump', 123.00, '2024-11-21', '2024-11-01', '99', 'Mistery', NULL);
INSERT INTO `meat_registration_db` VALUES (7, 'Beef', 'loin', 123.00, '2024-11-08', '2024-11-09', '123', 'Mistery', 19);
INSERT INTO `meat_registration_db` VALUES (8, 'Lamb', 'Hump', 99999999.99, '2024-11-09', '2024-11-30', '233', 'a', NULL);
INSERT INTO `meat_registration_db` VALUES (9, 'Beef', 'loin', 3350.00, '2024-11-19', '2024-11-20', '123123', 'Mistery', 20);
INSERT INTO `meat_registration_db` VALUES (10, 'Chicken', 'Wings ', 125.00, '2024-12-04', '2024-12-05', '433174', 'Mistery', 148);

-- ----------------------------
-- Table structure for meat_registration_dbs
-- ----------------------------
DROP TABLE IF EXISTS `meat_registration_dbs`;
CREATE TABLE `meat_registration_dbs`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `batch_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `meat_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `part_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `stock` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `batch_number`(`batch_number` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meat_registration_dbs
-- ----------------------------
INSERT INTO `meat_registration_dbs` VALUES (1, 'BATCH001', 'Beef', 'Tenderloin', 500.00, 20);
INSERT INTO `meat_registration_dbs` VALUES (2, '123123', 'Pork', 'Belly', 250.00, 50);
INSERT INTO `meat_registration_dbs` VALUES (3, 'BATCH003', 'Chicken', 'Breast', 150.00, 100);

-- ----------------------------
-- Table structure for meat_types
-- ----------------------------
DROP TABLE IF EXISTS `meat_types`;
CREATE TABLE `meat_types`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `meat_type` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meat_types
-- ----------------------------
INSERT INTO `meat_types` VALUES (4, 'Beef', '2024-11-08 00:06:08');
INSERT INTO `meat_types` VALUES (6, 'Lamb', '2024-11-08 00:16:26');
INSERT INTO `meat_types` VALUES (7, 'Chicken', '2024-12-04 18:47:56');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `meat_type_id` int NULL DEFAULT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp,
  `quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, 3, '2024-10-18', '122222');
INSERT INTO `orders` VALUES (2, 2, '2024-10-18', '100');
INSERT INTO `orders` VALUES (3, 2, '2024-10-18', '1222');

-- ----------------------------
-- Table structure for supplier
-- ----------------------------
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE `supplier`  (
  `supplier_id` int NOT NULL AUTO_INCREMENT,
  `shopname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `supplier_contact` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `supplier_shop_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`supplier_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1240 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of supplier
-- ----------------------------
INSERT INTO `supplier` VALUES (1238, 'Mistery', 'gensan', '111', 'starbright');
INSERT INTO `supplier` VALUES (1239, 'a', 'das', 'asd', 'asd');

-- ----------------------------
-- Table structure for transactions
-- ----------------------------
DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `items` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `total` decimal(10, 2) NOT NULL,
  `payment` decimal(10, 2) NOT NULL,
  `amount_change` decimal(10, 2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of transactions
-- ----------------------------
INSERT INTO `transactions` VALUES (1, '[{\"id\":\"9\",\"meat_type\":\"Beef\",\"part_name\":\"loin\",\"price\":\"3350.00\",\"date\":\"2024-11-19\",\"dispatch_date\":\"2024-11-20\",\"batch_number\":\"123123\",\"supplier\":\"Mistery\",\"stock\":\"30\",\"quantity\":\"20\",\"cost\":\"67000\"},{\"id\":\"7\",\"meat_type\":\"Beef\",\"part_name\":\"loin\",\"price\":\"123.00\",\"date\":\"2024-11-08\",\"dispatch_date\":\"2024-11-09\",\"batch_number\":\"123\",\"supplier\":\"Mistery\",\"stock\":\"30\",\"quantity\":\"20\",\"cost\":\"2460\"}]', 69460.00, 222222.00, 152762.00, '2024-11-25 07:03:31');
INSERT INTO `transactions` VALUES (2, '[{\"id\":\"10\",\"meat_type\":\"Chicken\",\"part_name\":\"Wings \",\"price\":\"125.00\",\"date\":\"2024-12-04\",\"dispatch_date\":\"2024-12-05\",\"batch_number\":\"433174\",\"supplier\":\"Mistery\",\"stock\":\"148\",\"quantity\":\"2\",\"cost\":\"250\"}]', 250.00, 500.00, 250.00, '2024-12-04 18:52:19');

-- ----------------------------
-- Table structure for type_meat_db
-- ----------------------------
DROP TABLE IF EXISTS `type_meat_db`;
CREATE TABLE `type_meat_db`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `meatname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `meat_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `meat_part` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of type_meat_db
-- ----------------------------
INSERT INTO `type_meat_db` VALUES (1, 'bagaso', 'Pork', 'Shoulder', '2024-09-24 03:31:17');
INSERT INTO `type_meat_db` VALUES (2, 'whole', 'Beef', 'Sirloin', '2024-09-24 03:31:49');
INSERT INTO `type_meat_db` VALUES (3, 'whole', 'Chicken', 'Wings', '2024-09-24 03:31:49');

-- ----------------------------
-- Table structure for user_db
-- ----------------------------
DROP TABLE IF EXISTS `user_db`;
CREATE TABLE `user_db`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_db
-- ----------------------------
INSERT INTO `user_db` VALUES (1, 'admin', 'admin', 'admin@gmail.com', 'admin', 'admin');

SET FOREIGN_KEY_CHECKS = 1;
