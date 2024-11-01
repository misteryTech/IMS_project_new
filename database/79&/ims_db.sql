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

 Date: 01/11/2024 20:29:46
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
-- Table structure for meat_db
-- ----------------------------
DROP TABLE IF EXISTS `meat_db`;
CREATE TABLE `meat_db`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `meat_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `meat_parts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `meat_price` decimal(10, 2) NOT NULL,
  `purchased_date` date NOT NULL,
  `supplier_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `meat_disposed` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of meat_db
-- ----------------------------
INSERT INTO `meat_db` VALUES (10, 'Chicken', 'breast', 12311.99, '2024-09-18', '123', NULL);
INSERT INTO `meat_db` VALUES (12, 'Beef', 'tenderloin', 276.00, '2024-09-12', 'Mistery', '2024-09-19');

-- ----------------------------
-- Table structure for meat_new_db
-- ----------------------------
DROP TABLE IF EXISTS `meat_new_db`;
CREATE TABLE `meat_new_db`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `meat_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `meat_parts` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meat_new_db
-- ----------------------------
INSERT INTO `meat_new_db` VALUES (1, 'Pork', 'Loin');
INSERT INTO `meat_new_db` VALUES (2, 'Pork', 'Hump');
INSERT INTO `meat_new_db` VALUES (3, 'Beef', 'Hump');
INSERT INTO `meat_new_db` VALUES (4, 'Chicken', 'Wings');

-- ----------------------------
-- Table structure for meat_registration
-- ----------------------------
DROP TABLE IF EXISTS `meat_registration`;
CREATE TABLE `meat_registration`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `meat_type` enum('beef','pork','chicken') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `part` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` decimal(10, 2) NOT NULL,
  `price` decimal(10, 2) NOT NULL,
  `expiry_date` date NOT NULL,
  `batch_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `received_date` date NOT NULL,
  `supplier` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of meat_registration
-- ----------------------------

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
  `batch_number` int NULL DEFAULT NULL,
  `supplier` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of meat_registration_db
-- ----------------------------
INSERT INTO `meat_registration_db` VALUES (1, 'Pork', 'Loin', 50.00, '2024-10-18', '2024-10-26', 2, 'Mistery');
INSERT INTO `meat_registration_db` VALUES (2, 'Pork', 'Loin', 50.00, '2024-10-18', '2024-10-26', 2, 'Mistery');
INSERT INTO `meat_registration_db` VALUES (3, 'Beef', 'Hump', 2.00, '2024-10-18', '2024-10-19', 22, 'a');
INSERT INTO `meat_registration_db` VALUES (4, 'Beef', 'Hump', 2.00, '2024-10-18', '2024-10-19', 22, 'a');
INSERT INTO `meat_registration_db` VALUES (5, 'Chicken', 'Wings', 255555.00, '2024-10-18', '2024-10-19', 22, 'a');
INSERT INTO `meat_registration_db` VALUES (6, 'Beef', 'Hump', 123.00, '2024-11-21', '2024-11-01', 99, 'Mistery');

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
