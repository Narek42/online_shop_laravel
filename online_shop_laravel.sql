/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100417
 Source Host           : localhost:3306
 Source Schema         : online_shop_laravel

 Target Server Type    : MySQL
 Target Server Version : 100417
 File Encoding         : 65001

 Date: 22/04/2021 15:16:49
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bay_products
-- ----------------------------
DROP TABLE IF EXISTS `bay_products`;
CREATE TABLE `bay_products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `product_id`(`product_id`) USING BTREE,
  CONSTRAINT `bay_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bay_products_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bay_products
-- ----------------------------
INSERT INTO `bay_products` VALUES (1, 8, 36);
INSERT INTO `bay_products` VALUES (2, 8, 41);
INSERT INTO `bay_products` VALUES (3, 8, 35);
INSERT INTO `bay_products` VALUES (4, 8, 39);

-- ----------------------------
-- Table structure for block
-- ----------------------------
DROP TABLE IF EXISTS `block`;
CREATE TABLE `block`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `admin_id` int(11) NULL DEFAULT NULL,
  `time` int(255) NULL DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `admin_id`(`admin_id`) USING BTREE,
  CONSTRAINT `block_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `block_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 45 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of block
-- ----------------------------
INSERT INTO `block` VALUES (43, 11, 10, 1617188127, 'sljdkf');

-- ----------------------------
-- Table structure for card
-- ----------------------------
DROP TABLE IF EXISTS `card`;
CREATE TABLE `card`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `qanak` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `product_id`(`product_id`) USING BTREE,
  CONSTRAINT `card_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `card_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of card
-- ----------------------------
INSERT INTO `card` VALUES (34, 8, 33, '1');

-- ----------------------------
-- Table structure for catalog
-- ----------------------------
DROP TABLE IF EXISTS `catalog`;
CREATE TABLE `catalog`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of catalog
-- ----------------------------
INSERT INTO `catalog` VALUES (1, 'Smartphones');
INSERT INTO `catalog` VALUES (2, 'Appliances');
INSERT INTO `catalog` VALUES (3, 'Tablets');
INSERT INTO `catalog` VALUES (4, 'Laptops');
INSERT INTO `catalog` VALUES (5, 'Computers');

-- ----------------------------
-- Table structure for feedback
-- ----------------------------
DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `stars` int(11) NULL DEFAULT NULL,
  `review` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_Id`(`user_id`) USING BTREE,
  INDEX `product_id`(`product_id`) USING BTREE,
  CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_Id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of feedback
-- ----------------------------
INSERT INTO `feedback` VALUES (2, 8, 39, 5, 'All good, thank you!');
INSERT INTO `feedback` VALUES (3, 8, 36, 5, 'lsndwdfwfw');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalog_id` int(11) NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `price` int(11) NULL DEFAULT NULL,
  `quantity` int(11) NULL DEFAULT NULL,
  `photo` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `valuta` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `catalog_id`(`catalog_id`) USING BTREE,
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`catalog_id`) REFERENCES `catalog` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (32, 4, 9, 'Macbook Pro 16 2020', 250000, 25, '[\"1612340770IMG3355.jpg\",\"1612340770macbook_pro_2019.jpg\",\"1612340770mbp16touch-space-select-201911_GEO_RU.jpg\"]', 'apple.laptops.com', '₽');
INSERT INTO `products` VALUES (33, 4, 9, 'Macbook 16 2020 Gold', 1200, 25, '[\"1612340892macbook_pro_2019.jpg\",\"1612340892mbp16touch-space-select-201911_GEO_RU.jpg\"]', 'Intel Core i7-9750H (6 Cores, 12 Threads, 2.6GHz, Turbo Boost up to 4.5GHz)\r\nIntel Core i9-9880H (8 Cores, 16 Threads, 2.3GHz, Turbo Boost up to 4.8GHz)\r\nIntel Core i9-9980HK (8 cores, 16 threads, 2.4 GHz, Turbo Boost up to 5.0 GHz)', '$');
INSERT INTO `products` VALUES (34, 1, 9, 'Iphone 12 Pro', 109000, 25, '[\"1612341085ba3e262af1b906139a78d24a18e7df6bf0899f0ef54aec4f3359bd8ddbb77d7e.jpg\",\"1612341085iPhone-12-Zach-Griff-8_large.jpeg\"]', '6.7-inch Super Retina XDR display1\r\nIncredibly durable Ceramic Shield front panel\r\nA14 Bionic, the fastest iPhone processor\r\nPro 12MP camera system: ultra wide-angle, wide-angle and telephoto; optical zoom range 5x; Night Mode, Deep Fusion, Smart HDR 3, A', '₽');
INSERT INTO `products` VALUES (35, 1, 9, 'Google Pixel 5 5G', 64000, 12, '[\"161234121266aeda1437c717171acfc01e181524971bd53239.jpg\",\"16123412121601478961_IMG_1425832.jpg\",\"1612341212google_otkleivshijsa_ot_korpusa_ekran_pixel_5_ne_uhudshaet_vodozaschitu_picture2_0.jpg\",\"1612341212nesloko_google_pixel_5.jpg\"]', 'The autonomy of the gadget allows you to maintain a built-in lithium battery with a capacity of 4000 mAh. Such energy, rationally spent on the operation of all systems, will be enough for a smartphone for a whole day of active loads. The battery supports ', '₽');
INSERT INTO `products` VALUES (36, 1, 9, 'Google Pixel 4a', 64000, 21, '[\"1612341492pixel-4.jpg\",\"1612341492tcc5715b40.jpg\",\"1612341492\\u0411\\u0435\\u0437 \\u043d\\u0430\\u0437\\u0432\\u0430\\u043d\\u0438\\u044f.jpg\"]', 'DnsShop.ru', '₽');
INSERT INTO `products` VALUES (37, 3, 9, 'Apple Ipad Mini', 500, 13, '[\"1612342447apple-ipad-mini-5-smart-cover.jpg\",\"1612342447ipad-mini-5-obzor.jpg\"]', 'GoodPay.com', '$');
INSERT INTO `products` VALUES (39, 4, 9, 'Lenovo Ideapad 155-25 ISK', 35000, 12, '[\"1612534916csm_2003588668_9229916e0b.jpg\",\"1612534916f0c4a820b72018311bce32f7f7f7e693.jpg\",\"1612534916IMG3355.jpg\"]', 'Dnsshop.ru', '₽');
INSERT INTO `products` VALUES (40, 4, 9, 'Lenovo Thinkpad', 2500, 25, '[\"1612535106Lenovo_ThinkPad_L390_Yoga_4.jpg\",\"1612535106orig (1).jpg\"]', 'Nk.ru', '$');
INSERT INTO `products` VALUES (41, 3, 9, 'Ipad mini', 35000, 12, '[\"1612535268apple-ipad-mini-8924-004.jpg\",\"1612535268ipad-mini-5-obzor.jpg\",\"1612535268mYqKAn6RCL65SSs2U3muiE.jpg\"]', 'DnsShop.com', '₽');

-- ----------------------------
-- Table structure for unavailables
-- ----------------------------
DROP TABLE IF EXISTS `unavailables`;
CREATE TABLE `unavailables`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `product_Id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `user_id`(`user_id`) USING BTREE,
  INDEX `product_Id`(`product_Id`) USING BTREE,
  CONSTRAINT `unavailables_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `unavailables_ibfk_2` FOREIGN KEY (`product_Id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of unavailables
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `surname` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `input` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (8, 'Narek', 'Hayrapetyan', 'nhayrapetyan@gmail.com', '$2y$10$1RcbQEf4X0AlLNm9u7PYxOkP6fbAceKbl5RhEozHTGMGjSdntQmzi', '0', '2021-04-21 06:52');
INSERT INTO `users` VALUES (9, 'Karen', 'Hakobyan', 'karen@gmail.com', '$2y$10$JJoPG0wKr6aqGfXjhqp0/e9fvE3y7jecebkWYJWpgV/Rub3V7h8f.', '1', '2021-03-24 09:48');
INSERT INTO `users` VALUES (10, 'Ivan', 'Ogly', 'ogly@gmail.com', '$2y$10$ChsiIBGX3T2Jp4ecWjMpB.AisoD9WeuqAZwEyXyh1B5DREdzBk4A2', '2', '2021-03-24 13:47');
INSERT INTO `users` VALUES (11, 'Manuk', 'Manukyan', 'manuk@gmail.com', '$2y$10$cQMcNENTD4tZ//ED./pYQeCHquoY5hzxStos6DZxL5i8pl.9NAyhO', '0', '2021-03-22 10:54');

SET FOREIGN_KEY_CHECKS = 1;
