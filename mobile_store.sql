/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : mobile_store

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 03/07/2022 16:00:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 36 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (27, 'Xiaomi', 'xiaomi', 'product');
INSERT INTO `categories` VALUES (31, 'Lumia', 'lumia', 'product');
INSERT INTO `categories` VALUES (32, 'Samsung', 'samsung', 'product');
INSERT INTO `categories` VALUES (35, 'I Phone', 'i-phone', 'product');

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NULL DEFAULT NULL,
  `product_id` int(11) NULL DEFAULT NULL,
  `price_buy` float NULL DEFAULT NULL,
  `quantity` int(11) NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 94 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES (90, 84, 14, 5000000, 2, '1656490653');
INSERT INTO `order_details` VALUES (91, 84, 17, 2000000, 2, '1656490653');
INSERT INTO `order_details` VALUES (92, 85, 16, 2600000, 1, '1656657462');
INSERT INTO `order_details` VALUES (93, 86, 16, 2600000, 1, '1656666079');

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NULL DEFAULT NULL,
  `total_money` float NULL DEFAULT NULL,
  `created_at` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `status` int(11) NULL DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 87 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (84, 75, 14000000, '1656490653', 2, 'Mua lu??n b???n ??i ', 'H?? Nam', '0121282282');
INSERT INTO `orders` VALUES (85, 75, 2600000, '1656657462', 2, 'fgfdg', 'H?? Nam', '0121282282');
INSERT INTO `orders` VALUES (86, 75, 2600000, '1656666079', 1, '', 'H?? Nam', '0121282282');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `images` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `price` decimal(10, 2) NULL DEFAULT NULL,
  `price_sale` decimal(10, 2) NULL DEFAULT NULL,
  `category_id` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (14, 'Samsung Galaxy S21 Ultra', 'samsung-galaxy-s21-ultra', '                                                                                                                                        ??i???n tho???i Samsung Galaxy S21 Ultra 5G 128GB                                                                                                                 ', '                                                                                                                                        S??? ?????ng c???p ???????c Samsung g???i g???m th??ng qua chi???c smartphone Galaxy S21 Ultra 5G v???i h??ng lo???t s??? n??ng c???p v?? c???i ti???n kh??ng ch??? ngo???i h??nh b??n ngo??i m?? c??n s???c m???nh b??n trong, h???a h???n ????p ???ng tr???n v???n nhu c???u ng??y c??ng cao c???a ng?????i d??ng.\r\n?????t ph?? trong thi???t k??? th???i th?????ng                                                                                                                ', 'assets/upload/1655643912_ochiro.png', 5000000.00, 5000000.00, 32);
INSERT INTO `products` VALUES (16, 'Samsung Galaxy Y', 'samsung-galaxy-y', '                                                                                    ??i???n tho???i Samsung Galaxy A20                                                                                                              ', '                                                                                    Samsung Galaxy A20 l?? chi???c m??y r??? nh???t trong d??ng Galaxy A c???a Samsung mang l???i cho ng?????i d??ng nh???ng tr???i nghi???m cao c???p c???a nh???ng chi???c m??y t???i t??? Samsung nh??ng v???n kh??ng ph???i b??? ra s??? ti???n qu?? l???n.\r\nM??n h??nh Infinity-V ho??n to??n m???i m???                                                                                                          ', 'assets/upload/1654770380_sam.jpg', 3400000.00, 2600000.00, 32);
INSERT INTO `products` VALUES (17, 'Samsung A20', 'samsung-a20', '                            ??i???n tho???i Samsung Galaxy A12 4GB (2021)                         ', '                            Galaxy A12 2021 chi???c ??i???n tho???i th??ng minh gi?? r??? ?????n t??? th????ng hi???u Samsung, n?? s??? h???u m???t c???u h??nh ???n ?????nh c??ng v???i vi??n pin dung l?????ng l???n 5000 mAh ????p ???ng ??a d???ng nhu c???u s??? d???ng c???a ng?????i ti??u d??ng.\r\nM??n h??nh l???n, m??? r???ng kh??ng gian tr???i nghi???m                                                    ', 'assets/upload/1654770410_samsung-a12-tr???ng.png', 3000000.00, 2000000.00, 32);
INSERT INTO `products` VALUES (18, 'Xiaomi Redmi Note 7', 'xiaomi-redmi-note-7', '                ??i???n tho???i Xiaomi Redmi Note 7 (4GB/64GB)', '                Xiaomi Redmi Note 7 4GB/64GB l?? chi???c smartphone gi?? r??? m???i ???????c gi???i thi???u v??o ?????u n??m 2019 v???i nhi???u trang b??? ????ng gi?? nh?? thi???t k??? notch gi???t n?????c hay camera l??n t???i 48 MP.\r\nHi???u n??ng m???nh m??? tr???i nghi???m game m?????t m??', 'assets/upload/1654782196_126551f758cd6ca321a87959e3510e2c.png', 3500000.00, 2500000.00, 27);
INSERT INTO `products` VALUES (19, '??i???n tho???i iPhone 12 Mini 64GB', 'dien-thoai-iphone-12-mini-64gb', '                                                                                                                        ??i???n tho???i iPhone 12 mini 64GB                                                                                        ', '                                                                                                                        ??i???n tho???i iPhone 12 mini 64 GB tuy l?? phi??n b???n th???p nh???t trong b??? 4 iPhone 12 series, nh??ng v???n s??? h???u nh???ng ??u ??i???m v?????t tr???i v??? k??ch th?????c nh??? g???n, ti???n l???i, hi???u n??ng ?????nh cao, t??nh n??ng s???c nhanh c??ng b??? camera ch???t l?????ng cao.                                                                                        ', 'assets/upload/1654782306_apple-iphone-12-mini-5.png', 12000000.00, 11000000.00, 35);
INSERT INTO `products` VALUES (25, '??i???n tho???i Nokia Lumia 520', 'dien-thoai-nokia-lumia-520', 'Nokia Lumia 520 ??? Smartphone Nokia gi?? r???, thi???t k??? ?????p ch???y Windows Phone 8  ', 'Nokia Lumia 520 l?? ??i???n tho???i th??ng minh ch???y Windows Phone 8 gi?? r??? nh???t hi???n nay m?? Nokia d??ng Lumia tung ra th??? tr?????ng. M??y c?? nhi???u m??u s???c tr??? trung, v?? c?? thi???t k??? kh?? ???d??? th????ng???.', 'assets/upload/1655738546_Nokia-Lumia-520-l.jpg', 2300000.00, 2000000.00, 31);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(512) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `supperAdmin` tinyint(1) NULL DEFAULT 0,
  `staff` tinyint(1) NULL DEFAULT 0,
  `avatar` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 80 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (54, 'Phan V??n Th??ng ', 'phanthang97202@gmail.com', '202cb962ac59075b964b07152d234b70', 'H?? Nam', '123344', 1, 0, 'assets/upload/1655530274_fgd.jpg');
INSERT INTO `users` VALUES (75, 'Phan B??nh', 'binh@gmail.com', '202cb962ac59075b964b07152d234b70', 'H?? Nam', '0121282282', 0, 0, 'assets/upload/1655783378_????? ?????? 206550667.jfif');
INSERT INTO `users` VALUES (78, 'Phan Li??n', 'lien@gmail.com', '202cb962ac59075b964b07152d234b70', 'H?? Nam', '1312432352', 0, 1, 'assets/upload/1655884339_157298-shhenok-labradudel-sobaka_porody-kot-pes-1080x1920.jpg');
INSERT INTO `users` VALUES (79, 'Tr???n ????nh C?????ng', 'cuong@gmail.com', '202cb962ac59075b964b07152d234b70', 'H?? Nam', '01299292191', 0, 1, 'assets/upload/1656491326_ex.png');

SET FOREIGN_KEY_CHECKS = 1;
